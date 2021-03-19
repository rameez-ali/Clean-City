<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Mail;
use App\Models\Timeslot;



class ServiceController extends Controller
{

    public function allServices(Request $request)
    {
        if($request->name!="")
        {
            return \response()->json(["services"=>Service::with('timeslot')->where('name','LIKE',"%$request->name%")->get()]);

        }
        return \response()->json(["services"=>Service::with('timeslot')->get()]);


    }


    public function serviceDetail(Request $request)
    {
        $service=Service::with("timeslot")->find($request->id);
        if($service)
        {
            return \response()->json(["Service"=>$service]);
        }
        return \response()->json(["message"=>"Service doesn't exist"],404);
        

    }



    public function index(Request $request)
    {
       $user = auth()->user();

       $services = $user->services('service')->latest()->get();

       return response()->json($services);

    }

    public function bookservice(Request $request)
    {

        $validation =$request->validate([
            'service_id'=>['required'],
            'selected_date'=>['required'],
            //'time_required'=>['required'],
            'time_slot'=>['required'],
            'recurrency'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
         ]);

         if(Timeslot::where("service_id",$request->service_id)->where("id",$request->time_slot)->first() !=null)
         {
            $serviceBooking= new ServiceBooking([
                'user_id'=>auth()->user()->id,
                'service_id'=>$request->service_id,
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

            return \response()->json($serviceBooking->save());


         }

         return \response()->json(["message"=>"Invalid Timeslot"],404);


        
       

        

    }


    public function serviceBookingDetail(Request $request)
    {
        $validation =$request->validate([
            'id'=>['required'],
         ]);
         $service=ServiceBooking::with('service','timeslot')->where('user_id',auth()->user()->id)->where("id",$request->id)->get();
         return \response()->json($service);

    }

    public function rejectService(Request $request)
    {

        $validation =$request->validate([
            'id'=>['required'],
            'reason'=>['required'],
            
         ]);

         $service=ServiceBooking::where('id',$request->id)->where('user_id',auth()->user()->id)->get();
         $service->status="Rejected by user";
         $service->reason=$request->reason;
         

        return \response()->json($service->save());

    }

    public function reject(Request $request)
    {
        $serviceBooking=ServiceBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $serviceBooking->status="rejected by customer";
        $serviceBooking->reason=$request->reason;
        return \response()->json(["status"=>$serviceBooking->save(),"message"=>"service has been rejected"]);
    }


    public function cancel(Request $request)
    {
        $serviceBooking=ServiceBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $serviceBooking->status="canceled by customer";
        $serviceBooking->reason="canceled by customer";
        return \response()->json(["status"=>$serviceBooking->save(),"message"=>"service has been canceled"]);
    }

}
