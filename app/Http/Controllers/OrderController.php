<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Stripe\Charge;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function clearCart($userId)
    {
        Cart::where('user_id', $userId)->delete();
    }

    public function store(Request $request)
    {
        try {
            Log::info('Received data:', $request->all());
            $request->validate([
                'total_amount' => 'required|numeric',
                'address' => 'required|string',
                'stripeToken' => 'required|string',
            ]);
            // Set your Stripe secret key
            Stripe::setApiKey(env('STRIPE_SECRET'));
            // Create the charge
            $charge = Charge::create([
                'amount' => $request->input('total_amount') * 100, // Convert to cents
                'currency' => 'inr', // Assuming INR, adjust as needed
                'source' => $request->input('stripeToken'),
                'description' => 'food-app order Payment',
            ]);
            $order = new Order();
            $order->total_amount = $request->input('total_amount');
            $order->address = $request->input('address');
            $order->user_id = Auth::id();
            $order->save();
            // Add food items to the order
            $foodItems = Cart::where('user_id', Auth::id())->get();
            foreach ($foodItems as $item) {
                // Assuming you have a `food_id` and `quantity` field in your Cart model
                $order->foodItems()->attach($item->food_id, ['quantity' => $item->quantity]);
            }
            Mail::to(auth()->user()->email)->send(new OrderPlaced($order));
            $this->clearCart(Auth::id());
            // dd($order);

            return Redirect::route('payment.success')->with('success', 'Order placed successfully');

        } catch (\Exception $e) {

            Log::error('Error occurred while processing order:', ['exception' => $e]);

            return response()->json(['message' => 'Error occurred while processing your request. Please try again later.', 'error' => $e->getMessage()], 500);
        }
    }
    public function paymentSuccess()
    {
        // Get the latest order of the authenticated user
        $order = Order::with('foodItems')->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->first(); // Fetch the latest order

        return view('payment.success', compact('order')); // Pass the order to the view
    }

    public function view()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view("order.view", compact('orders'));
    }
    public function orderDetails($orderId)
    {
        $order = Order::with('foods')->find($orderId);
        // Fetch the related orders if needed
        $orders = $order ? [$order] : []; // If $order is found, put it in an array; otherwise, initialize as empty.

        return view('order.order_detail', compact('order', 'orders'));
    }
    public function downloadCsv($id)
    {
        // Fetch the order details
        $order = Order::with('foods')->findOrFail($id);

        // Define CSV content for basic order details
        $csvContent = [
            ['Order ID', $order->id],
            ['Total Amount', '₹' . $order->total_amount],
            ['Address', $order->address],
            ['Status', $order->status],
            ['Created At', $order->created_at->format('d-m-Y H:i')],
            [], // Add an empty row for better readability
            ['Ordered Food Items'], // Header for food items section
            ['Food Name', 'Quantity'], // Sub-header for food details
        ];

        // Append food item details to the CSV content
        foreach ($order->foods as $food) {
            $csvContent[] = [$food->name, $food->pivot->quantity];
        }

        // Prepare the response as a streamed CSV download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=order_{$order->id}_details.csv",
        ];

        return response()->streamDownload(function () use ($csvContent) {
            $file = fopen('php://output', 'w');
            foreach ($csvContent as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, "order_{$order->id}_details.csv", $headers);
    }
}
