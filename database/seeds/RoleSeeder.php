<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Administrador',
        ]);

        $permissions = Permission::pluck('id');

        $role->permissions()->attach($permissions);
    }
}
