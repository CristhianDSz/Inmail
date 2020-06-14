<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThirdParty extends Model
{
    protected $fillable = ['name', 'address', 'city', 'identification', 'telephone', 'email_contact'];
}
