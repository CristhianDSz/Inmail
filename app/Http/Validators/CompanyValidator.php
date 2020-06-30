<?php

namespace App\Http\Validators;

class CompanyValidator
{

    protected function identificationRule($company)
    {
        if ($company->exists) {
            return 'required|min:8|unique:companies,identification,' . $company->id;
        }
        return 'required|min:8';
    }

    protected function emailRule($company)
    {
        if ($company->exists) {
            return 'required|email|unique:companies,email,' . $company->id;
        }
        return 'required|email';
    }

    public function rules($company)
    {
        return [
            'name' => 'required|min:3',
            'identification' => $this->identificationRule($company),
            'email' => $this->emailRule($company),
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:10|numeric',
            'logo', 'sometimes|file|image|max:5000',
            'print_logo', 'sometimes|file|image|max:5000'
        ];
    }

    public function validate($data, $company)
    {
        return validator($data, $this->rules($company))->validate();
    }
}
