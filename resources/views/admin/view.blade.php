<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $food->name }}</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #EEEDEB;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .food-title {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .food-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .food-description {
            margin-top: 20px;
        }

        .food-price {
            font-size: 1.5em;
            color: #6fb441;
            margin-top: 10px;
        }

        .back {
            text-decoration: none;
            color: rgb(29, 4, 4);
            font-size: 40px;
            display: inline-block; /* Ensure the anchor behaves like a block-level element */
            transition: transform 0.3s ease;
        }

        .back:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <a href="{{ url('/admin/dashboard') }}" class="back">←</a>
        </div>
        <h1 class="food-title">{{ $food->name }}</h1>
        <div class="food-image">
            <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}">
        </div>
        <div class="food-description">
            <p>{{ $food->description }}</p>
        </div>
        <div class="food-price">
            <p>Rs.{{ number_format($food->price, 2) }}</p>
        </div>
    </div>
</body>

</html>
