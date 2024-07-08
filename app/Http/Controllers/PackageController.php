<?php

namespace App\Http\Controllers;

use App\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function packagePage()
    {
        $packageService = new PackageService();
        $packageData = $packageService->showPackage();
    
        return view('products.package', $packageData);
    }

    public function addPackage(Request $request)
    {
        $package = (new PackageService)->addPackage($request);
        return response()->json($package);
    }
    public function halfSave(Request $request)
    {
        $package = (new PackageService)->halfStore($request);
        return response()->json($package);
    }
}
