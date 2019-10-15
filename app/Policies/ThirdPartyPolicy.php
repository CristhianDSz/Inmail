<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\PermissionPolicy;


class ThirdPartyPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function view(User $user)
    {
        return PermissionPolicy::hasPermission($user, "show third_parties");
    }

    /**
     * Determine whether the user can create third parties.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return PermissionPolicy::hasPermission($user, "create third_parties");
    }

    /**
     * Determine whether the user can update the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function update(User $user)
    {
        return PermissionPolicy::hasPermission($user, "edit third_parties");
        
    }

    /**
     * Determine whether the user can delete the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function delete(User $user)
    {
        return PermissionPolicy::hasPermission($user, "delete third_parties");
    }

}
