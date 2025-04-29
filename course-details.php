<?php
    include "libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('Loggedin')) {
        header("Location: index");
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
                        <div class="tab-content" id="pills-tabContent">
                            <?php
                            // Sample data - in real app you would fetch this from database
                            $lessons = [
                                ['id' => 'onGoing', 'title' => 'Intro', 'active' => true],
                                ['id' => 'completed', 'title' => 'A', 'active' => false],
                                ['id' => 'lesson3', 'title' => 'B', 'active' => false],
                                ['id' => 'lesson4', 'title' => 'C', 'active' => false],
                                ['id' => 'lesson5', 'title' => 'D', 'active' => false],
                                ['id' => 'lesson6', 'title' => 'E', 'active' => false],
                            ];
                            
                            // Display first 4 lessons
                            for ($i = 0; $i < min(4, count($lessons)); $i++) {
                                $lesson = $lessons[$i];
                            ?>
                            <div class="tab-pane fade <?= $lesson['active'] ? 'show active' : '' ?>" id="pills-<?= $lesson['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $lesson['id'] ?>-tab" tabindex="0">
                                <div class="rounded-16 overflow-hidden position-relative">
                                    <video class="player" playsinline controls data-poster="assets/images/thumbs/live-class.png">
                                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" />
                                        <source src="https://html.themeholy.com/path/to/video.webm" type="video/webm" />
                                    </video>
                                </div>
                                <!-- Course Card Start -->
                                <div class="card mt-24">
                                    <div class="card-body">
                                        <h4><?= $lesson['title'] ?></h4>
                                    </div>
                                </div>
                                <!-- Course Card End -->
                            </div>
                            <?php } ?>
                            
                            <!-- Hidden lessons that will be shown when "View More" is clicked -->
                            <div id="hiddenLessons" style="display: none;">
                                <?php for ($i = 4; $i < count($lessons); $i++) {
                                    $lesson = $lessons[$i];
                                ?>
                                <div class="tab-pane fade" id="pills-<?= $lesson['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $lesson['id'] ?>-tab" tabindex="0">
                                    <div class="rounded-16 overflow-hidden position-relative">
                                        <video class="player" playsinline controls data-poster="assets/images/thumbs/live-class.png">
                                            <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" />
                                            <source src="https://html.themeholy.com/path/to/video.webm" type="video/webm" />
                                        </video>
                                    </div>
                                    <!-- Course Card Start -->
                                    <div class="card mt-24">
                                        <div class="card-body">
                                            <h4><?= $lesson['title'] ?></h4>
                                        </div>
                                    </div>
                                    <!-- Course Card End -->
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="flex-between flex-wrap mb-12">
                                    <h5 class="mb-0 fw-bold">Your Lesson</h5>
                                    <span class="text-13">0/<?= count($lessons) ?></span>
                                </div>
                                <ul class="lesson-list" id="pills-tab" role="tablist">
                                    <?php
                                    // Display first 4 lesson items
                                    for ($i = 0; $i < min(4, count($lessons)); $i++) {
                                        $lesson = $lessons[$i];
                                    ?>
                                    <li class="lesson-list__item d-flex align-items-start gap-16 <?= $lesson['active'] ? 'active' : '' ?>" role="presentation">
                                        <span class="circle w-16 h-16 flex-center rounded-circle text-main-100 text-13 flex-shrink-0">
                                            <i class="ph-fill ph-circle"></i>
                                        </span>
                                        <div>
                                            <a class="nav-link text-13 text-heading d-block text-gray-600 fw-medium hover-text-main-600 <?= $lesson['active'] ? 'active' : '' ?>" 
                                               id="pills-<?= $lesson['id'] ?>-tab" 
                                               data-bs-toggle="pill" 
                                               data-bs-target="#pills-<?= $lesson['id'] ?>" 
                                               type="button" 
                                               role="tab" 
                                               aria-controls="pills-<?= $lesson['id'] ?>" 
                                               aria-selected="<?= $lesson['active'] ? 'true' : 'false' ?>">
                                                <?= $lesson['title'] ?>
                                                <span class="text-13 text-heading d-block text-gray-600 fw-medium">Last access: 12Jan 24. 8:00PM</span>
                                            </a>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    
                                    <!-- Hidden lesson items -->
                                    <div id="hiddenLessonItems" style="display: none;">
                                        <?php for ($i = 4; $i < count($lessons); $i++) {
                                            $lesson = $lessons[$i];
                                        ?>
                                        <li class="lesson-list__item d-flex align-items-start gap-16" role="presentation">
                                            <span class="circle w-16 h-16 flex-center rounded-circle text-main-100 text-13 flex-shrink-0">
                                                <i class="ph-fill ph-circle"></i>
                                            </span>
                                            <div>
                                                <a class="nav-link text-13 text-heading d-block text-gray-600 fw-medium hover-text-main-600" 
                                                   id="pills-<?= $lesson['id'] ?>-tab" 
                                                   data-bs-toggle="pill" 
                                                   data-bs-target="#pills-<?= $lesson['id'] ?>" 
                                                   type="button" 
                                                   role="tab" 
                                                   aria-controls="pills-<?= $lesson['id'] ?>" 
                                                   aria-selected="false">
                                                    <?= $lesson['title'] ?>
                                                    <span class="text-13 text-heading d-block text-gray-600 fw-medium">Last access: 12Jan 24. 8:00PM</span>
                                                </a>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </div>
                                    
                                    <?php if (count($lessons) > 4) { ?>
                                    <li class="lesson-list__item d-flex align-items-start gap-16" role="presentation">
                                        <button id="viewMoreBtn" class="btn btn-link text-13 text-heading d-block text-main-600 fw-medium hover-text-main-800">
                                            View More (+<?= count($lessons) - 4 ?>)
                                        </button>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <div class="card mt-24">
                            <div class="card-body">
                                <h4 class="mb-20">Assessment File</h4>
                                <a href="course-details" class="btn btn-main rounded-pill py-11 w-100">Download Now</a>
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
            const navLinks = document.querySelectorAll('.lesson-list .nav-link');
            const viewMoreBtn = document.getElementById('viewMoreBtn');
            const hiddenLessons = document.getElementById('hiddenLessons');
            const hiddenLessonItems = document.getElementById('hiddenLessonItems');

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');

                    // Remove all active from icons also if needed
                    document.querySelectorAll('.lesson-list__item').forEach(item => item.classList.remove('active'));
                    this.closest('.lesson-list__item').classList.add('active');
                });
            });

            if (viewMoreBtn) {
                viewMoreBtn.addEventListener('click', function() {
                    // Show hidden lessons
                    if (hiddenLessons) {
                        hiddenLessons.style.display = 'block';
                        // Move the content to the tab-content div
                        document.getElementById('pills-tabContent').appendChild(hiddenLessons);
                    }
                    
                    // Show hidden lesson items
                    if (hiddenLessonItems) {
                        hiddenLessonItems.style.display = 'block';
                        // Insert before the "View More" button
                        this.closest('li').insertAdjacentElement('beforebegin', hiddenLessonItems);
                    }
                    
                    // Remove the "View More" button
                    this.closest('li').remove();
                });
            }
        </script>
    </body>
</html>