<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Record extends Model
{
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
        return $this->belongsTo(ThirdParty::class, 'third_party_id');
    }

    public function scopeGetLast($query, $type)
    {
        return $query->where('type', $type)->orderBy('id', 'desc');
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
}
