<?php

namespace App\Http\Controllers\usersController\Services;

use App\Constants\Constant;
use App\Models\Permission;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ListPermissionsRoleService
{

    public static function listPermissions($id){

        DB::beginTransaction();

          try {

            $role =  Role::findOrFail($id);

            $permissions = Permission::all();

            foreach ($permissions as $permission) {

              $permission->checked = self::checkPermision($id, $permission->id);
            }
            

               
          DB::commit();

              return response()->json(['status' => 'ok' , 'data' => $permissions, 'smg' => Constant::ROLE_PERMISSIONS_LIST]);

                    
            } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


    public static function checkPermision($rol, $permission)
    {

      $permission = RoleHasPermission::where(['permission_id' => $permission, 'role_id' => $rol])->get();

      if($permission != '[]'){

        return true;
      }

      return false;

    }


}
