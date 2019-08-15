<?php

namespace App\Http\Controllers;

use App\Company;
use App\Record;
use Carbon\Carbon;
use PDF;

class FormatsController extends Controller
{
    public function index()
    {

        $firstDate =  Carbon::today()->toDateString();
        $secondDate =  Carbon::today()->toDateString();

        $todayRecords = Record::whereRaw('DATE(datetime) between ? and ? ', [$firstDate, $secondDate]);

        if (request()->has('first_date')) {
            $firstDate = request('first_date');
            $todayRecords = Record::whereRaw('DATE(datetime) between ? and ? ', [$firstDate, $secondDate]);
        }

        if (request()->has('second_date')) {
            $secondDate = request('second_date');
            $todayRecords = Record::whereRaw('DATE(datetime) between ? and ? ', [$firstDate, $secondDate]);
        }

        $todayRecords = $todayRecords->where('type', 'Entrada')->where('status', 'Registrado')->with('thirdParty')->with('employee');
        $todayRecords = $todayRecords->get();


        return view('formats.index', compact('firstDate', 'secondDate', 'todayRecords'));
    }

    public function getPdf($first_date, $second_date)
    {
        $company = Company::first();
        $records = Record::whereRaw('DATE(datetime) between ? and ? ', [$first_date, $second_date])->where('type', 'Entrada')->where('status', 'Registrado')->orderBy('datetime', 'desc')->with('thirdParty')->with('employee')->get()->sortBy('employee.firstname');

        // return view('formats.pdf', compact('records', 'company'));
        $pdf = PDF::loadView('formats.pdf', compact('records', 'company'));

        return $pdf->download('planilla.pdf');
    }
}
