<?php
    include "admin/libs/load.php";

    $bhero = Operations::getBHero();
    $blog = Operations::fetchBlog();

?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
        
        <!-- Page Title -->
        <title>Blog - <?= $blog['title'] ?></title>
        
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
                                        <li class="breadcrumb-item active" aria-current="page">blog single</li>
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

        <!-- Page Single Post Start -->
        <div class="page-single-post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Post Featured Image Start -->
                        <div class="post-image">
                            <figure class="image-anime reveal">
                                <img src="assets/<?= $blog['img'] ?>" alt="Image Error" />
                            </figure>
                        </div>
                        <!-- Post Featured Image Start -->

                        <!-- Post Single Content Start -->
                        <div class="post-content">
                            <!-- Post Entry Start -->
                            <div class="post-entry">
                                <blockquote class="wow fadeInUp" data-wow-delay="0.4s">
                                    <!-- Post Social Links Start -->
                                    <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                        <ul>
                                            <li>
                                                <a type="button" title="Share"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#shareModal"
                                                        data-post-url="<?= $_SERVER['REQUEST_URI'] ?>"
                                                        data-post-title="<?= $blog['title'] ?>">
                                                    <i class="fa-solid fa-share text-white"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="shareModalLabel">Share this post</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="mb-3">
                                                            <a href="#" id="whatsappShare" target="_blank" class="me-3"><i class="fab fa-whatsapp fa-2x"></i></a>
                                                            <a href="#" id="linkedinShare" target="_blank" class="me-3"><i class="fab fa-linkedin fa-2x"></i></a>
                                                            <a href="#" id="twitterShare" target="_blank" class="me-3"><i class="fa-brands fa-x-twitter fa-2x"></i></a>
                                                            <a href="#" id="moreShare" target="_blank" class="me-3"><i class="fa fa-ellipsis fa-2x"></i></a>
                                                        </div>
                                                        <input type="text" id="copyLinkInput" readonly class="form-control mb-2" />
                                                        <button onclick="copyShareLink()" class="btn btn-primary btn-sm">Copy Link</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                const pageUrl = window.location.href;
                                                const blogTitle = "Why Choose Aadhee Naturals & Face Yoga ?";
                                        
                                                document.getElementById("copyLinkInput").value = pageUrl;
                                        
                                                document.getElementById("whatsappShare").href =
                                                    "https://api.whatsapp.com/send?text=" + encodeURIComponent(blogTitle + " - " + pageUrl);
                                        
                                                document.getElementById("linkedinShare").href =
                                                    "https://www.linkedin.com/sharing/share-offsite/?url=" + encodeURIComponent(pageUrl);
                                        
                                                document.getElementById("twitterShare").href =
                                                    "https://twitter.com/intent/tweet?url=" + encodeURIComponent(pageUrl) + "&text=" + encodeURIComponent(document.title);
                                                    
                                                const shareData = {
                                                        title: blogTitle,
                                                        text: blogTitle,
                                                        url: pageUrl
                                                };
                                                    
                                                document.getElementById('moreShare').addEventListener('click', async () => {
                                                    try {
                                                        await navigator.share(shareData);
                                                    } catch (err) {
                                                        console.log('Share failed:', err.message);
                                                    }
                                                });
                                            });
                                        
                                            function copyShareLink() {
                                                const copyText = document.getElementById("copyLinkInput");
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); // For mobile
                                        
                                                navigator.clipboard.writeText(copyText.value).then(() => {
                                                    const toast = new bootstrap.Toast(document.getElementById('copyToast'));
                                                    toast.show();
                                                });
                                            }
                                        </script>
                                        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
                                            <div id="copyToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1000">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        Link copied to clipboard!
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Post Social Links End -->
                                    <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                        <span class="tag-links">
                                            <p class="m-0">Posted: <?= $blog['date'] ?></p>
                                            <p class="m-0">/ Created By: <?= $blog['owner'] ?></p>
                                            <p class="m-0">/ Category: <?= $blog['category'] ?></p>
                                        </span>
                                    </div>
                                </blockquote>

                                <h2 class="wow fadeInUp" data-wow-delay="0.8s"><?= $blog['title'] ?></h2>

                                <p class="wow fadeInUp" data-wow-delay="0.2s">
                                    <?= $blog['dec'] ?>
                                </p>

                                <p class="wow fadeInUp" data-wow-delay="1.4s">
                                    <?= $blog['content'] ?>
                                </p>
                            </div>
                            <!-- Post Entry End -->

                            <!-- Post Tag Links Start -->
                            <div class="post-tag-links">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- Post Tag Links End -->
                        </div>
                        <!-- Post Single Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Single Post End -->

        <?php include "template/footer.php" ?>
    </body>
</html>