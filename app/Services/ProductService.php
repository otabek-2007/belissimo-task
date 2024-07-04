<?php
namespace App\Services;

use App\Models\Package;
use App\Models\Product;

class ProductService
{
    public function showProducts($request)
    {
        $products = Product::query();

        $products->with(['category']);

        if ($request->has('category_id')) {
            $products->whereIn('category_id', [$request->category_id]);
        }

        return $products->get();
    }
    public function showProduct($request)
    {
        $product = Product::findOrFail($request->product_id);

        return $product;
    }
    public function addPackage($request)
    {
        $product = Product::findOrFail($request->product_id);

        // Create a new Package instance
        $package = new Package;

        $package->product_id = $product->id;
        $package->category_id = $product->category_id;
        $package->name_uz = $product->name_uz;
        $package->name_ru = $product->name_ru;
        $package->description_uz = $product->description_uz;
        $package->description_ru = $product->description_ru;
        $package->price = $product->price_small != 0 ? $product->price_small : ($product->price_medium != 0 ? $product->price_medium : $product->price_big);

        $package->save();
        return $package;
    }

}