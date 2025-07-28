<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Contact Us</title>
    <script src="https://kit.fontawesome.com/c32adfdcda.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #FFD28D;
            --secondary-color: #222222;
            --text-color: #666666;
            --light-bg: #f8f5f0;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: var(--white);
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
            color: var(--secondary-color);
        }

        .contact-header {
            background-image: url('{{ asset('contact.png') }}');
            background-size: cover;
            background-position: center;
            padding: 120px 20px;
            position: relative;
            text-align: center;
            color: var(--white);
        }

        .contact-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .contact-header h1 {
            font-size: 60px;
            margin-bottom: 15px;
            position: relative;
            color: var(--primary-color);
        }

        .contact-subtitle {
            font-family: 'Baskervville', serif;
            font-style: italic;
            font-size: 14px;
            margin-bottom: 10px;
            position: relative;
            color: var(--white);
        }

        .contact-subtitle a {
            text-decoration: none;
            color: var(--white);
        }

        .contact-container {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .contact-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }

        .contact-info,
        .contact-form,
        .map-container {
            flex: 1;
            min-width: 300px;
        }

        .map-container {
            height: 400px;
        }

        .info-box {
            display: flex;
            margin-bottom: 30px;
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .info-text h3 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .info-text p {
            margin: 0;
            color: var(--text-color);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e1e1e1;
            background-color: #f9f9f9;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--white);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn-primary {
            background-color: var(--white);
            border: none;
            padding: 14px 30px;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: rgb(206, 199, 199);
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 36px;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 2px;
            background-color: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title p {
            max-width: 700px;
            margin: 0 auto;
        }

        .map-container iframe {
            height: 100%;
            width: 100%;
            border: none;
            filter: grayscale(100%) invert(90%) contrast(120%);
        }

        /* ✅ Keeping original location style but fixing wrapping */
        .nearby-locations {
            margin-top: 80px;
        }

        .locations-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .location-box {
            border-right: 1px solid #FFD28D;
            border-bottom: 1px solid #FFD28D;
            /* ✅ Added horizontal line */
            flex: 1 1 33.33%;
            padding: 60px;
            box-sizing: border-box;
        }

        /* ✅ Remove right border for last column in row */
        .location-box:nth-child(3n) {
            border-right: none;
        }

        /* ✅ Remove bottom border for last row */
        .location-box:nth-last-child(-n+3) {
            border-bottom: none;
        }

        @media (max-width: 992px) {
            .location-box {
                flex: 1 1 50%;
            }

            .location-box:nth-child(2n) {
                border-right: none;
            }

            .location-box:nth-last-child(-n+2) {
                border-bottom: none;
            }
        }

        @media (max-width: 600px) {
            .location-box {
                flex: 1 1 100%;
                border-right: none;
                padding: 40px;
            }

            .location-box {
                border-bottom: 1px solid #FFD28D;
            }

            .location-box:last-child {
                border-bottom: none;
            }
        }

        @media (max-width: 768px) {
            .contact-header h1 {
                font-size: 40px;
            }

            .contact-content {
                flex-direction: column;
            }

            .map-container {
                height: 300px;
            }
        }
    </style>
</head>

<body style="background-color: #091E24">
    @include('layouts.navbar')

    <div class="contact-header">
        <div class="contact-subtitle">
            <a href="/">Home</a> / Contact Us
        </div>
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Whether you have a question about our services, want to make a reservation, or
            just want to say hello, feel free to reach out.</p>
    </div>

    <div class="contact-container">
        <div class="contact-content">
            <div class="contact-form">
                <center><h1 style="color: var(--primary-color); margin-bottom: 3rem">Contact Us</h1></center>
                <form action="#" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group"><input type="text" class="form-control" name="name"
                                placeholder="Your Name" required></div>
                        <div class="form-group"><input type="email" class="form-control" name="email"
                                placeholder="Your Email" required></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="comment" placeholder="Comment" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Contact Us</button>
                </form>
            </div>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96652.27317354927!2d-74.33557928194516!3d40.79756494697628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3a82f1352d0dd%3A0x81d4f72c4435aab5!2sTroy+Meadows+Wetlands!5e0!3m2!1sen!2sbd!4v1563075599994!5m2!1sen!2sbd"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="nearby-locations">
            <div class="section-title">
                <p style="color: var(--primary-color); margin-top: 3rem">Visit us</p>
                <h2 style="color: var(--primary-color)">Nearby Find Us</h2>
            </div>
            <div class="locations-grid">
                <div class="location-box">
                    <h3 style="color: var(--primary-color)">New York</h3>
                    <p style="color: var(--white)">901 N Pitt Str., Suite 170</p>
                    <p style="color: var(--white)">Alexandria, NY, USA</p>
                    <p style="color: var(--white)">info@example.com</p>
                </div>
                <div class="location-box">
                    <h3 style="color: var(--primary-color)">Los Angeles</h3>
                    <p style="color: var(--white)">901 N Pitt Str., Suite 170</p>
                    <p style="color: var(--white)">Alexandria, NY, USA</p>
                    <p style="color: var(--white)">info@example.com</p>
                </div>
                <div class="location-box">
                    <h3 style="color: var(--primary-color)">Chicago</h3>
                    <p style="color: var(--white)">901 N Pitt Str., Suite 170</p>
                    <p style="color: var(--white)">Alexandria, NY, USA</p>
                    <p style="color: var(--white)">info@example.com</p>
                </div>
                <div class="location-box">
                    <h3 style="color: var(--primary-color)">Houston</h3>
                    <p style="color: var(--white)">901 N Pitt Str., Suite 170</p>
                    <p style="color: var(--white)">Alexandria, NY, USA</p>
                    <p style="color: var(--white)">info@example.com</p>
                </div>
                <div class="location-box">
                    <h3 style="color: var(--primary-color)">Phoenix</h3>
                    <p style="color: var(--white)">901 N Pitt Str., Suite 170</p>
                    <p style="color: var(--white)">Alexandria, NY, USA</p>
                    <p style="color: var(--white)">info@example.com</p>
                </div>
                <div class="location-box">
                    <h3 style="color: var(--primary-color)">San Diego</h3>
                    <p style="color: var(--white)">901 N Pitt Str., Suite 170</p>
                    <p style="color: var(--white)">Alexandria, NY, USA</p>
                    <p style="color: var(--white)">info@example.com</p>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
