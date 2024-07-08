<?php

namespace App\Providers;

use App\Models\Package;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.header', function ($view) {
            $categories = Category::all()->take(6);
            $package_count = Package::sum('quantity');
            $view->with([
                'categories' => $categories,
                'package_count' => $package_count
            ]);
        });
    }
}
