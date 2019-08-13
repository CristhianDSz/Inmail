<?php

namespace App\Http\Controllers;

use App\Record;
use Carbon\Carbon;

class FormatsController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::today()->toDateString();
        $todayRecords = Record::whereRaw('DATE(datetime) = ?', [$currentDate])->where('type', 'Entrada')->where('status', 'Registrado')->orderBy('datetime', 'desc')->with('thirdParty')->with('employee')->get();
        return view('formats.index', compact('currentDate', 'todayRecords'));
    }

    public function filter()
    {
        $attributes = request()->validate([
            'first_date' => 'required',
            'second_date' => 'required'
        ]);
    }
}
