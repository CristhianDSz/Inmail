<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Dependency;
use App\Domain\Services\ImageService;
use App\Http\Validators\CompanyValidator;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('view', Company::class);
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
        $this->authorize('create', Company::class);

        return view('companies.create');
    }

    public function store()
    {
        $this->authorize('create', Company::class);

        $attributes = (new CompanyValidator())->validate(request()->all(), new Company());

        $company = Company::create($attributes);

        ImageService::store($company, 'logo');
        ImageService::store($company, 'print_logo');

        return redirect()->route('companies.index');
    }

    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        return view('companies.edit', compact('company'));
    }

    public function update(Company $company)
    {
        $this->authorize('update', $company);

        $attributes = (new CompanyValidator())->validate(request()->all(), $company);

        $company->update($attributes);

        ImageService::store($company, 'logo');
        ImageService::store($company, 'print_logo');

        return redirect()->route('companies.index');
    }
}
