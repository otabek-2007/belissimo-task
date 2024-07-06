<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->showProducts($request);

        if ($request->ajax()) {
            if ($request->has('category_id')) {
                $html = view('products.filtered-products', compact('products'))->render();
            } else if ($request->has('in_stock')) {
                $html = view('products.stock-products', compact('products'))->render();
            }
            return response()->json(['html' => $html]);

        }

        return view('index', compact('products'));
    }


    public function stockProduct(Request $request)
    {
        $stock = $this->productService->stockProduct($request);

        return view('products.stock-show', compact('stock'));
    }

    public function showProduct(Request $request)
    {
        $product = $this->productService->showProduct($request);

        return $product;
    }
}
