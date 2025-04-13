<!-- Header -->
<header class="site-header sticky-header layout-1">
    <div class="header-container">
        <div class="top-header">
            <div class="container">
                <div class="wrap-content-header">
                    <div class="header-logo" style="font-size: 36px; font-weight: bolder;">
                        <a href="/" class="logo">
                            {{-- <img src="assets/images/logo-header-05.png" alt="IMG"> --}}
                            <span style="color:white; size:24px">Story</span><span style="color:#E40914">wa</span>
                        </a>

                        <a href="/" class="mobile-logo">
                            {{-- <img src="assets/images/logo-header-05.png" alt="IMG"> --}}
                            <span style="color:white; size:24px">Story</span><span style="color:#E40914">wa</span>
                        </a>

                        <a href="/" class="sticky-logo">
                            {{-- <img src="assets/images/logo-header-05.png" alt="IMG"> --}}
                            <span style="color:white; size:24px">Story</span><span style="color:#E40914">wa</span>
                        </a>
                    </div>

                    <div class="right-logo">
                        <div class="widget_thim_layout_builder">
                            <div class="wpb_wrapper">
                                <!-- shortcode st-search-videos -->
                                <div class="bp-element bp-element-st-search-videos vblog-layout-header-1">
                                    <div class="wrap-element">
                                        <form class="search-form">
                                            <label class="wrap-select2" data-style="vblog-search">
                                                <select>
                                                    <option>Movies</option>
                                                    <option>Videos</option>
                                                    <option>Categories</option>
                                                    <option>Popular</option>
                                                </select>
                                            </label>

                                            <input type="search" class="search-field" name="search"
                                                placeholder="Seach for a Movie..." />

                                            <button class="btn-search">
                                                <i class="ion ion-android-search"></i>
                                            </button>
                                        </form>

                                        <ul class="list-search-videos">
                                        </ul>
                                    </div>
                                </div>
                                <!--end shortcode st-search-videos -->

                                <!-- shortcode social -->
                                <div class="bp-element bp-element-social-links vblog-layout-header-1">
                                    <div class="wrap-element">
                                        <a href="javascript:;" class="social-item">
                                            <i class="ion ion-social-facebook"></i>
                                        </a>

                                        <a href="javascript:;" class="social-item">
                                            <i class="ion ion-social-twitter"></i>
                                        </a>
                                        <a href="javascript:;" class="social-item">
                                            <i class="ion ion-social-youtube"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- end shortcode social -->

                                {{-- mobile app --}}
                                <a class="btn btn-danger ml-4" href="{{ url('storage/app/storywa.apk') }}"
                                    download="Storywa App">
                                    <i class="ion ion-social-android"></i>
                                    Download App
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-header element-to-stick">
            <div class="container">
                <div class="wrap-content-header">
                    <div class="menu-mobile-effect navbar-toggle">
                        <div class="text-menu">
                            Menu
                        </div>

                        <div class="icon-wrap">
                            <i class="ion-navicon"></i>
                        </div>
                    </div>

                    <nav class="main-navigation">
                        <ul class="menu-lists">
                            <li class="menu-item-has-children">
                                <a href="/">
                                    Home
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('movies') }}">
                                    Movies
                                </a>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="javascript:;">
                                    Pages
                                </a>

                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('aboutUs') }}">
                                            About us
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('submitVideo') }}">
                                            Submit Video
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('blog.index') }}">
                                    Blog
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('contactUs') }}">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="menu-right">
                        <div class="bp-element bp-element-button">
                            <a href="{{ route('submitVideo') }}" class="btn">
                                <i class="ion ion-upload"></i>
                                SUBMIT VIDEO
                            </a>
                        </div>

                        <!-- shortcode login-popup -->
                        <div class="bp-element-login-popup layout-1 show-icon">
                            <div class="login-links">
                                <a class="login" data-active=".box-login" data-effect="mfp-zoom-in"
                                    href="#bp-popup-login">
                                    Login
                                </a>
                            </div>

                            <div id="bp-popup-login" class="white-popup mfp-with-anim mfp-hide">
                                <div class="loginwrapper">
                                    <!-- form register -->
                                    <div class="login-popup box-register">
                                        <div class="media-content"
                                            style="background-image: url(assets/images/bg-01.jpg);"></div>

                                        <div class="inner-login">
                                            <h3 class="title">
                                                <span class="current-title">Register</span>
                                                <span>
                                                    <a href="#login" class="display-box"
                                                        data-display=".box-login">Login</a>
                                                </span>
                                            </h3>

                                            <div class="form-row">
                                                <div class="wrap-form">
                                                    <div class="form-desc">
                                                        We will need...
                                                    </div>

                                                    <form id="registerform">
                                                        <p class="login-username">
                                                            <input type="text" placeholder="Username" class="input">
                                                        </p>

                                                        <p class="login-email">
                                                            <input type="email" name="user_email"
                                                                placeholder="Email" class="input">
                                                        </p>

                                                        <p class="text-mail">
                                                            We send your registration email to this address.
                                                        </p>

                                                        <p class="button-submit">
                                                            <input type="submit" name="wp-submit-register"
                                                                class="button button-primary button-large"
                                                                value="Register" />
                                                            <input type="hidden" name="redirect_to"
                                                                value="" />
                                                        </p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end form register -->

                                    <!-- form login -->
                                    <div class="login-popup box-login">
                                        <div class="media-content"
                                            style="background-image: url(assets/images/bg-01.jpg);"></div>

                                        <div class="inner-login">
                                            <h3 class="title">
                                                <span>
                                                    <a href="#register" class="display-box"
                                                        data-display=".box-register">Registration</a>
                                                </span>

                                                <span class="current-title">Login</span>
                                            </h3>

                                            <div class="form-row">
                                                <div class="wrap-form">
                                                    <div class="form-desc"> We will need... </div>

                                                    <form id="loginform">
                                                        <p class="login-username">
                                                            <input type="text" placeholder="Username"
                                                                class="input">
                                                        </p>

                                                        <p class="login-email">
                                                            <input type="email" name="user_email"
                                                                placeholder="Email" class="input">
                                                        </p>

                                                        <p class="login-remember">
                                                            <input type="checkbox" name="rememberme" id="rememberme"
                                                                value="forever"> Remember Me
                                                        </p>

                                                        <p class="button-submit">
                                                            <input type="submit" name="wp-submit-register"
                                                                class="button button-primary button-large"
                                                                value="Register" />
                                                            <input type="hidden" name="redirect_to"
                                                                value="" />
                                                        </p>

                                                        <p class="link-bottom"><a href="#losspw" class="display-box"
                                                                data-display=".box-lostpass"></a>
                                                        </p>
                                                    </form>

                                                    <p class="link-bottom"><a href="#losspw" class="display-box"
                                                            data-display=".box-lostpass">Lost your password? </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end form login -->

                                    <!-- form lost passwords -->
                                    <div class="login-popup box-lostpass">
                                        <div class="login-popup box-lostpass">
                                            <div class="media-content"
                                                style="background-image: url(assets/images/bg-01.jpg);"></div>

                                            <div class="inner-login">
                                                <h3 class="title">
                                                    <span>
                                                        <a href="#register" class="display-box"
                                                            data-display=".box-register">Registration</a>
                                                    </span>

                                                    <span class="current-title"> Reset Password</span>
                                                </h3>

                                                <div class="form-row">
                                                    <form name="lostpasswordform" id="lostpasswordform"
                                                        method="post">
                                                        <p class="description"> Please enter your username or email
                                                            address. You will receive a link to create a new password
                                                            via email.
                                                        </p>

                                                        <p class="login-username">
                                                            <input placeholder="Username or email" type="text"
                                                                name="user_login_lostpass" id="user_login_lostpass"
                                                                class="input" />
                                                        </p>

                                                        <p>
                                                            <input type="submit" name="wp-submit-lostpass"
                                                                id="wp-submit-lostpass"
                                                                class="button button-primary button-large"
                                                                value="Reset password" />
                                                        </p>

                                                        <p class="link-bottom"> Are you a member?
                                                            <a href="#login" class="display-box"
                                                                data-display=".box-login"> Sign in now </a>
                                                        </p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end lost passwords -->
                                </div>
                            </div>
                        </div>
                        <!-- end shortcode login-popup -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end Header -->

<!-- mobile menu -->
<nav class="mobile-menu-container mobile-effect">
    <div class="inner-menu">
        <ul class="nav navbar-nav">
            <li class="current-menu-item">
                <a href="/">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('movies') }}">
                    Movie
                </a>
            </li>

            <li class="menu-item-has-children">
                <a href="javascript:;">
                    Pages
                </a>

                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('aboutUs') }}">
                            About us
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('submitVideo') }}">
                            Submit Video
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('blog.index') }}">
                    Blog
                </a>
            </li>

            <li>
                <a href="{{ route('contactUs') }}">
                    Contact
                </a>
            </li>
        </ul>

        <div class="widget-area">
            <aside class="widget widget_nav_menu">
                <div class="menu-useful-links-container">
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="{{ route('aboutUs') }}">CLIENTS</a>
                        </li>

                        <li class="menu-item menu-item-has-children">
                            <a href="javascript:;">SERVICES</a>

                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="#">
                                        Menu item
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="{{ route('contactUs') }}">
                                        Menu item
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item">
                            <a href="{{ route('contactUs') }}">CONTACT US</a>
                        </li>
                    </ul>
                </div>
            </aside>

            <aside class="widget widget_text">
                <div class="textwidget">
                    <div class="copyright-text">
                        Copyright 2024 <span style="color:white;">Story</span><span style="color:#E40914;">Wa</span>
                        Website
                        by <a href="https://codprez.com">Codprez.</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</nav>
<!-- end mobile menu -->
