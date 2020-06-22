<?php

namespace App\Domain\Services;

use App\Company;

class ImageService
{

    public static function store(Company $company, $imageName)
    {
        if (request()->has($imageName)) {
            $company->update([
                $imageName => request()->$imageName->store('uploads', 'public')
            ]);
        }
    }
}
