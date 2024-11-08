<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="bill">
                    <h3>Food-bill</h3>
                    <hr>
                    <div class="bill-details">
                        <div class="bill-header">
                            <div class="header-item">Product</div>
                            <div class="header-item">Quantity</div>
                            <div class="header-item text-end">Price</div>
                        </div>
                        <div class="bill-items">
                            @php
                            $totalPrice = 0;
                            @endphp
                            @foreach ($carts as $cart)
                            @if ($cart->user_id == auth()->id())
                            <div class="bill-item">
                                <div class="item-name">{{ $cart->food->name }}</div>
                                <div class="item-quantity"><span id="quantity-{{ $cart->id }}"></span></div> <!-- Updated line for quantity -->
                                <div class="item-price">₹{{ $cart->food->price }}</div>
                                @php
                                $totalPrice += $cart->quantity * $cart->food->price;
                                @endphp
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="total">
                        <div class="total-label">Total:</div>
                        <div id="total-amount">₹{{ number_format($totalPrice, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-div">
            <a href="{{ route('payment.payment') }}" class="btn  btn-warning text-dark">Proceed to Pay</a>
            <a href="/welcome" class="btn  btn-light">Cancel</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const totalPrice = localStorage.getItem('totalPrice');
            if (totalPrice) {
                document.getElementById('total-amount').innerText = totalPrice;
            } else {
                document.getElementById('total-amount').innerText = '0.00';
            }

            let cartIds = document.querySelectorAll('[id^="quantity-"]');
            cartIds.forEach(function (element) {
                let cartId = element.id.split('-')[1];
                let quantity = localStorage.getItem('quantity-' + cartId);
                if (quantity) {
                    element.innerText = quantity;
                }
            });
        });
    </script>
</body>
</html>
