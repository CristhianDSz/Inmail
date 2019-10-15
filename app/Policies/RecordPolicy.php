<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\PermissionPolicy;

class RecordPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the record.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function view(User $user)
    {
        return PermissionPolicy::hasPermission($user, "show records");
    }

    /**
     * Determine whether the user can view the records.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAccounting(User $user)
    {
        return PermissionPolicy::hasPermission($user, "validate accounting");
        
    }

    /**
     * Determine whether the user can view the record.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function viewControl(User $user)
    {
        return PermissionPolicy::hasPermission($user, "validate control");
        
    }

    /**
     * Determine whether the user can create records.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return PermissionPolicy::hasPermission($user, "create records");
    }

    /**
     * Determine whether the user can update the record.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function update(User $user)
    {
        return PermissionPolicy::hasPermission($user, "edit records");
    }

    /**
     * Determine whether the user can delete the record.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function delete(User $user)
    {
        return PermissionPolicy::hasPermission($user, "delete records");
    }

    /**
     * Determine whether the user can restore the record.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function restore(User $user)
    {
        //Implementar solo si es necesario
    }

    /**
     * Determine whether the user can permanently delete the record.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //Implementar solo si es necesario
    }
}
