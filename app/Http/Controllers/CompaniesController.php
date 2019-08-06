<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Dependency;

class CompaniesController extends Controller
{
    public function index()
    {
        $company = Company::first();
        $employees = Employee::count();
        $dependencies = Dependency::count();

        return view('companies.index', [
            'company' => $company,
            'employees' => $employees,
            'dependencies' => $dependencies,
        ]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|min:3',
            'identification' => 'required|min:8',
            'email' => 'required|email|unique:companies,email',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:10|numeric',
            'logo', 'sometimes|file|image|max:5000',
            'print_logo', 'sometimes|file|image|max:5000'
        ]);

        $company = Company::create($attributes);

        $this->storageImage($company, 'logo');
        $this->storageImage($company, 'print_logo');

        return redirect()->route('companies.index');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Company $company)
    {
        $attributes = request()->validate([
            'name' => 'required|min:3',
            'identification' => 'required|min:8|unique:companies,identification,' . $company->id,
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:10',
            'logo', 'sometimes|file|image|max:5000',
            'print_logo', 'sometimes|file|image|max:5000'
        ]);

        $company->update($attributes);

        $this->storageImage($company, 'logo');
        $this->storageImage($company, 'print_logo');

        return redirect()->route('companies.index');
    }

    private function storageImage($company, $imageName)
    {
        if (request()->has($imageName)) {
            $company->update([
                $imageName => request()->$imageName->store('uploads', 'public')
            ]);
        }
    }
}
