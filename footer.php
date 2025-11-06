<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        footer {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: #fff;
            padding: 50px 20px 30px 20px;
        }

        footer h5 {
            font-weight: 700;
            letter-spacing: 1px;
            color: #ffd700;
            margin-bottom: 20px;
        }

        footer p {
            font-size: 0.95rem;
            color: #f0f0f0;
            line-height: 1.6;
        }

        footer a {
            color: #fff;
            transition: 0.3s;
        }

        footer a:hover {
            color: #ffd700;
            text-decoration: none;
        }

        .social-icons li {
            display: inline-block;
            margin-right: 15px;
        }

        .social-icons li a {
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            transition: 0.3s;
        }

        .social-icons li a:hover {
            background: #ffd700;
            color: #000;
        }

        .footer-contact p i {
            color: #ffd700;
            margin-right: 10px;
        }

        hr {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            footer .col-md-3, footer .col-md-4 {
                text-align: center;
                margin-top: 20px;
            }
            .social-icons {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <footer>
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-3 col-lg-3 mx-auto mt-3">
                    <h5>Veloxa</h5>
                    <p>Here we are the Veloxa.lk&trade; to support you to accomplish your desires by selling high-quality products.</p>
                </div>

                <div class="col-12 col-md-3 col-lg-2 mx-auto mt-3 text-md-start text-center">
                    <p>&copy; 2025 Veloxa. All Rights Reserved.</p>
                </div>

                <div class="col-12 col-md-2 col-lg-2 mx-auto mt-3">
                    <ul class="list-unstyled social-icons d-flex">
                        <li><a href="#"><i class="bi bi-facebook fs-5"></i></a></li>
                        <li><a href="#"><i class="bi bi-twitter fs-5"></i></a></li>
                        <li><a href="#"><i class="bi bi-whatsapp fs-5"></i></a></li>
                        <li><a href="#"><i class="bi bi-linkedin fs-5"></i></a></li>
                        
                    </ul>
                </div>

                <div class="col-12 col-md-3 col-lg-3 mx-auto mt-3 footer-contact">
                    <h5>Contact</h5>
                    <p><i class="bi bi-house-fill"></i> Maradana, Colombo 10, Sri Lanka</p>
                    <p><i class="bi bi-at"></i> horizon@gmail.com</p>
                    <p><i class="bi bi-telephone-fill"></i> +94 112 356 356</p>
                    <p><i class="bi bi-printer-fill"></i> +94 112 356 356</p>
                </div>

            </div>

            <hr class="mt-4">

        </div>
    </footer>
</body>

</html>
