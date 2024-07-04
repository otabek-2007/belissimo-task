<?php
namespace App\Services;

use App\Models\Category;

class ProductService
{
    public function showProducts()
    {
        $products = Category::with('products')->get();
        return $products;
    }
}