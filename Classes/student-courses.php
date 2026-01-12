<?php
    include "libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('Loggedin') || Session::get('type') !== 'student') {
        header("Location: logout");
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
        
        <style>
            .video-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 24px;
                padding: 16px 0;
            }
            
            .video-card {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border: 1px solid #e5e7eb;
                height: 100%;
                display: flex;
                flex-direction: column;
            }
            
            .video-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
            
            .video-thumbnail {
                position: relative;
                width: 100%;
                padding-top: 56.25%;
                overflow: hidden;
                background-color: #000;
            }
            
            .video-thumbnail img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }
            
            .video-card:hover .video-thumbnail img {
                transform: scale(1.05);
            }
            
            .video-info {
                padding: 16px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }
            
            .video-title {
                font-size: 16px;
                font-weight: 600;
                color: #111827;
                margin-bottom: 8px;
                line-height: 1.4;
            }
            
            .video-description {
                font-size: 14px;
                color: #6b7280;
                line-height: 1.5;
            }
            
            .play-button {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 60px;
                height: 60px;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 2;
            }
            
            .play-button i {
                color: #ef4444;
                font-size: 24px;
                margin-left: 4px;
            }
            
            .category-badge {
                position: absolute;
                top: 12px;
                left: 12px;
                background: hsl(var(--main));
                color: white;
                padding: 4px 10px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
                z-index: 2;
            }
            
            @media (max-width: 768px) {
                .video-grid {
                    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                    gap: 16px;
                }
            }
        </style>
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

                <!-- YouTube-style Video Grid -->
                <div class="video-grid">
                    
                    <!-- Video Card 1 -->
                    <div class="video-card">
                        <a href="course-details">
                            <div class="video-thumbnail">
                                <div class="category-badge">Class 1</div>
                                <img src="assets/images/thumbs/course-details.png" alt="Class Video">
                                <div class="play-button">
                                    <i class="ph ph-play m-0"></i>
                                </div>
                            </div>
                        </a>
                        <div class="video-info">
                            <a href="course-details" class="video-title">This is first class video</a>
                            <p class="video-description">Whats it all class video don't skip the video.</p>
                        </div>
                    </div>
                    
                    <!-- Video Card 2 -->
                    <div class="video-card">
                        <a href="course-details">
                            <div class="video-thumbnail">
                                <div class="category-badge">Class 2</div>
                                <img src="assets/images/thumbs/course-details.png" alt="Class Video">
                                <div class="play-button">
                                    <i class="ph ph-play m-0"></i>
                                </div>
                            </div>
                        </a>
                        <div class="video-info">
                            <a href="course-details" class="video-title">This is second class video</a>
                            <p class="video-description">Whats it all class video don't skip the video.</p>
                        </div>
                    </div>
                    
                    <!-- Video Card 3 -->
                    <div class="video-card">
                        <a href="course-details">
                            <div class="video-thumbnail">
                                <div class="category-badge">Class 3</div>
                                <img src="assets/images/thumbs/course-details.png" alt="Class Video">
                                <div class="play-button">
                                    <i class="ph ph-play m-0"></i>
                                </div>
                            </div>
                        </a>
                        <div class="video-info">
                            <a href="course-details" class="video-title">Class Three Demo Title</a>
                            <p class="video-description">This is a sample description for class three.</p>
                        </div>
                    </div>
                    
                    <!-- Video Card 4 -->
                    <div class="video-card">
                        <a href="course-details">
                            <div class="video-thumbnail">
                                <div class="category-badge">Class 4</div>
                                <img src="assets/images/thumbs/course-details.png" alt="Class Video">
                                <div class="play-button">
                                    <i class="ph ph-play m-0"></i>
                                </div>
                            </div>
                        </a>
                        <div class="video-info">
                            <a href="course-details" class="video-title">Class Four Demo Title</a>
                            <p class="video-description">This is a sample description for class four.</p>
                        </div>
                    </div>
                    
                    <!-- Video Card 5 -->
                    <div class="video-card">
                        <a href="course-details">
                            <div class="video-thumbnail">
                                <div class="category-badge">Class 5</div>
                                <img src="assets/images/thumbs/course-details.png" alt="Class Video">
                                <div class="play-button">
                                    <i class="ph ph-play m-0"></i>
                                </div>
                            </div>
                        </a>
                        <div class="video-info">
                            <a href="course-details" class="video-title">Class Five Demo Title</a>
                            <p class="video-description">This is a sample description for class five.</p>
                        </div>
                    </div>
                    
                    <!-- Video Card 6 -->
                    <div class="video-card">
                        <a href="course-details">
                            <div class="video-thumbnail">
                                <div class="category-badge">Class 6</div>
                                <img src="assets/images/thumbs/course-details.png" alt="Class Video">
                                <div class="play-button">
                                    <i class="ph ph-play m-0"></i>
                                </div>
                            </div>
                        </a>
                        <div class="video-info">
                            <a href="course-details" class="video-title">Class Six Demo Title</a>
                            <p class="video-description">This is a sample description for class six.</p>
                        </div>
                    </div>

                </div>
                <!-- End YouTube-style Video Grid -->
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