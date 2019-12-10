<?php

namespace App\Http\Controllers;

use App\Record;

class TrackingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $records = Record::where('document_type','Facturas');

        if (auth()->user()->can('viewControl', Record::class) && 
            auth()->user()->can('viewAccounting', Record::class)) {
                $records = $records->where('status','Entregado')->orWhere('status','Visado Control Interno');
        }
        elseif (auth()->user()->can('viewControl', Record::class)) {
            $records = $records->where('status','Entregado');
        }

        elseif (auth()->user()->can('viewAccounting', Record::class)) {
            $records = $records->where('status','Visado Control Interno');
        }

        $records = $records->paginate(15);

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
