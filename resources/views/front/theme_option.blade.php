<!DOCTYPE html>

<html lang="en">

<head>

    <title>Theme Option</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
          <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">

    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <style>
        .theme_option_block li {
            text-decoration: none;
        }
    </style>
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
</head>
<body class="blue_theme bg_pattern">

<header id="header" class="equal-menus">

    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light">

            <div class="navbar-top">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <a class="navbar-brand" href="{{ route('home') }}">HOME</a>

                    </div>
                    @include('front.layouts.navbar-top')
                </div>

            </div>

            <div class="navbar-bottom">

                <div class="">


                    <div>

                        <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="navbar-collapse collapse" id="navbarSupportedContent">


                            <ul class="navbar-nav mx-auto nav-justify text-center w-100">
                                <li>
                                    <button class="navbar-close"><img src="{{ url('public/assets/images/close.png') }}" alt=""></button>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('publicgallery.featured') }}">gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('forum') }}">Forums</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL('subscription/1') }}">MY ARTISTS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>
                                </li>
                                @if (Auth::check())
                                    @if(Auth::user()->creator == 0)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{URL('/dashboard')}}">My page</a>
                                        </li>
                                    @elseif(Auth::user()->creator == 1)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{URL('/creatordashboard')}}">Creator
                                                Dashboard</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('mytopics') }}">MY TOPICS</a>
                                    </li>
                                @endif
                            </ul>

                        </div>

                    </div>


                </div>

            </div>

        </nav>

    </div>

</header>

<!-- secondary header-->

<div class="option_theme secondary_header mt-5">

    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">

            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="navbar-collapse collapse justify-content-start" id="navbar10">

                    <ul class="navbar-nav nav-fill w-100">

                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('generalSetting')}}">General</a></li>

                        <li class="nav-item"><a class="nav-link" href="#">Sorting and search settings</a></li>

                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('tagOption')}}">Tag settings</a></li>

                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('notificationOption')}}">Notifications and
                                Privacy</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('technicalOption')}}">Technical settings
                                etc</a></li>

                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('themeOption')}}">Theme Settings</a></li>

                        <li class="nav-item"><a class="nav-link"
                                                href="{{ route('socialOption')}}">Social</a></li>

                    </ul>

                </div>

            </div>

        </nav>

    </div>

</div>


<!-- main content start -->

<section class="viewhistory-wrapper">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-1">

            </div>

            <div class="col-lg-10">
                <form method="post" action="{{ route('themeOptionStore')}}">

                    @csrf
                    <div class="news_archieve_wrapper">

                        <div class="theme_option_block blue-b">

                            <h2>Homepage</h2>

                            <ul class="list-none">

                                <li style="padding: 0px 23px;"><input type="radio" name="homepage_theme"
                                                                      value="blue_theme" id="homepageblue"/><label
                                        for="homepageblue"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label></li>

                                <li style="padding: 0px 23px;"><input type="radio" name="homepage_theme"
                                                                      value="green_theme" id="homepagegreen"
                                                                      checked="checked"/><label for="homepagegreen"
                                                                                                style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label>
                                </li>

                                <li style="padding: 0px 23px;"><input type="radio" name="homepage_theme"
                                                                      value="orange_theme" id="homepageorange"/><label
                                        for="homepageorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>

                                <li style="padding: 0px 23px;"><input type="radio" name="homepage_theme"
                                                                      value="red_theme" id="homepagered"/><label
                                        for="homepagered"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label></li>

                            </ul>

                        </div>

                        <div class="theme_option_block green-b">

                            <h2>Gallery</h2>

                            <ul class="list-none">

                                <li style="padding: 0px 23px;"><input type="radio" name="gallery_theme"
                                                                      value="blue_theme" id="galleryblue"/><label
                                        for="galleryblue"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label></li>

                                <li style="padding: 0px 23px;"><input type="radio" name="gallery_theme"
                                                                      value="green_theme" id="gallerygreen"/><label
                                        for="gallerygreen" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label>
                                </li>

                                <li style="padding: 0px 23px;"><input type="radio" name="gallery_theme"
                                                                      value="orange_theme" id="galleryorange"/><label
                                        for="galleryorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>

                                <li style="padding: 0px 23px;"><input type="radio" name="gallery_theme"
                                                                      value="red_theme" id="galleryred"/><label
                                        for="galleryred"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label></li>

                            </ul>

                        </div>

                        <div class="theme_option_block orange-b">

                            <h2>Forums</h2>

                            <ul class="list-none">

                                <li style="padding: 0px 23px;"><input type="radio" name="forums_theme"
                                                                      value="blue_theme" id="forumsblue"/><label
                                        for="forumsblue"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label></li>

                                <li style="padding: 0px 23px;"><input type="radio" name="forums_theme"
                                                                      value="green_theme" id="forumsgreen"/><label
                                        for="forumsgreen"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label></li>

                                <li style="padding: 0px 23px;"><input type="radio" name="forums_theme"
                                                                      value="orange_theme" id="forumsorange"/><label
                                        for="forumsorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>

                                <li style="padding: 0px 23px;"><input type="radio" name="forums_theme" value="red_theme"
                                                                      id="forumsred"/><label for="forumsred"
                                                                                             style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label>
                                </li>

                            </ul>

                        </div>

                        <div class="theme_option_block red-b">

                            <h2>Others</h2>

                            <ul class="list-none">

                                <li style="padding: 0px 23px;"><input type="radio" name="others_theme"
                                                                      value="blue_theme" id="othersblue"/><label
                                        for="othersblue"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label></li>

                                <li style="padding: 0px 23px;"><input type="radio" name="others_theme"
                                                                      value="green_theme" id="othersgreen"/><label
                                        for="othersgreen"
                                        style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label></li>

                                <li style="padding: 0px 23px;"><input type="radio" name="others_theme"
                                                                      value="orange_theme" id="othersorange"/><label
                                        for="othersorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>

                                <li style="padding: 0px 23px;"><input type="radio" name="others_theme" value="red"
                                                                      id="othersred"/><label for="othersred"
                                                                                             style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label>
                                </li>

                            </ul>

                        </div>


                        <div class="col-lg-12" style="text-align:right;">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn-info btn" value="Submit"
                                       style="background: #fff;color: #a80000;font-weight: bold;padding: 15px 45px;">
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-lg-1">

            </div>

        </div>

    </div>

</section>

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

                            © 2022. All rights reserved.

                        </div>

                        <ul class="social-media mb-3">
                            <li>
                                <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                                    <i class="mdi mdi-youtube"></i>
                                    <span class="sr-only">{{ env('APP_NAME')  }} Youtube</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ env('APP_TWITTER_LINK', '#') }}">
                                    <i class="mdi mdi-twitter"></i>
                                    <span class="sr-only">{{ env('APP_NAME')  }} Twitter</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>
</body>
</html>
