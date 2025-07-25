<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
</head>

<body class="bg-dark">
    @include('layouts.navbar')
    <div class="about-us-page">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1>Delivering Happiness, One Order at a Time</h1>
            <p>Your trusted food delivery partner since 2014.</p>
        </div>

        <!-- Mission Section -->
        <section class="about-section mission">
            <h2>Our Mission</h2>
            <p>To make food delivery quick, reliable, and delightful.</p>
        </section>

        <!-- Statistics Section -->
        <section class="about-stats">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>{{ $orders->count() }}</h3>
                    <p>Orders Delivered</p>
                </div>
                <div class="stat-item">
                    <h3>{{ $foods->count() }}</h3>
                    <p>Total Items Covered</p>
                </div>
                <div class="stat-item">
                    <h3>{{ $users->count() }}</h3>
                    <p>Customers</p>
                </div>
            </div>
        </section>

        <!-- Journey Section -->
        <section class="about-section journey">
            <h2>Our Journey</h2>
            <p>
                Founded in 2014, we have grown from a small startup into one of the largest food delivery platforms in
                the country.
                With cutting-edge technology and passionate people, we've revolutionized the way food is ordered and
                enjoyed.
            </p>
        </section>

        <!-- Team Section -->
        <section class="about-section team">
            <h2>Meet the Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1511765392540-a4f3d816bfbb?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="CEO">
                    <h3>Rutul Prj</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1495576596703-e0063a132b6e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTQ3fHxzaGFkb3clMjBwaWN8ZW58MHx8MHx8fDA%3D"
                        alt="CTO">
                    <h3>Jane Smith</h3>
                    <p>Chief Technology Officer</p>
                </div>
                <div class="team-member">
                    <img src="https://plus.unsplash.com/premium_photo-1664199486611-3e1277e150cd?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDV8fHVzZXJ8ZW58MHx8MHx8fDA%3D"
                        alt="COO">
                    <h3>Mark Johnson</h3>
                    <p>Chief Operating Officer</p>
                </div>
            </div>
        </section>
        @include('layouts.footer')
    </div>
    <!-- GSAP and ScrollTrigger CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Register ScrollTrigger plugin
            gsap.registerPlugin(ScrollTrigger);

            // Hero Section Animations
            gsap.from(".hero-section h1", {
                opacity: 0,
                y: 20,
                duration: 1,
                ease: "power3.out",
            });

            gsap.from(".hero-section p", {
                opacity: 0,
                y: 20,
                duration: 1,
                ease: "power3.out",
                delay: 0.3,
            });

            // Mission Section Animations
            gsap.from(".mission h2", {
                opacity: 0,
                x: -20,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: ".mission",
                    start: "top 80%",
                },
            });

            gsap.from(".mission p", {
                opacity: 0,
                x: -20,
                duration: 1,
                ease: "power3.out",
                delay: 0.2,
                scrollTrigger: {
                    trigger: ".mission",
                    start: "top 80%",
                },
            });

            // Statistics Section Animations
            gsap.from(".stat-item", {
                opacity: 0,
                scale: 0.8,
                duration: 1,
                ease: "power3.out",
                stagger: 0.2,
                scrollTrigger: {
                    trigger: ".about-stats",
                    start: "top 80%",
                },
            });

            // Journey Section Animations
            gsap.from(".journey h2", {
                opacity: 0,
                y: 20,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: ".journey",
                    start: "top 80%",
                },
            });

            gsap.from(".journey p", {
                opacity: 0,
                y: 20,
                duration: 1,
                ease: "power3.out",
                delay: 0.2,
                scrollTrigger: {
                    trigger: ".journey",
                    start: "top 80%",
                },
            });

            // Team Section Animations
            gsap.from(".team-member", {
                opacity: 0,
                y: 20,
                duration: 1,
                ease: "power3.out",
                stagger: 0.2,
                scrollTrigger: {
                    trigger: ".team",
                    start: "top 80%",
                },
            });
        });
    </script>
</body>

</html>
