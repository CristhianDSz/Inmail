<?php

namespace App\Policies;

use App\User;
use App\ThirdParty;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThirdPartyPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any third parties.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function view(User $user, ThirdParty $thirdParty)
    {
        //
    }

    /**
     * Determine whether the user can create third parties.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function update(User $user, ThirdParty $thirdParty)
    {
        //
    }

    /**
     * Determine whether the user can delete the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function delete(User $user, ThirdParty $thirdParty)
    {
        //
    }

    /**
     * Determine whether the user can restore the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function restore(User $user, ThirdParty $thirdParty)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the third party.
     *
     * @param  \App\User  $user
     * @param  \App\ThirdParty  $thirdParty
     * @return mixed
     */
    public function forceDelete(User $user, ThirdParty $thirdParty)
    {
        //
    }
}
