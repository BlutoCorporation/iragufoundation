<?php
    include "admin/libs/load.php";

    $bhero = Operations::getBHero();
    $blogs = Operations::getBlogs();

?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
        
        <title>Blogs</title>
        
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
        <div class="page-header bg-section parallaxie">
            <!-- Page Header Box Start -->
            <div class="page-header-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Page Header Content Start -->
                            <div class="page-header-content">
                                <h1 class="wow fadeInUp">Latest <span>blog</span></h1>
                                <nav class="wow fadeInUp" data-wow-delay="0.25s">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index">home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">blog</li>
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

        <!-- Page Blog Start -->
        <div class="page-blog">
            <div class="container">
                <div class="row">
                    <?php
                        if (!empty($blogs)) {
                            foreach ($blogs as $row) {
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <!-- Post Item Start -->
                        <div class="post-item wow fadeInUp">
                            <!-- Post Featured Image Start -->
                            <div class="post-featured-image">
                                <figure>
                                    <a href="blog-single/<?= $row['id'] ?>" class="image-anime" data-cursor-text="View">
                                        <img src="assets/<?= $row['img'] ?>" alt="Image Error" />
                                    </a>
                                </figure>

                                <div class="post-btn">
                                    <a href="blog-single/<?= $row['id'] ?>">
                                        <img src="assets/images/arrow-white.svg" alt="Image Error" />
                                    </a>
                                </div>
                            </div>
                            <!-- Post Featured Image End -->

                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="blog-single/<?= $row['id'] ?>"><?= $row['title'] ?></a></h2>
                                <p><?= $row['dec'] ?></p>
                            </div>
                            <!-- Post Item Content End -->
                        </div>
                        <!-- Post Item End -->
                    </div>
                    <?php
                            }
                        } else { echo "<p>Blog's Not Found</p>"; }
                    ?>
                </div>
            </div>
        </div>
        <!-- Page Blog End -->

        <?php include "template/footer.php" ?>
    </body>
</html>