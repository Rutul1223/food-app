<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders - Elegencia Royale</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a !important;
            color: #FFD28D;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 1rem auto;
            padding: 15px;
            background-color: #222222;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .container h2 {
            color: #FFD28D;
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .card {
            background-color: #2b2b2b !important;
            border: 1px solid #FFD28D !important;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }

        .card-header {
            background-color: transparent;
            color: #FFD28D !important;
            padding: 15px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .card-body {
            padding: 0;
        }

        .order-info {
            font-family: 'Playfair Display', serif;
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 15px;
            font-size: 0.95rem;
        }

        .order-info div {
            width: 100%;
        }

        .order-info .total-amount {
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
        }

        .order-info .address {
            font-style: italic;
            color: #ffffff;
            word-break: break-word;
        }

        .order-info .status {
            color: #ffffff;
            font-weight: 600;
        }

        .card-header .link {
            color: inherit;
            text-decoration: none;
        }

        .bg-accept {
            color: #28a745 !important;
        }

        .bg-reject {
            color: #dc3545 !important;
        }

        .bg-pending {
            color: #FFD28D !important;
        }

        .created-at {
            font-size: 0.85rem;
            color: #cccccc;
            align-self: flex-end;
        }

        .card.link {
            text-decoration: none;
            color: inherit;
        }

        .no-orders {
            text-align: center;
            padding: 2rem;
            font-family: 'Playfair Display', serif;
            color: #FFD28D;
        }

        .no-orders p {
            color: #cccccc;
            font-family: 'Poppins', sans-serif;
            margin-top: 0.5rem;
        }

        /* Responsive styles for tablets and larger */
        @media (min-width: 768px) {
            .container {
                margin: 2rem auto;
                padding: 20px;
            }

            .container h2 {
                font-size: 2.5rem;
                margin-bottom: 2rem;
            }

            .card-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                padding: 15px 20px;
                font-size: 1.25rem;
                gap: 0;
            }

            .order-info {
                flex-direction: row;
                align-items: center;
                padding: 15px 20px;
                gap: 0;
            }

            .order-info div {
                flex: 1;
            }

            .order-info .total-amount {
                font-size: 1.1rem;
            }

            .order-info .status {
                margin-left: 3rem;
            }

            .created-at {
                margin-left: auto;
                font-size: 0.9rem;
            }
        }

        /* Additional optimization for very small screens */
        @media (max-width: 400px) {
            .container {
                padding: 10px;
            }

            .container h2 {
                font-size: 1.8rem;
            }

            .card-header {
                padding: 12px;
            }

            .order-info {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container">
        @if (count($orders) > 0)
            <h2>Order Status</h2>
            <div id="appStaper" class="stepper"></div>
            @foreach ($orders as $order)
                <a href="{{ route('order.order_detail', ['id' => $order->id]) }}" class="card link">
                    <div class="card-header">
                        Order #{{ $order->id }}
                        <span class="created-at">{{ $order->created_at }}</span>
                    </div>
                    <div class="card-body">
                        <div class="order-info">
                            <div class="total-amount">Total Amount: ₹ {{ $order->total_amount }}</div>
                            <div class="address"><b>Address:</b> {{ $order->address }}</div>
                            <div class="status"><b>Status:</b>
                                <span
                                    class="{{ $order->status === 'accept' ? 'bg-accept' : ($order->status === 'reject' ? 'bg-reject' : 'bg-pending') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="card">
                <div class="card-header no-orders">
                    No Orders Found
                </div>
                <div class="card-body no-orders">
                    <p>No orders have been placed yet. Explore our menu to start your culinary journey!</p>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
