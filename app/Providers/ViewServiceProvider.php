<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category; // Import the Category model

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
 public function boot()
{
    // Sharing $categories with the specified layout
    view()->composer('layouts.commerce', function ($view) {
        $categories = Category::all(); // Fetch categories
        $view->with('categories', $categories);
    });
}

}
