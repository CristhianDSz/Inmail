<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['identification', 'firstname', 'lastname', 'dependency_id'];

    public function dependency()
    {
        return $this->belongsTo(Dependency::class);
    }
}
