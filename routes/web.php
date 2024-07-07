<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ProductController::class, 'index']);
Route::get('/show/product', [ProductController::class, 'showProduct']); // Route to fetch product details
Route::get('/product/bonuses/{id}', [ProductController::class, 'showStockProduct']);
Route::get('/package/page', [PackageController::class, 'packagePage']);
Route::post('/add/product', [PackageController::class, 'addPackage']);