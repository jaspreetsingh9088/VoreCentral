<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
</head>
<body class="orange_theme">
<header id="header" class="equal-menus">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="navbar-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a class="navbar-brand" href="#">FORUMS</a>
                    </div>
                    <ul class="navbar-top-right-menu">
                        <li class="nav-item">
                            <a href="#" class="inbox-view-message">Upload</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="bell_icon"><i class="fa fa-bell" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="inbox-view-message">Logout</a>
                        </li>

                    </ul>

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
                                    <button class="navbar-close">
                                        <img src="{{ url('public/assets/images/close.png') }}" alt="">
                                    </button>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('publicgallery.featured') }}">gallery</a>
                                </li>
                                @if (Auth::check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('forum')}}">Forums</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL('subscription/1')}}">Subscriptions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>
                                </li>
                                @if (Auth::check())
                                    @if(Auth::user()->creator == 0)
                                        ?>
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

<section class="pm-inbox-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 pr-0">
                <div class="pm-inbox-left">
                    <div class="pminbox_sidebar">
                        <ul class="list-none">
                            <li><a href="{{ route('pminbox')}}">Inbox</a></li>
                            <li><a href="{{ route('pmsendmessage')}}">Sent messages</a></li>
                            <li><a href="{{route('newpm')}}">New PM</a></li>
                            <li class="page_active"><a href="{{route('pmsendmessage')}}">Message users</a></li>
                            <li><a href="{{route('pmfriends')}}">Friends</a></li>
                            <li><a href="{{route('pmdraft')}}">Drafts</a></li>
                            <li><a href="#">Social Options</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="pm-inbox-adspace">
                    <img src="assets/images/add_b.webp" class="w-100" alt=""/>
                </div>
                <div class="row">
                    <div class="col-lg-8 p-0">
                        <div class="pm-inbox-middle pm-friends">
                            <ul class="list-none">


                                <li>
                                    <div class="pm-inbox-main">
                                        <div class="pm-friends-row pm-inbox-row-left">
                                            <div class="friend-image">
                                                <img
                                                    src="https://employeyarena.com/vore1/public/profilepic/1662641098.webp"
                                                    alt=""/>
                                            </div>
                                            <div class="friend-content">
                                                <h4 class="m-0">y@z.com</h4>
                                                <p class="m-0">Prey</p>
                                                <p class="m-0">Subject - Subject Of Message</p>
                                            </div>
                                        </div>
                                        <div class="pm-inbox-row-right">

                                            <a href="{{route('pminbox_message_view')}}" class="inbox-view-message">View
                                                Message</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pm-inbox-main">
                                        <div class="pm-friends-row pm-inbox-row-left">
                                            <div class="friend-image">
                                                <img
                                                    src="https://employeyarena.com/vore1/public/profilepic/1662797726.webp"
                                                    alt=""/>
                                            </div>
                                            <div class="friend-content">
                                                <h4 class="m-0">Rama</h4>
                                                <p class="m-0">Pred</p>
                                                <p class="m-0">Subject - Testing Subject</p>
                                            </div>
                                        </div>
                                        <div class="pm-inbox-row-right">

                                            <a href="{{route('pminbox_message_view')}}" class="inbox-view-message">View
                                                Message</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pm-inbox-main">
                                        <div class="pm-friends-row pm-inbox-row-left">
                                            <div class="friend-image">
                                                <img
                                                    src="https://employeyarena.com/vore1/public/profilepic/1662641098.webp"
                                                    alt=""/>
                                            </div>
                                            <div class="friend-content">
                                                <h4 class="m-0">y@z.com</h4>
                                                <p class="m-0">Prey</p>
                                                <p class="m-0">Subject - Test Subject For Message</p>
                                            </div>
                                        </div>
                                        <div class="pm-inbox-row-right">

                                            <a href="{{route('pminbox_message_view')}}" class="inbox-view-message">View
                                                Message</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 pl-0">
                        <div class="pm-inbox-right">

                        </div>
                    </div>
                </div>
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
                                <a href="#">
                                    <i class="mdi mdi-youtube"></i>
                                    <span class="sr-only">{{ env('APP_NAME')  }} Youtube</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
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
