<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class UsersController extends Controller
{
    public function index()
    {

        $roles = Role::all(['id', 'name']);
        return view('users.index', compact('roles'));
    }
}
