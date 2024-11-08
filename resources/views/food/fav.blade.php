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
        .card {
            background-color: #7d995c !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: none;
        }

        .card-header {
            background-color: #333;
            color: #fff;
            padding: 12px 15px;
            border-bottom: none;
        }

        .card-body {
            padding: 15px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div>
                    @foreach($favorites as $favorite)
                    <div class="d-flex align-items-center food-details-container mb-3">
                        <div>
                            @if($favorite->food->image)
                            <img src="{{ asset('storage/' . $favorite->food->image) }}" class="card-img-top"
                                alt="Food Image">
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
                    {{-- <div class="card">
                        <div class="card-header">
                            Not found
                        </div>
                        <div class="card-body">
                            <p class="card-text2">Any Favourite items have been added yet.</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
