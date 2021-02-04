<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;



class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages=Package::select('id','name','created_at','status')->get();
        return response()->json(["packages"=>$packages],200);

    }


    public function indexToFrom(Request $request)
    {

        $from = explode("/", $request->from);
        $to = explode("/", $request->to);
        $from=$from[2]."-".$from[1]."-".$from[0];
        $to=$to[2]."-".$to[1]."-".$to[0];


        $packages=Package::select('id','name','created_at','status')->whereBetween('created_at', [$from, $to])->get();
        return response()->json(["packages"=>$packages],200);
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
    public function store(Request $request, Package $package)
    {
        
        return response()->json(["status"=>$package->fill($request->only($package->getFillable()))->save()],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response()->json(["package"=>Package::find($request->id)],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $package= Package::find($request->id);
        $package->name=$request->name;
        $package->description=$request->description;
        $package->price=$request->price;
        $package->recurrency=$request->recurrency;
        // $package->save();
        return response()->json(["status"=>$package->save()],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }


   public function packagestatus(Request $request)
   {
       $package=Package::find($request->id);
       if($request->status=='inactive')
       {
           $package->status=$request->status;
           return response()->json(["status"=>$package->save()],200);
       }
        $package->status=$request->status;
        return response()->json(["status"=>$package->save()],200);

   }
}
