<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\FAQ;
use App\Models\Package;
use App\Models\Service;
use App\Models\General;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Mail;


class GeneralController extends Controller
{
    public function contactUs(Request $request)
    {
        $validation =$request->validate([

           'first_name' => ['required', 'string', 'max:255'],
           'last_name' => ['required', 'string', 'max:255'],
           'subject' => ['required', 'string', 'max:255'],
           'message' => ['required', 'string', 'max:255'],
           'phone' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255'],
        ]);


        Mail::raw("Name: ".$request->first_name." ".$request->last_name."\nMessage: ".$request->message."\nPhone: ".$request->phone, function ($message)use($request) {
            $message->to($request->email)->subject("Contact Us (".$request->subject.")");
         });
        return \response()->json(["message"=>"Your message has been sent."],200);

    }


    public function faqs()
    {
        return \response()->json(["data"=>FAQ::all()]);
    }

    public function home()
    {
        $banner=General::find(1)->select("banner")->first();
        $service=Service::whereStatus("active")->get();
        $package=Package::whereStatus("active")->get();
        return \response()->json(["banner"=>$banner,"services"=>$service,"packages"=>$package]);
    }
}
