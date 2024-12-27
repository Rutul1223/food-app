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
                    <h3>50M+</h3>
                    <p>Orders Delivered</p>
                </div>
                <div class="stat-item">
                    <h3>500+</h3>
                    <p>Cities Covered</p>
                </div>
                <div class="stat-item">
                    <h3>100K+</h3>
                    <p>Restaurant Partners</p>
                </div>
            </div>
        </section>

        <!-- Journey Section -->
        <section class="about-section journey">
            <h2>Our Journey</h2>
            <p>
                Founded in 2014, we have grown from a small startup into one of the largest food delivery platforms in the country.
                With cutting-edge technology and passionate people, we've revolutionized the way food is ordered and enjoyed.
            </p>
        </section>

        <!-- Team Section -->
        <section class="about-section team">
            <h2>Meet the Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="/images/team1.jpg" alt="CEO">
                    <h3>Rutul Prj</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="/images/team2.jpg" alt="CTO">
                    <h3>Jane Smith</h3>
                    <p>Chief Technology Officer</p>
                </div>
                <div class="team-member">
                    <img src="/images/team3.jpg" alt="COO">
                    <h3>Mark Johnson</h3>
                    <p>Chief Operating Officer</p>
                </div>
            </div>
        </section>
        @include('layouts.footer')
    </div>
</body>
</html>

