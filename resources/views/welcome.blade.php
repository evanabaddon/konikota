<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Koni Kota Malang | Kalender Event">
    <meta name="keywords" content="Koni Kota Malang | Kalender Event">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Koni Kota Malang | Kalender Event</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('specer') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('specer') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('specer') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('specer') }}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('specer') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('specer') }}/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="search-btn search-switch">
            <i class="fa fa-search"></i>
        </div>
        <div class="header__top--canvas">
            <div class="ht-info">
                <ul>
                    <li>{{ date('d F Y | H:i:s') }}</li>
                </ul>
            </div>
            <div class="ht-links">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-vimeo"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
        <ul class="main-menu mobile-menu">
            <li class="{{ \Route::is('home') ? 'active' : '' }}"><a href="/">Home</a></li>
            <li class="{{ \Route::is('kalender') ? 'active' : '' }}"><a href="{{ route('kalender') }}">Kalender</a></li>
            <li class="{{ \Route::is('home') ? 'active' : '' }}"><a href="http://www.konikotamalang.org/">Kontak</a></li>
        </ul>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ht-info">
                            <ul>
                                <li>{{ date('d F Y | H:i:s') }}</li>
                                <li><a href="http://www.konikotamalang.org/">Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ht-links">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-vimeo"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="/"><img src="{{ asset('specer') }}/img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <ul class="main-menu">
                                <li class="{{ \Route::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                                <li class="{{ \Route::is('kalender') ? 'active' : '' }}"><a href="{{ route('kalender') }}">Kalender</a></li>
                                <li><a href="http://www.konikotamalang.org/">Kontak</a></li>
                            </ul>
                            <div class="nm-right search-switch">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas-open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    @yield('home')

    <!-- Footer Section Begin -->
    <footer class="footer-section set-bg" data-setbg="{{ asset('specer') }}/img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="fs-logo">
                        <div class="logo">
                            <a href="./index.html"><img src="{{ asset('specer') }}/img/logo.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-lg-1">
                    <div class="fs-logo">
                        <ul>
                            <li><i class="fa fa-phone"></i> (0341) 320236</li>
                            <li><i class="fa fa-thumb-tack"></i> Jl. Tangkuban Perahu No.2, Kauman, Kec. Klojen, Kota Malang, Jawa Timur 65119</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="fs-logo">
                        <div class="fs-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-tumblr"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright-option">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="co-text">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Koni Kota Malang</p>
                        </div>
                        <div class="co-widget">
                            <ul>
                                <li><a href="#">Copyright notification</a></li>
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="fa fa-close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="{{ asset('specer') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('specer') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('specer') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('specer') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('specer') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('specer') }}/js/main.js"></script>
</body>

</html>