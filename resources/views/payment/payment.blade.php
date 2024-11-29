<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Section</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #303030;
        }

        .checkout-form {
            background-color: #EEEDEB;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .checkout-header {
            font-size: 2rem; /* Increase font size for better emphasis */
            color: #a2a3a5; /* Slightly lighter shade of white */
            font-weight: bold;
            margin-top: 3rem; /* Adjust top margin */
            text-align: center;
            font-family: sans-serif;
            text-transform: uppercase; /* Make text all uppercase for style */
            letter-spacing: 2px; /* Add spacing between letters for a modern look */
            padding: 10px; /* Add padding for better spacing */
        }

        .form-control,
        .btn {
            border-radius: 20px;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Styles for suggestions */
        .suggestions {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            z-index: 1000;
            width: calc(100% - 30px);
            max-height: 200px;
            overflow-y: auto;
            border-radius: 5px;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }

        /* Style for Stripe card element */
        #card-element {
            background-color: #FFF;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #card-errors {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mx-auto">
                <div class="checkout-header">Payment Section</div>
                <div class="checkout-form">
                    <div class="list-group-item">Total Amount: <b>₹<span
                                id="total-amount">{{ number_format($totalPrice, 2) }}</span></b></div>
                    <hr>
                    <form id="payment-form" method="POST" action="{{ route('process.order') }}"
                        onsubmit="return handleFormSubmit()">
                        @csrf
                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="text" class="form-control" id="total_amount" name="total_amount"
                                value="{{ number_format($totalPrice, 2) }}" readonly>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="autocomplete" class="form-label">Address</label>
                            <input type="text" class="form-control" id="autocomplete" name="address"
                                placeholder="Enter address" required autocomplete="off" value="{{ old('address', $userAddress) }}">
                                <small id="profile-address-note" class="text-muted">This address is fetched from your profile. You can edit it if needed.</small>
                            <div id="suggestions" class="suggestions" style="display: none;"></div>
                        </div>
                        <div class="mb-4">
                            <label for="details" class="card-details">Card Details</label>
                            <div id="card-element"></div>
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <button type="submit" id="submit-payment" class="btn btn-sm btn-success">Buy Now</button>
                        <a href="/welcome" class="btn btn-sm btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const autocompleteInput = document.getElementById('autocomplete');
        const suggestionsContainer = document.getElementById('suggestions');

        autocompleteInput.addEventListener('input', function() {
            const query = this.value;
            if (query.length > 2) {
                fetch(
                        `https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&q=${query}&limit=10`
                        )
                    .then(response => response.json())
                    .then(data => {
                        suggestionsContainer.innerHTML = '';
                        if (data.length > 0) {
                            suggestionsContainer.style.display = 'block';
                            data.forEach(item => {
                                const suggestionItem = document.createElement('div');
                                suggestionItem.className = 'suggestion-item';
                                suggestionItem.innerText = item.display_name;
                                suggestionItem.onclick = function() {
                                    autocompleteInput.value = item.display_name;
                                    suggestionsContainer.style.display = 'none';
                                };
                                suggestionsContainer.appendChild(suggestionItem);
                            });
                        } else {
                            suggestionsContainer.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching address suggestions:', error);
                        suggestionsContainer.style.display = 'none';
                    });
            } else {
                suggestionsContainer.style.display = 'none';
            }
        });

        document.addEventListener('click', function(event) {
            if (!autocompleteInput.contains(event.target) && !suggestionsContainer.contains(event
                    .target)) {
                suggestionsContainer.style.display = 'none';
            }
        });


        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();

            // alert('Order placed successfully!');
        }
        document.addEventListener('DOMContentLoaded', () => {
            const addressInput = document.getElementById('autocomplete');
            const note = document.getElementById('profile-address-note');

            addressInput.addEventListener('input', () => {
                if (note) {
                    note.style.display = 'none';
                }
            });
        });

    </script>
</body>

</html>
