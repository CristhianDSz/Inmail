<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'identification', 'email', 'phone', 'address', 'logo', 'print_logo'];

    protected $hidden = ['created_at', 'updated_at'];


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function stickers()
    {
        return $this->hasMany(Sticker::class);
    }
}
