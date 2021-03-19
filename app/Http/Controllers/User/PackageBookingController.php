<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PackageBooking;
use App\Models\PackageBookingService;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Mail;


class PackageBookingController extends Controller
{
    public function book(Request $request)
    {
        $validation =$request->validate([
            'service_ids' => ['required'],
            'selected_date' => ['required', 'string', 'max:255'],
            'time_slot' => ['required', 'string', 'max:255'],
            'time_required' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'recurrency' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
         ]);


         $packageBooking= new PackageBooking([
            'user_id' => auth()->user()->id, 
            //'service_id' => $request->service_id,
            'selected_date' => $request->selected_date,
            'time_slot' => $request->time_slot,
            'time_required' => $request->time_required,
            'area' => $request->area,
            'recurrency' => $request->recurrency,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email
         ]);

        // $packageBooking->

         return \response()->json(["status"=>$packageBooking->save(),"message"=>"Your Quote Has Been Sent To Admin, We Will Get Back To You After The Review"]);
 
    }


    public function getOwnPackageBookingDetail(Request $request)
    {
        $packageBooking=PackageBooking::with('packageBookingService.service')->whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        return \response()->json(["data"=>$packageBooking]);

    }


    public function approve(Request $request)
    {
        $packageBooking=PackageBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $packageBooking->status="approved by customer";
        return \response()->json(["status"=>$packageBooking->save(),"message"=>"Quote has been approved"]);
    }

    public function reject(Request $request)
    {
        $packageBooking=PackageBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $packageBooking->status="rejected by customer";
        return \response()->json(["status"=>$packageBooking->save(),"message"=>"Quote has been rejected"]);
    }
}


