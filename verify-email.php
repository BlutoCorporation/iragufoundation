<?php
    include "libs/load.php";

    // Start session and get user info
    Session::start();
    $user = Operations::getUser();
    
    $emailToShow = $user['email'] ?? Session::get('Loggedin') ?? header('Location: index');

    // Redirect verified users
    if (Session::get('Loggedin') && $user['status'] === 'verified') {
        header('Location: index');
        exit;
    }

    // Initialize variables
    $success = "";
    $error = "";

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Combine OTP inputs
        function getFullOTP()
        {
            $otp = '';
            for ($i = 0; $i < 6; $i++) {
                $otp .= $_POST["otp_$i"] ?? '';
            }
            return $otp;
        }

        $email = $emailToShow;

        $otp = getFullOTP();
        if ($otp && $email) {
            $result = User::verifyOTP($email, $otp);
            if ($result === true) {
                Session::regenerate();
                Session::set("Loggedin", $email);
                header("Location: welcome");
                exit;
            } else {
                $error = $result;
            }
        }

        if (isset($_POST['resend']) && $email) {
            $resend = User::resendOTP($email);
            $success = $resend === true ? "A new OTP has been sent to your email." : $resend;
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
        <title>Verify OTP</title>
        
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
                <img src="assets/images/thumbs/auth-img4.png" alt="" />
            </div>
            <div class="auth-right py-40 px-24 flex-center flex-column">
                <div class="auth-right__inner mx-auto w-100">
                    <a href="index" class="auth-right__logo">
                        <img src="assets/images/logo/logo.png" alt="" />
                    </a>
                    <h2 class="mb-8">Verify your mail</h2>
                    <p class="text-gray-600 text-15 mb-32">Account activation OTP sent to your email address: <span class="fw-medium"> <?= htmlspecialchars($emailToShow) ?></span> Please enter OTP verify your account.</p>
                    
                    <?php if ($error): ?>
                        <p class="text-danger text-15 mb-32"><?= $error ?></p>
                    <?php elseif ($success): ?>
                        <p class="text-success text-15 mb-32"><?= $success ?></p>
                    <?php endif; ?>

                    <form id="verify" method="POST">
                        <input type="hidden" name="email" value="<?= htmlspecialchars($emailToShow) ?>">
                        <div class="mb-32">
                            <label class="form-label mb-8 h6">Type your 6 digit security code</label>
                            <div class="squire-input-wrapper flex-align">
                                <?php for ($i = 0; $i < 6; $i++): ?>
                                    <input type="number" name="otp_<?= $i ?>" class="squire-input form-control text-center p-6" min="0" max="9" required>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <button type="submit" name="verify" id="valid" class="btn btn-main rounded-pill w-100">Verify Now</button>
                    </form>
                    
                    <form class="d-flex justify-content-between mt-32" method="POST" action="verify-email">
                        <a href="index" class="d-flex align-items-center"> <i class="ph ph-arrow-left d-flex align-item-center me-5"></i> Back To Login</a>
                        
                        <p class="text-gray-600 text-center">
                            Wait for <span id="countdown">30</span> seconds to resend OTP.
                        </p>

                        <button type="submit" id="resendBtn" name="resend" class="text-main-600 hover-text-decoration-underline" style="display: none;">
                            Resend OTP
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <?php include "temp/footer.php" ?>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var countdownTime = 30;
                var countdownElement = document.getElementById("countdown");
                var resendButton = document.getElementById("resendBtn");

                var countdownInterval = setInterval(function() {
                    countdownTime--;
                    countdownElement.textContent = countdownTime;

                    if (countdownTime <= 0) {
                        clearInterval(countdownInterval);
                        countdownElement.parentElement.style.display = "none"; // hide the "Wait for X seconds" text
                        resendButton.style.display = "inline-block"; // show the resend button
                    }
                }, 1000);
            });

            document.addEventListener("DOMContentLoaded", function() {
                const inputs = document.querySelectorAll('.squire-input');
                const form = document.querySelector('form#verify');
                const valid = document.querySelector('#valid');

                function collectOTP() {
                    let otp = '';
                    inputs.forEach(input => {
                        otp += input.value.trim();
                    });
                    return otp;
                }

                function checkAndSubmitOTP() {
                    const fullOTP = collectOTP();
                    if (fullOTP.length === 6) {
                        if (valid) {
                            valid.innerHTML = "Verifying...";
                            valid.disabled = true;
                        }
                        inputs.forEach(inp => inp.readOnly = true); // make inputs readonly
                        form.submit();
                    }
                }

                inputs.forEach((input, index) => {
                    input.addEventListener('input', (e) => {
                        if (e.target.value.length > 1) {
                            e.target.value = e.target.value.slice(0, 1); // only allow 1 number
                        }
                        if (e.target.value && index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                        checkAndSubmitOTP(); // always check after every input
                    });

                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && !e.target.value) {
                            if (index > 0) {
                                inputs[index - 1].focus();
                            }
                        }
                        if (e.key === 'e' || e.key === '+' || e.key === '-' || e.key === '.') {
                            e.preventDefault(); // prevent unwanted keys in number input
                        }
                    });
                });
            });
        </script>

    </body>

</html>