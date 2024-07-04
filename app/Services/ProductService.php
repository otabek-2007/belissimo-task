<?php
namespace App\Services;

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
}