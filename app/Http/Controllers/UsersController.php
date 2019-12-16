<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $this->authorize('view',auth()->user());

        $roles = Role::all(['id', 'name']);
        $users = User::where('id','!=',auth()->user()->id)->has('roles')->with('roles')->orderBy('username')->withTrashed()->get();
        return view('users.index', compact('roles', 'users'));
    }

    public function create()
    {
        $this->authorize('create',User::class);

        $roles = Role::all(['id', 'name']);
        return view('users.create', compact('roles'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::all(['id', 'name']);
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        $this->authorize('update',$user);
       
        $attributes = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required'
        ]);

        $user->update($attributes);

        $user->roles()->sync(request()->input('roles'));

        return redirect()->route('users.index')->with([
            'message' => 'Usuario editado correctamente'
        ]);
    }

    public function restore($user)
    {
        $this->authorize('update',$user);

        $userTrashed = User::withTrashed()->findOrFail($user);

        if ($userTrashed->trashed()) {
            $userTrashed->restore();
        }

        return redirect()->route('users.index')->with([
            'message' => 'Usuario restaurado correctamente'
        ]);

    }

    public function editPassword()
    {
        return view('auth.passwords.edit');
    }

    public function updatePassword(User $user)
    {
        abort_if($user->id !== auth()->id(),403);

        $attributes = request()->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $attributes['password'] = bcrypt($attributes['password']);

        $user->update($attributes);
        
        return redirect()->back()->with(['message' => 'Contraseña actualizada correctamente']);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        
        $user->delete();
        
        return redirect()->route('users.index')->with(['message' => 'Usuario deshabilitado correctamente']);
    }
}
