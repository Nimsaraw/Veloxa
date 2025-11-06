<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    

    <style>



    </style>

</head>

<body class="glass-card">

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="offset-lg-1 col-4 col-lg-3 align-self-start mt-2">

                <?php

                session_start();

                if (isset($_SESSION["u"])) {

                    $data = $_SESSION["u"];

                ?>

                    <span class="text-lg-start"><span> <b>Veloxa | </b></span class="text-decoration-none fw-bold">Hi, <?php echo $data["fname"]; ?></span>


                <?php

                } else {

                ?>

                    <a href="index.php" class="text-decoration-none fw-bold">Sign In or Register</a>

                <?php

                }

                ?>




            </div>
            <div class="offset-lg-1 col-12 col-lg-6 align-self-start mt-2 text-center dropdown text-center">
                <div class="d-flex justify-content-center align-items-center gap-5 flex-wrap" >
                    <button class="btn btn-custom dropdown-toggle nav-link-custom" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About
                    </button>
                    <ul class="dropdown-menu shadow-lg border-0 rounded-3">
                        <li><a class="dropdown-item" href="myProducts.php"><i class="bi bi-box-seam me-2"></i> My Products</a></li>
                        <li><a class="dropdown-item" href="watchlist.php"><i class="bi bi-heart-fill me-2"></i> Watchlist</a></li>
                        <li><a class="dropdown-item" href="purchasingHistory.php"><i class="bi bi-clock-history me-2"></i> Purchase History</a></li>
                        <li><a class="dropdown-item" href="messages.php"><i class="bi bi-chat-dots-fill me-2"></i> Messages</a></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');">
                                <i class="bi bi-headset me-2"></i> Contact Admin
                            </a>
                        </li>
                    </ul>




                    <a href="advancedSearch.php" class="nav-link-custom">Advanced</a>

                    <i class="bi bi-person-circle icon-btn" onclick="window.location='userProfile.php';"></i>
                    <i class="bi bi-cart-fill icon-btn" onclick="window.location='cart.php';"></i>

                   
                </div>
            </div>

            <style>
                /* Custom Button */
                .btn-custom {

                    color: #fff;
                    font-weight: 600;
                    border: none;
                    border-radius: 12px;
                    padding: 8px 18px;
                    transition: 0.3s;
                }



                /* Dropdown */
                .dropdown-menu {
                    font-size: 0.95rem;
                }

                .dropdown-item {
                    padding: 10px 16px;
                    transition: 0.2s;
                    border-radius: 8px;
                    font-weight: 500;
                }



                /* Navigation Links */
                .nav-link-custom {
                    font-weight: 600;
                    color: #2c3e50;
                    text-decoration: none;
                    transition: 0.3s;
                }

                .nav-link-custom:hover {
                    color: #1abc9c;
                }

                /* Icons */
                .icon-btn {
                    font-size: 1.6rem;
                    color: #34495e;
                    cursor: pointer;
                    transition: 0.3s;
                }

                .icon-btn:hover {
                    color: #1abc9c;
                    transform: scale(1.2);
                }

                /* Sign Out */
                .signout {
                    font-weight: 600;
                    color: #e74c3c;
                    cursor: pointer;
                    transition: 0.3s;
                }

                .signout:hover {
                    color: #c0392b;
                }
            </style>


            <hr />

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>