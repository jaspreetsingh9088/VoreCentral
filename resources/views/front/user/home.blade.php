<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title></title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}" />
</head>

<body>
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a class="navbar-brand" href="#">Home</a>
                                </div>

                                <ul class="navbar-top-right-menu">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Register</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Login</a>
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
                                    <div class="navbar-collapse justify-content-center collapse"
                                        id="navbarSupportedContent">
                                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                            <li>
                                                <button class="navbar-close">
                                                    <img src="{{ url('public/assets/images/close.png') }}" alt="">
                                                </button>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                                            </li>
                                            @if(Auth::check())
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('forum')}}">Forums</a>
                                                </li>
                                            @endif
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{URL('subscription/1')}}">Subscriptions</a>
                                            </li>
                                            @if (Auth::check())
                                                @if(Auth::user()->creator == 0)
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{URL('/dashboard')}}">My page</a>
                                                    </li>
                                                @elseif(Auth::user()->creator == 1)
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{URL('/creatordashboard')}}">Creator Dashboard</a>
                                                    </li>
                                                @endif
                                            @endif
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('publicstore')}}">Store</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Options</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Misc</a>
                                                <ul class="submenu">
                                                    <li><a class="" href="{{ route('onlineuser') }}">Online Users</a></li>
                                                    <li><a class="" href="{{ URL('aboutus') }}">About us</a></li>
                                                    <li><a class="" href="{{ URL('contactus') }}">Contact us</a></li>
                                                    <li>
                                                        <a class="" href="{{ route('content.promoted.produced') }}">Content produced and promoted</a>
                                                    </li>
                                                    <li>
                                                        <a class="" href="{{ route('creator.information.monetisation') }}">Creator Information and Monetisation</a>
                                                    </li>
                                                    <li><a class="" href="{{ route('helpandsupport') }}">Help and Support</a></li>
                                                    <li>
                                                        <a class="" href="{{ route('information.different.subject') }}">Information about different subjects</a>
                                                    </li>
                                                    <li><a class="" href="{{URL('news_archieve')}}">News archive</a></li>
                                                    <li><a class="" href="{{URL('ourstaff')}}">Our staff</a></li>
                                                    <li>
                                                        <a class="" href="{{ route('privacypolicy') }}">Privacy Policy</a>
                                                    </li>
                                                    <li>
                                                        <a class="" href="{{route('termsservice')}}">Terms and Service</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>

            <!-- partial -->
            <div class="flash-news-banner">
                <div class="container">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <p class="mb-0"></p>
                        </div>
                        <div class="d-flex search_box">
                            <span class="mr-3 text-danger">
                                <div class="input-group">
                                    <input type="search" class="form-control rounded" placeholder="Search"
                                        aria-label="Search" aria-describedby="search-addon" />
                                    <button type="button" class="btn btn-outline-primary">
                                        search
                                    </button>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">
                <div class="container">
                    <div class="row" data-aos="fade-up">
                        <div class="col-xl-4">
                            <div class="group-image">
                                <div class="left">
                                    <div class="item bg-1">
                                        <img src="assets/images/item-08.webp" alt="Monteno" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 grid-margin">
                            <div class="position-relative about_cont">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a
                                    type specimen book. It has survived not only five centuries,
                                </p>

                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s,
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row slider_carousal" data-aos="fade-up">
                        <div class="col-sm-12">
                            <div id="demo" class="carousel slide" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="assets/images/news_banner.png" alt="thumb" class="img-fluid" />
                                        <div class="carousel-caption">
                                            <h3>
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting
                                            </h3>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the
                                                industry's standard dummy
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/images/news_banner2.webp" alt="thumb" class="img-fluid" />
                                        <div class="carousel-caption">
                                            <h3>
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting
                                            </h3>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the
                                                industry's standard dummy
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/images/519704.webp" alt="thumb" class="img-fluid" />
                                        <div class="carousel-caption">
                                            <h3>
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting
                                            </h3>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the
                                                industry's standard dummy
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
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


                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-12 grid-margin">
                            <div class="card background_trns">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="featured_section">
                                                <div class="card-title">Latest Featured</div>
                                                <div class="row">
                                                    <div class="col-sm-12 grid-margin">
                                                        <div class="position-relative">
                                                            <div class="rotate-img featured_img">
                                                                <img src="assets/images/news_banner2.webp" alt="thumb"
                                                                    class="img-fluid" />
                                                            </div>
                                                            <div class="badge-positioned">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="badge badge-danger font-weight-bold">
                                                                        <h2 class="_1fIHu">The First Bastion
                                                                        </h2>
                                                                        <div class="I1wyK">
                                                                            <div class="MLhH5 _20813">
                                                                                <a href="#" class=""><img
                                                                                        alt="FrankAtt's avatar"
                                                                                        src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                        class="_3gigK"
                                                                                        width="25" height="25" /></a>
                                                                            </div>
                                                                            <div class="MLhH5 aWCtT">
                                                                                <a data-hook="user_link"
                                                                                    data-username="FrankAtt"
                                                                                    data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                    data-usertype="core_access"
                                                                                    data-userid="20723266"
                                                                                    data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                                    href="https://www.deviantart.com/frankatt"
                                                                                    class="user-link _1Zf8w"><span
                                                                                        class="_36cte">FrankAtt</span><span
                                                                                        class="_3pMl0 _2179b"
                                                                                        style="cursor: pointer"
                                                                                        title="Core Member"
                                                                                        aria-label="Core Member"
                                                                                        role="img"></span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dd">
                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">28</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>

                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">857</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M12,1L9,9L1,12L9,15L12,23L15,15L23,12L15,9L12,1Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="featured_section">
                                                <div class="card-title">Latest Featured</div>
                                                <div class="row">
                                                    <div class="col-sm-12 grid-margin">
                                                        <div class="position-relative">
                                                            <div class="rotate-img featured_img">
                                                                <img src="assets/images/news_banner.png" alt="thumb"
                                                                    class="img-fluid" />
                                                            </div>
                                                            <div class="badge-positioned">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="badge badge-danger font-weight-bold">
                                                                        <h2 class="_1fIHu">The First Bastion
                                                                        </h2>
                                                                        <div class="I1wyK">
                                                                            <div class="MLhH5 _20813">
                                                                                <a href="#" class=""><img
                                                                                        alt="FrankAtt's avatar"
                                                                                        src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                        class="_3gigK"
                                                                                        width="25" height="25" /></a>
                                                                            </div>
                                                                            <div class="MLhH5 aWCtT">
                                                                                <a data-hook="user_link"
                                                                                    data-username="FrankAtt"
                                                                                    data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                    data-usertype="core_access"
                                                                                    data-userid="20723266"
                                                                                    data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                                    href="https://www.deviantart.com/frankatt"
                                                                                    class="user-link _1Zf8w"><span
                                                                                        class="_36cte">FrankAtt</span><span
                                                                                        class="_3pMl0 _2179b"
                                                                                        style="cursor: pointer"
                                                                                        title="Core Member"
                                                                                        aria-label="Core Member"
                                                                                        role="img"></span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dd">
                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">28</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>

                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">857</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M12,1L9,9L1,12L9,15L12,23L15,15L23,12L15,9L12,1Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="featured_section">
                                                <div class="card-title">Latest Featured</div>
                                                <div class="row">
                                                    <div class="col-sm-12 grid-margin">
                                                        <div class="position-relative">
                                                            <div class="rotate-img featured_img">
                                                                <img src="assets/images/news_banner2.webp" alt="thumb"
                                                                    class="img-fluid" />
                                                            </div>
                                                            <div class="badge-positioned">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="badge badge-danger font-weight-bold">
                                                                        <h2 class="_1fIHu">The First Bastion
                                                                        </h2>
                                                                        <div class="I1wyK">
                                                                            <div class="MLhH5 _20813">
                                                                                <a href="#" class=""><img
                                                                                        alt="FrankAtt's avatar"
                                                                                        src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                        class="_3gigK"
                                                                                        width="25" height="25" /></a>
                                                                            </div>
                                                                            <div class="MLhH5 aWCtT">
                                                                                <a data-hook="user_link"
                                                                                    data-username="FrankAtt"
                                                                                    data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                    data-usertype="core_access"
                                                                                    data-userid="20723266"
                                                                                    data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                                    href="https://www.deviantart.com/frankatt"
                                                                                    class="user-link _1Zf8w"><span
                                                                                        class="_36cte">FrankAtt</span><span
                                                                                        class="_3pMl0 _2179b"
                                                                                        style="cursor: pointer"
                                                                                        title="Core Member"
                                                                                        aria-label="Core Member"
                                                                                        role="img"></span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dd">
                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">28</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>

                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">857</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M12,1L9,9L1,12L9,15L12,23L15,15L23,12L15,9L12,1Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="featured_section">
                                                <div class="card-title">Latest Featured</div>
                                                <div class="row">
                                                    <div class="col-sm-12 grid-margin">
                                                        <div class="position-relative">
                                                            <div class="rotate-img featured_img">
                                                                <img src="assets/images/1-the-titans-sandra-s-rush.webp"
                                                                    alt="thumb" class="img-fluid" />
                                                            </div>
                                                            <div class="badge-positioned">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="badge badge-danger font-weight-bold">
                                                                        <h2 class="_1fIHu">The First Bastion
                                                                        </h2>
                                                                        <div class="I1wyK">
                                                                            <div class="MLhH5 _20813">
                                                                                <a href="#" class=""><img
                                                                                        alt="FrankAtt's avatar"
                                                                                        src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                        class="_3gigK"
                                                                                        width="25" height="25" /></a>
                                                                            </div>
                                                                            <div class="MLhH5 aWCtT">
                                                                                <a data-hook="user_link"
                                                                                    data-username="FrankAtt"
                                                                                    data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                    data-usertype="core_access"
                                                                                    data-userid="20723266"
                                                                                    data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                                    href="https://www.deviantart.com/frankatt"
                                                                                    class="user-link _1Zf8w"><span
                                                                                        class="_36cte">FrankAtt</span><span
                                                                                        class="_3pMl0 _2179b"
                                                                                        style="cursor: pointer"
                                                                                        title="Core Member"
                                                                                        aria-label="Core Member"
                                                                                        role="img"></span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dd">
                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">28</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>

                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">857</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M12,1L9,9L1,12L9,15L12,23L15,15L23,12L15,9L12,1Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="featured_section">
                                                <div class="card-title">Latest Featured</div>
                                                <div class="row">
                                                    <div class="col-sm-12 grid-margin">
                                                        <div class="position-relative">
                                                            <div class="rotate-img featured_img">
                                                                <img src="assets/images/519704.webp" alt="thumb"
                                                                    class="img-fluid" />
                                                            </div>
                                                            <div class="badge-positioned">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="badge badge-danger font-weight-bold">
                                                                        <h2 class="_1fIHu">The First Bastion
                                                                        </h2>
                                                                        <div class="I1wyK">
                                                                            <div class="MLhH5 _20813">
                                                                                <a href="#" class=""><img
                                                                                        alt="FrankAtt's avatar"
                                                                                        src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                        class="_3gigK"
                                                                                        width="25" height="25" /></a>
                                                                            </div>
                                                                            <div class="MLhH5 aWCtT">
                                                                                <a data-hook="user_link"
                                                                                    data-username="FrankAtt"
                                                                                    data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                                    data-usertype="core_access"
                                                                                    data-userid="20723266"
                                                                                    data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                                    href="https://www.deviantart.com/frankatt"
                                                                                    class="user-link _1Zf8w"><span
                                                                                        class="_36cte">FrankAtt</span><span
                                                                                        class="_3pMl0 _2179b"
                                                                                        style="cursor: pointer"
                                                                                        title="Core Member"
                                                                                        aria-label="Core Member"
                                                                                        role="img"></span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dd">
                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">28</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>

                                                                        <div class="_2rLSm">
                                                                            <div class="_2-4qx">857</div>
                                                                            <span class="_2FP2V _2Gw-F _272Qs">
                                                                                <svg style="width: 20px; height: 20px"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path fill="currentColor"
                                                                                        d="M12,1L9,9L1,12L9,15L12,23L15,15L23,12L15,9L12,1Z" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 latest_video">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="card-title">Latest Upload</div>
                                            </div>
                                            <div class="right_cont">
                                                <div class="border-bottom pb-3">
                                                    <div class="latest_upload">
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-11.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-08.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-09.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-11.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-08.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-09.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                        <a href="#" class="rotate-img"><img
                                                                src="assets/images/item-11.webp" alt="thumb"
                                                                class="img-fluid" /></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="right_cont latest_post">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="card-title">Latest Topics</div>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-09.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-08.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="right_cont latest_post">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="card-title">Latest Posts</div>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-09.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-08.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="div-w-80 mr-3">
                                                        <div class="rotate-img">
                                                            <img src="assets/images/item-10.webp" alt="thumb"
                                                                class="img-fluid" />
                                                        </div>
                                                    </div>
                                                    <h3 class="font-weight-600 mb-0">
                                                        Lorem Ipsum is simply dummy text of the printing
                                                        and typesetting industry.
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="right_cont">
                                                <img src="assets/images/add.webp" alt="thumb" class="img-fluid" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

                                        © {{ date('Y') }}.  All rights reserved.
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

            <!-- partial -->
        </div>
    </div>
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
</body>

</html>
