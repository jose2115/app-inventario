<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{

    public static function change($request){

        DB::beginTransaction();

        try {

           // Obtener el usuario autenticado
            $user = Auth::user();

            // Verificar que la contraseña actual sea correcta
            if (!Hash::check($request->oldPassword, $user->password)) {

                return response()->json(['smg' => "Contraseña incorrecta"]);

            }

            // Cambiar la contraseña del usuario
            $user = User::findOrFail($user->id);
            $user->password = Hash::make($request->newPassword);
            $user->save();

          DB::commit();

            return response()->json(['smg' => "Se cambio la contraseña"]);

                    
        } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
        }

    }

   
}
