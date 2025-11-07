<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Veloxa</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/Veloxa.png" />


    
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
            require "connection.php";
            if (isset($_SESSION["u"])) { ?>

                <div class="col-12">
                    <div class="watchlist-container">
                        <div class="row">

                            <div class="col-12">
                                <label class="page-title">Watchlist <i class="bi bi-heart-fill text-danger"></i></label>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in Watchlist..." />
                                    </div>
                                    <div class="col-12 col-lg-2 mb-3 d-grid">
                                        <button class="btn btn-primary"><i class="bi bi-search me-1"></i> Search</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-11 col-lg-2 border-end border-2">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                    </ol>
                                </nav>
                                <nav class="nav nav-pills flex-column">
                                    <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-heart me-2"></i>My Watchlist</a>
                                    <a class="nav-link" href="#"><i class="bi bi-cart me-2"></i>My Cart</a>
                                    <a class="nav-link" href="#"><i class="bi bi-clock-history me-2"></i>Recents</a>
                                </nav>
                            </div>

                            <?php
                            $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");
                            $watch_num = $watch_rs->num_rows;

                            if ($watch_num == 0) { ?>
                                <!-- empty view -->
                                <div class="col-12 col-lg-9">
                                    <div class="row">
                                        <div class="col-12 emptyView"></div>
                                        <div class="col-12 text-center">
                                            <label class="form-label fs-2 fw-bold">You have no items in your Watchlist yet.</label>
                                        </div>
                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                            <a href="home.php" class="btn btn-warning fs-4">Start Shopping</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <!-- have products -->
                                <div class="col-12 col-lg-9">
                                    <div class="row">
                                        <?php
                                        for ($x = 0; $x < $watch_num; $x++) {
                                            $watch_data = $watch_rs->fetch_assoc(); ?>
                                            <div class="card mb-4 col-12">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <?php
                                                        $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $watch_data["product_id"] . "'");
                                                        $images_data = $images_rs->fetch_assoc();
                                                        ?>
                                                        <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 220px; object-fit: cover;" />
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="card-body">
                                                            <?php
                                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_data["product_id"] . "'");
                                                            $product_data = $product_rs->fetch_assoc();
                                                            ?>
                                                            <h5 class="card-title fs-3 fw-bold"><?php echo $product_data["title"]; ?></h5>
                                                            <?php
                                                            $clr_rs = Database::search("SELECT * FROM `color` WHERE `color_id`='" . $product_data["color_color_id"] . "'");
                                                            $clr_data = $clr_rs->fetch_assoc();
                                                            ?>
                                                            <span class="fw-bold text-muted">Colour: <?php echo $clr_data["color_name"]; ?></span>
                                                            &nbsp; | &nbsp;
                                                            <?php
                                                            $condition_rs = Database::search("SELECT * FROM `condition` WHERE `condition_id`='" . $product_data["condition_condition_id"] . "'");
                                                            $condition_data = $condition_rs->fetch_assoc();
                                                            ?>
                                                            <span class="fw-bold text-muted">Condition: <?php echo $condition_data["condition_name"]; ?></span>
                                                            <br />
                                                            <span class="fw-bold text-muted">Price:</span>
                                                            <span class="fw-bold text-dark"> Rs. <?php echo $product_data["price"]; ?>.00</span>
                                                            <br />
                                                            <span class="fw-bold text-muted">Quantity:</span>
                                                            <span class="fw-bold text-dark"><?php echo $product_data["qty"]; ?> Items available</span>
                                                            <br />
                                                            <span class="fw-bold text-muted">Seller:</span>
                                                            <br />
                                                            <span class="fw-bold text-dark">Nimsara</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 d-flex flex-column justify-content-center align-items-center gap-2 p-3">
                                                        <a href="#" class="btn btn-outline-success w-100">Buy Now</a>
                                                        <a href="#" class="btn btn-outline-warning w-100">Add to Cart</a>
                                                        <a href="#" class="btn btn-outline-danger w-100" onclick='removeFromWatchlist(<?php echo $watch_data["id"]; ?>);'>Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- have products -->
                            <?php } ?>

                        </div>
                    </div>
                </div>

            <?php } else {
                //header("Location:home.php");
            } ?>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
        }

        .watchlist-container {
            background: #ffffffd9;
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            margin: 20px auto;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        hr {
            border: none;
            height: 2px;
            background: #3498db;
            border-radius: 3px;
            margin: 20px 0;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-primary {
            border-radius: 12px;
            background: linear-gradient(135deg, #3498db, #1abc9c);
            border: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1abc9c, #3498db);
            transform: scale(1.05);
        }

        .breadcrumb {
            background: none;
            font-size: 0.95rem;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
        }

        .nav-pills .nav-link {
            border-radius: 10px;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .nav-pills .nav-link.active {
            background: #1abc9c;
            color: #fff;
        }

        .nav-pills .nav-link:hover {
            background: #3498db;
            color: #fff;
        }

        .emptyView {
            background: url("resource/empty.svg") no-repeat center;
            background-size: contain;
            height: 250px;
        }

        .card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            color: #2980b9;
        }

        .btn-outline-success,
        .btn-outline-warning,
        .btn-outline-danger {
            border-radius: 12px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-outline-success:hover {
            background: #27ae60;
            color: #fff;
        }

        .btn-outline-warning:hover {
            background: #f39c12;
            color: #fff;
        }

        .btn-outline-danger:hover {
            background: #e74c3c;
            color: #fff;
        }

        .btn-warning {
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-warning:hover {
            background: #f39c12;
            transform: scale(1.05);
        }
    </style>
</body>

</html>
