@include('layouts.navbar')
<div class="container">
    <div class="alert alert-success text-center mt-5">
        <h2>Thank You for Your Order!</h2>
        <p>Your payment was successful. We’re getting your order ready to be shipped.</p>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>Order Summary</h4>
        </div>

        <div class="card-body">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'Credit and debit cards' }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Order Status:</strong> {{ $order->status ?? 'Pending' }}</p>
            <p><strong>Created At:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
            <h5>Food Items:</h5>
            <ul>
                @foreach ($order->foodItems as $food)
                    <li>{{ $food->name }} (Quantity: {{ $food->pivot->quantity }})</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('orders.downloadCsv', $order->id) }}" class="btn btn-primary">Download Order Details</a>
        <a href="/welcome" class="btn btn-secondary">Continue Shopping</a>
    </div>
</div>
