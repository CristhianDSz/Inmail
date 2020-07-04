<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;


class CompanyComposer
{

    public function compose(View $view)
    {
        $company = auth()->user()->company;
        $view->with('logo', $company->logo ?? null);
    }
}
