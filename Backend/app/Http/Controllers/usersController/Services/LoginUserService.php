<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class LoginUserService
{

  public static function login($request){

    try {


      $user = User::whereEmail($request->email)->first();

      if($user->state == 0){

        return response()->json(['error' => 'Usuario No activo!'], 300);

      }


        if(!is_null($user) && Hash::check($request->password, $user->password)){

            //crear el token
            $token = $user->createToken('zpp');

            $user->load(['roles']);

            $roles = $user->roles->pluck('name')->toArray();
            
            $permissions = $user->roles->flatMap->permissions->pluck('name')->unique()->toArray();

            $data = [
               'name' => $user->name,
               'email' => $user->email
            ];
            

            return response()->json(
              [
                'status'    => 'ok' ,
                'data'      => $data,
                'roles'     => $roles, 
                'permisos'  => $permissions, 
                'token'     => $token->plainTextToken,  
                'smg'       => Constant::WELCOME
              ]);

                                                                         
        }else{

            return response()->json(['error' => 'Correo o contraseña incorrectos!'], 300);
        }

    } catch (\Exception $ex) {
      //throw $th;
      return response()->json(['error' => $ex]);
    }

    
   
  }

}