<?php
    include "admin/libs/load.php";

    $bhero = Operations::getBHero();
    $about = Operations::getHomeAboutUs();
    $testmonials = Operations::getHomeReview();
    $team = Operations::getTeams();
?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
        
        <!-- Page Title -->
        <title>About Us</title>
        
        <?php include "template/head.php" ?>
        
        <style>
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
                                <h1 class="wow fadeInUp">About <span>Us</span></h1>
                                <nav class="wow fadeInUp" data-wow-delay="0.25s">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index">home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">about us</li>
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

        <?php
            if (!empty($about)) {
                $s1 = explode(',,', $status['s1']);
                $s2 = explode(',,', $status['s2']);
                $s3 = explode(',,', $status['s3']);
                $s4 = explode(',,', $status['s4']);
        ?>
        <!-- Company Growth Section Start -->
        <div class="company-growth bg-section mt-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <!-- Company Growth Image Start -->
                        <div class="company-growth-image">
                            <figure class="image-anime reveal">
                                <img src="assets/<?= $about['img'] ?>" style="object-fit: contain;" alt="">
                            </figure>
                        </div>
                        <!-- Company Growth Image End -->
                    </div>

                    <div class="col-lg-7">
                        <!-- Company Growth Content Start -->
                        <div class="company-growth-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">About Us</h3>
                                <h2 class="wow fadeInUp" data-wow-delay="0.25s"><?= $about['title'] ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.5s"><?= $about['dec'] ?></p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Company Growth Button Start -->
                            <div class="company-growth-btn wow fadeInUp" data-wow-delay="0.75s">
                                <a href="about" class="btn-default">Read More</a>
                            </div>
                            <!-- Company Growth Button End -->
                        </div>
                        <!-- Company Growth Content End -->
                    </div>

                    <div class="col-lg-12">
                        <!-- Company Growth Box Start -->
                        <div class="company-growth-box">
                            <!-- Company Growth Item Start -->
                            <div class="company-growth-item">
                                <h2><span class="counter"><?= $s1[0] ?></span>+</h2>
                                <h3 class="text-dark"><?= $s1[1] ?></h3>
                            </div>
                            <!-- Company Growth Item End -->

                            <!-- Company Growth Item Start -->
                            <div class="company-growth-item">
                                <h2><span class="counter"><?= $s2[0] ?></span>+</h2>
                                <h3 class="text-dark"><?= $s2[1] ?></h3>
                            </div>
                            <!-- Company Growth Item End -->

                            <!-- Company Growth Item Start -->
                            <div class="company-growth-item">
                                <h2><span class="counter"><?= $s3[0] ?></span>+</h2>
                                <h3 class="text-dark"><?= $s3[1] ?></h3>
                            </div>
                            <!-- Company Growth Item End -->

                            <!-- Company Growth Item Start -->
                            <div class="company-growth-item">
                                <h2><span class="counter"><?= $s4[0] ?></span>+</h2>
                                <h3 class="text-dark"><?= $s4[1] ?></h3>
                            </div>
                            <!-- Company Growth Item End -->
                        </div>
                        <!-- Company Growth Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Company Growth Section End -->
        <?php
            } else { echo "<p>About Us Not Found</p>"; }
        ?>

        <!-- Our Testimonial Section Start -->
        <div class="our-testimonial bg-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-8">
                        <div class="our-testimonial-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">testimonials</h3>
                                <h2 class="wow fadeInUp" data-wow-delay="0.25s">Real success stories from <span>our clients</span></h2>
                            </div>
                            <!-- Section Title End -->
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <!-- Testimonial Slider Start -->
                        <div class="testimonial-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    <?php
                                        if (!empty($testmonials)) {
                                            foreach ($testmonials as $row) {
                                    ?>
                                    <!-- Testimonial Slide Start -->
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <div class="testimonial-slider-image">
                                                <figure class="image-anime">
                                                    <img style="object-fit: contain;" src="assets/<?= $row['img'] ?>" alt="Image Error" />
                                                </figure>
                                            </div>
                                            <div class="testimonial-slider-content">
                                                <div class="testimonial-content">
                                                    <p><?= $row['review'] ?></p>
                                                </div>
                                                <div class="author-content">
                                                    <h3><?= $row['name'] ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Testimonial Slide End -->
                                    <?php
                                            }
                                        } else { echo "<p>Reviews Not Found</p>"; }
                                    ?>
                                </div>
                                <div class="testimonial-btn">
                                    <div class="testimonial-button-prev"></div>
                                    <div class="testimonial-button-next"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Slider End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Testimonial Section End -->

        <!-- Our Team Start -->
        <div class="our-team">
            <div class="container">
                <div class="row section-row align-items-center">
                    <div class="col-lg-7">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">our team</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.25s">Experienced coaches <span>dedicated to you</span></h2>
                        </div>
                        <!-- Section Title End -->
                    </div>
                </div>

                <div class="row">
                    <?php
                        if (!empty($team)) {
                            foreach ($team as $row) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- Company Logo Start -->
                        <div class="company-logo wow fadeInUp" data-wow-delay="0.2s">
                            <div class="team-image">
                                <figure class="image-anime">
                                    <img src="assets/<?= $row['img'] ?>" alt="Image Error" style="height: auto;"/>
                                </figure>
                            </div>
                            <!-- Team Content Start -->
                            <div class="team-content">
                                <h3 style="color: #000;"><?= $row['name'] ?></h3>
                                <p><?= $row['role'] ?></p>
                            </div>
                            <!-- Team Content End -->
                        </div>
                        <!-- Company Logo End -->
                    </div>
                    <?php
                            }
                        } else { echo "<p>Team Not Found</p>"; }
                    ?>
                </div>
            </div>
        </div>
        <!-- Our Team End -->

        <?php include "template/footer.php" ?>

    </body>
</html>