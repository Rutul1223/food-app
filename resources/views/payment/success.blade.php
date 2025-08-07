@include('layouts.navbar')

<!-- Order Confirmation Section -->
<section class="pt-5 pb-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title text-uppercase">Thank You for Your Order!</h2>
            <p class="text-muted fs-5">Your payment was successful. We're preparing your delicious food now.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Order Summary Card -->
                <div class="bg-white p-4 shadow-lg rounded-4">
                    <h4 class="text-uppercase mb-4 border-bottom pb-2">Order Summary</h4>

                    <div class="row mb-3">
                        <div class="col-sm-6"><strong>Order ID:</strong></div>
                        <div class="col-sm-6 text-muted">{{ $order->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><strong>Payment Method:</strong></div>
                        <div class="col-sm-6 text-muted">{{ $order->payment_method ?? 'Credit and Debit Cards' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><strong>Total Amount:</strong></div>
                        <div class="col-sm-6 text-muted">₹{{ number_format($order->total_amount, 2) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><strong>Delivery Address:</strong></div>
                        <div class="col-sm-6 text-muted">{{ $order->address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><strong>Order Status:</strong></div>
                        <div class="col-sm-6 text-muted">{{ $order->status ?? 'Pending' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6"><strong>Order Date:</strong></div>
                        <div class="col-sm-6 text-muted">{{ $order->created_at->format('d-m-Y H:i') }}</div>
                    </div>

                    <div class="mt-4">
                        <h5 class="text-uppercase mb-3">Ordered Items</h5>
                        <ul class="list-unstyled">
                            @foreach ($order->foodItems as $food)
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    {{ $food->name }}
                                    <span class="text-muted">(Qty: {{ $food->pivot->quantity }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        <a href="{{ route('orders.downloadCsv', $order->id) }}" class="btn btn-primary me-2">
                            <i class="bi bi-download me-1"></i> Download Details
                        </a>
                        <a href="/" class="btn btn-outline-dark">
                            <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
