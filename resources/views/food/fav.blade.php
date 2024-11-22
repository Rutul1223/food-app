<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E6B9A6 !important;
        }

        img {
            height: 100px;
        }
        .no-favorites-container {
            text-align: center;
            padding: 40px;
            background-color: #FFF5F3;
            border: 2px dashed #FF6F61;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            color: #333;
        }

        .no-favorites-container h3 {
            font-size: 1.8rem;
            color: #FF6F61;
            margin-bottom: 10px;
        }

        .no-favorites-container p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .no-favorites-container img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .no-favorites-container a {
            display: inline-block;
            background-color: #FF6F61;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .no-favorites-container a:hover {
            background-color: #e35b50;
        }

        .food-details-container {
            background-color: #EEEDEB;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-img-top {
            border-radius:50%;
        }

        .card-title {
            margin-left: 1.1vw;
        }

        .card-text {
            font-size: 1rem;
            color: #333;
        }
        .cont{
            gap: 6vw;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div>
                    @if($favorites->isEmpty())
                    <div class="no-favorites-container">
                        <img src="/storage/images/foods/empty_favorites.png" alt="No Favorites">
                        <h3>No Favorites Yet!</h3>
                        <p>You haven’t added any items to your favorites. Start exploring and add your favorite items to this list.</p>
                        <a href="{{ route('welcome') }}">Browse Food Items</a>
                    </div>
                    @else
                    @foreach($favorites as $favorite)
                    <div class="d-flex align-items-center food-details-container mb-3">
                        <div>
                            @if($favorite->food->image)
                            <a href={{ route('food.show',$favorite->food->id) }}><img src="{{ asset('storage/' . $favorite->food->image) }}" class="card-img-top"
                                alt="Food Image"></a>
                            @else
                            <div class="card-img-top text-center py-3">No Image</div>
                            @endif
                        </div>
                        <div
                            class="d-flex flex-column flex-md-row align-items-center justify-content-between ms-md-3 mt-3 mt-md-0">
                            <div class="cont d-flex">
                                <h5 class="card-title">{{ $favorite->food->name }}</h5>
                                <p class="card-text"><b>Rs. {{ $favorite->food->price }}</b></p>
                                <i class="fas fa-heart like-heart" style="color: red;"><form id="favoriteForm{{ $favorite->food->id }}" action="{{ route('food.favorite') }}" method="POST"
                                    style="display: none;"></form>
                                </i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
