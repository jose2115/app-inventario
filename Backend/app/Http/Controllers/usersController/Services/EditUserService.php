<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EditUserService
{

    public static function update(Request $request, $id){

        $user = User::findOrFail($id);
        $user = self::user($request, $user);

        DB::beginTransaction();

        try {

            $user->save();


            self::assignRoles($request, $user);


               
          DB::commit();

          $user->load(['roles']);

            if ($user->roles->isNotEmpty()) {
                $rolesNames = $user->roles->pluck('name')->implode(', ');
                $user->rol .= '(' . $rolesNames . ')';
            }

            $user = [
                'id' => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'roles' => $user->rol,
                'state' => $user->state
            ];

              return response()->json(['status' => 'ok' ,'data' => $user, 'smg' => Constant::USER_UPDATE]);

                    
        } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
        }

    }



    public static function user($request, $user){

        $user->name      = $request->name;
        $user->email     = $request->email;

        if($request->password){

            $user->password  = Hash::make($request->password);
        }
        

        return $user;

    }

 

    public static function assignRoles($request, $user){

        $selectedRoles = $request->selectedRoles;
        $selectedRolesCount = count($selectedRoles);

        $user->syncRoles([]);
        
        for ($i = 0; $i < $selectedRolesCount; $i++) {
            $rol = $selectedRoles[$i];
            $user->assignRole($rol['name']);
        }

    }
}
