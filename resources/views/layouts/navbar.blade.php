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
    <style>
        body {
            overflow-x: hidden;
        }
        .navbar {
            background-color: #EEEDEB;
            padding: 10px;
            /* border-bottom-left-radius: 20px; */
            /* border-bottom-right-radius: 20px; */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            color: rgba(7, 58, 2, 0.288) !important;
            font-weight: bold;
        }
        .navbar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .navbar li {
            padding: 0 15px;
        }
        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0;
            height: 2px;
            background-color: rgb(0, 0, 0);
            transition: width 0.3s ease;
        }
        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }
           /* Simplified dropdown styles */
        .profile-dropdown {
            position: relative;
        }

        .profile-dropdown img {
            cursor: pointer;
            border: 2px solid #EEEDEB;
            transition: border-color 0.3s;
        }

        .profile-dropdown img:hover {
            border-color: #ccc;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 5px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none; /* Hidden by default */
            z-index: 10;
        }

        .dropdown-menu.show {
            display: block; /* Show dropdown when toggled */
        }

        .dropdown-menu .dropdown-item {
            padding: 10px 20px;
            color: #2F3645;
            text-align: left;
            transition: background-color 0.3s;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f7f7f7;
        }
        /* Menu Dropdown */
    .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
        display: block;  /* Show dropdown on hover */
    }

    .dropdown-menu li {
        list-style-type: none;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="/">Food</a>

            <!-- Navbar Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Search Section -->
            <form action="{{ route('food.search') }}" method="GET" class="d-flex ms-3" style="max-width: 300px; width: 100%;">
                <input class="form-control me-2" type="search" name="search" placeholder="Find Your Fav F🍔🥘d!!" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-search"></i></button>
            </form>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Center Links -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/welcome" style="color: #2F3645; text-decoration:none">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" style="color: #2F3645; text-decoration:none" id="menuLink">Menu</a>
                        <!-- Dropdown will be populated here -->
                        <ul class="dropdown-menu" id="foodDropdown"></ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #2F3645; text-decoration:none">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #2F3645; text-decoration:none">Contact us</a>
                    </li>
                    @guest
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.view') }}" style="color: #2F3645; text-decoration:none">Orders</a>
                        </li>
                    @endguest
                </ul>

                <!-- Right-Aligned Icons and Dropdown -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a href="/login" class="btn btn-sm btn-danger">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn btn-sm btn-danger">Register</a>
                        </li>
                    @else
                        <!-- Cart Icon -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.view') }}" style="color: #000000; text-decoration:none">
                                <i style="font-size:20px" class="fas">&#xf07a;</i>
                                @if ($cartCount > 0)
                                    <span class="badge bg-danger">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                        <!-- Favorite Icon -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('food.fav') }}" style="color: rgb(168, 20, 20); text-decoration:none">
                                <i style="font-size:20px" class="fas fa-heart fav"></i>
                            </a>
                        </li>
                        <!-- User Dropdown -->
                        <div class="profile-dropdown">
                            <!-- Profile Image -->
                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                 alt="Profile Image"
                                 class="rounded-circle"
                                 style="width: 40px; height: 40px;"
                                 id="dropdownToggle">
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
    // Fetch food items via AJAX
    $.ajax({
        url: '{{ route("food.items") }}', // URL to the route
        method: 'GET',
        success: function(data) {
            // Check if there is any data
            if (data.length > 0) {
                let dropdown = $('#foodDropdown');
                dropdown.empty(); // Clear the dropdown

                // Add a default "Select a food item" option
                dropdown.append('<li><a class="dropdown-item" href="#">Select a food item</a></li>');

                // Loop through each food item and add to the dropdown
                data.forEach(function(food) {
                    dropdown.append(`
                        <li><a class="dropdown-item" href="#">${food.name}</a></li>
                    `);
                });
            }
        },
        error: function(xhr, status, error) {
            console.log("Error fetching food items: " + error);
        }
    });
});

        document.addEventListener("DOMContentLoaded", function() {
            const navbarLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navbarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navbarLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            const addToCartBtn = document.querySelector('.add-to-cart-btn');

            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function() {
                    // Perform any additional logic for adding to the cart here

                    // Wait for 3 seconds, then refresh the page
                    setTimeout(function() {
                        location.reload(); // Refresh the page
                    }, 2000);
                });
            }
        });

        // Toggle Dropdown Visibility
    document.getElementById('dropdownToggle').addEventListener('click', function () {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('show');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('profileDropdown');
        const toggle = document.getElementById('dropdownToggle');

        if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });

        function confirmLogout(event) {
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
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>

</html>
