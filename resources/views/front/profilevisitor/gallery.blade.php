<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="description"
              content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <title>Gallery</title>
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
        <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}" />
        <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
        <style>
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
        </style>
    </head>
<body class="green_theme" style="font-family:{{ $font }}">
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <a href="{{ route('home') }}" class="btn btn-success banner_homebutton">Home</a>
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div> </div>
                                <div class="right-bar">
                                    @include('front.profilevisitor.layout.navbar-top-right-menu')
                                    {{-- <ul class="social-icons">
                                        <li><a href="{{ env('APP_YOU_TUBE_LINK', '#')  }}"><img src="{{ url('public/assets/images/youtube.png') }}" alt=""></a></li>
                                        <li><a href="{{ env('APP_TWITTER_LINK', '#')  }}"><img src="{{ url('public/assets/images/twitter.png') }}" alt=""></a></li>
                                    </ul> --}}
                                </div>
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
            </header>

            <!-- partial -->
            <div class="flash-news-banner">
                <div class="container">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">

                            <p class="mb-0">

                            </p>
                        </div>
                        <div class="d-flex gallery_tab">
                            <ul class="">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Creators</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Random</a>
                                </li>

                            </ul>

                        </div>


                    </div>
                </div>
            </div>
            <div class="content-wrapper">
                <div class="container">

                    <div class="row gallery_main" data-aos="fade-up">
                        <div class="col-xl-3 p-1">
                            <div class="gallery_featured_menu">
                                <ul class="featured_menu">
                                    <li>
                                        <a href="{{ route('featuredgallery',[$creatore->id,'all']) }}">
                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z" />
                                            </svg>Featured
                                        </a>
                                    </li>
                                    <li><a href="{{ route('visitores.gallery.recency',[$creatore->id]) }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z" />
                                            </svg>Prioritise Recency</a></li>
                                    <li>
                                        <a href="{{ route('visitores.gallery.relevancy',[$creatore->id]) }}">
                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z" />
                                            </svg>Prioritise Relevancy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('visitores.gallery.prioritiseTags',[$creatore->id]) }}">
                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z" />
                                            </svg>Prioritise My Tags
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('visitores.gallery.prioritisePopularity',[$creatore->id]) }}">
                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z" />
                                            </svg>Prioritise popularity
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-9  grid-margin">
                            <div class="top_gallery">
                                <div class="d-flex search_box">
                                    <span class="mr-3 text-danger">
                                        <div class="input-group">
                                            <input type="search" class="form-control rounded" placeholder="Search"
                                                aria-label="Search" aria-describedby="search-addon">
                                            <button type="button" class="btn btn-outline-primary">search</button>
                                        </div>
                                    </span>
                                </div>

                                <div class="top_gallery_listing">
                                    <ul>
                                        <?php
			          if(isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0 ){
			              foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){

			       ?>


			          <li><a href="{{URL('contentdetail/'.$UsercontentDataV['id'])}}" class=""><img src="{{$UsercontentDataV['thumbnail']}}"
                                                    alt="thumb" class="img-fluid "></a>
                                            <div class="badge-positioned">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="badge badge-danger font-weight-bold">
                                                        <div class="I1wyK">
                                                            <div class="MLhH5 _20813"><a href="#"
                                                                    class=""><img alt="FrankAtt's avatar"
                                                                        src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                        class="_3gigK" width="25"
                                                                        height="25"></a></div>
                                                            <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                                    data-username="FrankAtt"
                                                                    data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                    data-usertype="core_access" data-userid="20723266"
                                                                    data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                    href="https://www.deviantart.com/frankatt"
                                                                    class="user-link _1Zf8w"><span
                                                                        class="_36cte">FrankAtt</span><span
                                                                        class="_3pMl0 _2179b" style="cursor:pointer"
                                                                        title="Core Member" aria-label="Core Member"
                                                                        role="img"></span></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="dd">
                                                        <div class="_2rLSm">
                                                            <div class="_2-4qx">28</div><span
                                                                class="_2FP2V _2Gw-F _272Qs">
                                                                <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                                    <path fill="currentColor"
                                                                        d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
	             <?php
			          }}
	             ?>

                                    </ul>


                                </div>


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


                    <div class="top_gallery_listing bottom_gallery">
                        <ul>
                            <li class="back_none">

                            </li>


                            <li><a href="#" class=""><img src="assets/images/item-09.png" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li><a href="#" class=""><img src="assets/images/item-08.png" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li><a href="#" class=""><img src="assets/images/item-10.png" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <li><a href="#" class=""><img src="assets/images/news_banner2.webp"
                                        alt="thumb" class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li><a href="#" class=""><img src="assets/images/news_banner.png"
                                        alt="thumb" class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-08.png" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <li><a href="#" class=""><img src="assets/images/item-09.png" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li><a href="#" class=""><img src="assets/images/item-08.png" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li><a href="#" class=""><img src="assets/images/item-10.png" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <li><a href="#" class=""><img src="assets/images/news_banner2.webp"
                                        alt="thumb" class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li><a href="#" class=""><img src="assets/images/news_banner.png"
                                        alt="thumb" class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>




                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li><a href="#" class=""><img src="assets/images/item-11.webp" alt="thumb"
                                        class="img-fluid "></a>
                                <div class="badge-positioned">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="badge badge-danger font-weight-bold">
                                            <div class="I1wyK">
                                                <div class="MLhH5 _20813"><a href="#" class=""><img
                                                            alt="FrankAtt's avatar"
                                                            src="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                            class="_3gigK" width="25" height="25"></a></div>
                                                <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                        data-username="FrankAtt"
                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                        data-usertype="core_access" data-userid="20723266"
                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                        href="https://www.deviantart.com/frankatt"
                                                        class="user-link _1Zf8w"><span
                                                            class="_36cte">FrankAtt</span><span
                                                            class="_3pMl0 _2179b" style="cursor:pointer"
                                                            title="Core Member" aria-label="Core Member"
                                                            role="img"></span></a></div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="_2rLSm">
                                                <div class="_2-4qx">28</div><span
                                                    class="_2FP2V _2Gw-F _272Qs">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>







                        </ul>




                    </div>

                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item ">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>





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


                                        © 2022. All rights reserved.
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
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
</body>

</html>
