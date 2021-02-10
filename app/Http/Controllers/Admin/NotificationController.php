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

    public function sendToDesktop($user,$title)
    {
        if ($user->FCM_token) {
            $serverKey = 'AAAAs9pWjCc:APA91bEfuu0ovHOMvgPFdOGsQ3HUd1y2TnRnh-RC0vbM0ITVn_0z-G5g7vnW8QCsG4Vuzq9wZ-8nJa5FoQl70fdEdf1nwgot1L-b1XD2zgKjYfIW8sv9_X0aRhO_JaVDu0oHBJMm1t1L';
            $fields = array(
            // "content_available" => true,
            "to" => $user->FCM_token,
            'priority' => 'high',
            "data" => array(
            "title" =>$title
            ),
            "notification" => array(
                "title" => $title,
                ),
            
            );
            $data_string = json_encode($fields);
            $headers = array('Authorization: key=' . $serverKey, 'Content-Type: application/json');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            $result = curl_exec($ch);
            curl_close($ch);
            error_log($result);
            return $result;
            }
            

    }

    




}
