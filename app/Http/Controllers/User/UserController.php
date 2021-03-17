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


    public function index()
    {

        return \response()->json(auth()->user());


    }

    public function editUser(Request $request)
    {
        $validation =$request->validate([

            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'image'=>'required'
         ]);


        
        $user = auth()->user();
        if($request->image)
        {
            $ext = $request->image->extension();
            $photo = $request->image->storeAs('images', Str::random(24) . ".{$ext}", 'public');
            $user->image = "storage/" . $photo;
        }
        
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->address=$request->address;
       
        return response()->json(['status' => $user->save() ], 200); 

    }


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
        
        if($request->image)
        {
            $ext = $request->image->extension();
            $photo = $request->image->storeAs('images', Str::random(24) . ".{$ext}", 'public');
            $user->image = "storage/" . $photo;
        }


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


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required',
            'retype_password'=>'required',
            
        ]);
        $user=auth()->user();
        if(Hash::check($request->current_password,$user->password))
        {
            if($request->new_password==$request->retype_password)
            {
                $user->password=Hash::make($request->new_password);
                $user->save();
                return response()->json(["status"=>"Password Updated"],200);
            }
            return response()->json(["status"=>"New Password and Confirm password must match"],401);
        }
        return response()->json(["status"=>"incorrect current password"],401);
    }


    


    





    

}
