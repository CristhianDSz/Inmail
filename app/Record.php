<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'date',
        'hour',
        'number',
        'date',
        'type',
        'document_type',
        'document_date',
        'invoice_number',
        'description',
        'attacheds',
        'third_party_id',
        'dependency_id',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function dependency()
    {
        return $this->belongsTo(Dependency::class, 'dependency_id');
    }

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class, 'third_party_id');
    }
}
