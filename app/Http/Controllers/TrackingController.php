<?php

namespace App\Http\Controllers;

use App\Record;

class TrackingController extends Controller
{
    public function index()
    {
        // return  Record::trackingBy(request()->input('record_ci'),'Entregado')->get();
        $records = Record::where('status','Entregado')->where('document_type','Facturas')->get();

        if (request()->has('record_ci')) {
            $this->validateRecord('record_ci');
            $records = Record::trackingBy(request()->input('record_ci'),'Entregado')->get();
        } elseif (request()->has('record_co')) {
            $this->validateRecord('record_co');
            $records = Record::trackingBy(request()->input('record_co'),'Visado Control Interno')->get();
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
