<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Veloxa</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="icon" href="resource/Veloxa.png" />



  </head>

  <body>



    <div class="page-header">
      <h2><i class="bi bi-box-seam-fill text-primary"></i> Add New Product</h2>
    </div>

    <div class="card-form">
      <!-- Category / Brand / Model -->
      <div class="form-section">
        <h5>Basic Info</h5>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Category</label>
            <select class="form-select" id="category" onchange="loadBrands();">
              <option value="0">Select Category</option>
              <?php
              $category_rs = Database::search("SELECT * FROM `category`");
              while ($category_data = $category_rs->fetch_assoc()) {
                echo "<option value='{$category_data['cat_id']}'>{$category_data['cat_name']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Brand</label>
            <select class="form-select" id="brand">
              <option value="0">Select Brand</option>
              <?php
              $brand_rs = Database::search("SELECT * FROM `brand`");
              while ($brand_data = $brand_rs->fetch_assoc()) {
                echo "<option value='{$brand_data['brand_id']}'>{$brand_data['brand_name']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Model</label>
            <select class="form-select" id="model">
              <option value="0">Select Model</option>
              <?php
              $model_rs = Database::search("SELECT * FROM `model`");
              while ($model_data = $model_rs->fetch_assoc()) {
                echo "<option value='{$model_data['model_id']}'>{$model_data['model_name']}</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>

      <!-- Title -->
      <div class="form-section">
        <h5>Product Title</h5>
        <input type="text" class="form-control" id="title" placeholder="Enter product title">
      </div>

      <!-- Condition / Colour / Quantity -->
      <div class="form-section">
        <h5>Product Details</h5>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Condition</label><br>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" id="b" name="c" checked>
              <label class="form-check-label" for="b">Brand New</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" id="u" name="c">
              <label class="form-check-label" for="u">Used</label>
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Colour</label>
            <select class="form-select" id="clr">
              <option value="0">Select Colour</option>
              <?php
              $clr_rs = Database::search("SELECT * FROM `color`");
              while ($clr_data = $clr_rs->fetch_assoc()) {
                echo "<option value='{$clr_data['color_id']}'>{$clr_data['color_name']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Quantity</label>
            <input type="number" class="form-control" id="qty" min="1" value="1">
          </div>
        </div>
      </div>

      <!-- Pricing -->
      <div class="form-section">
        <h5>Pricing</h5>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Price per Item</label>
            <div class="input-group">
              <span class="input-group-text">Rs.</span>
              <input type="text" class="form-control" id="cost">
              <span class="input-group-text">.00</span>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label">Payment Methods</label>
            <div class="col-12">
              <div class="row">
                <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                <div class="col-2 pm pm2"></div>
                <div class="col-2 pm pm3"></div>
                <div class="col-2 pm pm4"></div>
              </div>
            </div>

          </div>
        </div>

        <!-- Delivery -->
        <div class="form-section">
          <h5>Delivery Cost</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Within Colombo</label>
              <div class="input-group">
                <span class="input-group-text">Rs.</span>
                <input type="text" class="form-control" id="dwc">
                <span class="input-group-text">.00</span>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Outside Colombo</label>
              <div class="input-group">
                <span class="input-group-text">Rs.</span>
                <input type="text" class="form-control" id="doc">
                <span class="input-group-text">.00</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Description -->
        <div class="form-section">
          <h5>Description</h5>
          <textarea class="form-control" id="desc" rows="5" placeholder="Describe your product..."></textarea>
        </div>

        <!-- Images -->
        <div class="form-section">
          <h5>Product Images</h5>
          <div class="row g-3">
            <div class="col-md-4">
              <div class="img-preview" id="i0">+ Add Image</div>
            </div>
            <div class="col-md-4">
              <div class="img-preview" id="i1">+ Add Image</div>
            </div>
            <div class="col-md-4">
              <div class="img-preview" id="i2">+ Add Image</div>
            </div>
          </div>
          <input type="file" id="imageuploader" class="d-none" multiple>
          <div class="text-center mt-3">
            <label for="imageuploader" class="btn btn-outline-primary">Upload Images</label>
          </div>
        </div>

        <!-- Notice -->
        <div class="form-section">
          <small class="text-muted">
            <i class="bi bi-info-circle"></i> We charge 5% service fee from each product sale.
          </small>
        </div>

        <!-- Save -->
        <div class="form-section text-center">
          <button class="btn-gradient" onclick="addProduct();">Save Product</button>
        </div>
      </div>

      <?php include "footer.php"; ?>
      <style>
        body {
          font-family: 'Inter', sans-serif;
          background: #f4f6fb;
          margin: 0;
          padding: 0;
        }


        .page-header {
          text-align: center;
          padding: 40px 20px 20px;
        }

        .page-header h2 {
          font-weight: 800;
          color: #2d2f44;
        }

        .card-form {
          max-width: 1000px;
          margin: 0 auto 50px;
          background: #fff;
          border-radius: 16px;
          box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
          padding: 30px 40px;
        }

        .form-section {
          margin-bottom: 35px;
        }

        .form-section h5 {
          font-weight: 700;
          margin-bottom: 20px;
          color: #374151;
        }

        .form-label {
          font-weight: 600;
          color: #4b5563;
        }

        .form-control,
        .form-select {
          border-radius: 10px;
        }

        .divider {
          border-top: 2px dashed #e5e7eb;
          margin: 30px 0;
        }

        .img-preview {
          width: 100%;
          height: 160px;
          border-radius: 12px;
          border: 2px dashed #9ca3af;
          display: flex;
          align-items: center;
          justify-content: center;
          color: #9ca3af;
          font-weight: 600;
          background: #f9fafb;
        }

        .btn-gradient {
          background: linear-gradient(90deg, #4f46e5, #2563eb);
          color: white;
          border: none;
          border-radius: 12px;
          font-weight: 600;
          padding: 12px 20px;
          width: 100%;
          transition: all 0.3s ease;
        }

        .btn-gradient:hover {
          transform: translateY(-2px);
          box-shadow: 0 8px 18px rgba(79, 70, 229, 0.3);
        }
      </style>

      <script src="bootstrap.bundle.js"></script>
      <script src="script.js"></script>
  </body>

  </html>

<?php
} else {
  header("Location:home.php");
}
?>