<?php
    include "admin/libs/load.php";

    $bhero = Operations::getBHero();
    $services = Operations::getServices();
?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
        
        <!-- Page Title -->
        <title>Services</title>

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
                                <h1 class="wow fadeInUp">Image <span>Services</span></h1>
                                <nav class="wow fadeInUp" data-wow-delay="0.25s">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index">home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">services</li>
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

        <!-- Photo services Section Start -->
        <div class="page-gallery">
            <div class="container">
                <!-- services section start -->
                <div class="row gallery-items page-gallery-box">
                    <?php
                        if (!empty($services)) {
                            foreach ($services as $img) {
                                
                    ?>
                    <div class="col-lg-4 col-6">
                        <!-- image services start -->
                        <div class="photo-gallery wow fadeInUp" data-cursor-text="View">
                            <a href="assets/<?= $img['img']; ?>">
                                <figure class="image-anime">
                                    <img src="assets/<?= $img['img']; ?>" alt="Image Error" />
                                </figure>
                            </a>
                        </div>
                        <!-- image services end -->
                    </div>
                    <?php
                            }
                        } else {
                            echo "<p>Services Image Not Found</p>";
                        }
                    ?>
                </div>
                <!-- services section end -->
            </div>
        </div>
        <!-- Photo services Section End -->

        <?php include "template/footer.php" ?>

    </body>
</html>