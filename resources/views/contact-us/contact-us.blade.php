<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Contact Us</title>
    <script src="https://kit.fontawesome.com/c32adfdcda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
</head>
<body class="bg-dark">
    @include('layouts.navbar')
    <div class="container">
        <div class="row">
            <h1>Contact Us</h1>
        </div>
        <div class="row">
            <h4>We'd love to hear from you!</h4>
        </div>
        <div class="contact-content">
            <div class="form-container">
                <form action="#" method="POST">
                    @csrf
                    <div class="input-container">
                        <div class="styled-input wide">
                            <input type="text" name="name" required />
                            <label>Name</label>
                        </div>
                        <div class="styled-input">
                            <input type="email" name="email" required />
                            <label>Email</label>
                        </div>
                        <div class="styled-input">
                            <input type="tel" name="phone" required />
                            <label>Phone Number</label>
                        </div>
                        <div class="styled-input wide">
                            <textarea name="message" required></textarea>
                            <label>Message</label>
                        </div>
                        <div>
                            <button type="submit" class="btn-lrg submit-btn">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="image-container">
                <div class="contact-image"></div>
            </div>
        </div>
    </div>
</body>
</html>
