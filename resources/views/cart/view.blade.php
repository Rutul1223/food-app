<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart-items</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        body {
            background-color: #E6B9A6 !important;
        }

        .food-details-container {
            background-color: #EEEDEB;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        img {
            height: 100px;
            width: 100px;
            border-radius: 50px;
        }

        .cont h3 {
            margin-left: 1vw;
            color: #2F3645;
        }

        .card-title {
            margin-left: 1.1vw;
            color: #2F3645;
        }

        form button {
            margin-left: 1vw;
            margin-top: 2px;
        }

        .quantity-controls {
            margin-left: 1vw;
        }

        .btn1 {
            background-color: #d69191;
            border-radius: 15px;
        }

        .btn1,
        .btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn1:hover,
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    @include('layouts.navbar', ['cartItemCount' => $carts->count()])
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    @foreach ($carts as $cart)
                        <div class="d-flex align-items-center food-details-container mb-3">
                            <div>
                                <img src="{{ asset('storage/' . $cart->food->image) }}" class=""
                                    alt="{{ $cart->food->name }}">
                            </div>
                            <div
                                class="d-flex flex-column flex-md-row align-items-center justify-content-between ms-md-3 mt-3 mt-md-0">
                                <div class="cont">
                                    <h2 class="card-title">{{ $cart->food->name }}</h2>
                                    <h3>₹<span id="price-{{ $cart->id }}"
                                            data-original-price="{{ $cart->food->price }}">{{ $cart->food->price }}</span>
                                    </h3>
                                    <div class="quantity-controls">
                                        <button type="button" class="btn1 btn-sm"
                                            onclick="decreaseQuantity({{ $cart->id }})">-</button>
                                        <input type="text" name="quantity" id="quantity-{{ $cart->id }}"
                                            value="1" class="form-control d-inline"
                                            style="width: 40px; height:33px; text-align: center;border-radius:50%;background-color:rgb(243, 133, 150);color:white;"
                                            readonly>
                                        <button type="button" class="btn1 btn-sm"
                                            onclick="increaseQuantity({{ $cart->id }})">+</button>
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
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="food-details-container">
                    <div class="d-flex justify-content-between align-items-center">
                        @if ($carts->count() > 0)
                            <div style="color: #2F3645;">
                                Total Price: ₹ <span id="total-price">0.00</span>
                            </div>

                            <a href="{{ route('cart.checkout') }}" class="btn btn-sm btn-light"
                                style="border-color: #2F3645;">Check out</a>
                        @else
                            <div>
                                No items added to the cart.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function updatePrice(cartId) {
            let originalPrice = parseFloat(document.getElementById('price-' + cartId).getAttribute('data-original-price'));
            let quantity = parseInt(document.getElementById('quantity-' + cartId).value);
            let newPrice = (originalPrice * quantity).toFixed(2);
            document.getElementById('price-' + cartId).innerText = newPrice;
            updateTotalPrice();
            updateQuantity(cartId, quantity); // Add this line to update quantity in localStorage
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            let cartIds = document.querySelectorAll('[id^="price-"]');
            cartIds.forEach(function(element) {
                let price = parseFloat(element.innerText);
                totalPrice += price;
            });
            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
            localStorage.setItem('totalPrice', totalPrice.toFixed(2));
        }

        function updateQuantity(cartId, quantity) {
            localStorage.setItem('quantity-' + cartId, quantity); // Store quantity in localStorage
        }
        window.onload = function() {
            updateTotalPrice();
            updateQuantities(); // Add this line to update quantities on page load
        }

        function updateQuantities() {
            let cartIds = document.querySelectorAll('[id^="quantity-"]');
            cartIds.forEach(function(element) {
                let cartId = element.id.split('-')[1];
                let quantity = localStorage.getItem('quantity-' + cartId);
                if (quantity) {
                    element.value = quantity;
                    updatePrice(cartId); // Update the price based on the retrieved quantity
                }
            });
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
            document.querySelectorAll('form[id^="removeCartForm"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    const url = this.getAttribute(
                    'data-url'); // Get the URL from data-url attribute
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
                            return response.json(); // Parse JSON response
                        })
                        .then(data => {
                            // Check for success
                            if (data.success) {
                                // Show success message using SweetAlert2 Toast
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                });

                                // Optionally, remove the item from the DOM
                                // Example: form.closest('.cart-item').remove(); // Adjust selector as needed
                            } else {
                                // Show error message using SweetAlert2 Toast
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
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
</body>

</html>
