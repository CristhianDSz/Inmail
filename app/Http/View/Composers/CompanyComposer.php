<?php

namespace App\Http\View\Composers;

use App\Company;
use Illuminate\View\View;


class CompanyComposer
{

    public function compose(View $view)
    {
        $company = Company::first();
        $view->with('logo', $company->logo);
    }
}
