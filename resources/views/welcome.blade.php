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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
</head>

<body style="background-color: #f8f5f0;">
    @include('layouts.navbar')

    <!-- Hero Section -->
    <section class="gallery-hero">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Our Food Gallery</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="section-subtitle">Delicious Food</span>
                <h2 class="section-title">Our Food Gallery</h2>
                <div class="divider">
                    <img src="{{ asset('hero_bg_1.jpg') }}" alt="Divider">
                </div>
            </div>

            <!-- Gallery Filter Dropdown -->
            <div class="gallery-filter text-center mb-5">
                <select id="categoryFilter" class="form-select w-50 mx-auto" aria-label="Category filter">
                    <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category }}"
                            {{ $selectedCategory === $category->category ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Gallery Grid -->
            <div class="row gallery-grid">
                @foreach ($foods as $food)
                    <div class="col-lg-4 col-md-6 gallery-item mb-4" data-category="{{ $food->category }}">
                        <div class="gallery-card">
                            <div class="gallery-img">
                                <a href="{{ route('food.show', $food->id) }}">
                                    @if ($food->image)
                                        <img src="{{ asset('storage/' . $food->image) }}" class="img-fluid"
                                            alt="Food Image">
                                    @else
                                        <div class="no-image-placeholder">No Image Available</div>
                                    @endif
                                </a>
                                <div class="time-badge">
                                    {{ $food->time ? \Carbon\Carbon::parse($food->time)->format('i') . ' mins' : 'N/A' }}
                                </div>
                            </div>
                            <div class="gallery-card-body">
                                <div class="food-name-row">
                                    <h3>{{ $food->name }}</h3>
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
                                </div>
                                <div class="price-row">
                                    <div class="price">Rs. {{ $food->price }}</div>
                                    <form id="cartForm{{ $food->id }}" method="POST"
                                        data-url="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="food_id" value="{{ $food->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-cart">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Category filter functionality - navigates to the proper route
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;

            // Build the URL based on the selected category
            // Route pattern: /welcome/{category?}
            let url = '/welcome';
            if (selectedCategory && selectedCategory !== 'all') {
                // Encode the category to handle special characters and spaces
                url += '/' + encodeURIComponent(selectedCategory);
            }

            // Navigate to the new URL
            window.location.href = url;
        });

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
    </script>
</body>
</html>
