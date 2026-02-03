<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description"
        content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>All Gallery</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    {{-- <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.3.67/css/materialdesignicons.min.css" integrity="sha512-nRzny9w0V2Y1/APe+iEhKAwGAc+K8QYCw4vJek3zXhdn92HtKt226zHs9id8eUq+uYJKaH2gPyuLcaG/dE5c7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>

    <style>
        .gallery_audio header .navbar-bottom .navbar-nav .nav-item .nav-link {
            border-right: 0px;
        }

        .navbar-nav li:hover>ul.dropdown-menu {
            display: block;
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

        .creator_logo h2 {
            background: #fff;
            margin-top: 8px;
            padding: 48px 8px;
            font-size: 19px;
            margin: 0px;
        }

        .btn-outline-primary {
            background-color: #000;
            color: #FFFFFF;
            border-radius: 0px !important;
        }

        .banner_homebutton {
            background: #1c621e;
            color: black !important;
            padding: 14px 85px !important;
            position: absolute;
            font-weight: 900;
            line-height: 14px;
            font-size: 20px;
            z-index: 9999;
        }

        .banner_homebutton:hove {
            background: #1c621e !important;
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
<livewire:cursor-style>

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
                                        <div style="margin-left: 200px;">
                                            <div class="creator_logo">
                                                <label for="creator-logo">
                                                    <img style="width: 120px;height: 120px;"
                                                        src="{{ $myData['profile_pic'] }}" />
                                                </label>
                                                <input type="file" id="creator-logo" style="display:none;" />
                                            </div>
                                        </div>
                                        @include('front.layouts.navbar-top')
                                    </div>
                                </div>
                                <div class="navbar-bottom">
                                    <div class="">

                                        <div>
                                            <button class="navbar-toggler" type="button"
                                                data-target="#navbarSupportedContent"
                                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                                aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span> </button>
                                            <div class="navbar-collapse justify-content-center collapse"
                                                id="navbarSupportedContent">
                                                <ul
                                                    class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                                    <li>
                                                        <button class="navbar-close">
                                                            <img src="{{ url('public/assets/images/close.png') }}" alt="">
                                                        </button>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ URL('/') }}">Home</a>
                                                    </li>

                                                    <li class="nav-item active">
                                                        <a class="nav-link"
                                                            href="{{ URL('featuredgallery/all') }}">Featured</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ URL('creatorgallery/all') }}">Gallery</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ URL('collection') }}">Collections</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link dropdown-toggle" href="#">Media
                                                            (Subtabs)</a>

                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ URL('media/Audio') }}">Audio</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ URL('media/Comic') }}">Comics</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ URL('media/Games') }}">Games</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ URL('media/Literature') }}">Literature</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ URL('media/Picture') }}">Pictures</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ URL('media/Random') }}">Randomly Generated
                                                                    Text</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ URL('media/Video') }}">Videos</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ URL('community') }}">Community</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ URL('groupfavourite') }}">Group
                                                            favorites</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ URL('creatorjournal') }}">Journal</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ URL('creatorwebstore') }}">Webstore</a>
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
                                    <input type="text" placeholder="Search.." style="width:77%; ">
                                    <button type="button" class="btn btn-outline-primary"
                                        style="height: 46px; margin: left 4px;background: #195519; font-weight: 500; font-stretch: normal; font-style: normal; font-size: 17px;">Search</button>
                                    <div class="dropdown">
                                        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown"
                                            style="background:#195519; color:#fff; font-weight: 500; font-stretch: normal; font-style: normal;font-size: 17px; margin-left: 7px;padding: 11px 23px 7px 18px;">
                                            Filter
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ URL('gallery/new') }}">Newest first </a>
                                            <a class="dropdown-item" href="{{ URL('gallery/view') }}">Most Viewed</a>
                                            <a class="dropdown-item" href="{{ URL('gallery/old') }}">Oldest First</a>
                                            <a class="dropdown-item" href="{{ URL('gallery/fav') }}">Most favorited</a>
                                            <a class="dropdown-item" href="{{ URL('gallery/random') }}">Random Order</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="gallery_audio_listing">
                                    <ul>
                                        <?php
                                        if (count($UsercontentData) > 0) {
                                            if (!is_null($UsercontentData)) {
                                                foreach ($UsercontentData as $UsercontentDataV) {
                                                    ?>
                                                    <li>
                                                        <a href="{{ URL('contentdetail/' . $UsercontentDataV->id) }}" class="">
                                                            <img src="{{ $UsercontentDataV->thumbnail }}" alt="thumb"
                                                                class="img-fluid">
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        } else { ?>
                                        <h3 class="text-center" style="color: #000;">You do not have any content yet.
                                            Please add to view here</h3>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <nav aria-label="Page navigation example" class="clearfix">
                                    {{ $UsercontentData->links('vendor.pagination.bootstrap-5') }}
                                </nav>
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
                @include('front.layouts.footer')
                <!-- partial -->
            </div>
        </div>
        <!-- inject:js -->
        <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- plugin js for this page -->
        {{-- <script src="{{asset('assets/vendors/aos/dist/aos.js/aos.js')}}"></script> --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        <script src="{{asset('assets/js/demo.js')}}"></script>
        <script src="{{asset('assets/js/jquery.easeScroll.js')}}"></script>

        <!-- End custom js for this page-->
    </body>

</html>
