<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Food Gallery</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    @include('layouts.navbar')
    @include('layouts.carousel')
    <div class="container mt-5">
        <h2 class="text-center my-3 ">Food Items</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($foods as $food)
                <div class="col">
                    <div class="card">
                        <a href="{{ route('food.show', $food->id) }}">
                            @if ($food->image)
                                <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top" alt="Food Image">
                            @else
                                <div class="card-img-top text-center py-3">No Image</div>
                            @endif
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $food->name }}
                                @auth
                                    <i data-food-id="{{ $food->id }}"
                                        class="fas fa-heart like-heart {{ $food->isFavorite ? 'favorite-added' : '' }}"
                                        onclick="addToFavorites({{ $food->id }})"></i>
                                    <form id="favoriteForm{{ $food->id }}" action="{{ route('food.favorite') }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="food_id" value="{{ $food->id }}">
                                    </form>
                                @endauth
                            </h5>

                            <div class="fake">
                                <p class="card-text"> Rs. {{ $food->price }}</p>
                                <p class="card-text text-muted"> Rs. {{ $food->price + 50 }}</p>
                            </div>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="crt">
                                <form id="cartForm{{ $food->id }}" method="POST"
                                    data-url="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="food_id" value="{{ $food->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-danger add-to-cart-btn">Add To Cart <i
                                            class="fas">&#xf07a;</i></button>&nbsp;
                                </form>
                                <a href="{{ route('food.show', $food->id) }}" class="btn btn-dark">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        @if ($foods->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $foods->previousPageUrl() }}">&laquo;</a>
                            </li>
                        @endif

                        @foreach ($foods->getUrlRange(1, $foods->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $foods->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($foods->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $foods->nextPageUrl() }}">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function addToFavorites(foodId) {
            const heartIcon = document.querySelector(`[data-food-id="${foodId}"]`);
            const form = document.getElementById(`favoriteForm${foodId}`);
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        heartIcon.classList.toggle('favorite-added', data.isFavorite);
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.isFavorite ?
                                'Added to favorites!' : 'Removed from favorites!',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    } else {
                        console.error('Error:', data.error);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[id^="cartForm"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    const formData = new FormData(this);
                    const url = this.getAttribute(
                        'data-url'); // Get the URL from data-url attribute

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
