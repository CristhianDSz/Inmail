<?php

namespace App\Http\Controllers;

use App\RecordEvent;

class RecordEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('view', RecordEvent::class);

        $events =  RecordEvent::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('events.index', compact('events'));
    }
}
