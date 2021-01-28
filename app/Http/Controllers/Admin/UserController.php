<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('role_id','!=','1')->get();
        return response()->json(["users"=>$users],200);
    }

    public function indexToFrom(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        

        $users=User::where('role_id','!=','1')->whereBetween('created_at', [$from, $to])->get();
        error_log($users);
        return response()->json(["users"=>$users],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user=User::find(Auth::user()->id);
        $user->first_name=$request->first_name;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->save();
        return response()->json(["status"=>"User Data updated"],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changepassword(Request $request)
    {
        $user=User::find(Auth::user()->id);
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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //$photo = Profile::where('user_id', Auth::user()->id)->first();
            $token = Str::random(80);
            Auth::user()->api_token = $token;
            Auth::user()->save();
            $admin = Auth::user()->isAdmin();

            return response()->json(['token' => $token, 'user' => Auth::user(), 'isadmin' => $admin], 200);
        }

        return response()->json(["status" => "Incorrect Details"], 403);
    }

    public function verify(Request $request)
    {
        return $request->user(); 
    }


    public function userdata(Request $request)
    {
        return response()->json(["user"=>$request->user()],200); 
    }
    


    public function profilephoto(Request $request)
    {
        $user = User::find(Auth::user()->id);
        //$profile = Profile::where('user_id', $request->user)->first();
        $ext = $request->photo->extension();
        $photo = $request->photo->storeAs('images', Str::random(24) . ".{$ext}", 'public');
        $user->image = "storage/" . $photo;
        $user->save();
        return response()->json(['status' =>"Picture uploaded" ], 200); 
    }
}
