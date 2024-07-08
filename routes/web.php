<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ProductController::class, 'index']);
Route::get('/show/product', [ProductController::class, 'showProduct']);
Route::get('/show/half-pizza', [ProductController::class, 'halfPizza']);
Route::get('/products/construktor', [ProductController::class, 'construktor']);
Route::get('/product/bonuses/{id}', [ProductController::class, 'showStockProduct']);
Route::get('/package/page', [PackageController::class, 'packagePage']);
Route::post('/add/product', [PackageController::class, 'addPackage']);
Route::post('/half/save', [PackageController::class, 'halfSave']);