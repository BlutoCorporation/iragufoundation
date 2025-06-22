<?php
    include "libs/load.php";

    // Start a session
    Session::start();

    // Redirect if the user is already logged in
    if (Session::get('Loggedin')) {
        header('Location: welcome');
        exit;
    }

    $error = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if both username and password keys exist in $_POST
        if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])) {
            $user = $_POST['username'] ?? "";
            $pass = $_POST['password'] ?? "";

            // Call User::login
            $error = User::login($user, $pass);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign In</title>
        
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
        <!-- Preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="side-overlay"></div>

        <section class="auth d-flex">
            <div class="auth-left bg-main-50 flex-center p-24">
                <img src="assets/images/thumbs/auth-img1.png" alt="Thumbs" />
            </div>
            <div class="auth-right py-40 px-24 flex-center flex-column">
                <div class="auth-right__inner mx-auto w-100">
                    <a href="index" class="auth-right__logo">
                        <img src="assets/images/logo/logo.png" alt="Logo" />
                    </a>
                    <h2 class="mb-8">Welcome to Back! &#128075;</h2>
                    <p class="text-gray-600 text-15 mb-32">Please sign in to your account and start the adventure</p>
                    <?php if ($error): ?>
                        <p class="text-danger text-15 mb-32"><?= $error ?></p>
                    <?php endif; ?>

                    <form method="POST">
                        <!-- Username/Email Field -->
                        <div class="mb-24 form-control-icon">
                            <label for="username" class="form-label mb-8 h6">Email or Username</label>
                            <div class="position-relative">
                                <i class="ph ph-user icon"></i>
                                <input type="text" name="username" class="form-control py-11" id="username" placeholder="Type your username or email" required/>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-24 form-control-icon">
                            <label for="password" class="form-label mb-8 h6">Password</label>
                            <div class="position-relative">
                                <i class="ph ph-lock icon"></i>
                                <input type="password" name="password" class="form-control py-11" id="current-password" placeholder="Enter Password" required/>
                                <span class="toggle-password ph ph-eye-slash" data-target="#current-password"></span>
                            </div>
                        </div>

                        <div class="mb-32 flex-between flex-wrap gap-8">
                            <div class="form-check mb-0 flex-shrink-0">
                                <input class="form-check-input flex-shrink-0 rounded-4" type="checkbox" value="" id="remember" />
                                <label class="form-check-label text-15 flex-grow-1" for="remember">Remember Me</label>
                            </div>
                            <a href="forgot-password" class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Forgot Password?</a>
                        </div>

                        <button type="submit" name="submit" class="btn btn-main rounded-pill w-100">Sign In</button>
                        <p class="mt-32 text-gray-600 text-center">
                            New on our platform?
                            <a href="sign-up" class="text-main-600 hover-text-decoration-underline">Create an account</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>

        <?php include "temp/footer.php" ?>

        <script>
            $(document).ready(function () {
                // Toggle password visibility
                $('.toggle-password').on('click', function() {
                    const target = $(this).data('target');
                    const input = $(target);
                    const icon = $(this);
                    
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        icon.removeClass('ph-eye-slash').addClass('ph-eye');
                    } else {
                        input.attr('type', 'password');
                        icon.removeClass('ph-eye').addClass('ph-eye-slash');
                    }
                });

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
                $('#username').on('input', function() {
                    const val = $(this).val().trim();
                    if (val.length === 0) {
                        showError(this, "Username or email is required.");
                    } else {
                        clearError(this);
                    }
                });

                $('#current-password').on('input', function() {
                    const val = $(this).val().trim();
                    if (val.length === 0) {
                        showError(this, "Password is required.");
                    } else if (val.length < 6) {
                        showError(this, "Password must be at least 6 characters.");
                    } else {
                        clearError(this);
                    }
                });

                // Form submission validation
                $('form').on('submit', function(e) {
                    // Trigger all validations
                    $('#username, #current-password').trigger('input');
                    
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