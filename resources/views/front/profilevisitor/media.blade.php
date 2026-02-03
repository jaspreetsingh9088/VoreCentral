<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Media</title>

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
    <style>
        .notifications-list{
            top: 115px;
        }
        .gallery_audio header .navbar-bottom .navbar-nav .nav-item .nav-link {
            border-right: 0px;
        }

        .navbar-nav li:hover>ul.dropdown-menu {
            display: block;
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
        }

        /* rotate caret on hover */
        .dropdown-menu>li>a:hover:after {
            text-decoration: underline;
            transform: rotate(-90deg);
        }

        ul.dropdown-menu {
            margin: 0px;
            border-radius: 0px;
            padding: 0px;
            border: 0px;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            border-bottom: 1px solid #e3e3e3;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #123e12;
            color: #fff;
        }

        .buttons-container {
            text-align: right;
            margin-top: -40px;
        }

        .creator_logo h2 {
            background: #fff;
            margin-top: 8px;
            padding: 48px 8px;
            font-size: 19px;
            margin: 0px;
        }

        .form-control {
            border: #000 solid 1px;
            border-radius: 0px !important;
        }

        .btn-outline-primary {
            background-color: #000;
            color: #FFFFFF;
            border-radius: 0px !important;
        }
        .navbar-top{
            padding: 46px 0 !important;
        }
        .banner_homebutton{
            background: #001bb2;
            color: black !important;
            padding: 14px 78px !important;
            position: absolute;
            font-weight: 900;
            line-height: 14px;
            font-size: 20px;
            z-index: 9999;
        }
        .banner_homebutton:hove{
            background: #001bb2 !important;
        }
        @media only screen and (min-width: 761px) and (max-width: 1023px) {
            .banner_homebutton {
                top: 30px;
                right: 50%;
            }
        }
    </style>
    <!-- endinject -->
</head>

<body class="green_theme gallery_audio" style="font-family:{{ $font }}">
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <a href="{{ route('home') }}" class="btn btn-success banner_homebutton">Home</a>
                <div class="container">
                    <div class="row">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="navbar-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div style="margin-left : 200px;">
                                        <div class="creator_logo">
                                            <label for="creator-logo">
                                                <img style="width: 120px;height: 120px;" src="{{ $myData[0]['profile_pic'] }}" />
                                            </label>
                                            <input type="file" id="creator-logo" style="display:none;" />
                                        </div>
                                    </div>
                                    <div class="right-bar">
                                        @include('front.profilevisitor.layout.navbar-top-right-menu')
                                        {{-- <ul class="social-icons">
                                            <li><a href="{{ env('APP_YOU_TUBE_LINK', '#')  }}"><img src="{{ url('public/assets/images/youtube.png') }}" alt=""></a></li>
                                            <li><a href="{{ env('APP_TWITTER_LINK', '#')  }}"><img src="{{ url('public/assets/images/twitter.png') }}" alt=""></a></li>
                                        </ul> --}}
                                    </div>
                                    {{-- @include('front.layouts.navbar-top') --}}
                                </div>
                            </div>
                            <div class="navbar-bottom">
                                <div class="">
                                    <div>
                                        <button class="navbar-toggler" type="button"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span> </button>
                                        <div class="navbar-collapse justify-content-center collapse"
                                            id="navbarSupportedContent">
                                            <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                                <li>
                                                    <button class="navbar-close"><img src="{{ url('public/assets/images/close.png') }}" alt=""> </button>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="{{ route('featuredgallery',[$creatore->id,'all']) }}">Featured</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ URL($creatore->id.'/gallery/new') }}">Latest</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('profile.visitore.media',[$creatore->id,'Literature']) }}">Literature</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('profile.visitore.media',[$creatore->id,'Picture']) }}">Pictures</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('profile.visitore.media',[$creatore->id,'Comic']) }}">Comics</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('profile.visitore.media',[$creatore->id,'Video']) }}">videos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('profile.visitore.media',[$creatore->id,'Games']) }}">Games</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('profile.visitore.media',[$creatore->id,'Audio']) }}"">Audio</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Others</a>
                                                    <ul class="submenu">
                                                        <li> <a class="" href="{{ route('visitores.gallery.prioritiseTags',[$creatore->id]) }}">Prioritise my tags</a></li>
                                                        <li> <a class="" href="{{ route('visitores.gallery.recency',[$creatore->id]) }}">Prioritise recency</a></li>
                                                        <li> <a class="" href="{{ route('visitores.gallery.prioritisePopularity',[$creatore->id]) }}">Prioritise popularity</a></li>
                                                        <li> <a class="" href="{{ route('publicgallery.random') }}">RANDOM</a></li>
                                                        <li> <a class="" href="{{ route('publicgallery.creators') }}">Creators</a></li>
                                                        <li> <a class="" href="{{ URL('dlc') }}">DLC</a></li>
                                                        <li> <a class="" href="{{ route('generalSetting') }}">Options</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>

                    </div>
                </div>
            </header>

            <!-- partial -->
            <div class="content-wrapper">
                <div class="container">

                    <div class="row gallery_audio_sect" data-aos="fade-up">

                        <div class="col-xl-2 p-1">
                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>
                        </div>

                        <div class="col-xl-8  grid-margin">

                            <div class="input-group">
                                <input type="search" class="form-control rounded" placeholder="Search"
                                    aria-label="Search" aria-describedby="search-addon">
                                <button type="button" class="btn btn-outline-primary"
                                    style="height: 52px;">search</button>

                                <ul style="width: 135px;padding: 10px;margin: 0px 10px;">
                                    <li><a href="{{ URL('gallery/new') }}"> Newest first </a></li>
                                    <li><a href="{{ URL('gallery/view') }}">Most Viewed</a></li>
                                    <li><a href="{{ URL('gallery/old') }}">Oldest First</a></li>
                                    <li><a href="{{ URL('gallery/fav') }}">Most favorited</a></li>
                                    <li><a href="{{ URL('gallery/random') }}">Random Order</a></li>
                                </ul>
                            </div>

                            <div class="gallery_audio_listing">
                                <ul>
                                    @if (isset($UsercontentData) && count($UsercontentData) > 0)
                                        @foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV)
                                            <li>
                                              <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}"
                                                    class=""><img src="{{ $UsercontentDataV['thumbnail'] }}"
                                                        alt="thumb" class="img-fluid "></a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            {{ $UsercontentData->links() }}
                        </div>

                        <div class="col-xl-2">
                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>
                        </div>
  
                    </div>

                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-12">
                            <div class="ad_banner landscape">
                                <div data-banner-id="425470"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- main-panel ends -->
            <!-- container-scroller ends -->

            <!-- partial:partials/_footer.html -->
            <footer>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="fs-14 font-weight-600">
                                        <ul class="footer_menu">
                                            <li>
                                                <a href="{{ URL('contactus') }}">Contact us</a>
                                            </li>

                                            <li>
                                                <a href="{{ URL('aboutus') }}">About us</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('privacypolicy') }}">Privacy Policy</a>
                                            </li>

                                            <li>
                                                <a href="{{route('termsservice')}}">Terms of Service</a>
                                            </li>
                                        </ul>


                                        © {{ date('Y') }}. All rights reserved.
                                    </div>
                                    {{-- <ul class="social-media mb-3">
                                        <li>
                                            <a href="{{ env('APP_YOU_TUBE_LINK', '#')  }}">
                                                <img src="{{ url('public/assets/images/youtube.png') }}" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ env('APP_TWITTER_LINK', '#')  }}">
                                                <img src="{{ url('public/assets/images/twitter.png') }}" alt="">
                                            </a>
                                        </li>
                                    </ul> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- partial -->
        </div>
    </div>
    <!-- inject:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="./assets/js/demo.js"></script>
    <script src="./assets/js/jquery.easeScroll.js"></script>

    <!-- End custom js for this page-->
</body>

</html>
