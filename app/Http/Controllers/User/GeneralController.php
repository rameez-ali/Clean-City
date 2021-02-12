<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
           'email' => ['required', 'string', 'email', 'max:255'],
        ]);


        Mail::raw("Name: ".$request->first_name." ".$request->last_name."\nMessage: ".$request->message, function ($message)use($request) {
            $message->to($request->email)->subject("Contact Us (".$request->subject.")");
         });
        return \response()->json(["message"=>"Your message has been sent."],200);

    }
}
