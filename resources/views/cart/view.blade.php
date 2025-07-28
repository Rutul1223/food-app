<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart - Elegencia</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #091E24 !important;
            color: #fff;
        }

        .cart-section {
            padding: 80px 0;
            background-color: #091E24;
        }

        .subtitle {
            font-family: 'Baskervville', serif;
            font-size: 15px;
            font-style: italic;
            font-weight: 400;
            margin-bottom: 20px;
            text-align: center;
            color: #FFD28D;
        }

        .title {
            font-family: 'Baskervville', serif;
            font-size: 50px;
            font-weight: 400;
            margin-bottom: 40px;
            text-align: center;
            color: #FFD28D;
        }

        .no-carts-container {
            text-align: center;
            padding: 40px;
            background-color: #040D10;
            border: 2px solid #FFD28D;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            color: #ccc;
        }

        .no-carts-container img {
            max-width: 150px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .no-carts-container h3 {
            font-family: 'Baskervville', serif;
            font-size: 1.8rem;
            color: #FFD28D;
            margin-bottom: 10px;
        }

        .no-carts-container p {
            font-size: 1rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        .no-carts-container a {
            display: inline-block;
            background-color: transparent;
            color: #FFD28D;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border: 2px solid #FFD28D;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .no-carts-container a:hover {
            background-color: #FFD28D;
            color: #091E24;
        }

        .food-details-container {
            background-color: #040D10;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .food-details-container:hover {
            transform: scale(1.02);
        }

        .food-details-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .food-details-container:hover img {
            transform: scale(1.05);
        }

        .card-title {
            font-family: 'Baskervville', serif;
            font-size: 1.5rem;
            color: #FFD28D;
            margin: 0;
        }

        .price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #d4a373;
        }

        .original-price {
            font-size: 1rem;
            color: #ccc;
            text-decoration: line-through;
            margin-right: 5px;
        }

        .cont {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn1 {
            background-color: transparent;
            color: #FFD28D;
            border: 2px solid #FFD28D;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn1:hover {
            background-color: #FFD28D;
            color: #091E24;
        }

        .btn-danger {
            background-color: transparent;
            color: #FFD28D;
            border: 2px solid #FFD28D;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-danger:hover {
            background-color: #FFD28D;
            color: #091E24;
        }

        .btn-checkout {
            background-color: transparent;
            color: #FFD28D;
            border: 2px solid #FFD28D;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-checkout:hover {
            background-color: #FFD28D;
            color: #091E24;
        }

        .total-price-container {
            background-color: #040D10;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .total-price {
            font-family: 'Baskervville', serif;
            font-size: 1.5rem;
            color: #FFD28D;
        }

        @media (max-width: 768px) {
            .title {
                font-size: 36px;
            }

            .food-details-container img {
                width: 80px;
                height: 80px;
            }

            .card-title {
                font-size: 1.2rem;
            }

            .cont {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .quantity-controls {
                gap: 5px;
            }

            .btn1 {
                width: 25px;
                height: 25px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar', ['cartItemCount' => $carts->count()])
    <section class="cart-section">
        <div class="container">
            <div class="subtitle">Your Cart</div>
            <h2 class="title">Cart Items</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if ($carts->isEmpty())
                        <div class="no-carts-container">
                            <h3>No Cart Items Yet!</h3>
                            <p>You haven’t added any items to your cart. Start exploring and add your favorite dishes to this list.</p>
                            <a href="{{ route('main') }}">Browse Food Items</a>
                        </div>
                    @else
                        @foreach ($carts as $cart)
                            <div class="food-details-container">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <img src="{{ asset('storage/' . $cart->food->image) }}" alt="{{ $cart->food->name }}">
                                    </div>
                                    <div class="cont ms-3">
                                        <h2 class="card-title" style="color: #FFD28D">{{ $cart->food->name }}</h2>
                                        <div>
                                            <span class="original-price">₹{{ number_format($cart->food->price + 50, 2) }}</span>
                                            <span class="price">₹<span id="price-{{ $cart->id }}" data-original-price="{{ $cart->food->price }}">{{ number_format($cart->food->price, 2) }}</span></span>
                                        </div>
                                        <div class="quantity-controls">
                                            <button type="button" class="btn1 btn-sm" onclick="decreaseQuantity({{ $cart->id }})">-</button>
                                            <input type="text" name="quantity" id="quantity-{{ $cart->id }}" value="1" class="form-control d-inline" style="width: 40px; height: 33px; text-align: center; border-radius: 50%; background-color: #040D10; color: #FFD28D; border: 2px solid #FFD28D;" readonly>
                                            <button type="button" class="btn1 btn-sm" onclick="increaseQuantity({{ $cart->id }})">+</button>
                                        </div>
                                    </div>
                                    <form id="removeCartForm{{ $cart->id }}" data-url="{{ route('remove-from-cart', ['id' => $cart->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @if ($carts->count() > 0)
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="total-price-container">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="total-price">Total Price: ₹<span id="total-price">0.00</span></div>
                                <a href="{{ route('cart.checkout') }}" class="btn btn-sm btn-checkout" style="background-color: #FFD28D; color: #040D10;">Check out</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // GSAP Animations
        document.addEventListener('DOMContentLoaded', () => {
            // Animate subtitle and title
            gsap.from(".subtitle", {
                duration: 1.2,
                opacity: 0,
                y: 50,
                ease: "power3.out",
                delay: 0.3
            });

            gsap.from(".title", {
                duration: 1.2,
                opacity: 0,
                y: 50,
                ease: "power3.out",
                delay: 0.6
            });

            // Animate no-carts-container if present
            if (document.querySelector('.no-carts-container')) {
                gsap.from(".no-carts-container", {
                    duration: 1.2,
                    opacity: 0,
                    y: 50,
                    ease: "power3.out",
                    delay: 0.9
                });
            }

            // Animate cart items
            gsap.from(".food-details-container", {
                duration: 1.2,
                opacity: 0,
                y: 50,
                ease: "power3.out",
                stagger: 0.2,
                delay: 0.9
            });

            // Animate total price container if present
            if (document.querySelector('.total-price-container')) {
                gsap.from(".total-price-container", {
                    duration: 1.2,
                    opacity: 0,
                    y: 50,
                    ease: "power3.out",
                    delay: 1.1
                });
            }
        });

        // Existing JavaScript for cart functionality
        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('[id^="price-"]').forEach(priceElement => {
                let price = parseFloat(priceElement.innerText);
                totalPrice += price;
            });
            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
        }

        function updatePrice(cartId) {
            let quantity = parseInt(document.getElementById('quantity-' + cartId).value);
            let price = parseFloat(document.getElementById('price-' + cartId).getAttribute('data-original-price'));
            let newPrice = (price * quantity).toFixed(2);
            document.getElementById('price-' + cartId).innerText = newPrice;
            updateTotalPrice();
            updateQuantityInDatabase(cartId, quantity);
        }

        function updateQuantityInDatabase(cartId, quantity) {
            fetch(`/cart/update-quantity/${cartId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateTotalPrice();
                } else {
                    console.log('Error updating quantity:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function increaseQuantity(cartId) {
            let quantityElement = document.getElementById('quantity-' + cartId);
            let quantity = parseInt(quantityElement.value);
            quantity++;
            quantityElement.value = quantity;
            updatePrice(cartId);
        }

        function decreaseQuantity(cartId) {
            let quantityElement = document.getElementById('quantity-' + cartId);
            let quantity = parseInt(quantityElement.value);
            if (quantity > 1) {
                quantity--;
                quantityElement.value = quantity;
                updatePrice(cartId);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateTotalPrice();
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[id^="removeCartForm"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    const formData = new FormData(this);

                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
                            form.closest('.food-details-container').remove();
                            updateTotalPrice();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</body>
</html>
