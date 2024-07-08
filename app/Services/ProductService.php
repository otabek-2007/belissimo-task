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
            $category_id = 1;
            $products->where('category_id', $category_id);
        }

        return $products->get();
    }
    public function halfPizzat()
    {
        $halfPizza = Product::where('category_id', 1)->get();
        return $halfPizza;
    }
    public function construktor($request)
    {
        $products = Product::query();
        $products->with(['category']);
        $products->select('id', 'name_uz');

        if ($request->has('small')) {
            $products->where('price_small', '>', 0);
            $products->addSelect('price_small as price');
        } elseif ($request->has('medium')) {
            $products->where('price_medium', '>', 1000000000000000);
            $products->addSelect('price_medium as price');
        } elseif ($request->has('big')) {
            $products->where('price_big', '>', 0);
            $products->addSelect('price_big as price');
        } else {
            $products->where('price_small', '>', 0);
            $products->addSelect('price_small as price');
        }

        $construktor = $products->get();
        return $construktor;
    }

    public function stockProduct($id, $positionId = null)
    {
        $bonus = Bonus::with('bonusItems')->find($id);

        if (!$bonus) {
            abort(404);
        }

        $products = null;
        if ($positionId) {
            $products = Product::where('position', $positionId)->get();
        }

        return compact('bonus', 'products');
    }



    public function showProduct($request)
    {
        $product = Product::findOrFail($request->product_id);

        return $product;
    }

}