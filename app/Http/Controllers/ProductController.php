<?php
namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Product;
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


    public function showStockProduct($id, Request $request)
    {
        $bonus = Bonus::with('bonusItems')->find($id);

        if (!$bonus) {
            abort(404);
        }

        $product = null;
        $positionId = $request->input('position_id');

        if ($positionId) {
            $product = Product::where('position_id', $positionId)->first();
        }

        if ($request->ajax() && $product) {
            return response()->json([
                'name_uz' => $product->name_uz,
                'description_uz' => $product->description_uz,
                'price_small' => $product->price_small,
                'price_medium' => $product->price_medium,
                'price_big' => $product->price_big,
                'image' => $product->image,
            ]);
        }

        return view('products.stock-show', compact('bonus'));
    }



    public function showProduct(Request $request)
    {
        $product = $this->productService->showProduct($request);

        return $product;
    }
}
