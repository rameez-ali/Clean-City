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

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::where("email", $request->email)->first();
        if ($user) {
            $user->remember_token = mt_rand(100000, 999999);
            $user->save();
            Mail::raw("Your Password reset code is: " . $user->remember_token, function ($message) use ($user) {
                $message->to($user->email)->subject("Password reset code");
            });
            return \response()->json(["mail sent"], 200);
        }
        return \response()->json(["user not registered"], 404);
    }

    public function verifyCode(Request $request)
    {
        $user = User::where([
            ["email", '=', $request->email],
            ["remember_token", '=', $request->code],
        ])->first();
        if ($user) {
            $user->remember_token = Hash::make($user->remember_token);
            $user->save();
            return \response()->json(["status" => "verified", "token" => $user->remember_token], 200);
        }
        return \response()->json(["status" => "UnVerified"], 403);
    }

    public function updatePassword(Request $request)
    {

        $validation = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'token' => 'required',
        ]);

        $user = User::where([
            ["email", '=', $request->email],
            ["remember_token", '=', $request->token],
        ])->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->remember_token = "";
            $user->save();
            return \response()->json(["status" => "Password has been Updated"], 200);
        }
        return \response()->json(["status" => "Email doesn't exist"], 403);
    }
}
