<?php

namespace App\Http\Controllers;

use App\Record;

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

            Record::create($attributes);
        }

        return response()->json(['message' => 'Registros creados']);
    }

    public function update()
    { }

    public function destroy()
    { }
}
