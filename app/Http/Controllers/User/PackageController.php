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


class PackageController extends Controller
{
    public function index(Request $request)
    {
       //$user = auth()->user();
        
       //$packages = $user->packages()->latest()->get();
       $packages=PackageRequest::with('package')->where('user_id',auth()->user()->id)->get();

       return response()->json($packages);

    }

    public function bookPackage(Request $request)
    {

        $validation =$request->validate([
            'package_id'=>['required'],
            'selected_date'=>['required'],
            'time_required'=>['required'],
            'time_slot'=>['required'],
            'recurrency'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
         ]);
        
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



}




