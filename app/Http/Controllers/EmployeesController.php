<?php

namespace App\Http\Controllers;

use App\Employee;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function render()
    {
        return view('employees.index');
    }

    public function index()
    {
        $this->authorize('view', Employee::class);

        return Employee::with('dependency')->get();
    }

    public function store()
    {
        $this->authorize('create', Employee::class);

        $attributes = request()->validate([
            'identification' => 'required|min:3|unique:employees,identification',
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'dependency_id' => 'required'
        ]);

        Employee::create($attributes);

        return response()->json(['message' => 'Funcionario creado correctamente'], 201);
    }

    public function update(Employee $employee)
    {
        $this->authorize('update', $employee);

        $attributes = request()->validate([
            'identification' => 'required|min:8|unique:employees,identification,' . $employee->id,
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'dependency_id' => 'required'
        ]);

        $employee->update($attributes);

        return response()->json(['message' => 'Funcionario actualizado correctamente!'], 200);
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);

        $employee->delete();

        return response()->json(['message' => 'Funcionario eliminado correctamente!'], 200);
    }
}
