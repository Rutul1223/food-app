<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=">
  <title>Responsive Contact Us Page</title>
  <script src="https://kit.fontawesome.com/c32adfdcda.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
</head>

<body class="bg-dark">
    @include('layouts.navbar')
    <div class="container">
        <div class="row">
            <h1>Contact us</h1>
        </div>
        <div class="row">
            <h4 style="text-align:center">We'd love to hear from you!</h4>
        </div>
        <div class="row input-container">
            <div class="col-xs-12">
                <div class="styled-input wide">
                    <input type="text" required />
                    <label>Name</label>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="styled-input">
                    <input type="text" required />
                    <label>Email</label>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="styled-input" style="float:right;">
                    <input type="text" required />
                    <label>Phone Number</label>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="styled-input wide">
                    <textarea required></textarea>
                    <label>Message</label>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="btn-lrg submit-btn">Send Message</div>
            </div>
        </div>
    </div>

</body>

</html>
