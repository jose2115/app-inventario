<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name' => 'Administrador', 'guard_name' => 'api']);
        Role::create(['name' => 'Operador',      'guard_name' => 'api']);
        Role::create(['name' => 'Auditor',       'guard_name' => 'api']);
        Role::create(['name' => 'Invitado',       'guard_name' => 'api']);
        
    }
}
