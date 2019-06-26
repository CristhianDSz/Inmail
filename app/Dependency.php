<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependency extends Model
{
    protected $fillable = ['name', 'code'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
