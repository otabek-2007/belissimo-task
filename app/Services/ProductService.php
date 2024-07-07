<?php
namespace App\Services;

use App\Models\Bonus;
use App\Models\BonusItem;
use App\Models\Package;
use App\Models\Product;

class ProductService
{

    public function showProducts($request)
    {
        if ($request->has('in_stock')) {
            $bonuses = Bonus::with(['bonusItems'])->get();
            return $bonuses;
        }

        $products = Product::query();
        $products->with(['category']);
        if ($request->has('category_id')) {
            $products->where('category_id', $request->category_id);
        } else {
            $products->where('category_id', 1);
        }

        return $products->get();
    }

    public function stockProduct($id, $positionId = null)
    {
        $bonus = Bonus::with('bonusItems')->find($id);

        if (!$bonus) {
            abort(404);
        }

        $products = null;
        if ($positionId) {
            $products = Product::where('position_id', $positionId)->get();
        }

        return compact('bonus', 'products');
    }



    public function showProduct($request)
    {
        $product = Product::findOrFail($request->product_id);

        return $product;
    }

}