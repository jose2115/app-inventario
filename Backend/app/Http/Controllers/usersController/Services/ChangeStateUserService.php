<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChangeStateUserService
{

    public static function changeState($id){

        $user = User::findOrFail($id);

        DB::beginTransaction();

        try {

            if($user->state == 1){
                $state = 0;
            }else{
                $state = 1;
            }

            $user->state = $state;

            $user->save();

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

          DB::commit();

            

              return response()->json(['status' => 'ok' ,'data' => $user, 'smg' => Constant::USER_CHANGE_STATE]);

                    
        } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
        }

    }

   
}
