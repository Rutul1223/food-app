<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Updated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            line-height: 1.6;
            margin: 0 0 16px;
        }
        .email-body strong {
            color: #007bff;
        }
        .email-footer {
            text-align: center;
            padding: 15px;
            background-color: #f1f3f5;
            color: #6c757d;
            font-size: 14px;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h1>Order Status Updated</h1>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <p>Hello <strong>{{ $userName }}</strong>,</p>
            <p>We wanted to let you know that the status of your order <strong>#{{ $orderId }}</strong> has been updated to:</p>
            <p><strong>{{ $status }}</strong></p>
            <p>Thank you for choosing us. We hope to serve you again soon!</p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p>Need help? <a href="{{ url('/contact') }}" target="_blank">Contact Us</a></p>
            <p>&copy; {{ date('Y') }} YourCompanyName. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

