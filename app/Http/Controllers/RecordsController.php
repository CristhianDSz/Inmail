<?php

namespace App\Http\Controllers;

use App\Record;
use App\RecordEvent;
use App\Domain\Services\InvoiceService;
use App\Validators\RecordValidator;
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
        $this->authorize('view', Record::class);

        return Record::orderBy('datetime', 'DESC')->orderBy('number')
            ->with('employee:id,firstname,lastname')
            ->with('thirdParty:id,name')
            ->with('dependency:id,name')
            ->paginate(15);
    }

    public function search($record)
    {
        return Record::searchRecord($record)
            ->with('employee:id,firstname,lastname')
            ->with('thirdParty:id,name')
            ->with('dependency:id,name')
            ->get();
    }

    public function store()
    {
        $this->authorize('create', Record::class);

        $quantity = 1;
        $records = [];
        if (request()->exists('quantity')) {
            $quantity = request('quantity');
        }

        $attributes = (new RecordValidator)->validate(request()->all(), new Record());

        //Test before if a thirdparty invoice number's exists
        if (InvoiceService::invoiceExists(null, $attributes['invoice_number'], $attributes['third_party_id'])) {
            return response()->json(['message' => 'Este número de factura ya existe para el tercero'], 400);
        }

        for ($i = 0; $i < $quantity; ++$i) {
            $lastRecord = Record::getLast($attributes['type'])->first();
            $attributes['number'] = Record::makeRecord($lastRecord, $attributes['type']);
            $savedRecord = Record::create($attributes);
            $record = Record::where('id', $savedRecord->id)->first();
            $records[] = $record;
        }

        return response()->json(['message' => 'Registros creados correctamente', 'records' => $records]);
    }

    public function update(Record $record)
    {
        $this->authorize('update', $record);

        $attributes = (new RecordValidator)->validate(request()->all(), $record);

        //Test before if a thirdparty invoice number's exists
        if (InvoiceService::invoiceExists($attributes['id'], $attributes['invoice_number'], $attributes['third_party_id'])) {
            return response()->json(['message' => 'Este número de factura ya existe para el tercero'], 400);
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
}
