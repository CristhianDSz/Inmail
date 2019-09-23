<?php

namespace App\Policies;

use App\User;

class PermissionPolicy {

     /**
     * Determine if the user ($user) has a permission action ($name)
     *
     * @param User $user
     * @param string $name
     * @return boolean
     */
    public static function hasPermission(User $user, $name)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name === $name) {
                    return true;
                }
            }
        }

        return false;
    }
}