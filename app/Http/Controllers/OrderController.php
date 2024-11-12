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
            ]);
            $order = new Order();
            $order->total_amount = $request->input('total_amount');
            $order->address = $request->input('address');
            $order->user_id = Auth::id();
            $order->save();
            $this->clearCart(Auth::id());

            Mail::to(auth()->user()->email)->send(new OrderPlaced($order));

            return Redirect::route('order.view')->with('success', 'Order placed successfully');
        } catch (\Exception $e) {

            Log::error('Error occurred while processing order:', ['exception' => $e]);

            return response()->json(['message' => 'Error occurred while processing your request. Please try again later.', 'error' => $e->getMessage()], 500);
        }
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
        $order = Order::find($orderId);
        // Fetch the related orders if needed
        $orders = $order ? [$order] : []; // If $order is found, put it in an array; otherwise, initialize as empty.

        return view('order.order_detail', compact('order', 'orders'));
    }
    public function downloadCsv($id)
    {
        // Fetch the order details
        $order = Order::findOrFail($id);

        // Define CSV content
        $csvContent = [
            ['Order ID', $order->id],
            ['Total Amount', '₹' . $order->total_amount],
            ['Address', $order->address],
            ['Status', $order->status],
            ['Created At', $order->created_at->format('d-m-Y H:i')]
        ];

        // Open a temporary output stream
        $file = fopen('php://output', 'w');

        // Set CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=order_{$order->id}_details.csv",
        ];

        // Write each row to the output stream
        foreach ($csvContent as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        // Return the response with the CSV headers
        return Response::streamDownload(function () use ($csvContent) {
            $file = fopen('php://output', 'w');
            foreach ($csvContent as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, "order_{$order->id}_details.csv", $headers);
    }
}
