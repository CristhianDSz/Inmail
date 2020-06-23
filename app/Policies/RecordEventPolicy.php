<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\PermissionPolicy;

class RecordEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the record events.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function view(User $user)
    {
        return PermissionPolicy::hasPermission($user, 'show record event');
    }
}
