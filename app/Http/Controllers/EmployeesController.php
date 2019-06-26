<?php

namespace App\Http\Controllers;

use App\Employee;

class EmployeesController extends Controller
{
    public function render()
    {
        return view('employees.index');
    }

    public function index()
    {
        return Employee::with('dependency')->get();
    }

    public function store()
    {
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
        $employee->delete();

        return response()->json(['message' => 'Funcionario eliminado correctamente!'], 200);
    }
}
