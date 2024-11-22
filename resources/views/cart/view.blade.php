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
    <link rel="stylesheet" href="{{ asset('css/cartView.css') }}">
</head>

<body>
    @include('layouts.navbar', ['cartItemCount' => $carts->count()])
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="savings-message" id="savings-message">You saved: ₹<span id="saved-amount">0.00</span></div>
            <div class="col-md-8">
                <div>
                    @if($carts->isEmpty())
                    <div class="no-carts-container">
                        <img src="/storage/images/foods/empty_carts.png" alt="No cart">
                        <h3>No carts Yet!</h3>
                        <p>You haven’t added any items to your carts. Start exploring and add your cart items to this list.</p>
                        <a href="{{ route('welcome') }}">Browse Food Items</a>
                    </div>
                    @else
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
                                    <h3>
                                        <span class="text-muted" style="text-decoration: line-through; margin-right: 5px; font-weight:350">
                                            ₹{{ $cart->food->price + 50 }}
                                        </span>
                                        ₹<span id="price-{{ $cart->id }}" data-original-price="{{ $cart->food->price }}">{{ $cart->food->price }}</span>
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
                    @endif
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
            updateQuantity(cartId, quantity);
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            let originalTotalPrice = 0;

            let cartItems = document.querySelectorAll('[id^="price-"]');
            cartItems.forEach(function(element) {
                let originalPrice = parseFloat(element.getAttribute('data-original-price'));
                let quantity = parseInt(document.getElementById('quantity-' + element.id.split('-')[1]).value);

                originalTotalPrice += (originalPrice + 50) * quantity; // Summing the original (crossed-out) prices
                totalPrice += originalPrice * quantity; // Summing the discounted prices
            });

            document.getElementById('total-price').innerText = totalPrice.toFixed(2);

            // Calculate saved amount and update the display
            let savedAmount = originalTotalPrice - totalPrice;
            document.getElementById('saved-amount').innerText = savedAmount.toFixed(2);

            // Show or hide the savings message based on the amount saved
            if (savedAmount > 0) {
                document.getElementById('savings-message').style.display = 'block';
            } else {
                document.getElementById('savings-message').style.display = 'none';
            }

            localStorage.setItem('totalPrice', totalPrice.toFixed(2));
        }

        window.onload = function() {
            updateTotalPrice();
            updateQuantities();
        }

        function updateQuantity(cartId, quantity) {
            // Save quantity to local storage
            localStorage.setItem('quantity-' + cartId, quantity);
        }

        function increaseQuantity(cartId) {
            let quantityElement = document.getElementById('quantity-' + cartId);
            let quantity = parseInt(quantityElement.value);
            quantity++;
            quantityElement.value = quantity;
            updateQuantity(cartId, quantity);  // Store the updated quantity
            updatePrice(cartId);
        }

        function decreaseQuantity(cartId) {
            let quantityElement = document.getElementById('quantity-' + cartId);
            let quantity = parseInt(quantityElement.value);
            if (quantity > 1) {
                quantity--;
                quantityElement.value = quantity;
                updateQuantity(cartId, quantity);  // Store the updated quantity
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
                                // Remove the cart item from the DOM immediately after success
                                form.closest('.food-details-container').remove();

                                updateTotalPrice();
                                setTimeout(() => {
                                    location.reload();  // This will reload the page
                                }, 2000);
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
