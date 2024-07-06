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
            $products->where('category_id', $request->category_id);
        } else if ($request->has('in_stock')) {
            $products->where('in_stock', true);
        } else {
            $products->where('category_id', 1);
        }

        return $products->get();
    }
    public function stockProduct($request)
    {
        return Product::find($request->product_id)->with(['category']);
    }
    public function showProduct($request)
    {
        $product = Product::findOrFail($request->product_id);

        return $product;
    }

}