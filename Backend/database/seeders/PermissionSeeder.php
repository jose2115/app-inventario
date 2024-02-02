<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::create(['name' => 'see_history',              'guard_name' => 'api']);
        Permission::create(['name' => 'load_file',              'guard_name' => 'api']);

        Permission::create(['name' => 'create_inventario',        'guard_name' => 'api']);
        Permission::create(['name' => 'update_inventario',        'guard_name' => 'api']);
        Permission::create(['name' => 'see_inventario',           'guard_name' => 'api']);
        Permission::create(['name' => 'delete_inventario',        'guard_name' => 'api']);

        Permission::create(['name' => 'see_configuration',     'guard_name' => 'api']);

        Permission::create(['name' => 'see_products',     'guard_name' => 'api']);

        Permission::create(['name' => 'export_inventario',     'guard_name' => 'api']);

        Permission::create(['name' => 'see_permission',         'guard_name' => 'api']);
        Permission::create(['name' => 'asing_permission',        'guard_name' => 'api']);
        Permission::create(['name' => 'asing_role',             'guard_name' => 'api']);

        Permission::create(['name' => 'create_categoria',        'guard_name' => 'api']);
        Permission::create(['name' => 'update_categoria',        'guard_name' => 'api']);
        Permission::create(['name' => 'delete_categoria',        'guard_name' => 'api']);
        Permission::create(['name' => 'see_categoria',           'guard_name' => 'api']);

        Permission::create(['name' => 'create_users',           'guard_name' => 'api']);
        Permission::create(['name' => 'update_users',           'guard_name' => 'api']);
        Permission::create(['name' => 'delete_users',           'guard_name' => 'api']);
        Permission::create(['name' => 'see_users',              'guard_name' => 'api']);

        

        
    }
}
