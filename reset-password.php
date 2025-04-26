<?php
    include "libs/load.php";

    // Start session and get user info
    Session::start();
    $user = Operations::getUser();
    
    $emailToShow = $user['email'] ?? Session::get('Loggedin') ?? header('Location: forgot-password');

    $expiryTimestamp = strtotime($user['otp_expiry']);
    if ((string)$expiryTimestamp < time()) {
        $conn = Database::getConnection();
        $conn->query("UPDATE `auth` SET `otp_expiry` = NULL, `forgot` = NULL WHERE `email` = '$emailToShow' OR `username` = '$emailToShow' OR `phone` = '$emailToShow'");
        header('Location: forgot-password');
        exit;
    }

    // Redirect verified users
    if (Session::get('Loggedin') && $user['forgot'] === NULL) {
        header('Location: index');
        exit;
    }

    // Initialize variables
    $error = "";

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit']) && isset($_POST['new']) && isset($_POST['conf'])) {
            $new = $_POST['new'];
            $conf = $_POST['conf'];
            $error = User::resetPass($new, $conf);
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
        <title>Reset Password</title>
        
        <?php include "temp/head.php" ?>

        <style>
            .input-group .form-control.is-invalid {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }

            .input-group-text {
                background-color: #fff;
                border-right: 0;
            }

            .input-group .form-control {
                border-left: 0;
            }

            .input-group .form-control.is-invalid:focus {
                box-shadow: none;
            }

            /* New styles for icon alignment */
            .form-control-icon {
                position: relative;
            }

            .form-control-icon input {
                padding-left: 50px !important;
            }

            .form-control-icon .icon {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                z-index: 4;
                color: #6c757d;
            }

            .toggle-password {
                position: absolute;
                right: 16px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                z-index: 4;
                color: #6c757d;
            }

            .invalid-feedback {
                margin-top: 4px;
            }
        </style>
    
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
                <img src="assets/images/thumbs/auth-img3.png" alt="" />
            </div>
            <div class="auth-right py-40 px-24 flex-center flex-column">
                <div class="auth-right__inner mx-auto w-100">
                    <a href="index" class="auth-right__logo">
                        <img src="assets/images/logo/logo.png" alt="" />
                    </a>
                    <h2 class="mb-8">Reset Password</h2>
                    <p class="text-gray-600 text-15 mb-32">For <span class="fw-medium"> <?= htmlspecialchars($emailToShow) ?></span></p>

                    <p class="text-<?= $error ? 'success' : 'danger' ?> text-15 mb-32"><?= $error ?></p>

                    <form method="POST">
                        <div class="mb-24">
                            <label for="new-password" class="form-label mb-8 h6">New Password</label>
                            <div class="position-relative">
                                <input type="password" name="new" class="form-control py-11 ps-40" id="new-password" placeholder="Enter New Password" required/>
                                <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                                <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#new-password"></span>
                            </div>
                        </div>
                        <div class="mb-24">
                            <label for="confirm-password" class="form-label mb-8 h6">Confirm Password</label>
                            <div class="position-relative">
                                <input type="password" name="conf" class="form-control py-11 ps-40" id="confirm-password" placeholder="Enter Confirm Password" required/>
                                <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                                <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#confirm-password"></span>
                            </div>
                        </div>

                        <button type="submit" name="submit" class="btn btn-main rounded-pill w-100">Update</button>

                        <a href="forgot-password" class="mt-24 text-main-600 flex-align gap-8 justify-content-center"> <i class="ph ph-arrow-left d-flex"></i> Go Back</a>
                    </form>
                </div>
            </div>
        </section>

        <?php include "temp/footer.php" ?>

        <script>
            $(document).ready(function () {
                // Validation functions
                function showError(input, message) {
                    const parent = $(input).closest('.position-relative');
                    $(input).addClass('is-invalid');
                    if (!parent.next('.invalid-feedback').length) {
                        parent.after('<div class="invalid-feedback d-block">' + message + '</div>');
                    } else {
                        parent.next('.invalid-feedback').text(message);
                    }
                }

                function clearError(input) {
                    const parent = $(input).closest('.position-relative');
                    $(input).removeClass('is-invalid');
                    parent.next('.invalid-feedback').remove();
                }

                // Field validations
                $('#new-password').on('input', function() {
                    const val = $(this).val().trim();
                    if (val.length === 0) {
                        showError(this, "Password is required.");
                    } else if (val.length < 6) {
                        showError(this, "Password must be at least 6 characters.");
                    } else {
                        clearError(this);
                    }
                });

                $('#confirm-password').on('input', function() {
                    const newPassword = $('#new-password').val().trim();
                    const confirmPassword = $(this).val().trim();
                    
                    if (confirmPassword.length === 0) {
                        showError(this, "Password is required.");
                    } else if (confirmPassword.length < 6) {
                        showError(this, "Password must be at least 6 characters.");
                    } else if (confirmPassword !== newPassword) {
                        showError(this, "Passwords do not match.");
                    } else {
                        clearError(this);
                    }
                });

                // Form submission validation
                $('form').on('submit', function(e) {
                    // Trigger all validations
                    $('#new-password, #confirm-password').trigger('input');
                    
                    if ($('.is-invalid').length) {
                        e.preventDefault();
                        $('html, body').animate({
                            scrollTop: $('.is-invalid').first().offset().top - 100
                        }, 500);
                    }
                });
            });
        </script>

    </body>
</html>