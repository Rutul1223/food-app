<!-- resources/views/emails/order_placed.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Your Order Has Been Placed Successfully!</h1>
    <p>Dear {{ $order->user->name }},</p>
    <p>Thank you for your purchase. Below are your order details:</p>
    <ul>
        <li>Order ID: #{{ $order->id }}</li>
        <li>Ordered Food :<ul>
                @foreach ($order->foods as $food)
                    <li>{{ $food->name }} (Quantity: {{ $food->pivot->quantity }})</li>
                @endforeach
            </ul>
        </li>
        <li>Total Amount: ₹{{ $order->total_amount }}</li>
        <li>Address: {{ $order->address }}</li>
        <li>Status: {{ $order->status }}</li>
    </ul>
    <p>We will notify you once your order is dispatched.</p>
    <p>Best regards, <br> Rutul Morningstar</p>
</body>
</html>
