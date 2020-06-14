<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\PermissionPolicy;


class DependencyPolicy
{
    use HandlesAuthorization;
    

    /**
     * Determine whether the user can view the dependency.
     *
     * @param  \App\User  $user
     * @param  \App\Dependency  $dependency
     * @return mixed
     */
    public function view(User $user)
    {
        return PermissionPolicy::hasPermission($user, "show dependencies");
        
    }

    /**
     * Determine whether the user can create dependencies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return PermissionPolicy::hasPermission($user, "create dependencies");
        
    }

    /**
     * Determine whether the user can update the dependency.
     *
     * @param  \App\User  $user
     * @param  \App\Dependency  $dependency
     * @return mixed
     */
    public function update(User $user)
    {
        return PermissionPolicy::hasPermission($user, "edit dependencies");
        
    }

    /**
     * Determine whether the user can delete the dependency.
     *
     * @param  \App\User  $user
     * @param  \App\Dependency  $dependency
     * @return mixed
     */
    public function delete(User $user)
    {
        return PermissionPolicy::hasPermission($user, "delete dependencies");
    }
  
}
