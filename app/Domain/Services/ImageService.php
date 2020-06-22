<?php

namespace App\Domain\Services;

use App\Company;

class ImageService
{

    /**
     * Store an image in the destination disk, default public
     * TODO: implement the storage in S3
     *
     * @param Company $company
     * @param string $imageName
     * @return void
     */
    public static function store(Company $company, $imageName)
    {
        if (request()->has($imageName)) {
            $company->update([
                $imageName => request()->$imageName->store('uploads', 'public')
            ]);
        }
    }
}
