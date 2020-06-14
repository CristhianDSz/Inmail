<?php

namespace App\Http\Controllers;

use App\Dependency;

class DependenciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function render()
    {
        return view('dependencies.index');
    }

    public function index()
    {
        $this->authorize('view', Dependency::class);

        return Dependency::paginate(30);
    }

    public function getWithEmployees()
    {
        return Dependency::with('employees')->get();
    }

    public function store()
    {
        $this->authorize('create', Dependency::class);

        $attributes = request()->validate([
            'name' => 'required|string|min:3',
            'code' => 'required|min:2'
        ]);

        Dependency::create($attributes);

        return response()->json(['message' => 'Dependencia creada correctamente!'], 201);
    }

    public function update(Dependency $dependency)
    {
        $this->authorize('update', $dependency);

        $attributes = request()->validate([
            'name' => 'required|string|min:3',
            'code' => 'required|min:2'
        ]);

        $dependency->update($attributes);

        return response()->json(['message' => 'Dependencia actualizada correctamente!'], 200);
    }

    public function destroy(Dependency $dependency)
    {
        $this->authorize('delete', $dependency);

        $dependency->delete();

        return response()->json(['message' => 'Dependencia eliminada correctamente!'], 200);
    }
}
