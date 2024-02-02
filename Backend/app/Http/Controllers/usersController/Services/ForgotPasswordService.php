<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Mail\ForgotPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordService
{

     //recuperar contraseña
     public static function forgot($request) {

        $token = Str::random(64);

        $password_reset = PasswordReset::where('email', $request->email)->first();

        if ($password_reset !== null) {

            $password_reset->update([
                'email' => $request->email, 
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

        } else {
            PasswordReset::create(
                [
                    'email' => $request->email, 
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );
        }

        $new_url = config('app.domain_reset').(string) $token;

        $user = self::user($request->email); 

        Mail::to($request->email)->send(new ForgotPassword($new_url, $user->name));

        return response()->json(['msg' => Constant::FORGOT_PASSWORD]);
 
        
    }


    public static function user($email){

        $user = User::where('email' ,$email)
        ->first();

        return $user;
    }
}
