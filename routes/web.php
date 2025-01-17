<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SuperAdminController;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.loading');
});

Route::get('/welcome', function () {
    $foods = Food::paginate(9);
    return view('welcome', compact('foods'));
})->name('welcome');
Route::get('/dashboard', function () {})->name('dashboard');

Route::get('/main', function () {
    $categories = Food::distinct()->get(['category']);
    return view('main',compact('categories'));
})->name('main');

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);


Route::get('/search', [FoodController::class, 'search'])->name('food.search');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

// In routes/web.php or routes/api.php
Route::get('/food-items', [FoodController::class, 'getFoodItems'])->name('food.items');

Route::get('/about-us', function () {
    $orders = Order::all();
    $foods = Food::all();
    $users = User::all();
    return view('abouts-us.about-us',compact('orders','foods','users'));
})->name('about-us');

Route::get('/contact-us', function () {
    return view('contact-us.contact-us');
})->name('contact-us');


Route::middleware('auth')->group(function () {

    Route::get('/welcome/{category?}', [FoodController::class, 'categoryIndex'])->name('welcome');

    Route::get('/food/{id}', [FoodController::class, 'show'])->name('food.show');
    Route::post('/favorite', [FoodController::class, 'favorite'])->name('food.favorite');
    Route::get('/favorites', [FoodController::class, 'showFavorites'])->name('food.fav');


    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity']);
    route::get('/cart/view', [CartController::class, "view"])->name('cart.view');
    Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
    Route::get('/cart/checkout', [CartController::class, "checkout"])->name('cart.checkout');
    Route::get('/payment', [CartController::class, "payment"])->name("payment.payment");
    Route::get('/payment/success', [OrderController::class, 'paymentSuccess'])->name('payment.success');

    Route::post('/process-order', [OrderController::class, 'store'])->name('process.order');
    Route::get('/orders', [OrderController::class, "view"])->name('order.view');
    Route::get('/orders/{id}', [OrderController::class, 'orderDetails'])->name('order.order_detail');
    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/comments/{orderId}', [CommentController::class, 'show']);
    Route::get('/orders/{id}/download-csv', [OrderController::class, 'downloadCsv'])->name('orders.downloadCsv');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get("admin/dashboard", [HomeController::class, "index"])->name('admin.dashboards');
    route::get("admin/create", [HomeController::class, "create"]);
    route::post("admin/store", [HomeController::class, "store"])->name('admin.store');
    route::get("admin/{id}/edit", [HomeController::class, "edit"])->name('admin.edit');
    Route::put("admin/update/{food}", [HomeController::class, "update"])->name('admin.update');
    route::get("admin/{id}/view", [HomeController::class, "view"])->name('admin.view');

    Route::get('/admin/activity-log', [HomeController::class, 'getActivityLog'])->name('admin.activity.log');
    // Route::get('/admin/activity-log/filter', [HomeController::class, 'getActivityLogs']);

    Route::get('/admin/event-types', [HomeController::class, 'getEventTypes'])->name('admin.event-types');
    Route::get('/admin/comments', [HomeController::class, 'fetchComments']);
    Route::post('/admin/comments/{id}/mark-as-read', [HomeController::class, 'markAsRead']);
    Route::post('/admin/comments/{commentId}/reply', [HomeController::class, 'reply'])->name('comments.reply');

    Route::get('/order/{id}', [OrderController::class, 'orderDetails'])->name('admin.dashboard');
    Route::post('/order/{id}/status', [HomeController::class, 'updateOrderStatus'])->name('order.updateStatus');

    Route::get("/superAdmin/analytics",[SuperAdminController::class,'getAnalytics']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
