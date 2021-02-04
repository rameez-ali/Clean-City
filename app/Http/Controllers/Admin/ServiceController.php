<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;



class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::select('id','name','created_at','status')->get();
        return response()->json(["services"=>$services],200);
    }

    public function indexToFrom(Request $request)
    {
        $from = explode("/", $request->from);
        $to = explode("/", $request->to);
        $from=$from[2]."-".$from[1]."-".$from[0];
        $to=$to[2]."-".$to[1]."-".$to[0];

        $services=Service::select('id','name','created_at','status')->whereBetween('created_at', [$from, $to])->get();
        return response()->json(["services"=>$services],200);

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
        $ext = $request->photo->extension();
        $photo = $request->photo->storeAs('images', Str::random(24) . ".{$ext}", 'public');
       

        $service= new Service([
            'name'=>$request->name,
            'description'=>$request->description,
            'validity'=>$request->validity,
            'image'=> "storage/" . $photo
        ]);

        $service->save();
        return response()->json(['status' =>"Service Added" ], 200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $service=Service::find($request->id);
        return response()->json(["service"=>$service],200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $service=Service::find($request->id);
        $ext = $request->photo->extension();
        $photo = $request->photo->storeAs('images', Str::random(24) . ".{$ext}", 'public');
        $service->name=$request->name;
        $service->name=$request->validity;
        $service->name=$request->name;
        $service->image="storage/" . $photo;
        $service->save();
        return response()->json(["status"=>"Fields updated"],200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
