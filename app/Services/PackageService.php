<?php
namespace App\Services;

use App\Models\Package;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PackageService
{
    public function showPackage()
    {
        return Package::all();
    }
    public function addPackage($request)
    {
        return DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);

            $price = $product->price_small == 0 ? ($product->price_medium == 0 ? $product->price_big : $product->price_medium) : $product->price_small;

            $quantity = $request->quantity ?? 1;
            $package = Package::where('product_id', $product->id)->first();

            if ($package) {
                if ($quantity == 0) {
                    $package->delete();
                } else {
                    if ($quantity == 1) {
                        $package->quantity += 1;
                    } else {
                        $package->quantity = $quantity;
                    }
                    $package->save();
                }
            } else {
                if ($quantity > 0) {
                    $package = new Package();
                    $package->product_id = $product->id;
                    $package->quantity = $quantity;
                    $package->name_uz = $product->name_uz;
                    $package->name_ru = $product->name_ru;
                    $package->description_uz = $product->description_uz;
                    $package->description_ru = $product->description_ru;
                    $package->price = $price;
                    $package->save();
                }
            }

            return $package;
        });
    }


}
