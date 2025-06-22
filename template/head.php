<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
<!-- Google Fonts Css-->
<link rel="preconnect" href="https://fonts.googleapis.com/" />
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Fustat:wght@200..800&amp;display=swap" rel="stylesheet" />
<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<!-- SlickNav Css -->
<link href="assets/css/slicknav.min.css" rel="stylesheet" />
<!-- Swiper Css -->
<link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
<!-- Font Awesome Icon Css-->
<link href="assets/css/all.css" rel="stylesheet" media="screen" />
<!-- Animated Css -->
<link href="assets/css/animate.css" rel="stylesheet" />
<!-- Magnific Popup Core Css File -->
<link rel="stylesheet" href="assets/css/magnific-popup.css" />
<!-- Mouse Cursor Css File -->
<link rel="stylesheet" href="assets/css/mousecursor.css" />
<!-- Main Custom Css -->
<link href="assets/css/custom.css" rel="stylesheet" media="screen" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
    /* for desktop */
    .whatsapp_float {
        position:fixed;
        width:60px;
        height:60px;
        bottom:40px;
        left:40px;
        background-color:#25d366;
        color:#FFF;
        border-radius:50px;
        text-align:center;
            font-size:30px;
        box-shadow: 2px 2px 3px #999;
            z-index:100;
    }
    
    .whatsapp-icon {
        margin-top:16px;
    }

    /* for mobile */
    @media screen and (max-width: 767px){
        .whatsapp-icon {
            margin-top:10px;
        }
        .whatsapp_float {
            width: 40px;
            height: 40px;
            bottom: 20px;
            left: 10px;
            font-size: 22px;
        }
    }
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<style>
    /* Animation Keyframes */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Floating Button Container */
    .floating-btn-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 999;
    }

    /* Main Floating Button */
    .floating-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F10707, #FF6B6B);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(241, 7, 7, 0.3);
        transition: all 0.3s ease;
        animation: float 4s ease-in-out infinite;
        border: none;
        outline: none;
    }

    .floating-btn:hover {
        animation: pulse 0.5s ease infinite;
        box-shadow: 0 15px 30px rgba(241, 7, 7, 0.4);
    }

    .floating-btn i {
        font-size: 25px;
    }

    /* Popup Container */
    .login-popup {
        position: fixed;
        bottom: 120px;
        right: 30px;
        width: 350px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        padding: 30px;
        z-index: 1000;
        display: none;
        animation: fadeIn 0.5s ease-out forwards;
        transform-origin: bottom right;
    }

    .login-popup.active {
        display: block;
    }

    /* Popup Header */
    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .popup-title {
        font-family: 'Dancing Script', cursive;
        font-size: 28px;
        color: #F10707;
        font-weight: 700;
    }

    .close-btn {
        background: #f5f5f5;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        outline: none;
    }

    .close-btn:hover {
        background: #F10707;
        color: white;
    }

    /* Popup Content */
    .popup-content {
        margin-bottom: 25px;
    }

    .popup-text {
        color: #555;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 1px solid #ddd;
        border-radius: 30px;
        font-size: 14px;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-control:focus {
        border-color: #F10707;
        box-shadow: 0 0 0 3px rgba(241, 7, 7, 0.1);
    }

    /* Login Button */
    .login-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #F10707, #FF6B6B);
        color: white;
        border: none;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(241, 7, 7, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-btn i {
        margin-right: 8px;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(241, 7, 7, 0.3);
    }

    /* Footer Links */
    .popup-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 13px;
    }

    .footer-link {
        color: #F10707;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-link:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
        .floating-btn-container {
            bottom: 20px;
            right: 20px;
        }
        
        .floating-btn {
            width: 60px;
            height: 60px;
        }
        
        .login-popup {
            width: 90%;
            right: 5%;
            bottom: 100px;
        }
    }
</style>