<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = (new ProductService)->showProducts();
        return view('index', compact('products'));
    }
}
