<?php
namespace App\Services;

use App\Models\Package;
use App\Models\PackageHalf;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PackageService
{
    public function showPackage()
    {
        $packages = Package::all();
        $halfPackages = PackageHalf::all();

        return [
            'packages' => $packages,
            'halfPackages' => $halfPackages
        ];
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
    public function halfStore($request)
    {
        return DB::transaction(function () use ($request) {
            $productId = $request->product_id;
            $quantity = $request->quantity ?? 1;

            $packageHalf = PackageHalf::find($productId);

            if ($packageHalf) {
                if ($quantity == 0) {
                    $packageHalf->delete();
                } else {
                    $packageHalf->quantity = $quantity;
                    $packageHalf->save();
                }
            } else {
                $existingPackageHalf = PackageHalf::where('left_product_id', $request->left_product_id)
                    ->where('right_product_id', $request->right_product_id)
                    ->first();

                if ($existingPackageHalf) {
                    $existingPackageHalf->quantity += 1;
                    $existingPackageHalf->save();
                    $packageHalf = $existingPackageHalf;
                } else {
                    $request->left_product_id ? $request->left_product_id : 1;
                    $request->left_product_id ? $request->right_product_id : 1;
                    $leftProduct = Product::findOrFail($request->left_product_id);
                    $rightProduct = Product::findOrFail($request->right_product_id);

                    $leftPrice = $leftProduct->price_small == 0 ? ($leftProduct->price_medium == 0 ? $leftProduct->price_big : $leftProduct->price_medium) : $leftProduct->price_small;
                    $rightPrice = $rightProduct->price_small == 0 ? ($rightProduct->price_medium == 0 ? $rightProduct->price_big : $rightProduct->price_medium) : $rightProduct->price_small;

                    $packageHalf = PackageHalf::create([
                        'left_product_id' => $leftProduct->id,
                        'right_product_id' => $rightProduct->id,
                        'name_uz_one' => $leftProduct->name_uz,
                        'name_uz_two' => $rightProduct->name_uz,
                        'quantity' => $quantity,
                        'price' => $leftPrice + $rightPrice,
                    ]);
                }
            }

            return $packageHalf;
        });
    }




}
