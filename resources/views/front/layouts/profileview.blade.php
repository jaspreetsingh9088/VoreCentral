<style>
header .navbar-bottom{
    background: url(/public/assets/images/green_button_pattern.webp);

}
.navbar-top-right-menu li a{
    color:white;
    list-style: none;
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
                            <ul class="navbar-top-right-menu">
                                <?php
                                if (Auth::check()) { ?>
                                   @include('front.layouts.navbar-top')
                                    <?php
                                }else{ ?>
                                    <li class="nav-item">
                                        <a href="{{URL('/signup')}}" class="nav-link">Register</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL('/login')}}" class="nav-link">Login</a>
                                    </li>
                                    <?php
                                } ?>
                            </ul>
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
                @php
                $currenturl = request()->segment(2);
                $userid = Auth::id();
                @endphp

                <div class="">
                    <div class="navbar-top-right-menu" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="left-bar">
                            <ul class="navbar-top-right-menu" id="own-creater-nav-buttons" style="display: inline-flex;">
                                <li class="nav-item mr-2" style="width:155px; list-style:none;color:white;">
                                    <a href="{{ URL('/creatorupload') }}" class="nav-link">Manage Channel</a>
                                </li>
                                <li class="nav-item mr-2" style="width:122px;color:white; list-style:none">
                                    <a href="/edit-content" class="nav-link">Edit Content</a>
                                </li>
                                <li class="nav-item mr-2" style="width:85px;color:white; list-style:none">
                                    <a href="/creatorcontentupload" class="nav-link">Upload</a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <label for="creator-logo">
                                <img style="width: 120px; height: 120px;" src="{{ $myData['profile_pic'] }}" />
                            </label>
                            <input type="file" id="creator-logo" style="display:none;">
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



<div class="container" style="height: 50px;">

</div>


<div class="profile-nav">

    <div class="container">



    </div>

</div>
