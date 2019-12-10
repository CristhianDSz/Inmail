<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    const CURRENT_STATUS = ['Creado', 'Registrado', 'Entregado', 'Visado Control Interno', 'Visado Contabilidad'];

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

    public function scopeGetLast($query, $type)
    {
        return $query->where('type', $type)->orderBy('id', 'desc');
    }

    public function scopeSearchRecord($query, $record)
    {
        return $query->where('type','LIKE',"%$record%")
                        ->orWhere('status','LIKE',"%$record%")
                        ->orWhere('number','LIKE',"%$record%")
                        ->orWhere('document_type','LIKE',"%$record%")
                        ->orWhereHas('thirdParty', function ($query) use ($record) {
                            $query->where('name','LIKE',"%$record%");
                        })
                        ->orWhere(DB::raw('DATE_FORMAT(datetime,"%m-%d-%Y")'),'LIKE',"%$record%");
    }

    public function scopeTrackingBy($query, $record, $status)
    {
        if (in_array($status,self::CURRENT_STATUS)) {

            return $query->where('number', 'LIKE', "%$record%")->where('document_type','Facturas')->where('status', $status)->with('thirdParty')->with('employee.dependency');
        } 
    }

    public static function makeRecordNumber($record = null, $recordString)
    {
        $digits = null;
        if (!$record) {
            $digits = '001';
        } else {
            $recordSequence = (int) explode("-", $record->number)[1];
            $digits = (int) $recordSequence + 1;
        }

        $zerosToLeft = 0;
        while (strlen($digits) < 3) {
            $zerosToLeft++;
            $digits = str_pad($digits, $zerosToLeft, "0", STR_PAD_LEFT);
        }

        return $recordString . "{$digits}";
    }

    public static function makeNewRecordString($record)
    {
        $currentYear = Carbon::now()->year;
        $yearToString = (string) $currentYear;
        $recordYear = substr($yearToString, -3);

        $newRecordNumber = null;
        if ($record == 'Entrada') {
            $newRecordNumber = 'E' . $recordYear . "-";
        } else {
            $newRecordNumber = 'S' . $recordYear . "-";
        }
        return $newRecordNumber;
    }

    public function getFormatDatetimeAttribute()
    {
        return Carbon::parse($this->datetime)->format('d/m/Y');
    }

    public function scopeInvoiceNumberExists($query, $id=null, $invoiceNumber, $thirdParty)
    {
        if (!$id) {
            return $query->where('invoice_number',$invoiceNumber)->where('third_party_id',$thirdParty);
        }
        return $query->where('invoice_number',$invoiceNumber)->where('third_party_id',$thirdParty)->where('id','!=',$id);
        
    }
}
