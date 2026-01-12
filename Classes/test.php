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

    // Sample lessons data
    $lessons = [
        ['id' => 'lesson1', 'title' => 'Demo Title One', 'desc' => 'This is a sample description for lesson one.', 'active' => true],
        ['id' => 'lesson2', 'title' => 'Demo Title Two', 'desc' => 'This is a sample description for lesson two.', 'active' => false],
        ['id' => 'lesson3', 'title' => 'Demo Title Three', 'desc' => 'This is a sample description for lesson three.', 'active' => false],
        ['id' => 'lesson4', 'title' => 'Demo Title Four', 'desc' => 'This is a sample description for lesson four.', 'active' => false],
        ['id' => 'lesson5', 'title' => 'Demo Title Five', 'desc' => 'This is a sample description for lesson five.', 'active' => false],
        ['id' => 'lesson6', 'title' => 'Demo Title Six', 'desc' => 'This is a sample description for lesson six.', 'active' => false],
        ['id' => 'lesson7', 'title' => 'Demo Title Seven', 'desc' => 'This is a sample description for lesson seven.', 'active' => false],
        ['id' => 'lesson8', 'title' => 'Demo Title Eight', 'desc' => 'This is a sample description for lesson eight.', 'active' => false],
        ['id' => 'lesson9', 'title' => 'Demo Title Six', 'desc' => 'This is a sample description for lesson six.', 'active' => false],
        ['id' => 'lesson10', 'title' => 'Demo Title Seven', 'desc' => 'This is a sample description for lesson seven.', 'active' => false],
        ['id' => 'lesson11', 'title' => 'Demo Title Eight', 'desc' => 'This is a sample description for lesson eight.', 'active' => false],
        ['id' => 'lesson12', 'title' => 'Demo Title Six', 'desc' => 'This is a sample description for lesson six.', 'active' => false],
        ['id' => 'lesson13', 'title' => 'Demo Title Seven', 'desc' => 'This is a sample description for lesson seven.', 'active' => false],
        ['id' => 'lesson14', 'title' => 'Demo Title Eight', 'desc' => 'This is a sample description for lesson eight.', 'active' => false],
    ];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <?php include "temp/head-main.php" ?>
        
        <style>
            /* Custom styles for course details */
            .lesson-sidebar {
                max-height: calc(100vh - 200px);
                overflow-y: auto;
            }
            
            .lesson-sidebar::-webkit-scrollbar {
                width: 4px;
            }
            
            .lesson-sidebar::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            
            .lesson-sidebar::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 10px;
            }
            
            .lesson-item {
                padding: 12px 16px;
                border-left: 3px solid transparent;
                cursor: pointer;
                transition: all 0.2s ease;
                border-bottom: 1px solid #f3f4f6;
            }
            
            .lesson-item:last-child {
                border-bottom: none;
            }
            
            .lesson-item:hover {
                background-color: #fcf8f8;
                border-left-color: #f16363;
            }
            
            .lesson-item.active {
                background-color: #ffeeee;
                border-left-color: #f16363;
            }
            
            .lesson-item.active .lesson-title {
                color: #f16363;
                font-weight: 600;
            }
            
            .lesson-title {
                font-size: 14px;
                font-weight: 500;
                color: #374151;
                margin-bottom: 4px;
            }
            
            .lesson-desc {
                font-size: 12px;
                color: #6b7280;
                line-height: 1.4;
            }
            
            .lesson-number {
                width: 28px;
                height: 28px;
                background: #ffeeee;
                color: #f16363;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 600;
                flex-shrink: 0;
            }
            
            .lesson-item.active .lesson-number {
                background: #f16363;
                color: white;
            }
            
            .video-container {
                position: relative;
                padding-bottom: 56.25%; /* 16:9 aspect ratio */
                height: 0;
                overflow: hidden;
                background: #000;
                border-radius: 12px;
            }
            
            .video-container iframe,
            .video-container video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: 0;
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
                        <li><a href="index.php" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                        <li>
                            <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                        </li>
                        <li><span class="text-main-600 fw-normal text-15">Classes Details</span></li>
                    </ul>
                </div>
                <!-- Breadcrumb End -->
            
                <div class="row gy-4">
                    <div class="col-md-8">
                        <div class="tab-content" id="lessonTabContent">
                            <?php foreach ($lessons as $index => $lesson): ?>
                            <div class="tab-pane fade <?= $lesson['active'] ? 'show active' : '' ?>" 
                                 id="pills-<?= $lesson['id'] ?>" 
                                 role="tabpanel" 
                                 aria-labelledby="lesson-tab-<?= $lesson['id'] ?>">
                                
                                <!-- Video Player -->
                                <div class="rounded-16 overflow-hidden position-relative">
                                    <video id="videoPlayer-<?= $lesson['id'] ?>" class="player" playsinline controls data-poster="assets/images/thumbs/live-class.png">
                                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" />
                                        <source src="https://html.themeholy.com/path/to/video.webm" type="video/webm" />
                                    </video>
                                </div>
                                
                                <!-- Lesson Details -->
                                <div class="card mt-24">
                                    <div class="card-body">
                                        <h4><?= $lesson['title'] ?></h4>
                                        <p><?= $lesson['desc'] ?></p>
                                    </div>
                                </div>
                                
                                <!-- Assessment File (Only for first 4 lessons) -->
                                <?php if ($index < 4): ?>
                                <div class="card mt-24">
                                    <div class="card-body">
                                        <h4 class="mb-20">Assessment File</h4>
                                        <a href="course-details" class="btn btn-main rounded-pill py-11 w-100">Download Now</a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Lessons Sidebar -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="p-20 border-bottom">
                                    <h5 class="mb-0 fw-bold">Course Lessons</h5>
                                    <p class="text-gray-500 text-13 mb-0 mt-1">Total <?= count($lessons) ?> lessons</p>
                                </div>
                                
                                <div class="nav flex-column nav-pills lesson-sidebar p-20" id="lessonTab" role="tablist" aria-orientation="vertical">
                                    <?php foreach ($lessons as $index => $lesson): 
                                        $lessonNumber = $index + 1;
                                    ?>
                                    <div class="lesson-item d-flex align-items-start gap-12 nav-link <?= $lesson['active'] ? 'active' : '' ?>" 
                                         id="lesson-tab-<?= $lesson['id'] ?>"
                                         data-bs-toggle="pill"
                                         data-bs-target="#pills-<?= $lesson['id'] ?>"
                                         role="tab"
                                         aria-controls="pills-<?= $lesson['id'] ?>"
                                         aria-selected="<?= $lesson['active'] ? 'true' : 'false' ?>">
                                        
                                        <div class="lesson-number"><?= $lessonNumber ?></div>
                                        <div class="flex-grow-1">
                                            <div class="lesson-title"><?= $lesson['title'] ?></div>
                                            <div class="lesson-desc"><?= $lesson['desc'] ?></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="ph ph-play-circle" style="font-size: 18px; color: #6b7280;"></i>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Bootstrap tabs
                const lessonTabs = document.querySelectorAll('#lessonTab .nav-link');
                
                // Add click event to properly handle active states
                lessonTabs.forEach(tab => {
                    tab.addEventListener('click', function(e) {
                        // Remove active class from all tabs
                        lessonTabs.forEach(t => {
                            t.classList.remove('active');
                            t.querySelector('.lesson-number').style.backgroundColor = '#ffeeee';
                            t.querySelector('.lesson-number').style.color = '#f16363';
                            t.querySelector('.lesson-title').style.color = '#374151';
                            t.querySelector('.lesson-title').style.fontWeight = '500';
                            t.querySelector('i').style.color = '#6b7280';
                            t.setAttribute('aria-selected', 'false');
                        });
                        
                        // Add active class to clicked tab
                        this.classList.add('active');
                        this.querySelector('.lesson-number').style.backgroundColor = '#f16363';
                        this.querySelector('.lesson-number').style.color = 'white';
                        this.querySelector('.lesson-title').style.color = '#f16363';
                        this.querySelector('.lesson-title').style.fontWeight = '600';
                        this.querySelector('i').style.color = '#f16363';
                        this.setAttribute('aria-selected', 'true');
                        
                        // Scroll to active lesson in sidebar
                        setTimeout(() => {
                            this.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'nearest',
                                inline: 'nearest' 
                            });
                        }, 100);
                    });
                    
                    // Handle tab shown event to manage video playback
                    tab.addEventListener('shown.bs.tab', function(e) {
                        const targetId = this.getAttribute('data-bs-target');
                        const videoElement = document.querySelector(`${targetId} video.player`);
                        
                        if (videoElement) {
                            // Pause all other videos
                            document.querySelectorAll('video.player').forEach(video => {
                                if (video !== videoElement) {
                                    video.pause();
                                }
                            });
                            
                            // Try to play the current video
                            const playPromise = videoElement.play();
                            if (playPromise !== undefined) {
                                playPromise.catch(error => {
                                    console.log('Autoplay prevented:', error);
                                });
                            }
                        }
                    });
                });
                
                // Initialize video players using Plyr if available
                if (typeof Plyr !== 'undefined') {
                    document.querySelectorAll('.player').forEach(player => {
                        new Plyr(player);
                    });
                }
                
                // Keyboard navigation for lessons
                document.addEventListener('keydown', function(e) {
                    const activeTab = document.querySelector('#lessonTab .nav-link.active');
                    if (!activeTab) return;
                    
                    const allTabs = Array.from(document.querySelectorAll('#lessonTab .nav-link'));
                    const currentIndex = allTabs.indexOf(activeTab);
                    
                    if (e.key === 'ArrowDown' && currentIndex < allTabs.length - 1) {
                        e.preventDefault();
                        const nextTab = allTabs[currentIndex + 1];
                        const bsTab = new bootstrap.Tab(nextTab);
                        bsTab.show();
                        nextTab.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } else if (e.key === 'ArrowUp' && currentIndex > 0) {
                        e.preventDefault();
                        const prevTab = allTabs[currentIndex - 1];
                        const bsTab = new bootstrap.Tab(prevTab);
                        bsTab.show();
                        prevTab.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                });
                
                // Initialize first video player on load
                const firstVideo = document.querySelector('.tab-pane.show.active video.player');
                if (firstVideo && typeof Plyr !== 'undefined') {
                    new Plyr(firstVideo);
                }
                
                // Handle Bootstrap tab change events
                document.addEventListener('shown.bs.tab', function(event) {
                    const targetId = event.target.getAttribute('data-bs-target');
                    const targetPane = document.querySelector(targetId);
                    
                    if (targetPane) {
                        // Initialize Plyr for the newly shown video
                        const videoElement = targetPane.querySelector('video.player');
                        if (videoElement && !videoElement.plyr && typeof Plyr !== 'undefined') {
                            new Plyr(videoElement);
                        }
                    }
                });
            });
        </script>
    </body>
</html>