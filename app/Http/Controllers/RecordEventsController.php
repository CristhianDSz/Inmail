<?php

namespace App\Http\Controllers;

use App\RecordEvent;
use Illuminate\Http\Request;

class RecordEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events =  RecordEvent::with('user')->orderBy('created_at')->paginate(15);
        return view('events.index', compact('events')); 
    }
}
