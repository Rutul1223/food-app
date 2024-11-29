<head>
    <title>Order Details - #{{ $order->id }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
@include('layouts.navbar')
<style>
    body{
        background-color: #303030;
    }
    .container h2{
        color:#929292;
    }
    .bg-accept {
        background-color: green !important;
        color: white !important;
        padding: 5px;
        border-radius: 20px;
    }

    .bg-reject {
        background-color: red !important;
        color: white !important;
        padding: 5px;
        border-radius: 20px;
    }

    .bg-pending {
        background-color: yellow !important;
        color: black !important;
        padding: 5px;
        border-radius: 20px;
    }

    .qr-container {
        margin-top: 20px;
    }

    .qr-code {
        border: 2px solid #007bff;
        border-radius: 10px;
        padding: 10px;
        display: inline-block;

    }

    .download {
        margin-left: auto;
    }
</style>
<body>
<div class="container">
    <h2 class="text-center py-2">Order Details</h2>

    <div class="card">
        <div class="card-header">
            Order #{{ $order->id }}
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Amount</td>
                        <td>₹ {{ $order->total_amount }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <span
                                class="{{ $order->status === 'accept' ? 'bg-accept' : ($order->status === 'reject' ? 'bg-reject' : 'bg-pending') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Created At</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    <!-- Display Ordered Food Details -->
                    <tr>
                        <td>Ordered Food</td>
                        <td>
                            <ul>
                                @foreach ($order->foods as $food)
                                    <li>{{ $food->name }} (Quantity: {{ $food->pivot->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>QR Code</td>
                        <td class="qr-container">
                            <div class="qr-code">
                                <?php
                                // Prepare the order details with line breaks for better readability
                                $orderDetails = "Order ID: {$order->id}\n" . "Total Amount: ₹{$order->total_amount}\n" . "Address: {$order->address}\n" . "Status: {$order->status}\n" . "Created At: {$order->created_at->format('d-m-Y H:i')}";

                                // Ensure the string is UTF-8 encoded
                                $orderDetails = urlencode($orderDetails);

                                // Generate the QR code

                                ?>
                                {!! QrCode::size(100)->generate($orderDetails) !!}
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
            <div class="download">
                <a href="{{ route('orders.downloadCsv', $order->id) }}" class="btn btn-sm btn-secondary my-2 mx-1">
                    <i class="fas fa-download"></i> Download
                </a>
            </div>

        </div>
    </div>
</div>
</body>


<!-- Include chat view -->
@include('layouts.chat')
