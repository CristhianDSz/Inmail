<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    protected $append = ['total'];

    protected $fillable = [
        'name',
        'qr_style',
        'qr_color',
        'date_format',
        'registration_title',
        'mid_title',
        'footer_title',
        'is_default',
        'company_id'
    ];

    public function getTotalAttribute()
    {
        return $this->count();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
