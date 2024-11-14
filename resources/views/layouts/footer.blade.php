<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        /* Resetting default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Footer styles */
        .footer {
            background-color: #a55650;
            color: #ffffff;
            /* Text color */
            padding: 40px 0;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .footer h4 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer p,
        .footer address {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .footer hr {
            border-top-color: #ffffff;
            /* White separator line */
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .footer p {
            font-size: 14px;
        }


        /* Responsive styles */
        @media (max-width: 768px) {
            .footer .col-md-6 {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid footer">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h4><a  style="color: #ffffff">Food</a></h4>
                <p>Food is not only essential for sustenance but also deeply intertwined with culture, tradition, and
                    personal enjoyment. It encompasses a wide range of flavors, textures, and ingredients that vary
                    across regions and cuisines globally.</p>
            </div>
            <div class="col-md-6">
                <h4><i class="fas fa-envelope"></i> Contact Us</h4>
                <address>
                    <i class="fas fa-map-marker-alt"></i> Ahmedabad, India<br>
                    <i class="fas fa-phone-alt"></i> +91 9173494667<br>
                    <i class="fas fa-envelope"></i> rutulmorningstar@gmail.com
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
                <p><i class="fas fa-copyright"></i> 2024 Created By <span class="text-black font-semibold">Rutul Prajapati.</span> All rights reserved.</p>
                <div class=>
                    <a href="https://www.instagram.com/rutul_1223" style="text-decoration:none; color:inherit;"><i style='font-size:24px' class='fab'>&#xf16d;</i>&nbsp;&nbsp;</a>
                    <a href="https://www.linkedin.com/in/rutul-prajapati/" style="text-decoration:none; color:inherit;"> <i style='font-size:24px' class='fab'>&#xf0e1;</i>&nbsp;&nbsp;</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
