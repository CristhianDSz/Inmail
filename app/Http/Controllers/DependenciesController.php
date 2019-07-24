<?php

namespace App\Http\Controllers;

use App\Dependency;

class DependenciesController extends Controller
{
    public function render()
    {
        return view('dependencies.index');
    }

    public function index()
    {
        return Dependency::paginate(5);


        // return [
        //     'pagination' => [
        //         'total' => $dependencies->total()
        //     ],
        //     'dependencies' => $dependencies
        // ];
    }

    public function getWithEmployees()
    {
        return Dependency::with('employees')->get();
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|string|min:3',
            'code' => 'required|min:2'
        ]);

        Dependency::create($attributes);

        return response()->json(['message' => 'Dependencia creada correctamente!'], 201);
    }

    public function update(Dependency $dependency)
    {

        $attributes = request()->validate([
            'name' => 'required|string|min:3',
            'code' => 'required|min:2'
        ]);

        $dependency->update($attributes);

        return response()->json(['message' => 'Dependencia actualizada correctamente!'], 200);
    }

    public function destroy(Dependency $dependency)
    {
        $dependency->delete();

        return response()->json(['message' => 'Dependencia eliminada correctamente!'], 200);
    }
}
