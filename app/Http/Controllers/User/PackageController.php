<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PackageRequest;
use App\Models\Package;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class PackageController extends Controller
{
    public function index(Request $request)
    {
       //$user = auth()->user();
        
       //$packages = $user->packages()->latest()->get();
       $packages=PackageRequest::with('package')->where('user_id',auth()->user()->id)->get();

       return response()->json($packages);

    }


    public function packageDetail(Request $request)
    {
        $package=Package::with('packageservice.service.timeslot')->whereId($request->id)->get();
        if($package!="[]")
        {
            return \response()->json(["Package"=>$package]);
        }
        return \response()->json(["message"=>"Package doesn't exist"],404);
        



    }

    public function bookPackage(Request $request)
    {
      

        $validation =$request->validate([
            'package_id'=>['required'],
            'selected_date'=>['required'],
            'time_required'=>['required'],
            'time_slot'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
         ]);

         if($request->recurrency=="")
         {
             $request->recurrency="none";
         }
        
        $packageBooking= new PackageRequest([
            'user_id'=>auth()->user()->id,
            'package_id'=>$request->package_id,
            'selected_date'=>$request->selected_date,
            'time_required'=>$request->time_required,
            'time_slot'=>$request->time_slot,
            'recurrency'=>$request->recurrency,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ]);

        return response()->json($packageBooking->save());

    }


    public function packageBookingDetail(Request $request)
    {

        $validation =$request->validate([
            'id'=>['required'],
         ]);
        $package=PackageRequest::with('package')->where('user_id',auth()->user()->id)->where("id",$request->id)->get();
        return \response()->json($package);

    }


    public function cancelPackage(Request $request)
    {
        error_log($request->id);

        $package=PackageRequest::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $package->status="canceled";
        return response()->json(["status"=>$package->save(),"message"=>"Subscription has been canceled"]);
    }


    public function resubPackage(Request $request)
    {
        $validation =$request->validate([
            'id'=>['required'],
            'selected_date'=>['required'],
            'time_slot'=>['required'],
            'recurrency'=>['required'],
            
         ]);

         $oldPackage=PackageRequest::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        
        $packageBooking= new PackageRequest([
            'user_id'=>auth()->user()->id,
            'package_id'=>$oldPackage->package_id,
            'selected_date'=>$request->selected_date,
            'time_required'=>$oldPackage->time_required,
            'time_slot'=>$request->time_slot,
            'recurrency'=>$request->recurrency,
            'first_name'=>$oldPackage->first_name,
            'last_name'=>$oldPackage->last_name,
            'email'=>$oldPackage->email,
            'phone'=>$oldPackage->phone,
            'address'=>$oldPackage->address,
        ]);

        return response()->json($packageBooking->save());
    }


    public function allPackages(Request $request)
    {
        return response()->json(["packages"=>Package::with('packageservice.service.timeslot')->get()]);
    }


    public function availableSlots()
    {
        $current_date= Carbon::now();
        $service_duration=60;
        return $current_date;
    }



}




