<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    protected $fillable = [
        'name',
        'style',
        'color',
        'dateFormat',
        'registrationFormat',
        'midTitle',
        'footerTitle',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
