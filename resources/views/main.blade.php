<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food app</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Loader -->
    <div id="loader" class="loader-overlay">
        <div class="loader"></div>
    </div>
    @include('layouts.navbar')
    @include('layouts.hero')

    <!-- Categories Section -->
    <main id="categories">
        <div class="container">
            <h2 class="section-title text-center mb-5">Food Categories</h2>
            <div class="row">
                @foreach ($categories as $food)
                    @php
                        $images = [
                            'Burgers' =>
                                'https://img.freepik.com/free-photo/delicious-burger-with-fresh-ingredients_23-2150857908.jpg?semt=ais_hybrid',
                            'Chinese' =>
                                'https://t4.ftcdn.net/jpg/04/46/85/95/360_F_446859522_XnoDcU8PeIVAnRR1xDNXnlyfBo3xViSW.jpg',
                            'South-Indian' => 'https://i.pinimg.com/736x/65/ba/bf/65babfa10a37ee049e6b556f672103e5.jpg',
                            'Samosa' =>
                                'https://images.pexels.com/photos/4449068/pexels-photo-4449068.jpeg?cs=srgb&dl=pexels-satyam-verma-2901977-4449068.jpg&fm=jpg',
                            'Street-food' =>
                                'https://plus.unsplash.com/premium_photo-1669557209068-d4353d903be2?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZGFyayUyMGZvb2QlMjBwaG90b2dyYXBoeXxlbnwwfHwwfHx8MA%3D%3D',
                            'Pizza' =>
                                'https://thumbs.dreamstime.com/b/pizza-slices-flying-black-background-delicious-peperoni-pizza-slices-flying-pizza-pieces-melting-cheese-pizza-slices-330957696.jpg',
                            'Italian' =>
                                'https://img.freepik.com/premium-photo/closeup-image-fork-with-homemade-italian-tomatoes-spaghetti-pasta-tasty-italian-food-concept_67155-21166.jpg',
                            'Main-course' =>
                                'https://img.freepik.com/premium-photo/indian-lunch-dinner-main-course-food-group-includes-paneer-butter-masala-dal-makhani-palak-paneer-roti-rice-etc-selective-focus_466689-6854.jpg',
                        ];
                        $image =
                            $images[$food->category] ??
                            'https://img.freepik.com/free-photo/delicious-burger-with-fresh-ingredients_23-2150857908.jpg?semt=ais_hybrid';
                    @endphp
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="{{ route('welcome', ['category' => $food->category]) }}">
                            <div class="category-card shadow-lg">
                                <img src="{{ $image }}" alt="{{ $food->category }}"
                                    class="img-fluid w-100 category-img">
                                <div class="category-overlay d-flex align-items-center justify-content-center">
                                    <h4 class="text-white">{{ $food->category }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- JavaScript -->
    <script>
        window.onload = function() {
            document.getElementById('loader').style.display = 'none';
        };
    </script>
</body>

</html>
