<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DependenciesController extends Controller
{
    public function render()
    {
        return view('dependencies.index');
    }
    public function index()
    { }
}
