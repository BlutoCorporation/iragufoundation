<?php
    include "libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('Loggedin')) {
        header("Location: index");
        exit;
    }

    // Now safe to get user
    $user = Operations::getUser();

    if ($user && $user['status'] === 'not') {
        header("Location: verify-email");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <?php include "temp/head-main.php" ?>

    </head>
    <body>
        
        <?php include "temp/sideheader.php" ?>

        <div class="dashboard-main-wrapper">
            
            <?php include "temp/header.php" ?>

            <div class="dashboard-body">
                <div class="row gy-4">
                    <div class="col-xxl-8">
                        <div class="card h-100">
                            <div class="card-body grettings-box-two position-relative z-1 p-0">
                                <div class="row align-items-center h-100">
                                    <div class="col-lg-6">
                                        <div class="grettings-box-two__content">
                                            <h2 class="fw-medium mb-0 flex-align gap-10">Hi, <?= ucfirst(strtolower($user['username'])) ?><img src="assets/images/icons/wave-hand.png" alt="Wave Hand" /></h2>
                                            <h2 class="fw-medium mb-16">What would you like to learn today with your learning partner?</h2>
                                            <p class="text-15 text-gray-400">Explore courses, track your progress, and reach your learning goals effortlessly.</p>
                                            <a href="student-courses" class="btn btn-main rounded-pill mt-32">Explore Courses</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-md-block d-none mt-auto">
                                        <img src="assets/images/thumbs/gretting-thumb.png" alt="" />
                                    </div>
                                </div>
                                <img src="assets/images/bg/star-shape.png" class="position-absolute start-0 top-0 w-100 h-100 z-n1 object-fit-contain" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <!-- Widgets Start -->
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="flex-between gap-8 mb-24">
                                            <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl"><i class="ph-fill ph-users-three"></i></span>
                                            <div id="community-support" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>

                                        <h4 class="mb-2">1200000+</h4>
                                        <span class="text-gray-300">Trained Students</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="flex-between gap-8 mb-24">
                                            <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-purple-600 text-white text-2xl"><i class="ph-fill ph-certificate"></i></span>
                                            <div id="course-progress" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>

                                        <h4 class="mb-2">10+</h4>
                                        <span class="text-gray-300">Years in Service</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="flex-between gap-8 mb-24">
                                            <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl"><i class="ph-fill ph-graduation-cap"></i></span>
                                            <div id="complete-course" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>

                                        <h4 class="mb-2">350+</h4>
                                        <span class="text-gray-300">Schools</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="flex-between gap-8 mt-16">
                                            <span class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-two-600 text-white text-2xl"><i class="ph-fill ph-graduation-cap"></i></span>
                                            <div id="earned-certificate" class="remove-tooltip-title rounded-tooltip-value"></div>
                                        </div>

                                        <h4 class="mb-2">15+</h4>
                                        <span class="text-gray-300">Free Camp</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Widgets End -->
                    </div>
                </div>
            </div>
            <div class="dashboard-footer">
                <div class="flex-between flex-wrap gap-16">
                    <p class="text-gray-300 text-13 fw-normal">&copy; IraguFoundation <?= date('Y'); ?>, All Rights Reserved.</p>
                    <div class="flex-align flex-wrap gap-16">
                        <p class="text-gray-300 text-13 fw-normal">
                            Designed and Developed By
                            <a href="https://bluto.zeal.lol/" class="text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">Bluto Corporation</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?php include "temp/footer-main.php" ?>

    </body>
</html>