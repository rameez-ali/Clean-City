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
        if ($request->id) {
            $packages = PackageRequest::with('package')->where('user_id', auth()->user()->id)->where('package_id', $request->id)->get();
        } else {
            $packages = PackageRequest::with('package')->where('user_id', auth()->user()->id)->get();
        }
        return response()->json($packages);
    }


    public function packageDetail(Request $request)
    {
        $package = Package::with('packageservice.service')->whereId($request->id)->first();
        if ($package != "[]") {
            return \response()->json(["Package" => $package]);
        }
        return \response()->json(["message" => "Package doesn't exist"], 404);
    }

    public function bookPackage(Request $request)
    {


        $validation = $request->validate([
            'package_id' => ['required'],
            'selected_date' => ['required'],
            //'time_required'=>['required'],
            //'time_slot'=>['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'book_from' => ['required'],
            'book_to' => ['required'],
        ]);

        if ($request->recurrency == "") {
            $request->recurrency = "none";
        }

        $packageBooking = new PackageRequest([
            'user_id' => auth()->user()->id,
            'package_id' => $request->package_id,
            'selected_date' => $request->selected_date,
            //'time_required'=>$request->time_required,
            //'time_slot'=>$request->time_slot,
            'recurrency' => $request->recurrency,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'book_from' => $request->book_from,
            'book_to' => $request->book_to,
        ]);

        return response()->json($packageBooking->save());
    }


    public function packageBookingDetail(Request $request)
    {

        $validation = $request->validate([
            'id' => ['required'],
        ]);
        $package = PackageRequest::with('package')->where('user_id', auth()->user()->id)->where("id", $request->id)->get();
        return \response()->json($package);
    }


    public function cancelPackage(Request $request)
    {
        error_log($request->id);

        $package = PackageRequest::whereId($request->id)->whereUser_id(auth()->user()->id)->first();
        $package->status = "canceled";
        return response()->json(["status" => $package->save(), "message" => "Subscription has been canceled"]);
    }


    public function resubPackage(Request $request)
    {
        $validation = $request->validate([
            'id' => ['required'],
            'selected_date' => ['required'],
            'time_slot' => ['required'],
            'recurrency' => ['required'],

        ]);

        $oldPackage = PackageRequest::whereId($request->id)->whereUser_id(auth()->user()->id)->first();

        $packageBooking = new PackageRequest([
            'user_id' => auth()->user()->id,
            'package_id' => $oldPackage->package_id,
            'selected_date' => $request->selected_date,
            'time_required' => $oldPackage->time_required,
            'time_slot' => $request->time_slot,
            'recurrency' => $request->recurrency,
            'first_name' => $oldPackage->first_name,
            'last_name' => $oldPackage->last_name,
            'email' => $oldPackage->email,
            'phone' => $oldPackage->phone,
            'address' => $oldPackage->address,
        ]);

        return response()->json($packageBooking->save());
    }


    public function allPackages(Request $request)
    {
        if ($request->name) {
            return response()->json(["packages" => Package::with('packageservice.service')->where('name', 'LIKE', "%$request->name%")->get()]);
        }
        return response()->json(["packages" => Package::with('packageservice.service')->get()]);
    }


    public function TimeSlot(Request $request, $datenow = "2021-03-22", $package_id = 1)
    {
        $datenow = $request->datenow;
        $package_id = $request->package_id;

        $package = Package::with('packageservice.service')->whereId($package_id)->get()->toArray();

        $slotTime = 0;

        foreach ($package[0]['packageservice'] as $service) {

            $slotTime += $service['service']["time_required"];
        }

        $today = Carbon::createFromFormat('Y-m-d', $datenow);
        $current_date = Carbon::createFromFormat('Y-m-d H:i:s', $datenow . ' 00:00:00');
        $toDate = Carbon::createFromFormat('Y-m-d H:i:s', $datenow . ' 00:00:00');
        $bookings = PackageRequest::wherePackage_id($package_id)->get();

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

        // $all_slots = json_encode($all_slots);

        return $all_slots;
    }


    public function myPackageBookings(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $bookings = PackageRequest::with('package')->where('user_id', auth()->user()->id)->where('package_id', $request->id)->get();
        return \response()->json(['bookings' => $bookings]);
    }
}
