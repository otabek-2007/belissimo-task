<?php

namespace App\Http\Controllers;

use App\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function packagePage()
    {
        $package = (new PackageService)->showPackage();
        return view('products.package', compact('package'));
    }

    public function addPackage(Request $request)
    {
        $package = (new PackageService)->addPackage($request);
        return response()->json($package);
    }
}
