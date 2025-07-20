<?php

    include "admin/libs/load.php";

    $hero = Operations::getHomeHeros();
    $about = Operations::getHomeAboutUs();
    $status = Operations::getHomeAboutStatus();
    $section = Operations::getHomeSection();
    $changes = Operations::getChanges();
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
        <title>Iragu Foundation</title>

        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="IraguFoundation" />
        
        <?php include "template/head.php" ?>

    </head>
    <body>
        <?php include "template/header.php" ?>

        <!-- Hero Section Start -->
        <div class="hero bg-section hero-slider-layout">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                        if (!empty($hero)) {
                            foreach ($hero as $h) {
                    ?>
                    <!-- Hero Slide Start -->
                    <div class="swiper-slide">
                        <div class="hero-slide">
                            <!-- Slider Image Start -->
                            <div class="hero-slider-image">
                                <img src="assets/<?= $h['img']; ?>" alt="" />
                            </div>
                            <!-- Slider Image End -->

                            <!-- Hero Section Start -->
                            <div class="hero-section">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- Hero Content Start -->
                                            <div class="hero-content">
                                                <!-- Section Title Start -->
                                                <div class="section-title">
                                                    <h1 class="wow fadeInUp" data-wow-delay="0.2s"><?= $h['title']; ?></h1>
                                                </div>
                                                <!-- Section Title End -->
                                            </div>
                                            <!-- Hero Content End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hero Section End -->
                        </div>
                    </div>
                    <!-- Hero Slide End -->
                    <?php 
                            } 
                        } else { 
                            echo "<div class='col-12'><p class='text-center text-muted'>Home Page Hero Sliders Not Found</p></div>"; 
                        } 
                    ?>
                </div>
                <div class="hero-pagination"></div>
            </div>
        </div>
        <!-- Hero Section End -->

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

        <?php
            if (!empty($section)) {
                foreach ($section as $index => $row) {
                    if ($row['category'] == 'left') {
        ?>
        <!-- Our Expertise Section Start -->
        <div class="our-expertise <?= $index != '0' ? 'pt-0' : '' ?>">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Company Growth Image Start -->
                        <div class="company-growth-image">
                            <figure class="image-anime reveal">
                                <img src="assets/<?= $row['img'] ?>" alt="Imae Error">
                            </figure>
                        </div>
                        <!-- Company Growth Image End -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Our Expertise Content Start -->
                        <div class="our-expertise-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp"><?= $row['title'] ?></h3>
                                <h2 class="wow fadeInUp" data-wow-delay="0.25s"><?= $row['sub_title'] ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.5s"><?= $row['dec'] ?></p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Expertise Button Start -->
                            <div class="expertise-btn wow fadeInUp" data-wow-delay="0.75s">
                                <a href="tel:+917418281874" class="btn-default">contact now</a>
                            </div>
                            <!-- Expertise Button End -->
                        </div>
                        <!-- Our Expertise Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Expertise Section End -->
        <?php } elseif ($row['category'] == 'right') { ?>
        <!-- Our Expertise Section Start -->
        <div class="our-expertise <?= $index != '0' ? 'pt-0' : '' ?>">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Our Expertise Content Start -->
                        <div class="our-expertise-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp"><?= $row['title'] ?></h3>
                                <h2 class="wow fadeInUp" data-wow-delay="0.25s"><?= $row['sub_title'] ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.5s"><?= $row['dec'] ?></p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Expertise Button Start -->
                            <div class="expertise-btn wow fadeInUp" data-wow-delay="0.75s">
                                <a href="tel:+917418281874" class="btn-default">contact now</a>
                            </div>
                            <!-- Expertise Button End -->
                        </div>
                        <!-- Our Expertise Content End -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Company Growth Image Start -->
                        <div class="company-growth-image">
                            <figure class="image-anime reveal">
                                <img src="assets/<?= $row['img'] ?>" alt="Image Error">
                            </figure>
                        </div>
                        <!-- Company Growth Image End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Expertise Section End -->
        <?php
            } } }
        ?>

        <!-- Company Growth Section Start -->
        <div class="company-growth bg-section mb-4 py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <!-- Company Growth Content Start -->
                        <div class="company-growth-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">Transformation</h3>
                                <h2 class="wow fadeInUp" data-wow-delay="0.25s">Iragu <span>Foundation</span></h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Company Growth Image Start -->
                            <marquee class="company-growth-image">
                                <?php foreach ($changes as $cg) { ?>
                                <img src="assets/<?= $cg['img'] ?>" style="object-fit: contain; width: 700px;" alt="Image Error">
                                <?php } ?>
                            </marquee>
                            <!-- Company Growth Image End -->
                        </div>
                        <!-- Company Growth Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Company Growth Section End -->

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

        <!-- Our FAQs Section Start -->
        <div class="our-faqs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Our FAQs Content Start -->
                        <div class="our-faqs-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">IraguFoundation</h3>
                                <h2 class="wow fadeInUp" data-wow-delay="0.25s">Join Hands <span>With Us</span></h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- FAQs CTA Box Start -->
                            <div class="faqs-cta-box wow fadeInUp" data-wow-delay="0.75s">
                                <!-- Company Client Images Start -->
                                <div class="company-client-images">
                                    <div class="client-image">
                                        <figure class="image-anime">
                                            <img src="assets/images/satisfy-client-img-1.jpg" alt="" />
                                        </figure>
                                    </div>
                                    <div class="client-image">
                                        <figure class="image-anime">
                                            <img src="assets/images/satisfy-client-img-2.jpg" alt="" />
                                        </figure>
                                    </div>
                                    <div class="client-image">
                                        <figure class="image-anime">
                                            <img src="assets/images/satisfy-client-img-3.jpg" alt="" />
                                        </figure>
                                    </div>
                                    <div class="client-image">
                                        <figure class="image-anime">
                                            <img src="assets/images/satisfy-client-img-4.jpg" alt="" />
                                        </figure>
                                    </div>
                                    <div class="client-image">
                                        <figure class="image-anime">
                                            <img src="assets/images/satisfy-client-img-5.jpg" alt="" />
                                        </figure>
                                    </div>
                                </div>
                                <!-- Company Client Images End -->
                                <div class="faqs-cta-content">
                                    <h3>Still have you any question?</h3>
                                    <p>We're ready to help you to answer any questions.</p>
                                    <a href="tel:+919787676062" class="btn-phone"><i class="fa-solid fa-phone-volume"></i>+91 9787 676 062</a>
                                </div>
                            </div>
                            <!-- FAQs CTA Box End -->
                        </div>
                        <!-- Our FAQs Content End -->
                    </div>

                    <div class="col-lg-6">
                        <div class="our-faq-section">
                            <!-- FAQ Accordion Start -->
                            <div class="faq-accordion" id="faqaccordion">
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp">
                                    <h2 class="accordion-header" id="heading1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                            Uplift the society
                                        </button>
                                    </h2>
                                    <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqaccordion">
                                        <div class="accordion-body">
                                            <p>
                                                Join us in our activity to develop our society through education! Iragu is excited to announce a Free Education Camp aimed at providing good educational learning opportunities to privileged students. Handwriting is the key to education, and we believe that everyone deserves access to quality learning resources regardless of their socioeconomic. Attending our camp enriches the underprivileged through your hearty contribution to the uplift of our society.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                                    <h2 class="accordion-header" id="heading2">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            Through Social media
                                        </button>
                                    </h2>
                                    <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#faqaccordion">
                                        <div class="accordion-body">
                                            <p>
                                                Social media is an immortal platform to build a helping hand community for any social activity and widespread attention to develop helping communities. To raise awareness in society about student education and other activities. Through our social media subscribing , we raise funds to develop the student’s education by conducting free camps in rural villages and government schools, The subscribing funds are used for many social activities for the student’s education.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                                    <h2 class="accordion-header" id="heading3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            Gift to loved ones
                                        </button>
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqaccordion">
                                        <div class="accordion-body">
                                            <p>
                                                In the name of ARF Academy, Iragu Foundation conducts various socio-activities in villages, including rural camps for handwriting and communicative English. For many special occasions, the gift is the precious memories of your loved ones. Gifting through helping is most memorable to you and your beneficiary. In social media like Instagram and YouTube ARF serve many handwriting video especially your sweet names. Make a special occasion into precious memories.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                            </div>
                            <!-- FAQ Accordion End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our FAQs Section End -->

        <?php include "template/footer.php" ?>

        <!-- Floating Button Container -->
        <div class="floating-btn-container">
            <!-- Main Floating Button -->
            <button class="floating-btn" id="popupTrigger">
                <i class="material-icons">edit</i>
            </button>
            
            <!-- Login Popup -->
            <div class="login-popup" id="loginPopup">
                <div class="popup-header">
                    <h2 class="popup-title">Write Beautifully</h2>
                    <button class="close-btn" id="closePopup">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                
                <div class="popup-content">
                    <p class="popup-text">Unlock your handwriting potential with our expert-led online classes. Join thousands of students improving their writing daily!</p>
                    
                    <a href="Classes/"><button class="login-btn">
                        <i class="material-icons">login</i>
                        Start Learning Now
                    </button></a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const popupTrigger = document.getElementById('popupTrigger');
                const loginPopup = document.getElementById('loginPopup');
                const closePopup = document.getElementById('closePopup');
                
                // Toggle popup visibility
                popupTrigger.addEventListener('click', function() {
                    loginPopup.classList.toggle('active');
                });
                
                // Close popup
                closePopup.addEventListener('click', function() {
                    loginPopup.classList.remove('active');
                });
                
                // Auto-open after 3 seconds
                setTimeout(function() {
                    loginPopup.classList.add('active');
                }, 3000);
                
                // Close when clicking outside
                document.addEventListener('click', function(event) {
                    if (!loginPopup.contains(event.target) && event.target !== popupTrigger) {
                        loginPopup.classList.remove('active');
                    }
                });
            });
        </script>

    </body>
</html>