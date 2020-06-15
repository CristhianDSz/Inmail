<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Inmail Administrator',
            'username' => 'inmail',
            'email' => 'cristhiandsanchez@gmail.com',
            'password' => bcrypt('qwerty12345'),
        ]);

        $role = Role::first()->id;
        $user->roles()->attach($role);
    }
}