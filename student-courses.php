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
                <!-- Breadcrumb Start -->
                <div class="breadcrumb mb-24">
                    <ul class="flex-align gap-4">
                        <li><a href="index" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                        <li>
                            <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                        </li>
                        <li><span class="text-main-600 fw-normal text-15">Student Classes</span></li>
                    </ul>
                </div>
                <!-- Breadcrumb End -->

                <!-- Course Tab Start -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-20 flex-between flex-wrap gap-8">
                            <h4 class="mb-0">Capital Letter <b>A to Z</b></h4>
                        </div>
                        <div class="row g-20">

                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="card border border-gray-100">
                                    <div class="card-body p-8">
                                        <a href="course-details" class="bg-main-100 rounded-8 overflow-hidden text-center h-164 flex-center">
                                            <img src="assets/images/thumbs/course-details.png" alt="Course Image" />
                                        </a>
                                        <!-- <div class="p-8">
                                            <div class="flex-between gap-4 flex-wrap">
                                                <div class="flex-align gap-4">
                                                    <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    <span class="text-13 fw-bold text-gray-600">4.9</span>
                                                    <span class="text-13 fw-bold text-gray-600">(12k)</span>
                                                </div>
                                                <a href="course-details" class="btn btn-outline-main rounded-pill py-9">View Details</a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="card border border-gray-100">
                                    <div class="card-body p-8">
                                        <a href="course-details" class="bg-main-100 rounded-8 overflow-hidden text-center h-164 flex-center">
                                            <!-- <img src="assets/images/thumbs/course-img1.png" alt="Course Image" /> -->
                                            <h1 class="m-0 p-0">B</h1>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Course Tab End -->

                <!-- Recommended Course Start -->
                <div class="card mt-24">
                    <div class="card-body">
                        <div class="mb-20 flex-between flex-wrap gap-8">
                            <h4 class="mb-0">Small Letter <b>a to z</b></h4>
                        </div>
                        <div class="row g-20">
                            
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="card border border-gray-100">
                                    <div class="card-body p-8">
                                        <a href="course-details" class="bg-main-100 rounded-8 overflow-hidden text-center h-164 flex-center">
                                            <!-- <img src="assets/images/thumbs/course-img5.png" alt="Course Image" /> -->
                                            <h1 class="m-0 p-0">a</h1>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Recommended Course End -->
            </div>
            <div class="dashboard-footer">
                <div class="flex-between flex-wrap gap-16">
                    <p class="text-gray-300 text-13 fw-normal">&copy; IraguFoundation <?= date('Y'); ?>, All Rights Reserved.</p>
                </div>
            </div>
        </div>

        <?php include "temp/footer-main.php" ?>

    </body>
</html>