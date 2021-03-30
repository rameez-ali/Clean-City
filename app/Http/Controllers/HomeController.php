<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function demo_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName'      => 'required|',
            'email'     => 'required|email',
            'subject'   => 'required',
            'message'   => 'required',
        ], [
            'fullName.required'     => 'Please provide name',
            'email.required'         => 'Please provide email',
            'email.email'       => 'Please provide valid email',
            'subject.required'  => 'Please provide subject',
            'message.required'  => 'Please provide message'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => $validator->errors()->messages(),
                    'msg' => 'Please fill all the required fields.'
                ],
                401
            );
        }


        Mail::raw("Name: " . $request->fullName . "\nMessage: " . $request->message . "\nEmail: " . $request->email, function ($message) use ($request) {
            $message->to('support@majesticares.com')->subject("Contact Us (" . $request->subject . ")");
        });

        Mail::raw("Name: " . $request->fullName . "\nMessage: " . $request->message . "\nEmail: " . $request->email, function ($message) use ($request) {
            $message->to('maxwilson908@gmail.com')->subject("Contact Us (" . $request->subject . ")");
        });

        Mail::raw("Thank you contacting us. We will get back to you soon", function ($message) use ($request) {
            $message->to($request->email)->subject("Contact us (support@majesticares.com) ");
        });
        return \response()->json(["message" => "Your message has been sent."], 200);
    }
}
