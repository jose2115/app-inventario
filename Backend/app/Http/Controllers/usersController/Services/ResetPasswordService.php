<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordService
{

    //cambiar contraseña
    public static function reset(Request $request){
        

        $updatePassword = PasswordReset::where('token', $request->token)->first();

        if(!$updatePassword){
            return response()->json(['warning' => 'Token invalido!']);
        }

        $user = User::where('email', $updatePassword->email)->first();
        User::where('email', $updatePassword->email)->update(['password' => Hash::make($request->password)]);

        Mail::to($updatePassword->email)->send(new ResetPassword('new_url', $user->name));
        
        PasswordReset::where(['email'=> $updatePassword->email])->delete();

        

        return response()->json(['msg' => Constant::CHANGE_PASSWORD]);

    }
}
