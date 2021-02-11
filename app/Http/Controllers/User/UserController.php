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




class UserController extends Controller
{
    public function signup(Request $request)
    {

        //$request->validate

        $validation =$request->validate([

            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
         ]);

            $user= new User([
                "first_name"=>$request->first_name,
                "last_name"=>$request->last_name,
                "address"=>$request->address,
                "phone"=>$request->phone,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
            ]);
            return \response()->json(["status"=>$user->save(),"user"=>$user],200);
    }


    public function login(Request $request)
    {
        $validation= $request->validate([
            'email'=>['required', 'string', 'email', 'max:255'],
            'password'=>'required',
            'device_id'=>'required',
            ]);
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    $token = Str::random(80);
                    Auth::user()->api_token = $token;
                    Auth::user()->FCM_token=$request->device_id;
                    Auth::user()->save();
                    
                    return response()->json(['token' => $token, 'user' => Auth::user()], 200);
                }
                return response()->json(["status" => "Incorrect Details"], 403);
        
    }


    








    

}
