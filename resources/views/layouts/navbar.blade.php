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
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
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
        .navbar-nav .nav-item .nav-link.active {
            border-bottom: 2px solid rgb(241, 202, 202);
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
        .dropdown-menu {
            border: none;
            border-radius: 10px;
        }
        .dropdown-menu .dropdown-item {
            color: #2F3645 !important;
            transition: background-color 0.3s ease;
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: rgb(207, 190, 190);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Food</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="/welcome"
                            style="color: #2F3645; text-decoration:none">Home</a></li>
                    @guest
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('order.view') }}"
                                style="color: #2F3645; text-decoration:none">Orders</a></li>
                    @endguest
                </ul>
                <div class="d-flex justify-content-center flex-grow-1 mx-3">
                    <form action="{{ route('food.search') }}" method="GET" class="d-flex"
                        style="max-width: 400px; width: 100%;">
                        <input class="form-control me-2" type="search" name="search"
                            placeholder="Find Your Fav F🍔🥘d!!" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a href="/login" class="btn btn-sm btn-danger">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn btn-sm btn-danger">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"><img src="{{ asset('storage/' . Auth::user()->image) }}"
                                    alt="Profile Image" class="rounded-circle" style="width: 30px; height: 30px;">
                                {{-- {{ Auth::user()->name }} --}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="confirmLogout(event)">
                                            <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                            @guest
                            @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('cart.view') }}"
                                    style="color: #000000; text-decoration:none"><i style='font-size:20px'
                                        class='fas'>&#xf07a;</i>
                                    @if ($cartCount > 0)
                                        <span class="badge bg-danger">{{ $cartCount }}</span>
                                    @endif
                                </a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('food.fav') }}"
                                    style="color: rgb(168, 20, 20); text-decoration:none">
                                    <i style='font-size:20px' class='fas fa-heart fav'></i>
                                </a>
                            </li>
                        @endguest
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
