<?php

namespace App\Validators;

class RecordValidator
{

    public function rules($record)
    {
        return [
            'id'             => $record->exists ? 'required' : '',
            'type'           => 'required',
            'document_type'  => $record->exists ? 'required' : '',
            'document_date'  => $record->exists ? 'required' : '',
            'invoice_number' => '',
            'description'    => $record->exists ? 'required' : '',
            'attacheds'      => $record->exists ? 'required' : '',
            'third_party_id' => $record->exists ? 'required' : '',
            'dependency_id'  => $record->exists ? 'required' : '',
            'employee_id'    => $record->exists ? 'required' : '',
            'status'         => $record->exists ? 'required' : '',
            'copy'           => '',
            'quantity'       => ''
        ];
    }

    public function validate($data, $record)
    {
        return validator($data, $this->rules($record))->validate();
    }
}
