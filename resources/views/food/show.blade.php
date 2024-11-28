<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $food->name }} - Food Details</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/food-show.css') }}">
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="food-details-container">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="detail-img img-fluid" src="{{ asset('storage/' . $food->image) }}"
                                alt="{{ $food->name }}">
                        </div>
                        <div class="col-md-6">
                            <h2 class="mt-4"> {{ $food->name }}</h2>
                            <h3> Rs. {{ $food->price }}</h3>
                            <h4 class="card-description">{{ $food->description }}</h4>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="food_id" value="{{ $food->id }}">
                                <div class="crt">
                                    <button type="submit" class="btn btn-sm btn-danger">Add To Cart <i
                                            class="fas fa-dolly"></i></button>
                                    <button type="button" class="btn btn-sm btn-success ms-2 buy"><a
                                            href="{{ route('cart.checkout') }}"
                                            style="color: inherit; text-decoration:none;">Buy
                                            Now</a></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Pagination Section -->
                <div class="container mt-5">
                    <h4 class="text-center">More Items You May Like</h4>
                    <div class="d-flex align-items-center position-relative">
                        <!-- Previous Button -->
                        <button class="btn btn-sm btn-primary me-3 position-absolute start-0" onclick="previousPage()">
                            &laquo;
                        </button>

                        <!-- Food Items -->
                        <div id="food-items-container" class="row2 flex-grow-1 mx-5">
                            @foreach ($foods as $index => $foodItem)
                                <div class="card bg-dark">
                                    <img class="card-img-top" src="{{ asset('storage/' . $foodItem->image) }}"
                                        alt="{{ $foodItem->name }}">
                                    <h5 class="card-title text-white">{{ $foodItem->name }}</h5>
                                    <p class="card-text text-white">Rs. {{ $foodItem->price }}</p>
                                    <button class="btn btn-sm btn-warning mark-favorite" data-id="{{ $foodItem->id }}">
                                        <i class="{{ $foodItem->isFavorite ? 'fas' : 'far' }} fa-heart"></i>
                                        {{ $foodItem->isFavorite ? 'Unmark' : 'Mark as Favorite' }}
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Next Button -->
                        <button class="btn btn-sm btn-primary ms-3 position-absolute end-0" onclick="nextPage()">
                            &raquo;
                        </button>
                    </div>
                </div>


                <div class="text-center mt-3">
                    <a href="/welcome" class="btn btn-sm btn-light"><i class="fas fa-angle-double-left"></i>&nbsp;Go
                        Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Toastr JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        var currentPage = 0;
        var itemsPerPage = 5;
        var totalItems = {{ count($foods) }};

        function showItems(page) {
            var startIndex = page * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;

            var items = document.querySelectorAll('.card');
            for (var i = 0; i < items.length; i++) {
                if (i >= startIndex && i < endIndex) {
                    items[i].style.display = 'block';
                } else {
                    items[i].style.display = 'none';
                }
            }
        }

        function previousPage() {
            if (currentPage > 0) {
                currentPage--;
                showItems(currentPage);
            }
        }

        function nextPage() {
            if ((currentPage + 1) * itemsPerPage < totalItems) {
                currentPage++;
                showItems(currentPage);
            }
        }
        document.querySelectorAll('.mark-favorite').forEach(button => {
            button.addEventListener('click', function() {
                var foodId = this.dataset.id;
                var icon = this.querySelector('i');
                var isFavorite = icon.classList.contains('fas');

                // Make an AJAX request to toggle favorite
                fetch(`/favorite`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            food_id: foodId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Toggle the icon class based on the current status
                            icon.classList.toggle('fas', !isFavorite);
                            icon.classList.toggle('far', isFavorite);
                            this.textContent = isFavorite ? 'Mark as Favorite' : 'Unmark';

                            // Show SweetAlert toast notification
                            if (isFavorite) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Item removed from favorites!',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                            } else {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Item marked as favorite!',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                            }
                        } else {
                            console.error('Error:', data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        showItems(currentPage);
    </script>
</body>

</html>
