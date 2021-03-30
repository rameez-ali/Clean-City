<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public testing api

Route::middleware('cors')->post('/contactUs_demo', function (Request $request) {
    //dd($request);
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

//

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Auth::routes();


Route::group(['prefix' => 'admin'], function () {

    Route::post('/login', 'App\Http\Controllers\Admin\UserController@login')->name('login');
    // Route::post('/login', 'App\Http\Controllers\Admin\UserController@login')->name('login');


    Route::group(['middleware' => ['auth:api'], 'namespace' => 'App\Http\Controllers\Admin'], function () {

        //FCM
        Route::post('/storeFCM', 'UserController@storeFCM');

        //UserManagement
        Route::get('/verify', 'UserController@verify');
        Route::get('/userdata', 'UserController@userdata');
        Route::post('/editUser', 'UserController@update');
        Route::post('/changepassword', 'UserController@changepassword');
        Route::post('/profilephoto', 'UserController@profilephoto');
        Route::get('/getallusers', 'UserController@index');
        Route::get('/searchUser', 'UserController@searchUser');
        Route::get('/getalluserstofrom', 'UserController@indexToFrom');
        Route::post('/blockuser', 'UserController@blockuser');
        Route::get('/user', 'UserController@singleUser');

        //Services
        Route::get('/getallservices', 'ServiceController@index');
        Route::get('/service', 'ServiceController@show');
        Route::post('/addservice', 'ServiceController@store');
        Route::post('/updateService', 'ServiceController@update');
        Route::get('/servicetofrom', 'ServiceController@indexToFrom');

        //Package
        Route::get('/getallpackages', 'PackageController@index');
        Route::post('/addpackage', 'PackageController@store');
        Route::get('/package', 'PackageController@show');
        Route::get('/packageToFrom', 'PackageController@indexToFrom');
        Route::put('/package', 'PackageController@update');
        Route::post('/packagestatus', 'PackageController@packagestatus');

        //PackageRequests
        Route::get('/getallPackageRequests', 'PackageRequestController@index');
        Route::get('/PackageRequests', 'PackageRequestController@show');
        Route::post('/approveRejectPackage', 'PackageRequestController@acceptOrReject');
        Route::get('/PackageRequeststofrom', 'PackageRequestController@indexToFrom');

        //ServiceBooking
        Route::get('/getallServiceRequests', 'ServiceBookingController@index');
        Route::get('/ServiceRequests', 'ServiceBookingController@show');
        Route::post('/approveRejectService', 'ServiceBookingController@approveReject');
        Route::get('/ServiceRequeststofrom', 'ServiceBookingController@indextofrom');

        //PackageBookings
        Route::get('/getallpackagebookings', 'PackageBookingController@index');
        Route::get('/getpackagequote', 'PackageBookingController@show');
        Route::post('/rejectQuote', 'PackageBookingController@reject');
        Route::post('/generateQuote', 'PackageBookingController@generateQuote');
        Route::get('/getpackagequoteToFrom', 'PackageBookingController@indexToFrom');


        //Feedback
        Route::get('/getallfeedbacks', 'FeedbackController@index');
        Route::get('/getfeedback', 'FeedbackController@show');
        Route::post('/deletefeedback', 'FeedbackController@destroy');
        Route::get('/getfeedbackToFrom', 'FeedbackController@indexToFrom');

        //Notifications
        Route::get('/getunreadnotifications', 'NotificationController@adminNotification');
        Route::post('/markAsRead', 'NotificationController@markAsRead');
    });
});


//User


Route::group(['prefix' => 'user'], function () {




    //Authenticaton
    Route::post('/signup', 'App\Http\Controllers\User\UserController@signup');
    Route::post('/login', 'App\Http\Controllers\User\UserController@login');
    Route::post('/forgotPassword', 'App\Http\Controllers\User\ForgotPasswordController@forgotPassword');
    Route::post('/verifyCode', 'App\Http\Controllers\User\ForgotPasswordController@verifyCode');
    Route::post('/updatePassword', 'App\Http\Controllers\User\ForgotPasswordController@updatePassword');

    //General
    Route::post('/contactUs', 'App\Http\Controllers\User\GeneralController@contactUs');
    Route::get('/faqs', 'App\Http\Controllers\User\GeneralController@faqs');
    Route::get('/home', 'App\Http\Controllers\User\GeneralController@home');



    //Services
    Route::get('/services', 'App\Http\Controllers\User\ServiceController@allServices');
    Route::get('/serviceDetail', 'App\Http\Controllers\User\ServiceController@serviceDetail');

    //Packages
    Route::get('/packages', 'App\Http\Controllers\User\PackageController@allPackages');
    Route::get('/packageDetail', 'App\Http\Controllers\User\PackageController@packageDetail');



    Route::group(['middleware' => ['auth:api'], 'namespace' => 'App\Http\Controllers\User'], function () {
        //General
        Route::post('/changeRecurrency', 'GeneralController@change_Recurrency');





        //User
        Route::get('/userInfo', 'UserController@index');
        Route::post('/updateProfile', 'UserController@editUser');
        Route::post('/changePassowrd', 'UserController@changePassword');


        //Service
        Route::get('/myservices', 'ServiceController@index');
        Route::get('/myserviceDetail', 'ServiceController@serviceBookingDetail');
        Route::post('/bookservice', 'ServiceController@bookservice');
        Route::post('/rejectservice', 'ServiceController@reject');
        Route::post('/cancelservice', 'ServiceController@cancel');
        Route::get('/serviceSlots', 'ServiceController@TimeSlot');





        //Package
        Route::get('/mypackages', 'PackageController@index');
        Route::get('/mypackageDetail', 'PackageController@packageBookingDetail');
        Route::post('/bookpackage', 'PackageController@bookPackage');
        Route::post('/resubpackage', 'PackageController@resubPackage');
        Route::post('/cancelpackage', 'PackageController@cancelPackage');
        Route::get('/packageSlots', 'PackageController@TimeSlot');



        //Own Package Booking
        Route::post('/bookownPackage', 'PackageBookingController@book');
        Route::get('/ownpackageDetail', 'PackageBookingController@getOwnPackageBookingDetail');
        Route::post('/approvequote', 'PackageBookingController@approve');
        Route::post('/rejectquote', 'PackageBookingController@reject');
        Route::get('/ownPackageSlots', 'PackageBookingController@TimeSlot');



        //Notificaiton
        Route::get('/notifications', 'NotificationController@index');
    });
});
