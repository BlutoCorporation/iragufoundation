<?php
    include "admin/libs/load.php";

    $bhero = Operations::getBHero();
    $about = Operations::getHomeAboutUs();
    $status = Operations::getHomeAboutStatus();
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

            /* Honeycomb Grid Styles */
            #hexGrid {
                display: flex;
                flex-wrap: wrap;
                width: 90%;
                margin: 0 auto;
                overflow: hidden;
                font-family: sans-serif;
                list-style-type: none;
                padding: 0;
            }

            .hex {
                position: relative;
                visibility: hidden;
                outline: 1px solid transparent; /* fix for jagged edges in FF on hover transition */
                transition: all 0.5s;
                backface-visibility: hidden;
                will-change: transform;
            }
            
            .hex::after {
                content: '';
                display: block;
                padding-bottom: 86.602%;  /* =  100 / tan(60) * 1.5 */
            }
            
            .hexIn {
                position: absolute;
                width: 96%;
                padding-bottom: 110.851%; /* =  width / sin(60) */
                margin: 2%;
                overflow: hidden;
                visibility: hidden;
                outline: 1px solid transparent; /* fix for jagged edges in FF on hover transition */
                transform: rotate3d(0,0,1,-60deg) skewY(30deg);
                transition: all 0.5s;
            }
            
            .hexIn * {
                position: absolute;
                visibility: visible;
                outline: 1px solid transparent; /* fix for jagged edges in FF on hover transition */
            }
            
            .hexLink {
                display: block;
                width: 100%;
                height: 100%;
                text-align: center;
                color: #fff;
                overflow: hidden;
                transform: skewY(-30deg) rotate3d(0,0,1,60deg);
            }

            /*** HEX CONTENT ***/
            .hex img {
                left: -100%;
                right: -100%;
                width: auto;
                height: 100%;
                margin: 0 auto;
            }

            .hex h1, .hex p {
                width: 100%;
                padding: 5%;
                box-sizing: border-box;
                font-weight: 300;
                opacity: 0;
                margin: 0;
                transition: opacity 0.8s;
                z-index: 2;
            }

            .hex h1 {
                /* color: #F5CE95; */
                color: #FFFFFF;
                text-transform: capitalize;
                text-align: center;
                bottom: 40%;
                padding-top: 50%;
                font-size: 1.5em;
                z-index: 1;
            }
            
            .hex h1:before, .hex h1:after {
                display: inline-block;
                margin: 0 0.5em;
                width: 0.25em;
                height: 0.03em;
                background: #ffffff;
                content: '';
                vertical-align: middle;
                transition: all 0.3s;
                text-align: center;
            }

            .hex p {
                top: 50%;
                text-align: center;
                text-transform: uppercase;
                font-size: 0.9em;
                color: #fff;
            }

            .img {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-position: center center;
                background-size: cover;
                overflow: hidden;
                clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                transition: transform 0.5s ease;
            }

            .img:before, .img:after {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                content: '';
                opacity: 0;
                transition: opacity 0.5s;
            }
            
            .img:before {
                background: rgba(22, 103, 137, 0.3);
            }
            
            .img:after {
                background: linear-gradient(to top, transparent, rgba(0, 0, 0, 0.7), transparent);
            }

            /*** HOVER EFFECT  **********************************************************************/
            .hexLink:hover h1,
            .hexLink:hover p {
                opacity: 1;
            }

            .hexIn:hover .img:before,
            .hexIn:hover .img:after {
                opacity: 1;
            }
            
            .hexIn:hover .img {
                transform: scale(1.1);
            }

            /*** HEXAGON SIZING AND EVEN ROW INDENTATION *****************************************************************/
            @media (min-width: 1201px) { /* <- 5-4  hexagons per row */
                #hexGrid {
                    padding-bottom: 4.4%;
                }
                .hex {
                    width: 20%; /* = 100 / 5 */
                }
                .hex:nth-child(9n+6) { /* first hexagon of even rows */
                    margin-left: 10%;  /* = width of .hex / 2  to indent even rows */
                }
            }

            @media (max-width: 1200px) and (min-width: 901px) { /* <- 4-3  hexagons per row */
                #hexGrid {
                    padding-bottom: 5.5%;
                    font-size: 13px;
                }
                .hex {
                    width: 25%; /* = 100 / 4 */
                }
                .hex:nth-child(7n+5) { /* first hexagon of even rows */
                    margin-left: 12.5%;  /* = width of .hex / 2  to indent even rows */
                }
            }

            @media (max-width: 900px) and (min-width: 601px) { /* <- 3-2  hexagons per row */
                #hexGrid {
                    padding-bottom: 7.4%;
                    font-size: 14px;
                }
                .hex {
                    width: 33.333%; /* = 100 / 3 */
                }
                .hex:nth-child(5n+4) { /* first hexagon of even rows */
                    margin-left: 16.666%;  /* = width of .hex / 2  to indent even rows */
                }
            }

            @media (max-width: 600px) { /* <- 2-1  hexagons per row */
                #hexGrid {
                    padding-bottom: 11.2%;
                    font-size: 12px;
                }
                .hex {
                    width: 50%; /* = 100 / 2 */
                }
                .hex:nth-child(3n+3) { /* first hexagon of even rows */
                    margin-left: 25%;  /* = width of .hex / 2  to indent even rows */
                }
            }

            @media (max-width: 400px) {
                #hexGrid {
                    font-size: 10px;
                }
                .hex h1 {
                    font-size: 1.2em;
                }
                .hex p {
                    font-size: 0.8em;
                }
            }

            /* Loading state */
            .loading {
                text-align: center;
                padding: 50px;
                color: #666;
            }

            /* Team section spacing */
            .our-team {
                padding: 80px 0;
            }

            .section-title h2 {
                margin-bottom: 50px;
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
                                                    <small><?= $row['type'] === 'school' ? 'School' : 'Training Center'; ?></small>
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
                <div class="row section-row align-items-center m-0">
                    <div class="col-lg-7">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">our team</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.25s">Experienced coaches <span>dedicated to you</span></h2>
                        </div>
                        <!-- Section Title End -->
                    </div>
                </div>

                <!-- Honeycomb Grid -->
                <div class="grid">
                    <ul id="hexGrid">
                        <?php 
                        if (!empty($team)) {
                            $teamCount = count($team);
                            foreach ($team as $index => $row) { 
                        ?>
                        <li class="hex">
                            <div class="hexIn">
                                <a class="hexLink" href="javascript:void(0);">
                                    <div class='img' style='background-image: url("assets/<?= htmlspecialchars($row['img']) ?>");'></div>
                                    <h1><?= htmlspecialchars($row['name']) ?></h1>
                                    <p><?= htmlspecialchars($row['role']) ?></p>
                                </a>
                            </div>
                        </li>
                        <?php 
                            }
                        } else {
                            echo '<div class="col-12"><p class="text-center py-5">No team members found</p></div>';
                        } 
                        ?>
                    </ul>
                </div>
                
            </div>
        </div>
        <!-- Our Team End -->

        <?php include "template/footer.php" ?>

        <script>
            // JavaScript to initialize honeycomb grid
            document.addEventListener('DOMContentLoaded', function() {
                // Make hexagons visible after page loads
                setTimeout(function() {
                    const hexes = document.querySelectorAll('.hex, .hexIn');
                    hexes.forEach(hex => {
                        hex.style.visibility = 'visible';
                    });
                }, 100);

                // Add hover effect
                const hexLinks = document.querySelectorAll('.hexLink');
                hexLinks.forEach(link => {
                    link.addEventListener('mouseenter', function() {
                        const hexIn = this.closest('.hexIn');
                        if (hexIn) {
                            hexIn.style.transform = 'rotate3d(0,0,1,-60deg) skewY(30deg) scale(1.05)';
                            hexIn.style.zIndex = '10';
                        }
                    });
                    
                    link.addEventListener('mouseleave', function() {
                        const hexIn = this.closest('.hexIn');
                        if (hexIn) {
                            hexIn.style.transform = 'rotate3d(0,0,1,-60deg) skewY(30deg)';
                            hexIn.style.zIndex = '1';
                        }
                    });
                });

                // Add click effect for mobile
                hexLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            const hexIn = this.closest('.hexIn');
                            const isActive = hexIn.classList.contains('active');
                            
                            // Remove active class from all
                            document.querySelectorAll('.hexIn.active').forEach(item => {
                                item.classList.remove('active');
                            });
                            
                            // Toggle current
                            if (!isActive) {
                                hexIn.classList.add('active');
                            }
                        }
                    });
                });

                // Close active hexagon when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.hex')) {
                        document.querySelectorAll('.hexIn.active').forEach(item => {
                            item.classList.remove('active');
                        });
                    }
                });
            });

            // Fix for staggered rows with JavaScript
            window.addEventListener('resize', function() {
                const hexGrid = document.getElementById('hexGrid');
                const hexes = document.querySelectorAll('.hex');
                
                // Reset all margins first
                hexes.forEach(hex => {
                    hex.style.marginLeft = '';
                });
                
                // Reapply staggered margins based on screen size
                const width = window.innerWidth;
                
                if (width >= 1201) {
                    // 5 items per row pattern
                    hexes.forEach((hex, index) => {
                        if ((index + 1) % 9 >= 6 && (index + 1) % 9 <= 10) {
                            hex.style.marginLeft = '10%';
                        }
                    });
                } else if (width >= 901) {
                    // 4 items per row pattern
                    hexes.forEach((hex, index) => {
                        if ((index + 1) % 7 >= 5 && (index + 1) % 7 <= 7) {
                            hex.style.marginLeft = '12.5%';
                        }
                    });
                } else if (width >= 601) {
                    // 3 items per row pattern
                    hexes.forEach((hex, index) => {
                        if ((index + 1) % 5 >= 4 && (index + 1) % 5 <= 5) {
                            hex.style.marginLeft = '16.666%';
                        }
                    });
                } else {
                    // 2 items per row pattern
                    hexes.forEach((hex, index) => {
                        if ((index + 1) % 3 === 0) {
                            hex.style.marginLeft = '25%';
                        }
                    });
                }
            });

            // Trigger resize on load
            window.dispatchEvent(new Event('resize'));
        </script>
    </body>
</html>