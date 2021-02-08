<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;



class NotificationController extends Controller
{
    public function adminNotification(Request $request)
    {
        //$user=User::find(4);
        return response()->json(["notifications"=>$request->user()->unreadNotifications],200); 

    }



    public function markAsRead(Request $request)
    {
        return \response()->json(["status"=>$request->user()->unreadNotifications->where('id', $request->id)->markAsRead()],200);
    }




}
