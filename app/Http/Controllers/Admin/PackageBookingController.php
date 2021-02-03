<?php

namespace App\Http\Controllers\Admin;

use App\Models\PackageBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;



class PackageBookingController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->status=='request')
        {
            $packageBookings=PackageBooking::with('user','service')->whereNull('quote')->get();
            return \response()->json(["packages"=>$packageBookings],200);
        }
        $packageBookings=PackageBooking::with('user','service')->whereNotNull('quote')->get();
        return \response()->json(["packages"=>$packageBookings],200);

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
     * @param  \App\Models\PackageBooking  $packageBooking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        return response()->json(["package"=>PackageBooking::find($request->id)->with('user','service')->get()],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageBooking  $packageBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageBooking $packageBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageBooking  $packageBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageBooking $packageBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageBooking  $packageBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageBooking $packageBooking)
    {
        //
    }

    public function reject(Request $request)
    {
        $package=PackageBooking::find($request->id);
        $package->status="rejected";
        $package->reason=$request->reason;
        $package->quote=-1;
        $package->save();
        return response()->json(["status"=>"Quote Rejected"],200);
    }


    public function generateQuote(Request $request)
    {
        $package=PackageBooking::find($request->id);
        $package->quote=$request->quote;
        $package->status="approved";
        $package->selected_date=$request->date;
        $package->time_slot=$request->time;
        $package->save();
        return \response()->json(["status"=>"Quote generated successfully"],200);
        

    }
}
