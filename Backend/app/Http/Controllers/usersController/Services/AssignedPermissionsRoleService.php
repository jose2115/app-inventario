<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class AssignedPermissionsRoleService
{

    public static function assignedPermissions($role_id, $permisions_id, $action){


        DB::beginTransaction();

          try {

            if($action == 'true'){

              self::addPermissions($role_id, $permisions_id);

            }elseif($action == 'false'){

              self::lessPermissions($role_id, $permisions_id);

            }
            
            //agregar evento para auditar aqui
               
          DB::commit();

          return response()->json(['status' => 'ok' , 'smg' => Constant::ROLE_PERMISSIONS_ASSIGNED ]);

                    
            } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


    public static function addPermissions($role_id, $permisions_id)
    {
        $role = Role::find($role_id);
        $permission = Permission::findOrFail($permisions_id);
        $role->givePermissionTo($permission);

    }

    public static function lessPermissions($role_id, $permisions_id)
    {
      $role = Role::find($role_id);
      $permission = Permission::findOrFail($permisions_id);
      $role->revokePermissionTo($permission);

      /* $roleAndPermission = RoleHasPermission::where(['permission_id' => $permisions_id, 'role_id' => $role_id])->first();
      $roleAndPermission->delete(); */

    }

}
