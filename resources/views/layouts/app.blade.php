<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/mine.css')}}">

</head>
<body>


    <div id="app">


        <!-- Preloader -->
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <!-- End preloader -->

        <!-- ##### Header Area Start ##### -->
        <header class="header-area">
            <!-- Top Header Area -->
            <div class="top-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <!-- Breaking News Widget -->
                            <div class="breaking-news-area d-flex align-items-center">
                                <div class="news-title">
                                    <p>Breaking News:</p>
                                </div>
                                <div id="breakingNewsTicker" class="ticker">
                                    <ul>
                                        <li><a href="single-post.html">10 Things Amazon Echo Can Do</a></li>
                                        <li><a href="single-post.html">Welcome to Colorlib Family.</a></li>
                                        <li><a href="single-post.html">Boys 'doing well' after Thai</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="top-meta-data d-flex align-items-center justify-content-between">
                                <!-- Top Social Info -->
                                <div class="top-social-info">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                                <!-- Top Search Area -->

                                <!-- Login -->

                                <a href="login.html" class="login-btn"><i class="fa fa-user" aria-hidden="true"></i></a>


                                    <ul>
                                        <!-- Authentication Links -->
                                        @guest
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                            @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        {{ Auth::user()->full_name }} <span class="caret"></span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}</a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>

                                            @endif
                                        @else
                                            <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->full_name }} <span class="caret"></span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}</a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @endguest
                                    </ul>




                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navbar Area -->
            <div class="vizew-main-menu" id="sticker">
                <div class="classy-nav-container breakpoint-off">
                    <div class="container">

                        <!-- Menu -->
                        <nav class="classy-navbar justify-content-between" id="vizewNav">

                            <!-- Nav brand -->
                            <a href="index.html" class="nav-brand">Brand</a>

                            <!-- Navbar Toggler -->
                            <div class="classy-navbar-toggler">
                                <span class="navbarToggler"><span></span><span></span><span></span></span>
                            </div>

                            <div class="classy-menu">

                                <!-- Close Button -->
                                <div class="classycloseIcon">
                                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                                </div>

                                <!-- Nav Start -->
                                <div class="classynav">
                                    <ul>
                                        <li class="active"><a href="{{route('home')}}">Home</a></li>
                                        <li><a href="archive-list.html">Archives</a></li>
                                        <li><a href="#">Pages</a>
                                            <ul class="dropdown">
                                                <li><a href="#">- Home</a></li>
                                                <li><a href="archive-list.html">- Archive List</a></li>
                                                <li><a href="archive-grid.html">- Archive Grid</a></li>
                                                <li><a href="single-post.html">- Single Post</a></li>
                                                <li><a href="video-post.html">- Single Video Post</a></li>
                                                <li><a href="contact.html">- Contact</a></li>
                                                <li><a href="typography.html">- Typography</a></li>
                                                <li><a href="login.html">- Login</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Features</a>
                                            <div class="megamenu">
                                                <ul class="single-mega cn-col-4">
                                                    <li><a href="index.html">- Home</a></li>
                                                    <li><a href="archive-list.html">- Archive List</a></li>
                                                    <li><a href="archive-grid.html">- Archive Grid</a></li>
                                                    <li><a href="single-post.html">- Single Post</a></li>
                                                    <li><a href="video-post.html">- Single Video Post</a></li>
                                                    <li><a href="contact.html">- Contact</a></li>
                                                    <li><a href="typography.html">- Typography</a></li>
                                                    <li><a href="login.html">- Login</a></li>
                                                </ul>
                                                <ul class="single-mega cn-col-4">
                                                    <li><a href="index.html">- Home</a></li>
                                                    <li><a href="archive-list.html">- Archive List</a></li>
                                                    <li><a href="archive-grid.html">- Archive Grid</a></li>
                                                    <li><a href="single-post.html">- Single Post</a></li>
                                                    <li><a href="video-post.html">- Single Video Post</a></li>
                                                    <li><a href="contact.html">- Contact</a></li>
                                                    <li><a href="typography.html">- Typography</a></li>
                                                    <li><a href="login.html">- Login</a></li>
                                                </ul>
                                                <ul class="single-mega cn-col-4">
                                                    <li><a href="index.html">- Home</a></li>
                                                    <li><a href="archive-list.html">- Archive List</a></li>
                                                    <li><a href="archive-grid.html">- Archive Grid</a></li>
                                                    <li><a href="single-post.html">- Single Post</a></li>
                                                    <li><a href="video-post.html">- Single Video Post</a></li>
                                                    <li><a href="contact.html">- Contact</a></li>
                                                    <li><a href="typography.html">- Typography</a></li>
                                                    <li><a href="login.html">- Login</a></li>
                                                </ul>
                                                <ul class="single-mega cn-col-4">
                                                    <li><a href="index.html">- Home</a></li>
                                                    <li><a href="archive-list.html">- Archive List</a></li>
                                                    <li><a href="archive-grid.html">- Archive Grid</a></li>
                                                    <li><a href="single-post.html">- Single Post</a></li>
                                                    <li><a href="video-post.html">- Single Video Post</a></li>
                                                    <li><a href="contact.html">- Contact</a></li>
                                                    <li><a href="typography.html">- Typography</a></li>
                                                    <li><a href="login.html">- Login</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </div>
                                <!-- Nav End -->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- ##### Header Area End ##### -->





            @yield('content')




    </div> <!--- #app div close --->



    <!-- ##### All Javascript Script ############################################################################## -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('frontend/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('frontend/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('frontend/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('frontend/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('frontend/js/active.js')}}"></script>
    <script>

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>

    @yield('ajax-frontend')

</body>
</html>
