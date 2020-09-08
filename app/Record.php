<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    const CURRENT_STATUS = [
        'Creado',
        'Registrado',
        'Entregado',
        'Visado Control Interno',
        'Visado Contabilidad'
    ];

    protected $fillable = [
        'datetime',
        'number',
        'type',
        'document_type',
        'document_date',
        'invoice_number',
        'status',
        'copy',
        'description',
        'attacheds',
        'third_party_id',
        'dependency_id',
        'employee_id',
    ];

    /**
     * We call the model's lifecycle events for register the record events.
     *
     * @return void
     */
    public static function booted()
    {
        self::created(function ($record) {
            RecordEvent::register(auth()->user(), $record, 'Creado');
        });

        self::updated(function ($record) {
            RecordEvent::register(auth()->user(), $record, 'Modificado');
        });

        self::deleted(function ($record) {
            RecordEvent::register(auth()->user(), $record, 'Eliminado');
        });
    }

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
        return $this->belongsTo(ThirdParty::class);
    }

    public function getFormatDatetimeAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('m-d-Y H:m');
    }

    public function scopeLastOfType($query, $type)
    {
        return $query->where('type', $type)->orderBy('id', 'desc');
    }

    public function scopeSearchRecord($query, $record)
    {
        return $query->where('type', 'LIKE', "%$record%")
            ->orWhere('status', 'LIKE', "%$record%")
            ->orWhere('number', 'LIKE', "%$record%")
            ->orWhere('document_type', 'LIKE', "%$record%")
            ->orWhereHas('thirdParty', function ($query) use ($record) {
                $query->where('name', 'LIKE', "%$record%");
            })
            ->orWhere(DB::raw('DATE_FORMAT(datetime,"%m-%d-%Y")'), 'LIKE', "%$record%");
    }

    public function scopeTrackingBy($query, $record, $status)
    {
        if (in_array($status, self::CURRENT_STATUS)) {
            return $query
                ->where('number', 'LIKE', "%$record%")
                ->where('document_type', 'Facturas')
                ->where('status', $status)
                ->with('thirdParty')
                ->with('employee.dependency');
        }

        return $query->where('number', 'LIKE', "%$record%")
            ->with('thirdParty')->with('employee.dependency');
    }

    public function scopeInvoiceNumberExists($query, $id = null, $invoice, $thirdParty)
    {
        if (!$id) {
            return $query->where('invoice_number', $invoice)
                ->where('third_party_id', $thirdParty);
        }

        return $query->where('invoice_number', $invoice)
            ->where('third_party_id', $thirdParty)->where('id', '!=', $id);
    }
}
