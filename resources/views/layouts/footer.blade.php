<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        /* Footer Styles */
        .footer {
            background-color: #0a0a0a;
            /* Dark background matching Elegencia */
            color: #ffffff;
            font-family: "Times New Roman", Times, serif;
            padding: 60px 0 40px;
            text-align: center;
        }

        .footer h4 {
            font-size: 1.8rem;
            color: #FFD28D;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer p,
        .footer address {
            font-size: 1.1rem;
            color: #cccccc;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .footer address i {
            margin-right: 10px;
            color: #FFD28D;
        }

        .footer hr {
            border-top: 1px solid #333333;
            margin: 2rem auto;
            max-width: 1200px;
        }

        .footer-bottom p {
            font-size: 1rem;
            color: #cccccc;
            margin-bottom: 1rem;
        }

        .footer-bottom .font-semibold {
            color: #FFD28D;
            font-weight: bold;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-links a {
            color: #FFD28D;
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #a07b50;
        }

        /* Responsive Styles */
        @media (min-width: 768px) {

            .footer-about,
            .footer-contact {
                padding: 0 20px;
            }

            .footer h4 {
                font-size: 2rem;
            }

            .footer p,
            .footer address {
                font-size: 1.2rem;
            }

            .footer-bottom p {
                font-size: 1.1rem;
            }

            .social-links a {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 767.98px) {
            .footer {
                padding: 40px 0;
            }

            .footer-about,
            .footer-contact {
                margin-bottom: 2rem;
            }

            .footer h4 {
                font-size: 1.5rem;
            }

            .footer p,
            .footer address {
                font-size: 1rem;
            }

            .footer-bottom p {
                font-size: 0.9rem;
            }

            .social-links a {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 576px) {
            .footer {
                padding: 30px 15px;
            }

            .footer h4 {
                font-size: 1.3rem;
            }

            .footer p,
            .footer address {
                font-size: 0.9rem;
            }

            .social-links a {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid footer">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 footer-about">
                <h4>About Us</h4>
                <p>Food is not only essential for sustenance but also deeply intertwined with culture, tradition, and
                    personal enjoyment. It encompasses a wide range of flavors, textures, and ingredients that vary
                    across regions and cuisines globally.</p>
            </div>
            <div class="col-md-6 col-sm-12 footer-contact">
                <h4><i class="fas fa-envelope"></i> Contact Us</h4>
                <address>
                    <i class="fas fa-map-marker-alt"></i> Ahmedabad, India<br>
                    <i class="fas fa-phone-alt"></i> +91 9173494667<br>
                    <i class="fas fa-envelope"></i> rutulmorningstar@gmail.com
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-12 footer-bottom">
                <hr>
                <p><i class="fas fa-copyright"></i> 2025 Created By <span class="font-semibold">Rutul Prajapati</span>.
                    All rights reserved.</p>
                <div class="social-links">
                    <a href="https://www.instagram.com/rutul_1223" aria-label="Instagram"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/rutul-prajapati/" aria-label="LinkedIn"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
