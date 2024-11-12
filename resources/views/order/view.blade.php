<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .container {
            max-width: 100%;
            margin: 1vw auto;
            padding: 20px;
            /* background-color: #EEEDEB; */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       /* body {
            background-color: #E6B9A6 !important;
            font-family: Arial, sans-serif;
            color: #333;
        }*/


        .card {
            /*background-color: #939185 !important;*/
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: none;
        }

        .card-header {
            /*background-color: #333 !important;*/
            /*color: #b8adad !important;*/
            padding: 12px 15px;
            border-bottom: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .order-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-info div {
            flex: 1;
        }

        .order-info .total-amount {
            font-size: 18px;
            font-weight: bold;
        }

        .order-info .address {
            font-style: italic;
        }
        .order-info .status{
            margin-left: 3rem;
        }

        .card-header .link {
            color: inherit;
        }

        .bg-accept {
            color: green !important;
        }

        .bg-reject {
            color: red !important;
        }

        .bg-pending {
            color: rgb(233, 233, 20) !important;
        }
        .created-at {
            margin-left: auto; /* Push created date to the right */
        }
        .card.link {
            text-decoration: none;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container">

        @if (count($orders) > 0)
            {{-- <h2 class="text-center py-2">Order Status</h2> --}}
            <div id="appStaper" class="stepper"></div>
            @foreach ($orders as $order)
                <a href="{{ route('order.order_detail', ['id' => $order->id]) }}" class="card link">
                    <div class="card-header">
                        Order#{{ $order->id }}
                            <span class="created-at">{{ $order->created_at }}</span>
                    </div>

                    <div class="card-body">
                        <div class="order-info">
                            <div class="total-amount">Total Amount: ₹ {{ $order->total_amount }}</div>
                            <div class="address"><b>Address:</b> {{ $order->address }}</div>
                            <div class="status"><b>Status:</b><span
                                    class="{{ $order->status === 'accept' ? 'bg-accept' : ($order->status === 'reject' ? 'bg-reject' : 'bg-pending') }}">
                                    {{ $order->status }}
                                </span></div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="card">
                <div class="card-header">
                    No orders found
                </div>
                <div class="card-body">
                    <p class="card-text">No orders have been added yet.</p>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
