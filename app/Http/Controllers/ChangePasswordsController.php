<?php

namespace App\Http\Controllers;


class ChangePasswordsController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('change_passwords.edit', compact('user'));
    }
}
