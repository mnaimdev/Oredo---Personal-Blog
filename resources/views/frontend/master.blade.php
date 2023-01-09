<!doctype html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="icon" sizes="16x16" href="assets/img/favicon.png">

    <!-- Title -->Stay Connected
    <title> Oredoo - Personal Blog HTML Template </title>

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('/frontend_asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend_asset/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend_asset/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend_asset/css/fontawesome.css') }}">

    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('/frontend_asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend_asset/css/custom.css') }}">
</head>

<body>
    <!--loading -->
    <div class="loader">
        <div class="loader-element"></div>
    </div>

    <!-- Header-->
    <header class="header navbar-expand-lg fixed-top ">
        <div class="container-fluid ">
            <div class="header-area ">
                <!--logo-->
                <div class="logo">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('/frontend_asset/img/logo/logo-dark.png') }}" alt=""
                            class="logo-dark">
                        <img src="{{ asset('/frontend_asset/img/logo/logo-white.png') }}" alt=""
                            class="logo-white">
                    </a>
                </div>
                <div class="header-navbar">
                    <nav class="navbar">
                        <!--navbar-collapse-->
                        <div class="collapse navbar-collapse" id="main_nav">
                            <ul class="navbar-nav ">
                                <li class="nav-item ">
                                    <a class="nav-link active" href="{{ route('welcome') }}"> Home </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""> Blogs </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('author.list') }}"> Authors </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about') }}"> About </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}"> Contact </a>
                                </li>
                            </ul>
                        </div>
                        <!--/-->
                    </nav>
                </div>

                <!--header-right-->
                <div class="header-right ">
                    <!--theme-switch-->
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" />
                            <span class="slider round ">
                                <i class="lar la-sun icon-light"></i>
                                <i class="lar la-moon icon-dark"></i>
                            </span>
                        </label>
                    </div>

                    <!--search-icon-->
                    <div class="search-icon">
                        <i class="las la-search"></i>
                    </div>
                    <!--button-subscribe-->
                    <div class="botton-sub">

                        @auth('guestlogin')
                            <div class="dropdown show">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::guard('guestlogin')->user()->name }}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('guest.profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('guest.logout') }}">Logout</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('guest.register') }}" class="btn-subscribe">Sign Up</a>
                        @endauth

                    </div>
                    <!--navbar-toggler-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </header>


    @yield('content')

    <!--footer-->
    <div class="footer">
        <div class="footer-area">
            <div class="footer-area-content">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Menu</h6>
                                <ul>
                                    <li><a href="{{ route('welcome') }}">Homepage</a></li>
                                    <li><a href="{{ route('about') }}">about us</a></li>
                                    <li><a href="{{ route('contact') }}">contact us</a></li>
                                    <li><a>privacy</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--newslatter-->
                        <div class="col-md-6">
                            <div class="newslettre">
                                <div class="newslettre-info">
                                    <h3>Subscribe To OurNewsletter</h3>
                                    <p>Sign up for free and be the first to get notified about new posts.</p>
                                </div>

                                <form action="{{ route('subscribe.store') }}" class="post">
                                    @csrf
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Your Email Adress">

                                        </div>

                                        <button class="submit-btn" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                    <div class="my-3">
                                        @error('email')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/-->
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Follow us</h6>
                                <ul>
                                    <li><a href="https://www.facebook.com/mnaimdev" target="_blank">facebook</a></li>
                                    <li><a href="https://www.instagram.com/mohammadnaimkhan66/"
                                            target="_blank">instagram</a></li>
                                    <li><a href="https://www.youtube.com/channel/UC_Ew5V5FHxBSux33r24dquw"
                                            target="_blank">youtube</a></li>
                                    <li><a href="https://twitter.com/mnaimdev" target="_blank">twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer-copyright-->
            <div class="footer-area-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright">
                                <p>© 2022, Mohammad Naim, All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>

    <!--Back-to-top-->
    <div class="back">
        <a href="#" class="back-top">
            <i class="las la-long-arrow-alt-up"></i>
        </a>
    </div>

    <!--Search-form-->
    <div class="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10 m-auto">
                    <div class="search-width">
                        <button type="button" class="close">
                            <i class="far fa-times"></i>
                        </button>
                        <form class="search-form" action="https://oredoo.assiagroupe.net/Oredoo/search.html">
                            <input type="search" value="" placeholder="What are you looking for?">
                            <button type="submit" class="search-btn"> search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('/frontend_asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/frontend_asset/js/popper.min.js') }}"></script>
    <script src="{{ asset('/frontend_asset/js/bootstrap.min.js') }}"></script>


    <!-- JS Plugins  -->
    <script src="{{ asset('/frontend_asset/js/theia-sticky-sidebar.js') }}"></script>
    <script src="{{ asset('/frontend_asset/js/ajax-contact.js') }}"></script>
    <script src="{{ asset('/frontend_asset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/frontend_asset/js/switch.js') }}"></script>
    <script src="{{ asset('/frontend_asset/js/jquery.marquee.js') }}"></script>



    <!-- JS main  -->
    <script src="{{ asset('/frontend_asset/js/main.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('footer_script')

</body>

</html>
