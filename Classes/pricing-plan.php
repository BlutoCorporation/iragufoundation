<?php
    include "libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('Loggedin')) {
        header("Location: index");
        exit;
    }

    // Now safe to get user
    ₹user = Operations::getUser();

    if (₹user && ₹user['status'] === 'not') {
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
                        <li><span class="text-main-600 fw-normal text-15">Pricing Plan</span></li>
                    </ul>
                </div>
                <!-- Breadcrumb End -->

                <div class="card mt-24">
                    <div class="card-header border-bottom">
                        <h4 class="mb-4">Pricing Breakdown</h4>
                        <p class="text-gray-600 text-15">Creating a detailed pricing plan for your course requries considering various factors.</p>
                    </div>
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-md-4 col-sm-6">
                                <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
                                    <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-package"></i></span>
                                    <h3 class="mb-4">Basic Plan</h3>
                                    <span class="text-gray-600">Perfect plan for students</span>
                                    <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">₹50 <span class="text-md text-gray-600">/year</span></h2>
                                    <ul>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Intro video the course
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Interactive quizes
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Course curriculum
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Community supports
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Certificate of completion
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Sample lesson showcasing
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Access to course community
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-outline-main w-100 rounded-pill py-16 border-main-300 text-17 fw-medium mt-32">Get Started</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative active">
                                    <span class="plan-badge py-4 px-16 bg-main-600 text-white position-absolute inset-inline-end-0 inset-block-start-0 mt-8 text-15">Recommended</span>
                                    <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-planet"></i></span>
                                    <h3 class="mb-4">Standard Plan</h3>
                                    <span class="text-gray-600">For users who want to do more</span>
                                    <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">₹129 <span class="text-md text-gray-600">/year</span></h2>

                                    <ul>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Intro video the course
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Interactive quizes
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Course curriculum
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Community supports
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Certificate of completion
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Sample lesson showcasing
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Access to course community
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-main w-100 rounded-pill py-16 border-main-600 text-17 fw-medium mt-32">Get Started</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
                                    <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-trophy"></i></span>
                                    <h3 class="mb-4">Premium Plan</h3>
                                    <span class="text-gray-600">Your entire friends in one place</span>
                                    <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">₹280 <span class="text-md text-gray-600">/year</span></h2>

                                    <ul>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Intro video the course
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Interactive quizes
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Course curriculum
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Community supports
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Certificate of completion
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Sample lesson showcasing
                                        </li>
                                        <li class="flex-align gap-8 text-gray-600 mb-lg-4">
                                            <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                            Access to course community
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-outline-main w-100 rounded-pill py-16 border-main-300 text-17 fw-medium mt-32">Get Started</a>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label mb-8 h6 mt-32">Terms & Policy</label>
                                <ul class="list-inside">
                                    <li class="text-gray-600 mb-4">1. Set up multiple pricing levels with different features and functionalities to maximize revenue</li>
                                    <li class="text-gray-600 mb-4">2. Continuously test different price points and discounts to find the sweet spot that resonates with your target audience</li>
                                    <li class="text-gray-600 mb-4">3. Price your course based on the perceived value it provides to students, considering factors</li>
                                </ul>
                                <button type="button" class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2 mt-24" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="ph ph-plus me-4"></i>
                                    Add New Plan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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