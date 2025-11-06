<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Cart | Veloxa</title>

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="resource/Veloxa.png" />


  <style>
    body {
      background: #f7f9fb;
      font-family: "Poppins", sans-serif;
      color: #333;
    }

    /* Breadcrumb Section */
    .breadcrumb {
      background: transparent;
    }

    .breadcrumb-item a {
      color: #0d6efd;
      text-decoration: none;
      font-weight: 500;
    }

    .breadcrumb-item.active {
      color: #495057;
      font-weight: 600;
    }

    /* Cart Title */
    .cart-header {
      background: linear-gradient(90deg, #0d6efd, #4facfe);
      color: #fff;
      border-radius: 12px;
      padding: 15px 20px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .cart-header h1 {
      font-size: 1.8rem;
      font-weight: 700;
      margin: 0;
    }

    .cart-header i {
      font-size: 2rem;
    }

    /* Product Card */
    .card {
      border: none;
      border-radius: 16px;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      transition: 0.3s;
    }

    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
    }

    .card img {
      border-radius: 12px;
    }

    .card-title {
      font-size: 1.4rem;
      font-weight: 600;
      color: #222;
    }

    .fw-bold.text-black-50 {
      color: #6c757d !important;
    }

    .btn {
      border-radius: 10px;
      font-weight: 600;
      transition: 0.2s;
    }

    .btn:hover {
      transform: scale(1.05);
    }

    /* Empty Cart */
    .emptyCart {
      height: 220px;
      background: url("resource/empty-cart.png") center/contain no-repeat;
    }

    /* Summary Section */
    .summary-box {
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .summary-box hr {
      border-top: 2px solid #f0f0f0;
    }

    .summary-box .fs-4 {
      color: #0d6efd;
    }

    .btn-primary {
      background: linear-gradient(90deg, #0d6efd, #4facfe);
      border: none;
      font-weight: 600;
      padding: 10px;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #4facfe, #0d6efd);
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">

      <?php include "header.php";
      require "connection.php";

      if (isset($_SESSION["u"])) {
        $user = $_SESSION["u"]["email"];
        $total = 0;
        $shipping = 0;
      ?>

        <!-- Breadcrumb -->
        <div class="col-12 pt-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-3">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
          </nav>
        </div>

        <!-- Cart Header -->
        <div class="col-12 cart-header">
          <h1>My Cart</h1>
          <i class="bi bi-cart4"></i>
        </div>

        <div class="col-12 mb-3">
          <div class="row g-3">

            <!-- Left Side (Products) -->
            <div class="col-12 col-lg-9">
              <div class="row">

                <?php
                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
                $cart_num = $cart_rs->num_rows;

                if ($cart_num == 0) { ?>
                  <!-- Empty Cart -->
                  <div class="col-12 text-center">
                    <div class="emptyCart"></div>
                    <h2 class="fw-bold mt-3">Your cart is empty</h2>
                    <a href="home.php" class="btn btn-outline-primary fs-5 mt-3">Start Shopping</a>
                  </div>
                <?php } else {
                  for ($x = 0; $x < $cart_num; $x++) {
                    $cart_data = $cart_rs->fetch_assoc();
                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                    $product_data = $product_rs->fetch_assoc();
                     $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                $image_data = $image_rs->fetch_assoc();

                    $total += $product_data["price"] * $cart_data["qty"];

                    $address_rs = Database::search("SELECT district.district_id AS did FROM `user_has_address`
                      INNER JOIN `city` ON user_has_address.city_city_id=city.city_id
                      INNER JOIN `district` ON city.district_district_id=district.district_id
                      WHERE `users_email`='" . $user . "'");
                    $address_data = $address_rs->fetch_assoc();

                    if ($address_data["did"] == 4) {
                      $shipping += $product_data["delivery_fee_colombo"];
                    } else {
                      $shipping += $product_data["delivery_fee_other"];
                    }

                    $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                    $seller_data = $seller_rs->fetch_assoc();
                    $seller = $seller_data["fname"] . " " . $seller_data["lname"];
                ?>
                    <!-- Product Card -->
                    <div class="card mb-4 p-3">
                      <div class="row g-3 align-items-center">
                        <div class="col-md-4 text-center">
                          <img src="<?php echo $image_data["code"]; ?>" class="img-fluid">
                        </div>
                        <div class="col-md-5">
                          <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>
                          <p class="mb-1 text-muted">Seller: <strong><?php echo $seller; ?></strong></p>
                          <p class="mb-1">Colour: Black | Condition: Used</p>
                          <p class="mb-1 fw-bold">Price: Rs. <?php echo number_format($product_data["price"]); ?>.00</p>
                          <label class="fw-bold">Quantity:</label>
                          <input type="number" class="form-control w-50 d-inline-block mt-2" value="<?php echo $cart_data['qty']; ?>">
                          <p class="mt-3 text-muted">Delivery Fee: Rs.300.00</p>
                        </div>
                        <div class="col-md-3 d-grid">
                          <a class="btn btn-success mb-2">Buy Now</a>
                          <a class="btn btn-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>
                        </div>
                      </div>
                    </div>
                  <?php }
                } ?>
              </div>
            </div>

            <!-- Right Side (Summary) -->
            <div class="col-12 col-lg-3">
              <div class="summary-box">
                <h4 class="fw-bold">Summary</h4>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                  <span>Items (<?php echo $cart_num; ?>)</span>
                  <span>Rs. <?php echo number_format($total); ?>.00</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span>Shipping</span>
                  <span>Rs. <?php echo number_format($shipping); ?>.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                  <span class="fs-5 fw-bold">Total</span>
                  <span class="fs-5 fw-bold text-primary">Rs. <?php echo number_format($total + $shipping); ?>.00</span>
                </div>
                <button class="btn btn-primary w-100">Checkout</button>
              </div>
            </div>

          </div>
        </div>

      <?php } else {
        echo ("Please login or signup first");
      } ?>

      <?php include "footer.php"; ?>
    </div>
  </div>

  <script src="bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>
</html>
