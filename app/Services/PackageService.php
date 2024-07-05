<?php
namespace App\Services;

use App\Models\Package;


class PackageService
{
    public function showPackage()
    {
        $package = Package::all();
        return $package;
    }
}