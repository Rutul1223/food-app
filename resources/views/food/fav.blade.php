<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites - Elegencia</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto:wght@400&display=swap" rel="stylesheet">
    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        body {
            font-family: 'Baskervville', sans-serif;
            background-color: #091E24 !important;
        }

        .favorites-section {
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

        .no-favorites-container {
            text-align: center;
            padding: 40px;
            background-color: #040D10;
            border: 2px solid #FFD28D;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            color: #ccc;
        }

        .no-favorites-container img {
            max-width: 150px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .no-favorites-container h3 {
            font-family: 'Baskervville', serif;
            font-size: 1.8rem;
            color: #FFD28D;
            margin-bottom: 10px;
        }

        .no-favorites-container p {
            font-size: 1rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        .no-favorites-container a {
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

        .no-favorites-container a:hover {
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

        .card-img-top {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .food-details-container:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-title {
            font-family: 'Baskervville', serif;
            font-size: 1.5rem;
            color: #FFD28D;
            margin: 0;
        }

        .card-text {
            font-size: 1rem;
            color: #ccc;
        }

        .price {
            margin-top: 10px;
            margin-left: 4rem;
            font-family: 'Baskervville', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: #d4a373;
        }

        .like-heart {
            margin-left: 4rem;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .like-heart:hover {
            transform: scale(1.2);
        }

        .cont {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .title {
                font-size: 36px;
            }

            .card-img-top {
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
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <section class="favorites-section">
        <div class="container">
            <div class="subtitle">Your Favorites</div>
            <h2 class="title">Favorite Dishes</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if($favorites->isEmpty())
                    <div class="no-favorites-container">
                        <img src="/storage/images/foods/empty_favorites.png" alt="No Favorites">
                        <h3>No Favorites Yet!</h3>
                        <p>You haven’t added any items to your favorites. Start exploring and add your favorite dishes to this list.</p>
                        <a href="{{ route('main') }}">Browse Food Items</a>
                    </div>
                    @else
                    @foreach($favorites as $favorite)
                    <div class="food-details-container">
                        <div class="d-flex align-items-center">
                            <div>
                                @if($favorite->food->image)
                                <a href="{{ route('food.show', $favorite->food->id) }}">
                                    <img src="{{ asset('storage/' . $favorite->food->image) }}" class="card-img-top" alt="{{ $favorite->food->name }}">
                                </a>
                                @else
                                <div class="card-img-top text-center py-3">No Image</div>
                                @endif
                            </div>
                            <div class="cont ms-3">
                                <h5 class="card-title" style="color: #FFD28D">{{ $favorite->food->name }}</h5>
                                <p class="price">₹{{ number_format($favorite->food->price, 2) }}</p>
                                <i class="fas fa-heart like-heart" style="color: red;">
                                    <form id="favoriteForm{{ $favorite->food->id }}" action="{{ route('food.favorite') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="food_id" value="{{ $favorite->food->id }}">
                                    </form>
                                </i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

            // Animate no-favorites-container if present
            if (document.querySelector('.no-favorites-container')) {
                gsap.from(".no-favorites-container", {
                    duration: 1.2,
                    opacity: 0,
                    y: 50,
                    ease: "power3.out",
                    delay: 0.9
                });
            }

            // Animate favorite items
            gsap.from(".food-details-container", {
                duration: 1.2,
                opacity: 0,
                y: 50,
                ease: "power3.out",
                stagger: 0.2,
                delay: 0.9
            });
        });
    </script>
</body>
</html>
