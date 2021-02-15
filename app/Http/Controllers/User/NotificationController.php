<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class NotificationController extends Controller
{
    public function index(Request $request)
    {
        //$user=User::find(4);
        return response()->json(["notifications"=>$request->user()->notifications],200); 

    }
}
