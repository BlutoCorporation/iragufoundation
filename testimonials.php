<?php
    include "admin/libs/load.php";

    $bhero = Operations::getBHero();
    $testmonials = Operations::getHomeReview();
?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
        
        <!-- Page Title -->
        <title>Testimonials</title>
        
        <?php include "template/head.php" ?>

        <style>
            .client-author-content h3 {
                color: #000;
            }

            .page-header {
                background: url("assets/<?= $bhero['img'] ?>") no-repeat !important;
                background-position: center center !important;
                background-size: cover !important;
            }
        </style>

    </head>
    <body>
        <?php include "template/header.php" ?>

        <!-- Page Header Start -->
        <div class="page-header bg-section">
            <!-- Page Header Box Start -->
            <div class="page-header-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Page Header Content Start -->
                            <div class="page-header-content">
                                <h1 class="wow fadeInUp">Our <span>Testimonial</span></h1>
                                <nav class="wow fadeInUp" data-wow-delay="0.25s">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index">home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">testimonial</li>
                                    </ol>
                                </nav>
                            </div>
                            <!-- Page Header Content End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header Box End -->
        </div>
        <!-- Page Header End -->

        <!-- Page Testimonial Start -->
        <div class="page-testimonial">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">testimonials</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.25s">Real success stories from <span>our clients</span></h2>
                        </div>
                        <!-- Section Title End -->

                        <?php
                            if (!empty($testmonials)) {
                                foreach ($testmonials as $row) {
                        ?>
                        <!-- Client Testimonial Item Start -->
                        <div class="client-testimonial-item wow fadeInUp">
                            <!-- Client Testimonial Author Start -->
                            <div class="client-testimonial-author">
                                <!-- Client Author Image Start -->
                                <div class="client-author-image">
                                    <figure class="image-anime">
                                        <img style="object-fit: contain;" src="assets/<?= $row['img'] ?>" alt="Image Error" />
                                    </figure>
                                </div>
                                <!-- Client Author Image End -->

                                <!-- Client Author Content Start -->
                                <div class="client-author-content">
                                    <h3><?= $row['name'] ?></h3>
                                </div>
                                <!-- Client Author Content End -->
                            </div>
                            <!-- Client Testimonial Author End -->

                            <!-- Client Testimonial Content Start -->
                            <div class="client-testimonial-content">
                                <p><?= $row['review'] ?></p>
                            </div>
                            <!-- Client Testimonial Content End -->
                        </div>
                        <!-- Client Testimonial Item End -->
                        <?php
                                }
                            } else { echo "<p>Reviews Not Found</p>"; }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Testimonial End -->

        <?php include "template/footer.php" ?>

    </body>
</html>