<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\PermissionPolicy;

class CompanyPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function view(User $user)
    {
        return PermissionPolicy::hasPermission($user,'show company');
        
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return PermissionPolicy::hasPermission($user,'create company');
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function update(User $user)
    {
        return PermissionPolicy::hasPermission($user,'edit company');
        
    }
}
