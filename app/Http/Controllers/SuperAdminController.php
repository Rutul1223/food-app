<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function getAnalytics(){
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $favProducts = Favorite::count();
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');
        $topUsers = User::select('users.id', 'users.name', 'users.email')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->selectRaw('COUNT(orders.id) as order_count')
        ->groupBy('users.id', 'users.name', 'users.email')
        ->orderBy('order_count', 'desc')
        ->limit(5) // Adjust the limit as needed
        ->get();
        return view('admin.Super_admin.analytics', compact('totalOrders','totalUsers','favProducts','monthlySales','topUsers'));
    }
}
