<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'show users', 'description' => 'Listar usuarios']);
        Permission::create(['name' => 'create users', 'description' => 'Crear usuarios']);
        Permission::create(['name' => 'edit users', 'description' => 'Editar usuarios']);
        Permission::create(['name' => 'delete users', 'description' => 'Eliminar usuarios']);
        Permission::create(['name' => 'show roles', 'description' => 'Listar roles']);
        Permission::create(['name' => 'create roles', 'description' => 'Crear roles']);
        Permission::create(['name' => 'edit roles', 'description' => 'Editar roles']);
        Permission::create(['name' => 'delete roles', 'description' => 'Eliminar roles']);
        Permission::create(['name' => 'show third_parties', 'description' => 'Listar terceros']);
        Permission::create(['name' => 'create third_parties', 'description' => 'Crear terceros']);
        Permission::create(['name' => 'edit third_parties', 'description' => 'Editar terceros']);
        Permission::create(['name' => 'delete third_parties', 'description' => 'Eliminar terceros']);
        Permission::create(['name' => 'show dependencies', 'description' => 'Listar dependencias']);
        Permission::create(['name' => 'create dependencies', 'description' => 'Crear dependencias']);
        Permission::create(['name' => 'edit dependencies', 'description' => 'Editar dependencias']);
        Permission::create(['name' => 'delete dependencies', 'description' => 'Eliminar dependencias']);
        Permission::create(['name' => 'show employees', 'description' => 'Listar empleados']);
        Permission::create(['name' => 'create employees', 'description' => 'Crear empleados']);
        Permission::create(['name' => 'edit employees', 'description' => 'Editar empleados']);
        Permission::create(['name' => 'delete employees', 'description' => 'Eliminar empleados']);
        Permission::create(['name' => 'show records', 'description' => 'Listar registros']);
        Permission::create(['name' => 'create records', 'description' => 'Crear registros']);
        Permission::create(['name' => 'edit records', 'description' => 'Editar registros']);
        Permission::create(['name' => 'delete records', 'description' => 'Eliminar registros']);

        Permission::create(['name' => 'validate control', 'description' => 'Visado control interno']);
        Permission::create(['name' => 'validate accounting', 'description' => 'Visado contabilidad']);
        Permission::create(['name' => 'create company', 'description' => 'Crear compañía']);
        Permission::create(['name' => 'edit company', 'description' => 'Editar compañía']);
    }
}
