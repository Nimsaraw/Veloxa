<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Veloxa</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/Veloxa.png" />

    <style>
        /* ===== Modern Hero Carousel ===== */
        .hero-img {
            height: 70vh;
            object-fit: cover;
            filter: brightness(65%);
        }

        .carousel-caption {
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.45);
            border-radius: 12px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            animation: fadeInUp 1s ease-in-out;
        }

        .carousel-caption h2,
        .carousel-caption p {
            text-shadow: 0px 2px 8px rgba(0, 0, 0, 0.7);
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 50% 50%;
            padding: 20px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* ===== Product Card Modern Look ===== */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            color: #1a1a1a;
        }

        .btn-success {
            border-radius: 20px;
        }

        .btn-dark {
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <hr />
            <?php
            require "connection.php";
            $category_rs = Database::search("SELECT * FROM `category`");
            $category_num = $category_rs->num_rows;
            for ($x = 0; $x < $category_num; $x++) {
                $category_data = $category_rs->fetch_assoc();
            ?>
            <?php
            }
            ?>

            <!-- Search Bar -->

            <hr />

            <div class="col-12" id="basicSearchResult">
                <div class="row">

                    <!-- 🚀 Modern Hero Carousel -->
                    <div class="col-12 mb-4">
                        <div id="techwaveHero" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">

                                <div class="carousel-item active">
                                    <img src="resource/slider images/posterimg.jpg" class="d-block w-100 hero-img" alt="Welcome">
                                    <div class="carousel-caption">
                                        <h2 class="fw-bold display-4 text-light"> Welcome to Veloxa</h2>
                                        <p class="lead text-white-50">Your One-Stop Online Store</p>
                                        <a href="shop.php" class="btn btn-lg btn-warning rounded-pill mt-3 shadow">Shop Now</a>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="resource/slider images/posterimg2.jpg" class="d-block w-100 hero-img" alt="Delivery">
                                    <div class="carousel-caption">
                                        <h2 class="fw-bold display-5 text-light"> Super Fast Delivery</h2>
                                        <p class="lead text-white-50">Enjoy the Lowest Delivery Costs</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="resource/slider images/posterimg3.jpg" class="d-block w-100 hero-img" alt="Products">
                                    <div class="carousel-caption">
                                        <h2 class="fw-bold display-5 text-light">Discover New Products</h2>
                                        <p class="lead text-white-50">Fresh Tech Every Week</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Controls -->

                        </div>
                    </div>
                    <!-- 🚀 End Modern Hero Carousel -->


                    <?php
$c_rs = Database::search("SELECT * FROM `category`");
$c_num = $c_rs->num_rows;
for ($y = 0; $y < $c_num; $y++) {
    $c_data = $c_rs->fetch_assoc();
?>
    <!-- Category Title -->
    <div class="col-12 mt-4 mb-3 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold text-black mb-0"><?php echo $c_data["cat_name"]; ?></h3>
        
    </div>

    <!-- Product Cards -->
    <div class="col-12 mb-4">
        <div class="row g-3">
            <?php
            $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $c_data["cat_id"] . "' AND 
                `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");
            $product_num = $product_rs->num_rows;

            for ($z = 0; $z < $product_num; $z++) {
                $product_data = $product_rs->fetch_assoc();
                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                $image_data = $image_rs->fetch_assoc();
            ?>
                <div class="col-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden product-card">
                        <img src="<?php echo $image_data["code"]; ?>" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;" />
                        <div class="card-body text-center p-3">
                            <h6 class="fw-bold text-dark text-truncate"><?php echo $product_data["title"]; ?></h6>
                            
                            <span class="fs-6 fw-semibold text-primary">Rs. <?php echo $product_data["price"]; ?>.00</span><br />

                            <?php if ($product_data["qty"] > 0) { ?>
                                <br/>
                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' 
                                   class="btn btn-success w-100 mb-2">Buy Now</a>
                                <button class="btn btn-outline-dark w-100 mb-2" 
                                        onclick="addToCart(<?php echo $product_data['id']; ?>);">
                                    <i class="bi bi-cart-plus-fill fs-5"></i> Add to Cart
                                </button>
                            <?php } else { ?>
                                <span class="text-danger fw-bold">Out of Stock</span><br /><br />
                                <button class="btn btn-secondary w-100 mb-2 disabled" href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">Buy Now</button>
                                <button class="btn btn-secondary w-100 disabled">
                                    <i class="bi bi-cart-plus-fill fs-5"></i> Add to Cart
                                </button>
                            <?php } ?>

                            <?php
                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data["id"] . "' AND 
                                `users_email`='" . $_SESSION["u"]["email"] . "'");
                            $watchlist_num = $watchlist_rs->num_rows;

                            if ($watchlist_num == 1) {
                            ?>
                                <button class="btn btn-light w-100 border border-danger" 
                                        onclick='addToWatchlist(<?php echo $product_data["id"]; ?>); '>
                                    <i class="bi bi-heart-fill text-danger fs-5" id="heart<?php echo $product_data["id"]; ?>"></i> In Watchlist
                                </button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-light w-100 border border-primary" 
                                        onclick='addToWatchlist(<?php echo $product_data["id"]; ?>); '>
                                    <i class="bi bi-heart text-primary fs-5" id="heart<?php echo $product_data["id"]; ?>"></i> Add to Watchlist
                                </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- End Product Cards -->
<?php } ?>

                </div>
                <div class="why-choose-section">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <h2 class="section-title">Choose Your Brand</h2>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

                                <div class="row my-5">
                                    <div class="col-6 col-md-6" id="product-brand-container">
                                        <div class="feature" id="product-brand-card">
                                            <div class="icon" id="product-brand-mini-card">
                                                <img src="resource/slider images/bag.svg" alt="Image" class="imf-fluid">
                                                <a href="#" id="product-brand-a">

                                                    <a href="advancedSearch.php" class="nav-link-custom" style="font-size: 20px;">Damro Furniture</a>
                                                </a>
                                            </div>

                                            <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                        </div>
                                        <br/>
                                        <div class="feature" id="product-brand-card">
                                            <div class="icon" id="product-brand-mini-card">
                                                <img src="resource/slider images/bag.svg" alt="Image" class="imf-fluid">
                                                <a href="#" id="product-brand-a">

                                                    <a href="advancedSearch.php" class="nav-link-custom" style="font-size: 20px;">Singer Furniture</a>
                                                </a>
                                            </div>

                                            <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                        </div>
                                        <br/>

                                        <div class="feature" id="product-brand-card">
                                            <div class="icon" id="product-brand-mini-card">
                                                <img src="resource/slider images/bag.svg" alt="Image" class="imf-fluid">
                                                <a href="#" id="product-brand-a">

                                                    <a href="advancedSearch.php" class="nav-link-custom" style="font-size: 20px;">Arpico Furniture</a>
                                                </a>
                                            </div>

                                            <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-5 ">
                                <div class="img-wrap">
                                    <img src="resource/slider images/posterimg.jpg" alt="Image" class="img-fluid">
                                </div>

                            </div>
                            <br/>

                        </div>
                    </div>
                </div>
            </div>
            </br>


            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <style>
        .nav-link-custom {
            font-weight: 600;
            color: #2c3e50;
            text-decoration: none;
            transition: 0.3s;
            
        }

        .nav-link-custom:hover {
            color: #1abc9c;
        }
    </style>
</body>

</html>