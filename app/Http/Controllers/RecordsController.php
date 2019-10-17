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
        //return Record::invoiceNumberExists('12345',2)->first();
        return view('correspondence.index');
    }

    public function index()
    {
        $this->authorize('view', Record::class);
        
        return Record::orderBy('datetime','DESC')->orderBy('number')->with('employee:id,firstname,lastname')->with('thirdParty:id,name')->with('dependency:id,name')->get();
    }

    public function store()
    {
        $this->authorize('create', Record::class);

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
        //Test before if a thirdparty invoice number's exists
        if ( $this->inoviceNumberExists(null,$attributes['invoice_number'],$attributes['third_party_id'])) {
            return response()->json(['message' => 'Este número de factura ya existe para el tercero'],400);
        }

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
        $this->authorize('update', $record);

        $attributes = request()->validate([
            'id' => 'required|numeric',
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
        //Test before if a thirdparty invoice number's exists
        if ($this->inoviceNumberExists($attributes['id'],$attributes['invoice_number'],$attributes['third_party_id'])) {
            return response()->json(['message' => 'Este número de factura ya existe para el tercero'],400);
        }

        $record->update($attributes);

        return response()->json(['message' => 'Registro actualizado correctamente']);
    }

    public function destroy(Record $record)
    {
        $this->authorize('delete', $record);
        $record->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }

    public function getPdf()
    {
        $records = request()->all();
        $counter = 0;
        $pdf = PDF::loadView('records.pdf2', compact('records', 'counter'));
        return $pdf->download('radicados.pdf');
    }

    public function inoviceNumberExists($idRecord = null, $invoiceNumber, $thirdParty)
    {
        if ($invoiceNumber !== null && $thirdParty !== null) {
            return Record::invoiceNumberExists($idRecord, $invoiceNumber,$thirdParty)->first();
        }
        return false;
    }

}
