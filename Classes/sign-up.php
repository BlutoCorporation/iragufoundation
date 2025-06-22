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
    $success = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['standard']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $standard = $_POST['standard'];

            // Call the register method
            $error = User::register($username, $password, $email, $phone, $standard);
            if (!$error) {
                $success = "Registration successful!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign Up</title>
        
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

            .form-control-icon input,
            .form-control-icon select {
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
                <img src="assets/images/thumbs/auth-img2.png" alt="Thumbs" />
            </div>
            <div class="auth-right py-40 px-24 flex-center flex-column">
                <div class="auth-right__inner mx-auto w-100">
                    <a href="index" class="auth-right__logo">
                        <img src="assets/images/logo/logo.png" alt="Logo" />
                    </a>
                    <h2 class="mb-8">Sign Up</h2>
                    <p class="text-gray-600 text-15 mb-32">Please sign up to your account and start the adventure</p>
                    <?php if ($error): ?>
                        <p class="text-danger text-15 mb-32"><?= $error ?></p>
                    <?php elseif ($success): ?>
                        <p class="text-success text-15 mb-32"><?= $success ?></p>
                    <?php endif; ?>

                    <form method="POST">
                        <!-- Username Field -->
                        <div class="mb-24 form-control-icon">
                            <label for="username" class="form-label mb-8 h6">Username</label>
                            <div class="position-relative">
                                <i class="ph ph-user icon"></i>
                                <input type="text" name="username" class="form-control py-11" id="username" placeholder="Type your username" required/>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-24 form-control-icon">
                            <label for="email" class="form-label mb-8 h6">Email</label>
                            <div class="position-relative">
                                <i class="ph ph-envelope icon"></i>
                                <input type="email" name="email" class="form-control py-11" id="email" placeholder="Type your email address" required/>
                            </div>
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-24 form-control-icon">
                            <label for="phone" class="form-label mb-8 h6">Phone Number</label>
                            <div class="position-relative">
                                <i class="ph ph-phone icon"></i>
                                <input type="number" name="phone" maxlength="10" class="form-control py-11" id="phone" placeholder="Type your phone number" required/>
                            </div>
                        </div>

                        <!-- Standard Field -->
                        <div class="mb-24 form-control-icon">
                            <label for="standard" class="form-label mb-8 h6">Select Standard</label>
                            <div class="position-relative">
                                <i class="ph ph-graduation-cap icon"></i>
                                <select name="standard" id="standard" class="form-control py-11" required>
                                    <option value="" disabled selected>Select your standard</option>
                                    <option value="1">1st Standard</option>
                                    <option value="2">2nd Standard</option>
                                    <option value="3">3rd Standard</option>
                                    <option value="4">4th Standard</option>
                                    <option value="5">5th Standard</option>
                                    <option value="6">6th Standard</option>
                                    <option value="7">7th Standard</option>
                                    <option value="8">8th Standard</option>
                                    <option value="9">9th Standard</option>
                                    <option value="10">10th Standard</option>
                                    <option value="11">11th Standard</option>
                                    <option value="12">12th Standard</option>
                                </select>
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

                        <button type="submit" name="submit" class="btn btn-main rounded-pill w-100">Sign Up</button>
                        <p class="mt-32 text-gray-600 text-center">
                            Already have an account?
                            <a href="index" class="text-main-600 hover-text-decoration-underline"> Log In</a>
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
                    if (val.length < 3) {
                        showError(this, "Username must be at least 3 characters.");
                    } else {
                        clearError(this);
                    }
                });

                $('#email').on('input', function() {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    const val = $(this).val().trim();
                    if (!emailPattern.test(val)) {
                        showError(this, "Please enter a valid email address.");
                    } else {
                        clearError(this);
                    }
                });

                $('#phone').on('input', function() {
                    const val = $(this).val().trim();
                    if (!/^\d{10}$/.test(val)) {
                        showError(this, "Enter a valid 10-digit phone number.");
                    } else {
                        clearError(this);
                    }
                });

                $('#standard').on('change', function() {
                    if (!$(this).val()) {
                        showError(this, "Please select your standard.");
                    } else {
                        clearError(this);
                    }
                });

                $('#current-password').on('input', function() {
                    const val = $(this).val().trim();
                    if (val.length < 6) {
                        showError(this, "Password must be at least 6 characters.");
                    } else {
                        clearError(this);
                    }
                });

                // Form submission validation
                $('form').on('submit', function(e) {
                    // Trigger all validations
                    $('#username, #email, #phone, #standard, #current-password').trigger('input');
                    
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