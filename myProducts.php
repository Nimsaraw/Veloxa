<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $pageno;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products | Veloxa</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="icon" href="resource/Veloxa.png" />


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f9fafb;
            font-family: 'Inter', sans-serif;
        }

        /* Top Bar */
        .top-bar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 30px;
        }

        .top-bar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .profile-info {
            display: flex;
            align-items: center;
        }

        .profile-info img {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            object-fit: cover;
            margin-right: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .profile-info h5 {
            margin: 0;
            font-weight: 700;
            color: #111827;
        }

        .profile-info small {
            color: #6b7280;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #2563eb, #4f46e5);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 9px 16px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(79,70,229,0.4);
        }

        /* Filters */
        .filters {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filters input,
        .filters select {
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 7px 12px;
            font-size: 0.9rem;
        }

        /* Products Grid */
        .products {
            padding: 30px;
        }

        .product-card {
            background: #fff;
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        }

        .product-img {
            width: 100%;
            height: 180px;
            border-radius: 14px;
            object-fit: cover;
            margin-bottom: 12px;
        }

        .product-card h6 {
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .price {
            color: #2563eb;
            font-weight: 700;
        }

        .stock {
            color: #059669;
            font-size: 0.9rem;
        }

        .product-actions .btn {
            font-size: 0.85rem;
            padding: 8px 12px;
            border-radius: 10px;
        }

        /* Pagination */
        .pagination .page-link {
            border-radius: 10px;
            margin: 0 4px;
            border: none;
            color: #4f46e5;
            font-weight: 600;
        }

        .pagination .page-item.active .page-link {
            background: #4f46e5;
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="top-bar">
        <div class="top-bar-inner">
            <!-- Profile -->
            <div class="profile-info">
               
                <div>
                    <h5><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h5>
                    <small><?php echo $email; ?></small>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters">
                <input type="text" id="s" placeholder="Search products...">

                <select id="sort-time">
                    <option value="">Active Time</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>

                <select id="sort-qty">
                    <option value="">Quantity</option>
                    <option value="high">High → Low</option>
                    <option value="low">Low → High</option>
                </select>

                <select id="sort-condition">
                    <option value="">Condition</option>
                    <option value="new">Brand New</option>
                    <option value="used">Used</option>
                </select>

                <button class="btn-gradient" onclick="sort1(0);">Apply</button>
                <button class="btn btn-outline-secondary" onclick="clearsort();">Clear</button>
            </div>

            <!-- Add Product -->
            <button class="btn-gradient" onclick="window.location='addProduct.php'">
                <i class="bi bi-plus-circle me-1"></i> Add Product
            </button>
        </div>
    </div>

    <!-- Products -->
    <div class="products">
        <div class="row g-4" id="sort">
            <?php
            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "'");
            $product_num = $product_rs->num_rows;

            $results_per_page = 6;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "' 
                LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="product-card">
                    <?php
                    $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                    $product_img_data = $product_img_rs->fetch_assoc();
                    ?>
                    <img src="<?php echo $product_img_data["code"]; ?>" class="product-img" />
                    <h6><?php echo $selected_data["title"]; ?></h6>
                    <p class="price">Rs. <?php echo $selected_data["price"]; ?>.00</p>
                    <p class="stock"><?php echo $selected_data["qty"]; ?> left</p>

                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" role="switch"
                            id="fd<?php echo $selected_data["id"]; ?>"
                            onchange="changeStatus(<?php echo $selected_data['id']; ?>);"
                            <?php if ($selected_data["status_status_id"] == 2) { ?> checked <?php } ?> />
                        <label class="form-check-label" for="fd<?php echo $selected_data["id"]; ?>">
                            <?php if ($selected_data["status_status_id"] == 2) { ?>
                                <span class="text-success">Active</span>
                            <?php } else { ?>
                                <span class="text-danger">Inactive</span>
                            <?php } ?>
                        </label>
                    </div>

                    <div class="product-actions d-flex gap-2">
                        <button class="btn btn-success w-50" onclick="sendId(<?php echo $selected_data['id']; ?>);"><i class="bi bi-pencil-square"></i> Edit</button>
                        <button class="btn btn-danger w-50"><i class="bi bi-trash"></i> Delete</button>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Pagination -->
            <div class="col-12 mt-4">
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link"
                                href="<?php if ($pageno <= 1) { echo ("#"); } else { echo "?page=" . ($pageno - 1); } ?>">
                                &laquo;
                            </a>
                        </li>
                        <?php
                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?php echo $x; ?>"><?php echo $x; ?></a></li>
                        <?php
                            } else {
                        ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $x; ?>"><?php echo $x; ?></a></li>
                        <?php
                            }
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link"
                                href="<?php if ($pageno >= $number_of_pages) { echo ("#"); } else { echo "?page=" . ($pageno + 1); } ?>">
                                &raquo;
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php
} else {
    header("Location:home.php");
}
?>
