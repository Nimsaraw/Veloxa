<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veloxa</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/Veloxa.png" />


    <style>
        /* Body background */
        body.main-body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        /* Logo */
        .logo {
            background: url("resources/logo.svg") no-repeat center;
            background-size: 80px;
            height: 80px;
            margin: 10px auto;
        }

        /* Titles */
        .title01 {
            font-size: 2rem;
            font-weight: 600;
            color: #f8f9fa;
        }
        .title02 {
            font-size: 1.5rem;
            font-weight: 500;
            color: #2a5298;
        }

        /* Card containers */
        #signUpBox, #signInBox {
            background: #ffffff;
            color: #333;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0px 8px 25px rgba(0,0,0,0.15);
            transition: all 0.3s ease-in-out;
        }
        #signUpBox:hover, #signInBox:hover {
            transform: translateY(-3px);
        }

        /* Labels */
        label.form-label {
            font-weight: 500;
            color: #444;
        }

        /* Inputs */
        .form-control {
            border-radius: 12px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: border 0.3s;
        }
        .form-control:focus {
            border-color: #2a5298;
            box-shadow: 0 0 8px rgba(42, 82, 152, 0.3);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-weight: 500;
        }
        .btn-dark {
            background: #343a40;
            border-radius: 12px;
        }
        .btn-danger {
            border-radius: 12px;
        }
        .btn:focus {
            box-shadow: none;
        }

        /* Forgot password modal */
        .modal-content {
            border-radius: 16px;
        }

        /* Footer */
        footer p {
            font-size: 0.9rem;
            color: #e2e6ea;
        }
    </style>
</head>

<body class="main-body">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to Veloxa</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-3 d-none d-lg-block background"></div>

                    <!-- signupbox -->
                    <div class="col-12 col-lg-6" id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Create New Account</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="msg"></div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="ex:- John" id="fname" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="ex:- Doe" id="lname" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex:- john@gmail.com" id="email" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="********" id="password" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" placeholder="ex:- 0771234568" id="mobile" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control" id="gender">
                                    <?php
                                        require "connection.php";
                                        $rs = Database::search("SELECT * FROM `gender`");
                                        $n = $rs->num_rows;
                                        for ($x = 0; $x < $n; $x++) {
                                            $d = $rs->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-12 d-grid ">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <h6 class="f" onclick="changeView();">Already have an account? Sign In</h6>
                            </div>
                        </div>
                    </div>
                    <!-- signupbox -->

                    <!-- signinbox -->
                    <div class="col-12 col-lg-6 d-none" id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign In</p>
                            </div>
                            <?php
                                $email = "";
                                $password = "";
                                if (isset($_COOKIE["email"])) { $email = $_COOKIE["email"]; }
                                if (isset($_COOKIE["password"])) { $password = $_COOKIE["password"]; }
                            ?>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme" />
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <h6  onclick="changeView();">New to Veloxa? Join Now</h6>
                            </div>
                        </div>
                    </div>
                    <!-- signinbox -->
                </div>
            </div>
            <!-- content -->

            <!-- modal -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np"/>
                                        <button class="btn btn-outline-secondary" type="button" onclick="showPassword();">Show</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp"/>
                                        <button class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

            <!-- footer -->
            <footer class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2025 Veloxa.lk || All Rights Reserved</p>
            </footer>
            <!-- footer -->

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>
</html>
