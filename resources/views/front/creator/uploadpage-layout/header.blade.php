<style>
    .popup-background {
        background: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
    }

    .popup-background-outter {
        display: table;
        width: 100%;
        height: 100%;
    }

    .popup-background-center {
        display: table-cell;
        vertical-align: middle;
    }

    .popup-set {
        background-color: #000;
        max-width: 720px;
        width: 100%;
        margin: auto;
        padding: 20px;
        box-sizing: border-box;
        position: relative;
    }

    span.close-icon {
        background-color: #184589;
        width: 30px;
        height: 30px;
        position: absolute;
        top: -13px;
        right: -13px;
        text-align: center;
        font-style: normal;
        line-height: 30px;
        color: #fff;
        border-radius: 30px;
        cursor: pointer;
    }

    .bottom-box {
        text-align: right;
    }

    .bottom-box a.close-btn {
        background-color: #f00;
        color: #fff;
        width: 80px;
        height: 25px;
        display: inline-block;
        text-align: center;
        line-height: 25px;
        margin-right: 5px;
    }

    .bottom-box a.tick-btn {
        background-color: #43a047;
        color: #fff;
        width: 25px;
        height: 25px;
        display: inline-block;
        text-align: center;
        line-height: 25px;
    }

    .popup-background {
        display: none;
    }

    .relative-box {
        position: relative;
    }

    .check-select {
        position: absolute;
        bottom: 0;
    }

    .info-btn {
        cursor: pointer;
    }

    .relative-box img {
        background-image: url(assets/images/cool-calm-yellow-water-background.webp);
        padding-top: 10px;
        border-radius: 5px;
    }

    ul.social-icons {
        text-align: right;
        margin-top: 30px;
        padding: 0px;
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

    .uploadbtn {
        background-color: #fff;
        color: #000;
        padding: 14px;
        font-size: 16px;
        text-transform: uppercase;
        position: relative;
        z-index: 0;
        position: absolute;
        right: 30px;
        bottom: 36px;
        border-radius: 50px;
        border: 1px solid #222;
    }

    .navbar-top {
        padding: 46px 0 !important;
    }

    .notifications-list {
        top: 110px;
    }
    .navbar-top-right-menu li a{
        color:black;
    }
    #own-creator-hearder {
    background:
        url('/public/assets/images/banner.png') top center no-repeat,
        #000;
    background-size: 100% 50%;
    height:500px;
    }
</style>
<header id="own-creator-hearder" >
   <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light"> 
                <div class="navbar-top top-0">
                    <div class="d-flex justify-content-between align-items-center">
                    @if(Auth::check())
                        <br>
                        <h3 style="color: #fff;"><strong>Welcome {{ Auth::user()->username }}</strong></h3>
                    @endif
                        <div class="mobile-margin" style="margin-left : 200px;">
                        </div>
                        <div class="right-bar">
                                @php
                                    $currenturl = request()->segment(2);
                                    $userid = Auth::id();

                                    if($userid == 'featuredgallery'){
                                        $userid = request()->segment(1);
                                    }elseif($userid == 'media'){
                                        $userid = request()->segment(2);
                                    }elseif($userid == 'gallery'){
                                        $userid = request()->segment(3);
                                    }

                                @endphp
                            @include('front.layouts.navbar-top')
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
                            <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                                        <a class="nav-link" href="{{ route('publicgallery.pictures',['all','featured']) }}">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('forum')}}">Forums</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('publicstore')}}">Store</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Misc</a>
                                        <ul class="submenu">
                                            <li><a class="" href="{{URL('dlc')}}">DLC</a></li>
                                            <li>
                                                <a class="" href="{{route('generalSetting')}}">Options</a>
                                            </li>
                                            <li><a class="" href="{{URL('news_archieve')}}">News archive</a></li>
                                            <li>
                                                <a class="" href="{{ route('content.promoted.produced') }}">Content produced and promoted</a>
                                            </li>
                                            <li><a class="" href="{{ route('onlineuser') }}">Online Users</a></li>
                                            <li><a class="" href="{{ route('myvault') }}">Purchased Content</a></li>
                                            <li><a class="" href="{{ URL('publicgallery/pictures/latest') }}">Inner Gallery</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <ul style="list-style-type:none;">
                    <li>
                        <div>
                        <img style="width: 120px; height: 120px;margin-top:15px;vertical-align:bottom" src="{{ $myData['profile_pic'] }}" />
                            <label for="creator-logo">
                                 <span style="color:white;">{{ Auth::user()->username }} </span>
                            </label>
                            <input type="file" id="creator-logo" style="display:none;">
                        </div>
                    </li>
                 </ul>
                @php
                $currenturl = request()->segment(2);
                $userid = Auth::id();

                @endphp

                <div class="">
                    <div class="navbar-top-right-menu" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="left-bar">
                            <ul class="navbar-top-right-menu" id="own-creater-nav-buttons" style="display: inline-flex;">
                                <li class="nav-item mr-2" style="width:157px; list-style:none;">
                                    <a href="{{ URL('/creatorupload') }}" class="nav-link">Manage Channel</a>
                                </li>
                                <li class="nav-item mr-2" style="width:157px;">
                                    <a href="/edit-content" class="nav-link">Edit Content</a>
                                </li>
                                <li class="nav-item mr-2" style="width:157px;">
                                    <a href="/creatorcontentupload" class="nav-link">Upload</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

                <div class="navbar-bottom">
                    <div class="">
                        <div>
                            <button class="navbar-toggler" type="button" data-target="#navbarSupportedContentOwn" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContentOwn">
                                <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                    <li>
                                        <button class="navbar-close"><img src="{{ url('public/assets/images/close.png') }}" alt=""></button>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ URL($userid.'/creatordashboard') }}/">Main</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ URL($userid.'/creatorgallery/all/featured') }}">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('creator.visitor.collection',[$userid]) }}">Collections</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ URL($userid.'/community') }}">Community</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ URL($userid.'/creatorjournal') }}">Journal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ URL($userid.'/creatorwebstore') }}">Webstore</a>
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