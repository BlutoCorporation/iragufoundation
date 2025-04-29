<!--==================== Preloader Start ====================-->
<div class="preloader">
    <div class="loader"></div>
</div>
<!--==================== Preloader End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- ============================ Sidebar Start ============================ -->
<aside class="sidebar">
    <!-- sidebar close btn -->
    <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute">
        <i class="ph ph-x"></i>
    </button>
    <!-- sidebar close btn -->

    <a href="index" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
        <img src="assets/images/logo/logo.png" alt="Logo" />
    </a>

    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm h-100 d-flex flex-column justify-content-between overflow-scroll">
        <div class="p-20 ">
            <ul class="sidebar-menu">
                <li class="sidebar-menu__item">
                    <a href="index" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="student-courses" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
                        <span class="text">Classes</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="pricing-plan" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-coins"></i></span>
                        <span class="text">Pricing</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="p-20">
            <div class="bg-main-50 p-20 pt-0 rounded-16 text-center mt-74">
                <span class="border border-5 bg-white mx-auto border-primary-50 w-114 h-114 rounded-circle flex-center text-success-600 text-2xl translate-n74">
                    <!-- <img src="assets/images/icons/certificate.png" alt="" class="centerised-img" /> -->
                    <?php
                        $avatarPath = ($user['avatar'] === '../assets/img/user.png') ? 'assets/' . $user['avatar'] : $user['avatar'];
                    ?>
                    <img src="<?= $avatarPath ?>" alt="User Avatar" class="rounded-circle" />
                </span>
                <div class="mt-n74">
                    <h5 class="mb-4 mt-22"><?= ucfirst(strtolower($user['username'])) ?></h5>
                    <!-- <p class="">< ?= htmlspecialchars(mb_strimwidth($user['bio'], 0, 35, "...")) ?></p> -->
                    <a href="profile" class="btn btn-main mt-16 rounded-pill">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</aside>
<!-- ============================ Sidebar End  ============================ -->