<?php
    include "libs/load.php";

    // Start session and get user info
    Session::start();
    $user = Operations::getUser();
    
    $emailToShow = $user['email'] ?? Session::get('Loggedin');

    // Initialize variables
    $error = "";

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit']) && isset($_POST['email'])) {
            $email = $_POST['email'];
            $reset = User::forGot($email);
            $error = $reset === true ? header("Location: verification") : $reset;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Title -->
        <title>Forgot Password</title>
        
        <?php include "temp/head.php"; ?>

    </head>
    <body>
        <!--==================== Preloader Start ====================-->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!--==================== Preloader End ====================-->

        <!--==================== Sidebar Overlay End ====================-->
        <div class="side-overlay"></div>
        <!--==================== Sidebar Overlay End ====================-->

        <section class="auth d-flex">
            <div class="auth-left bg-main-50 flex-center p-24">
                <img src="assets/images/thumbs/auth-img3.png" alt="Thumbs" />
            </div>
            <div class="auth-right py-40 px-24 flex-center flex-column">
                <div class="auth-right__inner mx-auto w-100">
                    <a href="index" class="auth-right__logo">
                        <img src="assets/images/logo/logo.png" alt="Logo" />
                    </a>
                    <h2 class="mb-8">Forgot Password?</h2>
                    <p class="text-gray-600 text-15 mb-32">Lost your password? Please enter your email address. You will receive a OTP to create a new password.</p>

                    <p class="text-<?= $error ? 'success' : 'danger' ?> text-15 mb-32"><?= $error ?></p>

                    <form method="POST">
                        <div class="mb-24">
                            <label for="email" class="form-label mb-8 h6">Email </label>
                            <div class="position-relative">
                                <?php
                                    if (!Session::get('Loggedin')) {
                                ?>
                                <input type="email" name="email" class="form-control py-11 ps-40" id="email" placeholder="Type your email address" required/>
                                <?php
                                    } else {
                                ?>
                                <input type="email" name="email" class="form-control py-11 ps-40" style="background: #9e9e9e30 !important;" id="email" placeholder="Type your email address" readonly value="<?= $emailToShow ?>" required/>
                                <?php } ?>
                                <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-envelope"></i></span>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-main rounded-pill w-100">Send OTP</button>

                        <a href="index" class="my-32 text-main-600 flex-align gap-8 justify-content-center"> <i class="ph ph-arrow-left d-flex"></i> Go Back</a>
                    </form>

                </div>
            </div>
        </section>

        <?php include "temp/footer.php" ?>

    </body>
</html>