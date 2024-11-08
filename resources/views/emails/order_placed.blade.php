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
    <p>Dear {{ $order->user_name }},</p>
    <p>Thank you for your purchase. Below are your order details:</p>
    <ul>
        <li>Order ID: #{{ $order->order_id }}</li>
        <li>Total Amount: ₹{{ $order->total_amount }}</li>
        <li>Address: {{ $order->address }}</li>
        <li>Payment Status: {{ $order->payment_status }}</li>
    </ul>
    <p>We will notify you once your order is dispatched.</p>
    <p>Best regards, <br> Rutul Morningstar</p>
</body>
</html>
