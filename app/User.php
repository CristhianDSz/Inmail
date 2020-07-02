<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function existentRole($id)
    {
        foreach ($this->roles->pluck('id') as $idRole) {
            if ($idRole ===  $id) {
                return true;
            }
        }
    }

    //Pendiente refactorizar con colecciones
    public function allPermissions()
    {
        $permissions = [];
        $roles = $this->roles()->get();

        foreach ($roles as $role) {
            foreach ($role->permissions()->get() as $permission) {
                $permissions[] = $permission->name;
            }
        }

        return $permissions;
    }

    /**
     * A user can register one or more record events
     *
     * @return void
     */
    public function recordEvents()
    {
        return $this->hasMany(RecordEvent::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
