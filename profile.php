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

    $error = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['submit'])) {
            $user = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $standard = $_POST['std'];
            $gen = $_POST['gender'];
            $locat = $_POST['location'];

            // Call the register method
            $error = User::setUser($user, $email, $phone, $gen, $locat, $standard);
        }

        if (isset($_FILES['avatar'])) {
            $avatar = $_FILES['avatar']; // Pass the entire file array to the function
            $fileSize = $_FILES['avatar']['size'];
            $error = User::setAvatar($avatar, $fileSize);
        }

        if (isset($_POST['remove_avatar'])) {
            // If the remove button is clicked, remove the avatar
            $error = User::removeAvatar(); // Your function to remove avatar
        }

        if (isset($_POST['old']) && isset($_POST['new']) && isset($_POST['conf']) && isset($_POST['submit'])) {
            $old = $_POST['old'];
            $new = $_POST['new'];
            $conf = $_POST['conf'];
    
            // Call the register method
            $error = User::setNewPass($old, $new, $conf);
        }
        
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
            .avatar-upload-box.dragover {
                border-color: #007bff;
                background-color: #e6f0ff;
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
                        <li><span class="text-main-600 fw-normal text-15">Profile</span></li>
                        <li>
                            <p class="<?= $error ? 'text-success' : 'text-danger' ?>">
                                <?= $error ?>
                                <a href="profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                    </svg>
								</a>
                            </p>
                        </li>
                    </ul>
                </div>
                <!-- Breadcrumb End -->

                <div class="card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="cover-img position-relative">
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <div id="coverImagePreview" style="background-image: url('assets/images/thumbs/setting-cover-img.png');"></div>
                                </div>
                            </div>
                        </div>

                        <div class="setting-profile px-24">
                            <div class="flex-between">
                                <div class="d-flex align-items-end flex-wrap mb-32 gap-24">
                                    <?php
                                        $avatarPath = ($user['avatar'] === '../assets/img/user.png') ? 'assets/' . $user['avatar'] : $user['avatar'];
                                    ?>
                                    <img src="<?= $avatarPath ?>" alt="User Avatar" class="w-120 h-120 rounded-circle border border-white" />
                                    <div>
                                        <h4 class="mb-8"><?= ucfirst(strtolower($user['username'])) ?></h4>
                                        <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                            <?php if (!empty($user['gender'])) { ?>
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 d-flex text-lg"><i class="ph ph-swatches"></i></span>
                                                <span class="text-gray-600 d-flex text-15"><?= $user['gender'] ?></span>
                                            </div>
                                            <?php }
                                            if (!empty($user['location'])) { ?>
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 d-flex text-lg"><i class="ph ph-map-pin"></i></span>
                                                <span class="text-gray-600 d-flex text-15"><?= $user['location'] ?></span>
                                            </div>
                                            <?php } 
                                            if (!empty($user['uploaded_time'])) { ?>
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 d-flex text-lg"><i class="ph ph-calendar-dots"></i></span>
                                                <span class="text-gray-600 d-flex text-15"><?= $user['uploaded_time'] ?></span>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav common-tab style-two nav-pills mb-0" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill" data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details" aria-selected="true">My Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password" aria-selected="false">Password</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-plan-tab" data-bs-toggle="pill" data-bs-target="#pills-plan" type="button" role="tab" aria-controls="pills-plan" aria-selected="false">Plan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-billing-tab" data-bs-toggle="pill" data-bs-target="#pills-billing" type="button" role="tab" aria-controls="pills-billing" aria-selected="false">Billing</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <!-- My Details Tab start -->
                    <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
                        <div class="card mt-24">
                            <div class="card-header border-bottom">
                                <h4 class="mb-4">My Details</h4>
                                <p class="text-gray-600 text-15">Please fill full details about yourself</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row gy-4">
                                        <div class="col-12">
                                            <label for="imageUpload" class="form-label mb-8 h6">Your Photo</label>
                                            <div class="flex-align gap-22">
                                                <div class="avatar-upload flex-shrink-0">
                                                    <input type="file" name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                    <div class="avatar-preview">
                                                        <div id="profileImagePreview" style="background-image: url('<?= $avatarPath ?>');"></div>
                                                    </div>
                                                </div>
                                                <?php
                                                    if ($user['avatar'] !== '../assets/img/user.png') {
                                                ?>
                                                <button type="submit" name="remove_avatar" class="btn btn-outline-main rounded-pill p-12">
                                                    Remove
                                                </button>
                                                <?php } ?>
                                                <div
                                                    class="avatar-upload-box text-center position-relative flex-grow-1 py-24 px-4 rounded-16 border border-main-300 border-dashed bg-main-50 hover-bg-main-100 hover-border-main-400 transition-2 cursor-pointer"
                                                >
                                                    <label for="imageUpload" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 rounded-16 cursor-pointer z-1"></label>
                                                    <span class="text-32 icon text-main-600 d-inline-flex"><i class="ph ph-upload"></i></span>
                                                    <span class="text-13 d-block text-gray-400 text my-8">Click to upload or drag and drop</span>
                                                    <!-- <span class="text-13 d-block text-main-600">SVG, PNG, JPEG OR GIF (max 1080px1200px)</span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-end gap-8">
                                                <!-- <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button> -->
                                                <button type="submit" name="submit" class="btn btn-main rounded-pill py-9" hidden>Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="POST">
                                    <div class="row gy-4">
                                        <div class="col-sm-6 col-xs-6">
                                            <label for="username" class="form-label mb-8 h6">Userame</label>
                                            <input type="text" class="form-control py-11" id="fname" placeholder="Enter Username" name="username" value="<?= $user['username']; ?>" required/>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <label for="email" class="form-label mb-8 h6">Email</label>
                                            <input type="email" class="form-control py-11" id="email" placeholder="Enter Email Address" name="email" value="<?= $user['email']; ?>" required/>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <label for="phone" class="form-label mb-8 h6">Phone Number</label>
                                            <input type="number" class="form-control py-11" id="phone" placeholder="Enter Phone Number" name="phone" value="<?= $user['phone']; ?>" required/>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <label for="standard" class="form-label mb-8 h6">Category</label>
                                            <select name="std" id="standard" class="form-control py-11" required>
                                                <option value="<?= $user['std'] ?>" selected>Select your standard</option>
                                                <option value="1">1st Standard</option>
                                                <option value="2">2nd Standard</option>
                                                <option value="3">3rd Standard</option>
                                                <option value="4">4th Standard</option>
                                                <option value="5">5th Standard</option>
                                                <option value="6">6th Standard</option>
                                                <option value="7">7th Standard</option>
                                                <option value="8">8th Standard</option>
                                                <option value="9">9th Standard</option>
                                                <option value="10">10th Standard</option>
                                                <option value="11">11th Standard</option>
                                                <option value="12">12th Standard</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <label for="gender" class="form-label mb-8 h6">Gender</label>
                                            <select name="gender" id="standard" class="form-control py-11" required>
                                                <option value="<?= $user['gender']; ?>"><?= $user['gender']; ?></option>
                                                <?php if ($user['gender'] !== 'Male') { ?>
                                                <option value="Male">Male</option>
                                                <?php } else { ?>
                                                <option value="Female">Female</option>
                                                <?php } ?>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <label for="location" class="form-label mb-8 h6">Address</label>
                                            <input type="text" class="form-control py-11" id="lname" placeholder="Enter Your Address" name="location" value="<?= $user['location'] ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-end gap-8">
                                                <!-- <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button> -->
                                                <button type="submit" name="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- My Details Tab End -->
                    
                    <!-- Password Tab Start -->
                    <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab" tabindex="0">
                        <div class="card mt-24">
                            <div class="card-header border-bottom">
                                <h4 class="mb-4">Password Settings</h4>
                                <p class="text-gray-600 text-15">Please fill full details about yourself</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form method="POST">
                                        <div class="col-md-6">
                                            <div class="row gy-4">
                                                <div class="col-12">
                                                    <label for="current-password" class="form-label mb-8 h6">Current Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" name="old" class="form-control py-11" id="current-password" placeholder="Enter Current Password" />
                                                        <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#current-password"></span>
                                                    </div>
                                                </div>
                                                <a href="forgot-password" style="text-align: end;" class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Forgot Password?</a>
                                                <div class="col-12">
                                                    <label for="new-password" class="form-label mb-8 h6">New Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" name="new" class="form-control py-11" id="new-password" placeholder="Enter New Password" />
                                                        <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#new-password"></span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="confirm-password" class="form-label mb-8 h6">Confirm Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" name="conf" class="form-control py-11" id="confirm-password" placeholder="Enter Confirm Password" />
                                                        <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#confirm-password"></span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label mb-8 h6">Password Requirements:</label>
                                                    <ul class="list-inside">
                                                        <li class="text-gray-600 mb-4">At least one lowercase character</li>
                                                        <li class="text-gray-600 mb-4">Minimum 8 characters long - the more, the better</li>
                                                        <li class="text-gray-300 mb-4">At least one number, symbol, or whitespace character</li>
                                                    </ul>
                                                </div>
                                                <!-- <div class="col-12">
                                                    <label class="form-label mb-8 h6">Two-Step Verification</label>
                                                    <ul>
                                                        <li class="text-gray-600 mb-4 fw-semibold">Two-factor authentication is not enabled yet.</li>
                                                        <li class="text-gray-600 mb-4 fw-medium">Two-factor authentication adds a layer of security to your account by requiring more than just a password to log in. Learn more.</li>
                                                    </ul>
                                                    <button type="submit" class="btn btn-main rounded-pill py-9 mt-24">Enable two-factor authentication</button>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-end gap-8">
                                                <!-- <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button> -->
                                                <button type="submit" name="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Password Tab End -->

                    <!-- Plan Tab Start -->
                    <div class="tab-pane fade" id="pills-plan" role="tabpanel" aria-labelledby="pills-plan-tab" tabindex="0">
                        <div class="card mt-24">
                            <div class="card-header border-bottom">
                                <h4 class="mb-4">Pricing Breakdown</h4>
                                <p class="text-gray-600 text-15">Creating a detailed pricing plan for your course requries considering various factors.</p>
                            </div>
                            <div class="card-body">
                                <div class="row gy-4">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
                                            <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-package"></i></span>
                                            <h3 class="mb-4">Basic Plan</h3>
                                            <span class="text-gray-600">Perfect plan for students</span>
                                            <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">₹50 <span class="text-md text-gray-600">/year</span></h2>
                                            <ul>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Intro video the course
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Interactive quizes
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Course curriculum
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Community supports
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Certificate of completion
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Sample lesson showcasing
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Access to course community
                                                </li>
                                            </ul>
                                            <a href="#" class="btn btn-outline-main w-100 rounded-pill py-16 border-main-300 text-17 fw-medium mt-32">Get Started</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative active">
                                            <span class="plan-badge py-4 px-16 bg-main-600 text-white position-absolute inset-inline-end-0 inset-block-start-0 mt-8 text-15">Recommended</span>
                                            <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-planet"></i></span>
                                            <h3 class="mb-4">Standard Plan</h3>
                                            <span class="text-gray-600">For users who want to do more</span>
                                            <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">₹129 <span class="text-md text-gray-600">/year</span></h2>

                                            <ul>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Intro video the course
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Interactive quizes
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Course curriculum
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Community supports
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Certificate of completion
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Sample lesson showcasing
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Access to course community
                                                </li>
                                            </ul>
                                            <a href="#" class="btn btn-main w-100 rounded-pill py-16 border-main-600 text-17 fw-medium mt-32">Get Started</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
                                            <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-trophy"></i></span>
                                            <h3 class="mb-4">Premium Plan</h3>
                                            <span class="text-gray-600">Your entire friends in one place</span>
                                            <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">₹280 <span class="text-md text-gray-600">/year</span></h2>

                                            <ul>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Intro video the course
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Interactive quizes
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Course curriculum
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Community supports
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Certificate of completion
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4 mb-20">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Sample lesson showcasing
                                                </li>
                                                <li class="flex-align gap-8 text-gray-600 mb-lg-4">
                                                    <span class="text-24 d-flex text-main-600"><i class="ph ph-check-circle"></i></span>
                                                    Access to course community
                                                </li>
                                            </ul>
                                            <a href="#" class="btn btn-outline-main w-100 rounded-pill py-16 border-main-300 text-17 fw-medium mt-32">Get Started</a>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label mb-8 h6 mt-32">Terms & Policy</label>
                                        <ul class="list-inside">
                                            <li class="text-gray-600 mb-4">1. Set up multiple pricing levels with different features and functionalities to maximize revenue</li>
                                            <li class="text-gray-600 mb-4">2. Continuously test different price points and discounts to find the sweet spot that resonates with your target audience</li>
                                            <li class="text-gray-600 mb-4">3. Price your course based on the perceived value it provides to students, considering factors</li>
                                        </ul>
                                        <button type="button" class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2 mt-24" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="ph ph-plus me-4"></i>
                                            Add New Plan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Plan Tab End -->

                    <!-- Billing Tab Start -->
                    <div class="tab-pane fade" id="pills-billing" role="tabpanel" aria-labelledby="pills-billing-tab" tabindex="0">
                        <!-- Payment Method Start -->
                        <div class="card mt-24">
                            <div class="card-header border-bottom">
                                <h4 class="mb-4">Payment Method</h4>
                                <p class="text-gray-600 text-15">Update your billing details and address</p>
                            </div>
                            <div class="card-body">
                                <div class="row gy-4">
                                    <div class="col-lg-5">
                                        <div class="card border border-gray-100">
                                            <div class="card-header border-bottom border-gray-100">
                                                <h6 class="mb-0">Contact Email</h6>
                                            </div>
                                            <div class="card-body">
                                                <div
                                                    class="payment-method payment-method-one form-check form-radio d-flex align-items-center justify-content-between mb-16 rounded-16 bg-main-50 p-20 cursor-pointer position-relative transition-2"
                                                >
                                                    <div>
                                                        <h6 class="title mb-14">Send to my email account</h6>
                                                        <span class="d-block">exampleinfo@mail.com</span>
                                                    </div>
                                                    <label class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 cursor-pointer" for="emailOne"></label>
                                                    <input class="form-check-input payment-method-one" type="radio" name="emailCheck" id="emailOne" />
                                                </div>
                                                <div class="payment-method payment-method-one form-check form-radio d-block rounded-16 bg-main-50 p-20 cursor-pointer position-relative transition-2 mt-24">
                                                    <div class="flex-between mb-14 gap-4">
                                                        <h6 class="title mb-0">Send to an alternative email</h6>
                                                        <input class="form-check-input payment-method-one" type="radio" name="emailCheck" id="emailTwo" />
                                                    </div>
                                                    <label class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 cursor-pointer" for="emailTwo"></label>
                                                    <span class="border-text d-block bg-white border border-main-200 px-20 py-8 rounded-8">exampleinfo@mail.com</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="card border border-gray-100">
                                            <div class="card-header border-bottom border-gray-100 flex-between gap-8">
                                                <h6 class="mb-0">Card Details</h6>
                                                <a href="#" class="btn btn-outline-main rounded-pill py-6">Add New Card</a>
                                            </div>
                                            <div class="card-body">
                                                <div
                                                    class="payment-method payment-method-two form-check form-radio d-flex align-items-center justify-content-between mb-16 rounded-16 bg-main-50 p-20 cursor-pointer position-relative transition-2"
                                                >
                                                    <div class="flex-align align-items-start gap-16">
                                                        <div>
                                                            <img src="assets/images/thumbs/payment-method1.png" alt="" class="w-54 h-40 rounded-8" />
                                                        </div>
                                                        <div>
                                                            <h6 class="title mb-0">Visa **** **** 5890</h6>
                                                            <span class="d-block">Up to 60 User and 100GB team data</span>
                                                            <div class="text-13 flex-align gap-8 mt-12 pt-12 border-top border-gray-100">
                                                                <span>Set as default</span>
                                                                <a href="#" class="fw-bold">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 cursor-pointer" for="visaCard"></label>
                                                    <input class="form-check-input payment-method-two" type="radio" name="cardDetails" id="visaCard" />
                                                </div>
                                                <div class="payment-method payment-method-two form-check form-radio d-flex align-items-center justify-content-between rounded-16 bg-main-50 p-20 cursor-pointer position-relative transition-2">
                                                    <div class="flex-align align-items-start gap-16">
                                                        <div>
                                                            <img src="assets/images/thumbs/payment-method2.png" alt="" class="w-54 h-40 rounded-8" />
                                                        </div>
                                                        <div>
                                                            <h6 class="title mb-0">Mastercard **** **** 1895</h6>
                                                            <span class="d-block">Up to 60 User and 100GB team data</span>
                                                        </div>
                                                    </div>
                                                    <label class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 cursor-pointer" for="masterCard"></label>
                                                    <input class="form-check-input payment-method-two" type="radio" name="cardDetails" id="masterCard" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Payment Method End -->

                        <!-- Billing history Start -->
                        <div class="card mt-24">
                            <div class="card-header border-bottom">
                                <div class="flex-between flex-wrap gap-16">
                                    <div>
                                        <h4 class="mb-4">Billing History</h4>
                                        <p class="text-gray-600 text-15">See the transaction you made</p>
                                    </div>
                                    <div class="flex-align flex-wrap justify-content-end gap-8">
                                        <button type="button" class="toggle-search-btn btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Add Filter</button>
                                        <button type="button" class="btn btn-main rounded-pill py-9">Download All</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card toggle-search-box border-bottom border-gray-100 rounded-0">
                                <div class="card-body">
                                    <form action="#" class="search-input-form">
                                        <div class="search-input">
                                            <select class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                                                <option value="" selected disabled>Invoice Type</option>
                                                <option value="">Credit Invoice</option>
                                                <option value="">Debit Invoice</option>
                                                <option value="">Mixed Invoice</option>
                                                <option value="">Commercial Invoice</option>
                                            </select>
                                        </div>
                                        <div class="search-input">
                                            <select class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                                                <option value="" selected disabled>amount</option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                            </select>
                                        </div>
                                        <div class="search-input">
                                            <input type="date" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8" />
                                        </div>
                                        <div class="search-input">
                                            <select class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                                                <option value="" selected disabled>plan</option>
                                                <option value="">Basic Plan</option>
                                                <option value="">Standard Plan</option>
                                                <option value="">Premium Plan </option>
                                            </select>
                                        </div>
                                        <div class="search-input">
                                            <button type="submit" class="btn btn-main rounded-pill py-9 w-100">Apply Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body p-0 overflow-x-auto">
                                <table id="studentTable" class="table table-lg table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th class="fixed-width w-40 h-40 ps-20">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox" id="selectAll" />
                                                </div>
                                            </th>
                                            <th class="h6 text-gray-600">
                                                <span class="position-relative">
                                                    Invoices
                                                </span>
                                            </th>
                                            <th class="h6 text-gray-600 text-center">Amount</th>
                                            <th class="h6 text-gray-600 text-center">Dates</th>
                                            <th class="h6 text-gray-600 text-center">Status</th>
                                            <th class="h6 text-gray-600 text-center">Plan</th>
                                            <th class="h6 text-gray-600 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fixed-width w-40 h-40">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex-align gap-10">
                                                    <div class="w-32 h-32 bg-gray-50 flex-center rounded-circle p-2">
                                                        <img src="assets/images/thumbs/invoice-logo1.png" alt="" class="" />
                                                    </div>
                                                    <div class="">
                                                        <h6 class="mb-0">Design Accesibility</h6>
                                                        <span class="text-13 fw-medium text-gray-200">Edmate - #012500</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">$180</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">06/22/2024</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Paid</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">Basic</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-12">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fixed-width w-40 h-40">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex-align gap-10">
                                                    <div class="w-32 h-32 bg-gray-50 flex-center rounded-circle p-2">
                                                        <img src="assets/images/thumbs/invoice-logo2.png" alt="" class="" />
                                                    </div>
                                                    <div class="">
                                                        <h6 class="mb-0">Design System</h6>
                                                        <span class="text-13 fw-medium text-gray-200">Edmate - #012500</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">$250</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">06/22/2024</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-info-600 bg-info-100 py-2 px-10 rounded-pill">Unpaid</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">Professional</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-12">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fixed-width w-40 h-40">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex-align gap-10">
                                                    <div class="w-32 h-32 bg-gray-50 flex-center rounded-circle p-2">
                                                        <img src="assets/images/thumbs/invoice-logo1.png" alt="" class="" />
                                                    </div>
                                                    <div class="">
                                                        <h6 class="mb-0">Frondend Develop</h6>
                                                        <span class="text-13 fw-medium text-gray-200">Edmate - #012500</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">$128</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">06/22/2024</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Paid</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">Basic</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-12">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fixed-width w-40 h-40">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex-align gap-10">
                                                    <div class="w-32 h-32 bg-gray-50 flex-center rounded-circle p-2">
                                                        <img src="assets/images/thumbs/invoice-logo1.png" alt="" class="" />
                                                    </div>
                                                    <div class="">
                                                        <h6 class="mb-0">Design Usability</h6>
                                                        <span class="text-13 fw-medium text-gray-200">Edmate - #012500</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">$132</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">06/22/2024</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-info-600 bg-info-100 py-2 px-10 rounded-pill">Unpaid</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">Basic</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-12">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fixed-width w-40 h-40">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex-align gap-10">
                                                    <div class="w-32 h-32 bg-gray-50 flex-center rounded-circle p-2">
                                                        <img src="assets/images/thumbs/invoice-logo4.png" alt="" class="" />
                                                    </div>
                                                    <div class="">
                                                        <h6 class="mb-0">Digital Marketing</h6>
                                                        <span class="text-13 fw-medium text-gray-200">Edmate - #012500</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">$186</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">06/22/2024</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Paid</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-gray-600">Advance</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-12">Download</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer border-top border-gray-100">
                                <div class="flex-align justify-content-end gap-8">
                                    <!-- <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button> -->
                                    <button type="submit" name="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                                </div>
                            </div>
                        </div>
                        <!-- Billing history End -->
                    </div>
                    <!-- Billing Tab End -->
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
            // Table Header Checkbox checked all js Start
            $("#selectAll").on("change", function () {
                $(".form-check .form-check-input").prop("checked", $(this).prop("checked"));
            });

            // Data Tables
            new DataTable("#studentTable", {
                searching: false,
                lengthChange: false,
                info: false, // Bottom Left Text => Showing 1 to 10 of 12 entries
                pagination: false,
                info: false, // Bottom Left Text => Showing 1 to 10 of 12 entries
                paging: false,
                columnDefs: [
                    { orderable: false, targets: [0, 6] }, // Disables sorting on the 1st & 7th column (index 6)
                ],
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const imageUpload = document.getElementById('imageUpload');
                const form = document.querySelector('form[enctype="multipart/form-data"]');
                const submitButton = form.querySelector('button[type="submit"]');

                function autoSubmitForm(previewElement, imageFile) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewElement.style.backgroundImage = 'url(' + e.target.result + ')';
                        submitButton.disabled = true;
                        submitButton.textContent = "Uploading...";

                        // Submit the form
                        if (form.requestSubmit) {
                            form.requestSubmit();
                        } else {
                            submitButton.click();
                        }
                    };
                    reader.readAsDataURL(imageFile);
                }

                // Native file input change
                imageUpload.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const preview = document.getElementById('profileImagePreview');
                        autoSubmitForm(preview, this.files[0]);
                    }
                });

                // Drag & Drop support with jQuery
                function uploadImageFunction(imageId, previewId, dropAreaId) {
                    const input = $(imageId)[0];
                    const preview = $(previewId);
                    const dropArea = $(dropAreaId);

                    // File input change (handled by native listener already)

                    // Drag and drop events
                    dropArea.on("dragover", function (e) {
                        e.preventDefault();
                        dropArea.addClass("dragover");
                    });

                    dropArea.on("dragleave", function (e) {
                        e.preventDefault();
                        dropArea.removeClass("dragover");
                    });

                    dropArea.on("drop", function (e) {
                        e.preventDefault();
                        dropArea.removeClass("dragover");

                        const files = e.originalEvent.dataTransfer.files;
                        if (files && files[0]) {
                            // Show preview and auto-submit
                            autoSubmitForm(preview[0], files[0]);

                            // Optionally update input element (for form completeness)
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(files[0]);
                            input.files = dataTransfer.files;
                        }
                    });
                }

                uploadImageFunction("#imageUpload", "#profileImagePreview", ".avatar-upload-box");
                uploadImageFunction("#coverImageUpload", "#coverImagePreview", ".cover-upload-box");
            });
        </script>
    </body>
</html>