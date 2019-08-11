<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class UsersController extends Controller
{
    public function index()
    {

        $roles = Role::all(['id', 'name']);
        $users = User::has('roles')->with('roles')->orderBy('username')->get();
        return view('users.index', compact('roles', 'users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all(['id', 'name']);
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user->update($attributes);

        $user->roles()->sync(request()->input('roles'));

        return redirect()->route('users.index')->with([
            'message' => 'Usuario editado correctamente'
        ]);
    }
}
