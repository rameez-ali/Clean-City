<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceBooking;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Mail\ServiceApproved as ServiceApprovedMail ;
use App\Notifications\ServiceApproved;
use Illuminate\Support\Facades\Mail;
use App\Events\Hello;
use Illuminate\Support\Facades\Auth;



class ServiceBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $serviceBooking= ServiceBooking::with('user','service')->where('first_name','LIKE',"%$request->search%")->get();
        return \response()->json(["services"=>$serviceBooking],200);
    }


    public function indextofrom(Request $request)
    {

        $request->validate([
            'to'=>'required',
            'from'=>'required',
            
        ]);


        $from = explode("/", $request->from);
        $to = explode("/", $request->to);
        $from=$from[2]."-".$from[0]."-".$from[1];
        $to=$to[2]."-".$to[0]."-".$to[1];

        $serviceBooking= ServiceBooking::with('user','service')->whereBetween('created_at', [$from, $to])->get();
        return \response()->json(["services"=>$serviceBooking],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceBooking  $serviceBooking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response()->json(["servicebooking"=>ServiceBooking::find($request->id)->with('user','service')->get()],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceBooking  $serviceBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceBooking $serviceBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceBooking  $serviceBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceBooking $serviceBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceBooking  $serviceBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceBooking $serviceBooking)
    {
        //
    }


    public function approveReject(Request $request)
    {
        $serviceBooking=ServiceBooking::find($request->id);
        $user=User::find($serviceBooking->user_id);
        if($request->status=='approve')
        {
            $serviceBooking->status=$request->status;
            $serviceBooking->quote=$request->quote;
            $serviceBooking->reason=null;
          //  Mail::to($serviceBooking->email)->send(new ServiceApprovedMail($serviceBooking));
          \Notification::route('mail', $serviceBooking->email)->notify(new ServiceApproved($serviceBooking));

            $user->notify(new ServiceApproved($serviceBooking));
            broadcast(new Hello());
            return response()->json(["status"=>$serviceBooking->save()],200);



        }
       // error_log($serviceBooking->user_id);

        $serviceBooking->quote=null;
        $serviceBooking->status=$request->status;
        $serviceBooking->reason=$request->reason;
       
        //Mail::to($serviceBooking->email)->send(new ServiceApprovedMail($serviceBooking));


        \Notification::route('mail', $serviceBooking->email)->notify(new ServiceApproved($serviceBooking));
        

        $user->notify(new ServiceApproved($serviceBooking));
        //$request->user()->notify(new ServiceApproved($serviceBooking));
        broadcast(new Hello());
        $test= new NotificationController();
        $test->sendToDesktop(Auth::user(),"Testing notification");
        return response()->json(["status"=>$serviceBooking->save()."--",$test ],200);
        //\Notification::send($request);

        

        

    }
}
