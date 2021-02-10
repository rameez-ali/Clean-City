<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user="";
       
        if($request->blocked=='true')
        {
           
            $users=User::select('id','first_name','last_name','email','created_at')->where('role_id','!=','1')->where('status','=','blocked')->get();
        }
        else
        {
            
            $users=User::select('id','first_name','last_name','email','created_at')->where('role_id','!=','1')->where('status','=','active')->paginate(10);


        }
        return response()->json(["users"=>$users],200);
    }

    public function indexToFrom(Request $request)
    {

        $request->validate([
            'to'=>'required',
            'from'=>'required',
            
        ]);
       
        $from = explode("/", $request->from);
        $to = explode("/", $request->to);
        $from=$from[2]."-".$from[0]."-".$from[1];
        $to=$to[2]."-".$to[0]."-".$to[1];
 
        $user="";
       
        if($request->blocked=='true')
        {
          
            $users=User::select('id','first_name','last_name','email','created_at')->where('role_id','!=','1')->where('status','=','blocked')->whereBetween('created_at', [$from, $to])->get();
        }
        else
        {
            $users=User::select('id','first_name','last_name','email','created_at')->whereBetween('created_at', [new Carbon($from), new Carbon($to)])->where('role_id','!=','1')->where('status','=','active')->get();
            error_log($users);  

        }
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

        $request->validate([
            'first_name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'price'=>'required'
        ]);
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

        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required',
            'retype_password'=>'required',
            
        ]);
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

        $request->validate([
            'email'=>'required',
            'password'=>'required',
            ]);
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

    public function singleUser(Request $request)
    {
        $user=User::find($request->id);

        return response()->json(["user"=>$user],200); 
    }
    


    public function profilephoto(Request $request)
    {
        $request->validate([
            'photo'=>'required',
            
        ]);
        $user = User::find(Auth::user()->id);
        //$profile = Profile::where('user_id', $request->user)->first();
        $ext = $request->photo->extension();
        $photo = $request->photo->storeAs('images', Str::random(24) . ".{$ext}", 'public');
        $user->image = "storage/" . $photo;
        $user->save();
        return response()->json(['status' =>"Picture uploaded" ], 200); 
    }

    public function blockuser(Request $request){
        $user=User::find($request->id);

        if($request->status=='block')
        {
            $user->status="blocked";
            $user->save();
            return response()->json(["status"=>"User Blocked"],200);

        }
    
            $user->status="active";
            $user->save();
            return response()->json(["status"=>"User Unblocked"],200);
    
       
    }


    public function searchUser(Request $request)
    {

        if($request->blocked=='true')
        {
           
            $users=User::select('id','first_name','last_name','email','created_at')->where('first_name','LIKE',"%$request->search%")->where('role_id','!=','1')->where('status','=','blocked')->get();
        }
        else
        {
            
            $users=User::select('id','first_name','last_name','email','created_at')->where('first_name','LIKE',"%$request->search%")->where('role_id','!=','1')->where('status','=','active')->get();


        }
        return response()->json(["users"=>$users],200);

    }


    public function storeFCM(Request $request)
    {
        $user=User::find($request->user()->id);
        $user->FCM_token=$request->fcm;
        return \response()->json(["status"=>$user->save()],200);
    }
}
