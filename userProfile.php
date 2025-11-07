<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>User Profile | Veloxa</title>

  <!-- Bootstrap & Icons -->
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="resource/Veloxa.png" />


  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f8faff, #e9f1ff);
      min-height: 100vh;
    }

    .profile-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
      padding: 30px;
      transition: all 0.3s ease-in-out;
    }

    .profile-card:hover {
      transform: translateY(-5px);
    }

    .profile-img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid #0d6efd;
    }

    .form-control,
    .form-select {
      border-radius: 12px;
      padding: 10px 14px;
    }

    .btn-primary {
      border-radius: 12px;
      font-weight: 600;
      padding: 12px;
      background: linear-gradient(45deg, #0d6efd, #5a8dee);
      border: none;
      transition: 0.3s;
    }

    .btn-primary:hover {
      background: linear-gradient(45deg, #0b5ed7, #4369d9);
      transform: scale(1.03);
    }

    .signout-btn {
      font-weight: 600;
      color: #e74c3c;
      cursor: pointer;
      transition: 0.3s;
    }

    .signout-btn:hover {
      color: #c0392b;
    }

    .section-title {
      font-weight: 600;
      color: #333;
      border-left: 5px solid #0d6efd;
      padding-left: 10px;
      margin-bottom: 20px;
    }

    .accordion-button {
      border-radius: 12px !important;
      font-weight: 500;
    }

    .accordion-body {
      background: #f9fbff;
      border-radius: 12px;
    }
  </style>

  <link rel="icon" href="resources/logo.svg" />
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php include "header.php"; ?>

      <?php
      require "connection.php";

      if (isset($_SESSION["u"])) {
        $email = $_SESSION["u"]["email"];
        $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON gender.id=users.gender_id WHERE `email`='" . $email . "'");
        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");
        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id INNER JOIN `province` ON district.province_province_id=province.province_id WHERE `users_email`='" . $email . "'");

        $details = $details_rs->fetch_assoc();
        $image_details = $image_rs->fetch_assoc();
        $address_details = $address_rs->fetch_assoc();
      ?>

        <div class="col-12 py-5">
          <div class="profile-card mx-auto col-lg-10">
            <div class="row g-4">
              <!-- Profile Image -->
              <div class="col-md-3 border-end d-flex flex-column align-items-center justify-content-center">
                <?php if (empty($image_details["path"])) { ?>
                  <img src="resources/new_user.svg" class="profile-img mb-3" id="viewImg" />
                <?php } else { ?>
                  <img src="<?php echo $image_details["path"]; ?>" class="profile-img mb-3" id="viewImg"/>
                <?php } ?>

                <h5 class="fw-bold"><?php echo $details["fname"] . " " . $details["lname"]; ?></h5>
                <p class="text-muted mb-1"><?php echo $email; ?></p>

                <input type="file" class="d-none" id="profileimg" />
                <label for="profileimg" class="btn btn-primary mt-3" onclick="changeImage();">
                  <i class="bi bi-upload me-2"></i> Update Image
                </label>
              </div>

              <!-- Profile Settings -->
              <div class="col-md-6 border-end">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="section-title">Profile Settings</h4>
                  <span class="signout-btn" onclick="signout();">
                    <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                  </span>
                </div>

                <div class="row g-3">
                  <div class="col-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" value="<?php echo $details["fname"]; ?>" id="fname"/>
                  </div>
                  <div class="col-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $details["lname"]; ?>" id="lname"/>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Mobile</label>
                    <input type="text" class="form-control" value="<?php echo $details["mobile"]; ?>" id="mobile"/>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" value="<?php echo $details["password"]; ?>" readonly />
                      <span class="input-group-text bg-primary text-white">
                        <i class="bi bi-eye-slash-fill"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" readonly value="<?php echo $details["email"]; ?>" />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Registered Date</label>
                    <input type="text" class="form-control" readonly value="<?php echo $details["joined_date"]; ?>" />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Gender</label>
                    <input type="text" class="form-control" readonly value="<?php echo $details["gender_name"] ?>" />
                  </div>

                  <!-- Collapsible Address Box -->
                  <div class="col-12 mt-3">
                    <div class="accordion" id="addressAccordion">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingAddress">
                          <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAddress" aria-expanded="false" aria-controls="collapseAddress">
                            <i class="bi bi-geo-alt-fill me-2 text-primary"></i> Manage Address
                          </button>
                        </h2>
                        <div id="collapseAddress" class="accordion-collapse collapse <?php echo !empty($address_details["line1"]) ? 'show' : ''; ?>" aria-labelledby="headingAddress" data-bs-parent="#addressAccordion">
                          <div class="accordion-body">
                            <div class="row g-3">
                              <div class="col-12">
                                <label class="form-label">Address Line 01</label>
                                <input type="text" class="form-control" value="<?php echo !empty($address_details["line1"]) ? $address_details["line1"] : ''; ?>" id="line1"/>
                              </div>
                              <div class="col-12">
                                <label class="form-label">Address Line 02</label>
                                <input type="text" class="form-control" value="<?php echo !empty($address_details["line2"]) ? $address_details["line2"] : ''; ?>" id="line2"/>
                              </div>
                              <div class="col-md-4">
                                <label class="form-label">Postal Code</label>
                                <input type="text" class="form-control" value="<?php echo !empty($address_details["postal_code"]) ? $address_details["postal_code"] : ''; ?>" id="pcode"/>
                              </div>
                              <div class="col-md-4">
                                <label class="form-label">Province</label>
                                <select class="form-select" id="province">
                                  <option value="0">Select Province</option>
                                  <?php
                                  $province_rs = Database::search("SELECT * FROM `province`");
                                  while ($province_data = $province_rs->fetch_assoc()) {
                                  ?>
                                    <option value="<?php echo $province_data["province_id"]; ?>"
                                      <?php if (!empty($address_details["province_id"]) && $province_data["province_id"] == $address_details["province_id"]) {
                                        echo "selected";
                                      } ?>>
                                      <?php echo $province_data["province_name"]; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="col-md-4">
                                <label class="form-label">District</label>
                                <select class="form-select" id="district">
                                  <option value="0">Select District</option>
                                  <?php
                                  $district_rs = Database::search("SELECT * FROM `district`");
                                  while ($district_data = $district_rs->fetch_assoc()) {
                                  ?>
                                    <option value="<?php echo $district_data["district_id"]; ?>"
                                      <?php if (!empty($address_details["district_id"]) && $district_data["district_id"] == $address_details["district_id"]) {
                                        echo "selected";
                                      } ?>>
                                      <?php echo $district_data["district_name"]; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="col-md-6">
                                <label class="form-label">City</label>
                                <select class="form-select" id="city">
                                  <option value="">Select City</option>
                                  <?php
                                  $city_rs = Database::search("SELECT * FROM `city`");
                                  while ($city_data = $city_rs->fetch_assoc()) {
                                  ?>
                                    <option value="<?php echo $city_data["city_id"]; ?>"
                                      <?php if (!empty($address_details["city_id"]) && $city_data["city_id"] == $address_details["city_id"]) {
                                        echo "selected";
                                      } ?>>
                                      <?php echo $city_data["city_name"]; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 d-grid mt-4">
                    <button class="btn btn-primary" onclick="updateProfile();">
                      <i class="bi bi-save2 me-2"></i> Update My Profile
                    </button>
                  </div>
                </div>
              </div>

              <!-- Extra Column (Right Side for future widgets) -->
              <div class="col-md-3 d-flex flex-column align-items-center justify-content-center">
                <i class="bi bi-person-lines-fill display-1 text-primary mb-3"></i>
                <p class="text-muted">Manage your profile info securely.</p>
              </div>
            </div>
          </div>
        </div>

      <?php } else { /* header("Location:home.php"); */ } ?>

      <?php include "footer.php"; ?>
    </div>
  </div>

  <script src="bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>
