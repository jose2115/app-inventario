<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterUserPruebaService
{

  
    public static function store($request){


        DB::beginTransaction();

          try {

            $user = new User;
            $user = self::user($request, $user);

            $user->save();

            self::assignRoles($request, $user);
               
        DB::commit();

            //$user->load(['roles']);

            return response()->json(['status' => 'ok' ,'data' => $user, 'smg' => Constant::USER_CREATE]);

            } catch (\Exception $ex) {
            
        DB::rollBack();

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }



    public static function user($request, $user){

        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->password       = Hash::make($request->password);
        $user->remember_token = Str::random(25);
        $user->state          = 1;

        return $user;

    }


    public static function assignRoles($request, $user){

        $selectedRoles = $request->selectedRoles;
        $selectedRolesCount = count($selectedRoles);
        

        for ($i = 0; $i < $selectedRolesCount; $i++) {
            $rol = $selectedRoles[$i];
            $user->assignRole($rol['name']);
        }

    }
}
