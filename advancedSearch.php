<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search | Veloxa</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">

    <link rel="icon" href="resource/Veloxa.png" />


    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg,  #1e3c72, #2a5298);
            min-height: 100vh;
            color: #fff;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-weight: 700;
            font-size: 2.2rem;
            color: #fff;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px;
            font-size: 0.95rem;
            border: 1px solid #e0e0e0;
        }

        .btn-custom {
            border-radius: 12px;
            font-weight: 600;
            padding: 12px;
            background: linear-gradient(45deg, #007bff, #00c6ff);
            border: none;
            color: white;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: linear-gradient(45deg, #0056b3, #0099cc);
        }

        hr {
            border-top: 2px solid rgba(255, 255, 255, 0.3);
        }

        .empty-state {
            color: rgba(255, 255, 255, 0.8);
        }

        .sort-box {
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container-fluid ">
        <div class="row">

           

            <div class="col-12 text-center mb-4">
                <p class="title">Advanced Search</p>
            </div>

            <!-- Search Input -->
            <div class=" col-4 col-lg-4 mb-4">
                <div class="glass-card">
                    <div class="row g-3 align-items-center">
                        <div class="col-lg-10">
                            <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                        </div>
                        <div class="col-lg-2 d-grid">
                            <button class="btn btn-custom" onclick="advancedSearch(0);">
                                <i class="bi bi-search me-2"></i>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <!-- Filters -->
                    <div class="row g-3 mt-2">
                        <div class="col-lg-12">
                            <option value="0">Select Category</option>
                            <select class="form-select" id="c1">
                                <option value="0"></option>
                                <?php
                                require "connection.php";
                                $category_rs = Database::search("SELECT * FROM `category`");
                                while ($category_data = $category_rs->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-12">
                            <option value="0">Select Brand</option>
                            <select class="form-select" id="b1">
                                <option value="0"></option>
                                <?php
                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                while ($brand_data = $brand_rs->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-12">
                            <option value="0">Select Model</option>
                            <select class="form-select" id="m">
                                <option value="0"></option>
                                <?php
                                $model_rs = Database::search("SELECT * FROM `model`");
                                while ($model_data = $model_rs->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-12">
                            <option value="0">Select Condition</option>
                            <select class="form-select" id="c2">
                                <option value="0"></option>
                                <?php
                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                while ($condition_data = $condition_rs->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-12">
                            <option value="0">Select Colour</option>
                            <select class="form-select" id="c3">
                                <option value="0"></option>
                                <?php
                                $color_rs = Database::search("SELECT * FROM `color`");
                                while ($color_data = $color_rs->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $color_data["color_id"]; ?>"><?php echo $color_data["color_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-12">
                            <option value="0">Price From...</option>
                            <input type="text" class="form-control"  id="pf" />
                        </div>

                        <div class="col-lg-12">
                            <option value="0">Price To...</option>
                            <input type="text" class="form-control"  id="pt" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sort Section -->
            <div class=" offset-lg-1 col-6 col-lg-6 mb-4">
                <div class=" offset-lg-2">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-8">
                            <select class="form-select sort-box" id="s">
                                <option value="0">SORT BY</option>
                                <option value="1">PRICE LOW TO HIGH</option>
                                <option value="2">PRICE HIGH TO LOW</option>
                                <option value="3">QUANTITY LOW TO HIGH</option>
                                <option value="4">QUANTITY HIGH TO LOW</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6 mb-4"></div>
                <div class="col-6 col-lg-6 mb-4"></div>
                <div class="col-6 col-lg-6 mb-4"></div>

           
                <div class="glass-card text-center">
                    <div class="row" id="view_area">
                        <div class="col-12 my-5">
                            <i class="bi bi-search empty-state" style="font-size: 90px;"></i>
                            <p class="h4 mt-3 empty-state">No Items Searched Yet...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <?php include "footer.php"; ?>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>
</html>
