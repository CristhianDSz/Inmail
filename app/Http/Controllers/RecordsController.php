<?php

namespace App\Http\Controllers;

use App\Record;
use PDF;

class RecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function render()
    {
        return view('correspondence.index');
    }

    public function index()
    {
        return Record::orderBy('type')->orderBy('number')->get();
    }

    public function store()
    {
        $quantity = 1;
        $records = [];
        if (request()->exists('quantity')) {
            $quantity = request('quantity');
        }

        $attributes = request()->validate([
            'type' => 'required',
            'document_type' => '',
            'document_date' => '',
            'invoice_number' => '',
            'description' => '',
            'attacheds' => '',
            'third_party_id' => '',
            'dependency_id' => '',
            'employee_id' => '',
            'status' => '',
            'copy' => '',
        ]);

        unset($attributes['quantity']);


        for ($i = 0; $i < $quantity; $i++) {
            $lastRecord = Record::getLast($attributes['type'])->first();
            $recordString = Record::makeNewRecordString($attributes['type']);
            $number = Record::makeRecordNumber($lastRecord, $recordString);

            $attributes['number'] = $number;

            $savedRecord = Record::create($attributes);

            $records[] = Record::where('id', $savedRecord->id)->first();
        }

        return response()->json(['message' => 'Registros creados correctamente', 'records' => $records]);
    }

    public function update(Record $record)
    {
        $attributes = request()->validate([
            'number' => 'required',
            'type' => 'required',
            'document_type' => 'required',
            'document_date' => 'required',
            'invoice_number' => '',
            'description' => 'required',
            'attacheds' => 'required',
            'third_party_id' => 'required',
            'dependency_id' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
            'copy' => '',
        ]);

        $record->update($attributes);
        return response()->json(['message' => 'Registro actualizado correctamente']);
    }

    public function destroy(Record $record)
    {
        $record->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }

    public function getPdf()
    {

        $records = request()->all();

        $counter = 0;
        //return view('records.pdf', compact('records'));
        $pdf = PDF::loadView('records.pdf', compact('records', 'counter'));

        return $pdf->download('radicados.pdf');
    }
}
