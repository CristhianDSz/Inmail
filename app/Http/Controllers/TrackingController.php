<?php

namespace App\Http\Controllers;

use App\Record;

class TrackingController extends Controller
{
    public function index()
    {
        $records = [];

        if (request()->has('record_ci')) {
            $this->validateRecord('record_ci');
            $records = Record::trackingCi(request()->input('record_ci'))->get();
        } elseif (request()->has('record_co')) {
            $this->validateRecord('record_co');
            $records = Record::trackingCo(request()->input('record_co'))->get();
        }

        return view('tracking.index', compact('records'));
    }

    public function validateRecord($input)
    {
        return request()->validate([
            $input => 'required|min:3'
        ]);
    }

    public function update(Record $record)
    {
        $status = $record->status === 'Entregado' ? 'Visado Control Interno' : 'Visado Contabilidad';
        $record->update([
            'status' => $status
        ]);

        return redirect()->back()->with(['message' => 'Registrado visado correctamente']);
    }
}
