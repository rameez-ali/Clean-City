<?php

namespace App\Http\Controllers\Admin;

use App\Models\PackageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;



class PackageRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $packageRequest=PackageRequest::with('user.first_name','user.last_name','user.email','date_created','status')->get();
        $packageRequest=PackageRequest::with(['user','package'])->get();
        return response()->json(["packageRequests"=>$packageRequest],200);

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
     * @param  \App\Models\PackageRequest  $packageRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PackageRequest $packageRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageRequest  $packageRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageRequest $packageRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageRequest  $packageRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageRequest $packageRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageRequest  $packageRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageRequest $packageRequest)
    {
        //
    }
}
