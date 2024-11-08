<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;


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
        View::composer('*', function ($view) {
            if (auth()->check()) {
                // If the user is authenticated, calculate the cart count based on their cart items
                $carts = Cart::where('user_id', auth()->user()->id)->get();
                $cartCount = $carts->count();
            } else {
                // If the user is not authenticated, set the cart count to 0
                $cartCount = 0;
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
