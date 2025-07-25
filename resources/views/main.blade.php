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
    @include('opening-hours.hours')
    @include('menu.menu')
    <!-- Categories Section -->
    @include('cards.card')
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
