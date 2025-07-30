<head>
    <title>Order Details - #{{ $order->id }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('{{ asset('empty_carts.webp') }}') no-repeat center center fixed;
            background-size: cover;
            color: #FFD700;
            height: 100vh;
            overflow: hidden;
            /* Prevent scrolling */
            position: relative;
            font-family: 'Prompt', sans-serif;
        }

        /* Dark overlay for better readability */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        /* Navbar fixed */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
        }

        /* Main content container */
        .content-wrapper {
            height: calc(100vh - 60px);
            /* Full height minus navbar */
            padding-top: 60px;
            /* Space for navbar */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Order details container */
        .order-container {
            width: 90%;
            max-width: 600px;
            padding: 20px;
        }

        /* Order title */
        .order-title {
            font-family: 'Baskervville';
            font-size: 28px;
            text-align: center;
            text-decoration: underline;
            margin-bottom: 4rem;
            color: #FFD28D;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
        }

        /* Details row - left/right layout */
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .detail-label {
            font-family: 'Baskervville';
            font-weight: bold;
            color: #FFD28D;
        }

        .detail-value {
            font-family: 'Playfair Display';
            color: #FFFFFF;
            text-align: right;
            max-width: 60%;
        }

        /* Status badge */
        .badge {
            padding: 4px 10px;
            border-radius: 10px;
            font-weight: bold;
            display: inline-block;
        }

        .bg-accept {
            background: #4CAF50;
            color: #fff !important;
        }

        .bg-reject {
            background: #E53935;
            color: #fff !important;
        }

        .bg-pending {
            background: #FFD28D;
            color: #000 !important;
        }

        /* Food list */
        .food-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .food-list li {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
        }

        /* QR code section */
        .qr-section {
            text-align: center;
            margin: 25px 0;
        }

        .qr-code {
            padding: 5px;
            background: #fff;
            display: inline-block;
            border-radius: 5px;
        }

        /* Download button */
        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #FFD28D;
            color: #000;
            border-radius: 5px;
            text-decoration: none;
            font-family: 'Playfair Display';
            margin-top: 15px;
            transition: background 0.3s;
        }

        .download-btn:hover {
            background: #e6caa0;
        }
    </style>
</head>
@include('layouts.navbar')

<body>
    <div class="content-wrapper">
        <div class="order-container">
            <h1 class="order-title">Order No: #{{ $order->id }}</h1>
            <div style="margin-bottom: 8rem">
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value">₹ {{ $order->total_amount }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value">{{ $order->address }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">
                        <span
                            class="badge {{ $order->status === 'accept' ? 'bg-accept' : ($order->status === 'reject' ? 'bg-reject' : 'bg-pending') }}">
                            {{ $order->status }}
                        </span>
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Created At:</span>
                    <span class="detail-value">{{ $order->created_at->format('d-m-Y H:i') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Ordered Food:</span>
                    <span class="detail-value">
                        <ul class="food-list">
                            @foreach ($order->foods as $food)
                                <li>
                                    <span>{{ $food->name }} </span>&nbsp;
                                    <span>x {{ $food->pivot->quantity }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </span>
                </div>

                <div class="qr-section">
                    <div class="qr-code">
                        <?php
                        $orderDetails = "Order ID: {$order->id}\n" . "Total Amount: ₹{$order->total_amount}\n" . "Address: {$order->address}\n" . "Status: {$order->status}\n" . "Created At: {$order->created_at->format('d-m-Y H:i')}";
                        $orderDetails = urlencode($orderDetails);
                        ?>
                        {!! QrCode::size(100)->generate($orderDetails) !!}
                    </div>
                    <br>
                    <a href="{{ route('orders.downloadCsv', $order->id) }}" class="download-btn">⬇ Download Order</a>
                </div>
            </div>
        </div>
    </div>
</body>

@include('layouts.chat')
