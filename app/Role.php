<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getPermissionsListAttribute()
    {
        return $this->permissions->pluck('id');
    }

    public function existentPermission($id)
    {
        foreach ($this->permissions->pluck('id') as $idPermission) {
            if ($idPermission ===  $id) {
                return true;
            }
        }
    }
}
