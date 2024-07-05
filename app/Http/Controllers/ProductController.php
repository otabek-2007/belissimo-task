<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = (new ProductService)->showProducts($request);

        if ($request->ajax()) {
            return view('products.filtered-products', compact('products'))->render();
        }

        return view('index', compact('products'));
    }
    public function showProduct(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name_uz,
            'description' => $product->description_uz,
            'price' => $product->price_small ?: $product->price_medium ?: $product->price_big,
            'image' => '/image/image.png',
        ]);
    }

    public function addPackage(Request $request)
    {
        $package = (new ProductService)->addPackage($request);
        return $package;
    }

}
