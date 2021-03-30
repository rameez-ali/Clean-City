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
use Carbon\Carbon;



class PackageBookingController extends Controller
{
    public function book(Request $request)
    {
        $validation = $request->validate([
            'service_ids' => ['required'],
            'selected_date' => ['required', 'string', 'max:255'],
            //'time_slot' => ['required', 'string', 'max:255'],
            //'time_required' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'recurrency' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'book_from' => ['required'],
            'book_to' => ['required'],
        ]);


        $packageBooking = new PackageBooking([
            'user_id' => auth()->user()->id,
            //'service_id' => $request->service_id,
            'selected_date' => $request->selected_date,
            //'time_slot' => $request->time_slot,
            //'time_required' => $request->time_required,
            'area' => $request->area,
            'recurrency' => $request->recurrency,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'book_from' => $request->book_from,
            'book_to' => $request->book_to,
        ]);

        $packageBooking->save();
        //$packageBooking->packageBookingService()->attach(['service_id'=>$request->service_ids]);
        foreach ($request->service_ids as $id) {

            $PBS = new PackageBookingService([
                'packageBooking_id' => $packageBooking->id, 'service_id' => $id
            ]);
            $PBS->save();
        }
        //return \response()->json(["data"=>$request->service_ids]);



        return \response()->json(["message" => "Your Quote Has Been Sent To Admin, We Will Get Back To You After The Review"]);
    }


    public function getOwnPackageBookingDetail(Request $request)
    {
        $packageBooking = PackageBooking::with('packageBookingService.service')->whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        return \response()->json(["data" => $packageBooking]);
    }


    public function approve(Request $request)
    {
        $packageBooking = PackageBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        if ($packageBooking != []) {
            $packageBooking->status = "approved by customer";
            return \response()->json(["status" => $packageBooking->save(), "message" => "Quote has been approved"]);
        }

        return \response()->json(["message" => "Booking not found"], 404);
    }

    public function reject(Request $request)
    {
        $packageBooking = PackageBooking::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        if ($packageBooking != []) {
            $packageBooking->status = "rejected by customer";
            return \response()->json(["status" => $packageBooking->save(), "message" => "Quote has been rejected"]);
        }
        return \response()->json(["message" => "Booking not found"], 404);
    }


    public function TimeSlot(Request $request, $datenow = "2021-03-22")
    {
        $datenow = $request->datenow;
        //$package_id=$request->package_id;
        //$limit=240;

        //$packageBooking=PackageBooking::with('packageBookingService.service')->get()->toArray();

        $slotTime = 240;

        // foreach ($packageBooking as $service ){ 

        //     //$slotTime+= $service['service']["time_required"];
        //     array_push($slotTime,$service['package_booking_service']);

        // }

        $today = Carbon::createFromFormat('Y-m-d', $datenow);
        $current_date = Carbon::createFromFormat('Y-m-d H:i:s', $datenow . ' 00:00:00');
        $toDate = Carbon::createFromFormat('Y-m-d H:i:s', $datenow . ' 00:00:00');
        $bookings = PackageBooking::all();

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
