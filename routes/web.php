<?php

use Illuminate\Support\Facades\Route;
use App\Events\Hello;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return view('admin.admin');
});

Route::get('/', function () {
    return response()->json("home");;
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/broadcast', function () {
    broadcast(new Hello());
});


Route::post('/contactUs_demo', function (Request $request) {

    // $request->validate([

    //     'full_name' => ['required', 'string', 'max:255'],
    //     'subject' => ['required', 'string', 'max:255'],

    //     'message' => ['required', 'string', 'max:255'],
    //     'email' => ['required', 'string', 'email', 'max:255'],
    // ]);


    Mail::raw("Name: " . $request->fullName . "\nMessage: " . $request->message, function ($message) use ($request) {
        $message->to($request->email)->subject("Contact Us (" . $request->subject . ")");
    });
    return \response()->json(["message" => "Your message has been sent."], 200);
});
