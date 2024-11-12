<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'food_id' => 'required|exists:food,id',
            ]);

            $foodId = $validatedData['food_id'];
            $userId = auth()->user()->id;

            Cart::create([
                'user_id' => $userId,
                'food_id' => $foodId,
                'quantity' => 1
            ]);
            // Get the updated cart count
            $cartCount = Cart::where('user_id', $userId)->count();

            // Return a JSON response
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart!',
                'cartCount' => $cartCount,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to cart.',
            ], 500);
        }
    }

    public function view()
    {
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->with('food')->get();
        $cartCount = $carts->count();
        return view("cart.view", compact('carts', 'cartCount'));
    }

    public function removeFromCart($id)
    {
        try {
            $cartItem = Cart::findOrFail($id);
            $cartItem->delete();
            // Get the updated cart count
            $cartCount = Cart::where('user_id', auth()->user()->id)->count();
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'cartCount' => $cartCount,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart.',
            ]);
        }
    }

    public function checkout()
    {

        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->with('food')->get();


        $totalPrice = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->food->price;
        });

        return view('cart.checkout', compact('carts', 'totalPrice'));
    }

    public function payment()
    {
        return view('payment.payment');
    }
}
