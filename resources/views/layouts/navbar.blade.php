<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="/">FOODIE</a>

            <!-- Navbar Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Search Section -->
            {{-- <form action="{{ route('food.search') }}" method="GET" class="d-flex ms-3 "
                style="max-width: 300px; width: 100%;color">
                <input class="form-control bg-gray-300 me-2 rounded" type="search" name="search" placeholder="Find Your Fav F🍔🥘d!!"
                    aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
            </form> --}}

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Center Links -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/main" style="color: #ffffff; text-decoration:none">Home</a>
                    </li>
                    @guest
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.view') }}"
                                style="color: #ffffff; text-decoration:none">Orders</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" style="color: #ffffff; text-decoration:none"
                                id="menuLink">Menu</a>
                            <!-- Dropdown will be populated here -->
                            <ul class="dropdown-menu" id="foodDropdown"></ul>
                        </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link" href="/about-us" style="color: #ffffff; text-decoration:none">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact-us" style="color: #ffffff; text-decoration:none">Contact
                            us</a>
                    </li>
                </ul>

                <!-- Right-Aligned Icons and Dropdown -->
                <ul class="navbar-nav ms-auto mr-6">
                    @guest
                        <li class="nav-item">
                            <a href="/login" class="login-button">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="register-button">Register</a>
                        </li>
                    @else
                        <!-- Cart Icon -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.view') }}"
                                style="color: #FFD28D; text-decoration:none">
                                <i style="font-size:20px" class="fas">&#xf07a;</i>
                                @if ($cartCount > 0)
                                    <span class="badge bg-danger">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                        <!-- Favorite Icon -->
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="{{ route('food.fav') }}" style="color: #FFD28D; text-decoration:none">
                                <i style="font-size:20px" class="fas fa-heart fav"></i>
                            </a>
                        </li>
                        <!-- User Dropdown -->
                        <div class="profile-dropdown">
                            <!-- Profile Image -->
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Image"
                                class="rounded-circle" style="width: 40px; height: 40px;" id="dropdownToggle">
                            <!-- Dropdown Menu -->
                            <ul class="dropdown-menu" id="profileDropdown">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <a class="dropdown-item" href="#" onclick="confirmLogout(event)">
                                            <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch food categories and item counts via AJAX
            $.ajax({
                url: '{{ route('food.items') }}',
                method: 'GET',
                success: function(data) {
                    console.log('Food categories:', data); // Log response for debugging
                    if (data && Array.isArray(data) && data.length > 0) {
                        let dropdown = $('#foodDropdown');
                        dropdown.empty();
                        data.forEach(function(category) {
                            let categoryRoute =
                                `{{ url('/welcome') }}/${encodeURIComponent(category.category)}`;
                            dropdown.append(`
                        <li>
                            <a class="dropdown-item" href="${categoryRoute}">
                                ${category.category} <!-- <span class="badge bg-primary">${category.item_count}</span> -->
                            </a>
                        </li>
                    `);
                        });
                    } else {
                        console.log('No categories found or invalid data format');
                        $('#foodDropdown').append(
                            '<li><a class="dropdown-item" href="#">No categories available</a></li>'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching food categories:', status, error, xhr.responseText);
                    $('#foodDropdown').append(
                        '<li><a class="dropdown-item" href="#">Error loading categories</a></li>');
                }
            });

            // Toggle menu dropdown on click for mobile
            $('.nav-item.dropdown .nav-link').on('click', function(e) {
                if ($(window).width() < 992) {
                    e.preventDefault();
                    const dropdownMenu = $(this).next('.dropdown-menu');
                    dropdownMenu.toggleClass('show');
                }
            });

            // Toggle profile dropdown on click
            $('#dropdownToggle').on('click', function(e) {
                e.stopPropagation();
                $('#profileDropdown').toggleClass('show');
            });

            // Close all dropdowns if clicked outside
            $(document).on('click', function(e) {
                const profileDropdown = $('#profileDropdown');
                const profileToggle = $('#dropdownToggle');
                const menuDropdowns = $('.navbar-nav .dropdown-menu');
                const menuToggles = $('.nav-item.dropdown .nav-link');

                if (!profileDropdown.is(e.target) && profileDropdown.has(e.target).length === 0 && !
                    profileToggle.is(e.target)) {
                    profileDropdown.removeClass('show');
                }

                if ($(window).width() < 992) {
                    if (!menuDropdowns.is(e.target) && menuDropdowns.has(e.target).length === 0 && !
                        menuToggles.is(e.target)) {
                        menuDropdowns.removeClass('show');
                    }
                }
            });

            // Active link highlighting
            const navbarLinks = $('.navbar-nav .nav-link');
            navbarLinks.on('click', function() {
                navbarLinks.removeClass('active');
                $(this).addClass('active');
            });

            // Cart button page refresh
            $('.add-to-cart-btn').on('click', function() {
                setTimeout(function() {
                    location.reload();
                }, 2000);
            });

            // Logout confirmation
            window.confirmLogout = function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure you want to log out?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, log out'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#logout-form').submit();
                    }
                });
            };
        });
    </script>
</body>

</html>
