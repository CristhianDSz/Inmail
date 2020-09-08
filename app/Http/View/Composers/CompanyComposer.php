<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;


class CompanyComposer
{

    public function compose(View $view)
    {
        $company = auth()->user()->company ?? null;
        if ($company && $company->logo) {
            return $view->with('logo', asset('storage/' .$company->logo));
        }

        return $view->with('logo', asset('img/logo.png'));
    }
}
