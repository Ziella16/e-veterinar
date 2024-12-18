<?php
session_start(); // Start the session to track user login

// Check if the user is logged in (you can replace this with actual login logic)
$is_logged_in = isset($_SESSION['user_id']); // Assume user ID is stored in the session after login



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form data here
    $appointment_date = $_POST['appointment_date'];  // Example of handling a POST request
    // Redirect to a confirmation page after submitting
    header("Location: confirmation.php");
    exit();
}

?>



<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <main>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>E-Veterinar </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <a href="index.php"></a>

                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">



                                        </ul>
                                        </li>

                                        </ul>
                                    </nav>
                                </div>


                                <div class="dropdown">
                                    <button type="button" onclick="document.location='login.php'"
                                        class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        <a href="login.php">Login</a>

                                        <button type="button" onclick="document.location='signup.php'"
                                            class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            <a href="signup.php">Register</a>
                                        </button>
                                        <ul class="dropdown-menu">


                                        </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!--? Slider Area Start-->
        <div class="slider-area">
            <div class="slider-active dot-style">
                <!-- Slider Single -->
                <div class="single-slider d-flex align-items-center slider-height">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-7 col-lg-8 col-md-10 ">
                                <!-- Video icon -->
                                <div class="video-icon">
                                    <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=up68UAfH0d0"
                                        data-animation="bounceIn" data-delay=".4s">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                                <div class="hero__caption">
                                    <span data-animation="fadeInUp" data-delay=".3s">Selamat Datang Ke Veterinar Parit
                                        Buntar</span>
                                    <h1 data-animation="fadeInUp" data-delay=".3s">We Take Care Of Your Pet.</h1>
                                    <p data-animation="fadeInUp" data-delay=".6s"></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Single -->
                <div class="single-slider d-flex align-items-center slider-height">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-7 col-lg-8 col-md-10 ">
                                <!-- Video icon -->
                                <div class="video-icon">
                                    <a class="popup-video btn-icon"
                                        href="https://lh3.googleusercontent.com/ggs/AF1QipNXPaGAtFcerIfT_z_RrTC1QG2-vhbC1YjWCrJ4=m18"
                                        data-animation="bounceIn" data-delay=".4s">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                                <div class="hero__caption">
                                    <span data-animation="fadeInUp" data-delay=".3s">Selamat Datang Ke Veterinar Parit
                                        Buntar</span>
                                    <h1 data-animation="fadeInUp" data-delay=".3s">We Treat Your Pet</h1>
                                    <p data-animation="fadeInUp" data-delay=".6s"></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider Social -->
            <div class="button-text d-none d-md-block">
                <span></span>
            </div>
        </div>



        <!-- About Area End-->
        <!--? Gallery Area Start -->
        <div class="gallery-area section-padding30">
            <div class="container fix">
                <div class="row justify-content-sm-center">
                    <div class="cl-xl-7 col-lg-8 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-70">
                            <span>Our Recent Photos</span>
                            <h2>Pets Photo Gallery</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <!-- <a href="assets/img/gallery/gallery1.png" class="img-pop-up">View Project</a> -->
                            <div class="gallery-img size-img"
                                style="background-image: url(assets/img/gallery/gallery1.png);"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img size-img"
                                style="background-image: url(assets/img/gallery/gallery2.png);"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img size-img"
                                style="background-image: url(assets/img/gallery/gallery3.png);"></div>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img size-img"
                                style="background-image: url(assets/img/gallery/gallery4.png);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
        <!--? Contact form Start -->
        <div class="contact-form-main pb-top">
            <div class="container">
                <div class="row justify-content-md-end">
                    <div class="col-xl-7 col-lg-7">
                        <div class="form-wrapper">

                        </div>
                    </div>


                    <!--? Testimonial Start -->
                    <div class="testimonial-area testimonial-padding section-bg"
                        data-background="assets/img/gallery/section_bg03.png">
                        <div class="container">
                            <!-- Testimonial contents -->
                            <div class="row d-flex justify-content-center">
                                <div class="col-xl-8 col-lg-8 col-md-10">
                                    <div class="h1-testimonial-active dot-style">
                                        <!-- Single Testimonial -->
                                        <div class="single-testimonial text-center">
                                            <div class="testimonial-caption ">
                                                <!-- founder -->
                                                <div class="testimonial-founder">
                                                    <div class="founder-img mb-40">
                                                        <img src="assets/img/gallery/testi-logo.png" alt="">
                                                        <span>Zikry</span>
                                                        <p>Creative Director</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-top-cap">
                                                    <p>“Pets have more love and effection than most people.”</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Testimonial -->
                                        <div class="single-testimonial text-center">
                                            <div class="testimonial-caption ">
                                                <!-- founder -->
                                                <div class="testimonial-founder">
                                                    <div class="founder-img mb-40">
                                                        <img src="assets/img/gallery/testi-logo.png" alt="">
                                                        <span>Aiman</span>
                                                        <p>Creative Director</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-top-cap">
                                                    <p>“The purity of a person's heart can be quickly gauged by the way they look at animals.”</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Testimonial -->
                                        <div class="single-testimonial text-center">
                                            <div class="testimonial-caption ">
                                                <!-- founder -->
                                                <div class="testimonial-founder">
                                                    <div class="founder-img mb-40">
                                                        <img src="assets/img/gallery/testi-logo.png" alt="">
                                                        <span>Hariedz</span>
                                                        <p>Creative Director</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-top-cap">
                                                    <p>“I think having an animal in your life makes you a better person.”</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial End -->
                    <!--? Blog start -->
                    <div class="home_blog-area section-padding30">
                        <div class="container">
                            <div class="row justify-content-sm-center">
                                <div class="cl-xl-7 col-lg-8 col-md-10">
                                </div>
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo mb-25">
                                    <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Pejabat Perkhidmatan Veterinar Daerah Kerian
                                            Jalan Padang, 34200 Parit Buntar, Perak Darul Ridzuan. </p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="https://www.facebook.com/sai4ull"><i
                                            class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter-square"></i></a>
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-square"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>CONTACT</h4>
                                <ul>

                                    <li>Phone: +05-7161479</li>
                                    <li>Email: <a href="mailto:vetcare@gmail.com"
                                            style="color: #1976D2;">veterinar@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>ABOUT US</h4>
                                <ul>
                                    <li>
                                        <p>Menyediakan Perkhidmatan Veterinar Yang Berkualiti Bagi Menjamin Kepentingan
                                            Awam & Industri Haiwan Yang Mapan Demi Kesejahteraan Manusia.</p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>FOLLOW US</h4>
                                <ul>
                                    <div class="footer-social">

                                        <li><a href="https://www.facebook.com/sai4ull"
                                                style="color: #1976D2;">Facebook</a> <a
                                                href="https://www.facebook.com/sai4ull"><i
                                                    class="fab fa-facebook-square"></i></a></li>
                                        <li><a href="#" style="color: #1976D2;">Twitter</a></li>
                                        <li><a href="#" style="color: #1976D2;">Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    © 2024 Copyright &copy;
                                    <script>document.write(new Date().getFullYear());</script> : e-veterinar.com <i
                                        class="fa fa-heart" aria-hidden="true"></i></a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    </main>
</body>

</html>