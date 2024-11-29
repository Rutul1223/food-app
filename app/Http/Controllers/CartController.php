<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $existingCartItem = Cart::where('user_id', $userId)->where('food_id', $foodId)->first();

        if ($existingCartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item already in cart!',
            ]);
        }

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
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->with('food')->get();


        $totalPrice = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->food->price;
        });
        $userAddress = Auth::user()->address;
        return view('payment.payment', compact('carts', 'totalPrice','userAddress'));
    }
    public function updateQuantity(Request $request, $id)
    {
        try {
            // Validate the input
            $validatedData = $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            // Find the cart item
            $cartItem = Cart::findOrFail($id);
            $cartItem->quantity = $validatedData['quantity'];
            $cartItem->save();

            // Recalculate the total price
            $totalPrice = Cart::where('user_id', auth()->user()->id)->sum(function ($cart) {
                return $cart->quantity * $cart->food->price;
            });

            // Return the updated total price and success message
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated successfully.',
                'totalPrice' => $totalPrice,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update quantity.',
            ], 500);
        }
    }
}
