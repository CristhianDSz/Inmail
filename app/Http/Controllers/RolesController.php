<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index()
    {
        $this->authorize("view", Role::class);

        $permissions = Permission::get(['description', 'id']);
        $roles = Role::has('permissions')->get();
        return view('roles.index', [
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }

    public function store()
    {
        $this->authorize("create", Role::class);

        $attributes = request()->validate([
            'name' => 'required|min:3|string'
        ]);

        request()->validate([
            'permissions' => 'required'
        ]);

        $permissionsIds = request()->input('permissions');

        $role = Role::create($attributes);

        $role->permissions()->attach($permissionsIds);


        return redirect()->back()->with([
            'message' => 'Rol creado correctamente'
        ]);
    }

    public function edit(Role $role)
    {
        $this->authorize("update",$role);

        $permissions = Permission::get(['description', 'id']);
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Role $role)
    {
        $this->authorize("update",$role);

        $attributes = request()->validate([
            'name' => 'required|min:3|string'
        ]);

        request()->validate([
            'permissions' => 'required'
        ]);

        $permissionsIds = request()->input('permissions');

        $role->update($attributes);

        $role->permissions()->sync($permissionsIds);

        return redirect()->route('roles.index')->with([
            'message' => 'Rol actualizado correctamente'
        ]);
    }
}
