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
            <a class="navbar-brand" href="/">Food</a>

            <!-- Navbar Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Search Section -->
            <form action="{{ route('food.search') }}" method="GET" class="d-flex ms-3 "
                style="max-width: 300px; width: 100%;color">
                <input class="form-control bg-gray-300 me-2 rounded" type="search" name="search" placeholder="Find Your Fav F🍔🥘d!!"
                    aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
            </form>

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
                        <a class="nav-link" href="#" style="color: #ffffff; text-decoration:none">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #ffffff; text-decoration:none">Contact us</a>
                    </li>
                </ul>

                <!-- Right-Aligned Icons and Dropdown -->
                <ul class="navbar-nav ms-auto mr-6">
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
                            <a class="nav-link" href="{{ route('cart.view') }}"
                                style="color: #ffffff; text-decoration:none">
                                <i style="font-size:20px" class="fas">&#xf07a;</i>
                                @if ($cartCount > 0)
                                    <span class="badge bg-danger">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                        <!-- Favorite Icon -->
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="{{ route('food.fav') }}"
                                style="color: rgb(168, 20, 20); text-decoration:none">
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
                url: '{{ route('food.items') }}', // URL to the route
                method: 'GET',
                success: function(data) {
                    // Check if there is any data
                    if (data.length > 0) {
                        let dropdown = $('#foodDropdown');
                        dropdown.empty(); // Clear the dropdown

                        // Loop through each category and display category name with item count
                        data.forEach(function(category) {
                            let categoryRoute = `{{ url('/welcome') }}/${category.category}`;
                            dropdown.append(`
                                <li>
                                    <a class="dropdown-item" href="${categoryRoute}">
                                        ${category.category} <span class="badge bg-primary">${category.item_count}</span>
                                    </a>
                                </li>
                            `);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error fetching food categories: " + error);
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
        document.getElementById('dropdownToggle').addEventListener('click', function() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('show');
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', function(e) {
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
