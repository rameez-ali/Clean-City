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
use Carbon\Carbon;



class ServiceController extends Controller
{

    public function allServices(Request $request)
    {
        // if($request->name!="")
        // {
        //     return \response()->json(["services"=>Service::with('timeslot')->where('name','LIKE',"%$request->name%")->get()]);

        // }
        // return \response()->json(["services"=>Service::with('timeslot')->get()]);


        if ($request->name != "") {
            return \response()->json(["services" => Service::where('name', 'LIKE', "%$request->name%")->get()]);
        }
        return \response()->json(["services" => Service::get()]);
    }


    public function serviceDetail(Request $request)
    {
        $service = Service::find($request->id);
        if ($service) {
            return \response()->json(["Service" => $service]);
        }
        return \response()->json(["message" => "Service doesn't exist"], 404);
    }



    // public function index(Request $request)
    // {
    //     $user = auth()->user();

    //     $services = $user->services('service')->latest()->get();

    //     return response()->json($services);
    // }

    public function index(Request $request)
    {

        if ($request->id) {
            $services = ServiceBooking::with('service')->where('user_id', auth()->user()->id)->where('service_id', $request->id)->get();
        } else {
            $services = ServiceBooking::with('service')->where('user_id', auth()->user()->id)->get();
        }
        return response()->json($services);
    }

    public function bookservice(Request $request)
    {

        $validation = $request->validate([
            'service_id' => ['required'],
            'selected_date' => ['required'],
            //'time_required'=>['required'],
            //'time_slot'=>['required'],
            'recurrency' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'book_from' => ['required'],
            'book_to' => ['required'],

        ]);

        //  if(Timeslot::where("service_id",$request->service_id)->where("id",$request->time_slot)->first() !=null)
        //  {
        $serviceBooking = new ServiceBooking([
            'user_id' => auth()->user()->id,
            'service_id' => $request->service_id,
            'selected_date' => $request->selected_date,
            //'time_required'=>$request->time_required,
            // 'time_slot'=>0,
            'recurrency' => $request->recurrency,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'book_from' => $request->book_from,
            'book_to' => $request->book_to,

        ]);
        $serviceBooking->save();
        return \response()->json(["message" => "Your Service request has been submitted!"]);


        //}









    }


    public function serviceBookingDetail(Request $request)
    {
        $validation = $request->validate([
            'id' => ['required'],
        ]);
        $service = ServiceBooking::with('service')->where('user_id', auth()->user()->id)->where("id", $request->id)->first();
        return \response()->json($service);
    }

    public function rejectService(Request $request)
    {

        $validation = $request->validate([
            'id' => ['required'],
            'reason' => ['required'],

        ]);

        $service = ServiceBooking::where('id', $request->id)->where('user_id', auth()->user()->id)->get();
        $service->status = "Rejected by user";
        $service->reason = $request->reason;


        return \response()->json($service->save());
    }

    public function reject(Request $request)
    {
        $serviceBooking = ServiceBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $serviceBooking->status = "rejected by customer";
        $serviceBooking->reason = $request->reason;
        return \response()->json(["status" => $serviceBooking->save(), "message" => "service has been rejected"]);
    }


    public function cancel(Request $request)
    {
        $serviceBooking = ServiceBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $serviceBooking->status = "canceled by customer";
        $serviceBooking->reason = "canceled by customer";
        return \response()->json(["status" => $serviceBooking->save(), "message" => "service has been canceled"]);
    }



    public function TimeSlot(Request $request, $datenow = "2021-03-22", $service_id = 1)
    {
        $datenow = $request->datenow;
        $service_id = $request->service_id;
        $service = Service::find($service_id);
        $slotTime = "$service->time_required";
        $today = Carbon::createFromFormat('Y-m-d', $datenow);
        $current_date = Carbon::createFromFormat('Y-m-d H:i:s', $datenow . ' 00:00:00');
        $toDate = Carbon::createFromFormat('Y-m-d H:i:s', $datenow . ' 00:00:00');
        $bookings = ServiceBooking::whereService_id($service_id)->get();



        $timeslot = [];


        while ($today->format('Y-m-d') == $current_date->format('Y-m-d')) {
            $toDate->addMinutes($slotTime);
            array_push($timeslot, $current_date . " " . $toDate);
            $current_date->addMinutes($slotTime);
        }

        foreach ($bookings as $booking) {
            $removeDate = $booking->book_from . " " . $booking->book_to;




            if (($key = array_search($removeDate, $timeslot)) !== false) {
                unset($timeslot[$key]);
            }
        }

        $timeslot = array_values($timeslot);
        $all_slots = [];
        foreach ($timeslot as $time) {
            $times = explode(" ", $time);
            $time_from = $times[0] . " " . $times[1];
            $time_to = $times[2] . " " . $times[3];
            $final_slot = [$time_from, $time_to];
            array_push($all_slots, $final_slot);
        }



        return $all_slots;
    }
}
