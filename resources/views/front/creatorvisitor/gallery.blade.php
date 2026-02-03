<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Public Gallery</title>
    <link rel="icon" href="{{url('public/assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{url('public/assets/css/style-1.css') }}" />

    <script src="{{url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{url('public/assets/js/demo.js') }}"></script>
    <script src="{{url('public/assets/js/jquery.easeScroll.js') }}"></script>

    <!-- endinject -->
    <style>
        body{
            background: #000;
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

        header .navbar-bottom .navbar-nav .nav-item .nav-link{
            padding : 19px;
            line-height: 18px;
        }

        body.green_theme {
            background-image: none;
            background-color: #000;
        }

        @media (min-width: 1200px) {
            .green_theme .container, .green_theme .container-lg, .green_theme .container-md, .green_theme .container-sm, .green_theme .container-xl {
                width: calc(100% - 10px);
                max-width: 1272px;
            }
        }
        .search-gallery-items{
            background: #083008;
            border: 1px solid #083008;
            height: 35px;
            margin: 0px 14px;
            color:white;
        }
        #type_filter{
            height:32px;
        }
        #order_filter{
            height:32px;
        }
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
        width: 25px;
        height: 25px;
        display: inline-block;
        text-align: center;
        line-height: 25px;
        margin-right: 20px;
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

header .navbar-bottom{
    background: url(/public/assets/images/green_button_pattern.webp);
}

.navbar-top-right-menu li a{
    background: url(/public/assets/images/green_button_pattern.webp) 0 0/cover !important;
    color:black;
}
  @media (min-width: 1200px) {
        .container {
            max-width: 95% !important;
        }
    }
    .navbar-nav{
        width:100%;
    }
    </style>
</head>
<livewire:cursor-style>

@php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
$id = request()->route('id');
 if ($id) {
    $customebg = User::find($id)?->themebg ?? Auth::user()->themebg;
 } else {
    $customebg = Auth::user()->themebg;
 }

if($customebg != null){
$style = 'background: url('.$customebg.') 0% 0% / cover repeat !important;';
}
@endphp
<body class="@yield('bodyclass')" data-aos-easing="ease" data-aos-duration="2000" data-aos-delay="0"
style="<?php echo $style; ?>">
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
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
                                <li><a href="{{ env('APP_YOU_TUBE_LINK', '#')  }}"><img src="{{url('public/assets/images/youtube.png') }}" alt=""></a></li>
                                <li><a href="{{ env('APP_TWITTER_LINK', '#')  }}"><img src="{{url('public/assets/images/twitter.png') }}" alt=""></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="navbar-bottom">
                    <div class="">
                        <div>
                            <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"  data-toggle="collapse" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="navbar-collapse justify-content-center collapse"
                                id="navbarSupportedContent">
                                <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                    <li>
                                        <button class="navbar-close">
                                            <img src="{{url('public/assets/images/close.png') }}" alt="">
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
                            <img style="width: 120px; height: 120px;margin-top:15px;vertical-align:bottom" src="{{ $myData[0]['profile_pic'] }}" /> 

                            <label for="creator-logo">
                            <span style="color:white;">{{ $myData[0]['username'] }} </span>
                            </label>
                            <input type="file" id="creator-logo" style="display:none;">
                        </div>
                    </li>
                 </ul>
                @php
                $currenturl = request()->segment(2);
                $userid = request()->segment(1);

                @endphp
                @if(Auth::check() && Auth::id() ==$userid)

                <div class="">
                    <div class="navbar-top-right-menu" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="left-bar">
                            <ul class="navbar-top-right-menu" id="own-creater-nav-buttons" style="display: inline-flex;">
                                <li class="nav-item mr-2" style="width:155px; list-style:none;">
                                    <a href="{{ URL('/creatorupload') }}" class="nav-link">Manage Channel</a>
                                </li>
                                <li class="nav-item mr-2" style="width:122px;">
                                    <a href="/edit-content" class="nav-link">Edit Content</a>
                                </li>
                                <li class="nav-item mr-2" style="width:85px;">
                                    <a href="/creatorcontentupload" class="nav-link">Upload</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                @else
                <div style="height:50px;"> </div>
                @endif

                <div class="navbar-bottom">
                    <div class="">
                        <div>
                            <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false"  aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent2">
                                <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                    <li>
                                        <button class="navbar-close"><img src="{{url('public/assets/images/close.png') }}" alt=""></button>
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

@php
            $currenturl = request()->segment(2);
            $userid = request()->segment(1);
            $type=request()->segment(3);
            $order=request()->segment(4);
            if($userid == 'featuredgallery'){
            $userid = request()->segment(1);
            }elseif($userid == 'media'){
            $userid = request()->segment(2);
            }elseif($userid == 'gallery'){
            $userid = request()->segment(3);
            }

            @endphp   

            <!-- partial -->
            <div class="flash-news-banner">
                <div class="container">
                    <div class="d-lg-flex align-items-center justify-content-between">
                    <form action="{{ url()->current() }}" method="GET" style="margin-top: 2%;">
                                @csrf
                                <div class="d-flex container search_box">
                                    <span class="mr-3 text-danger">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control rounded"
                                                placeholder="Search" aria-label="Search"
                                                aria-describedby="search-addon" required>
                                            <input type="hidden" name="filter" id="type">
                                            <input type="hidden" name="order" id="order">
                                            <input type="hidden" name="user_id" value="@php echo $userid ; @endphp" >
                                            <button type="submit" class="search-gallery-items">search</button>
                                        </div>
                                    </span>
                                </div>
                            </form>
                        <div class="d-flex align-items-center">
                            <p class="mb-0"></p>
                        </div>
       
                        <div class="d-flex gallery_tab">
                            <ul class="">
                                <li class="nav-item">
                                <select id="type_filter">
                                    <option value="">Select Type</option>
                                    <option value="{{ URL($userid.'/creatorgallery/all') }}" @php if($type=="all"){ echo "selected";} @endphp>All Content</option>
                                    <option value="{{ URL($userid.'/creatorgallery/literature') }}" @php if($type=="literature"){ echo "selected";} @endphp>Literature</option>
                                    <option value="{{ URL($userid.'/creatorgallery/comic') }}" @php if($type=="comic"){ echo "selected";} @endphp>Comics</option>
                                    <option value="{{ URL($userid.'/creatorgallery/picture') }}" @php if($type=="picture"){ echo "selected";} @endphp>Pictures</option>
                                    <option value="{{ URL($userid.'/creatorgallery/Video') }}" @php if($type=="Video"){ echo "selected";} @endphp>Video</option>
                                    <option value="{{ URL($userid.'/creatorgallery/Games') }}" @php if($type=="Game"){ echo "selected";} @endphp>Games</option>
                                    <option value="{{ URL($userid.'/creatorgallery/Audio') }}" @php if($type=="Audio"){ echo "selected";} @endphp>Audio</option>
                                </select>
                                 </li>

                                 <li class="nav-item">
                                 <select id="order_filter">
                                    <option value="">Select Order</option>
                                    <option value="featured"  @php if($order=="featured"){ echo "selected";} @endphp>Featured</option>
                                    <option value="latest"  @php if($order=="latest"){ echo "selected";} @endphp>Latest</option>
                                    <option value="recency"  @php if($order=="recency"){ echo "selected";} @endphp>Prioritise Recency</option>
                                    <option value="relevancy"  @php if($order=="relevancy"){ echo "selected";} @endphp>Prioritise Relevancy</option>
                                    <option value="prioritiseTags" {{ $selectedOrder == 'prioritiseTags' ? 'selected' : '' }}>Prioritise My Tags</option>
                                    <option value="prioritisePopularity" {{ $selectedOrder == 'prioritisePopularity' ? 'selected' : '' }}>Prioritise Popularity</option>

                                </select>
                                 </li>
                                 <li class="nav-item">
                                    <a href="{{ URL($userid.'/collection') }}" class="nav-link" style="color: #fff;">Collection</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('publicgallery.random') }}" class="nav-link" style="color: #fff;">Random</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <script>
                document.getElementById('type_filter').addEventListener('change', function () {
                    let orderFilter = document.getElementById('order_filter').value || 'latest'; // Default to 'latest' if empty
                    if (this.value) {
                        let updatedUrl = this.value.replace('latest', orderFilter); // Replace 'latest' with selected sorting
                        window.location.href = updatedUrl;
                    }
                });

                document.getElementById('order_filter').addEventListener('change', function () {
                    let orderFilter1 = document.getElementById('type_filter').value;
                    if (orderFilter1) {
                        let updatedUrl = orderFilter1.replace(/(featured|recency|relevancy|prioritisePopularity|prioritiseTags|latest)/, this.value || 'latest'); // Replace sorting value
                               updatedUrl=updatedUrl+"/"+this.value;
                        console.log(updatedUrl);

                          window.location.href = updatedUrl;
                    }
                });

                function preselectValues() {
                    let currentUrl = window.location.href;
                    let type_filter = document.getElementById('type_filter');
                    let orderFilter = document.getElementById('order_filter');

                    let urlParts = currentUrl.split('/publicgallery/')[1]?.split('/') || [];
                    let selectedCategory = urlParts[0];
                    let selectedSorting = urlParts[1] || 'latest';
                    document.getElementById('type').value = selectedCategory.replace(/s/g, '');
                    document.getElementById('order').value = selectedSorting;

                    orderFilter.value =  selectedSorting;

                    for (let option of type_filter.options) {
                        if (option.value.includes(selectedCategory)) {
                            type_filter.value = option.value;
                            break;
                        }
                    }
                }

                window.onload = preselectValues;

            </script>


            <div class="">
                <div class="">

                    <div class="row gallery_audio_sect" data-aos="fade-up">

                  <!--       <div class="col-xl-2 col-md-3">
                            <div class="ad_banner vertical">
                              <div data-banner-id="425472"></div>

                            </div>
                        </div> -->
                        <div class="col-xl-12 col-md-12 grid-margin">
                                @if (count($data) > 0)
                                @php $item=0 @endphp
                                <div class="gallery_audio_listing">
                                    <ul>
                                        @foreach ($data as $index=>$filteredData)
                                        @php
                                        $user = App\Models\User::select('username', 'profile_pic','id','creator')->where('id', $filteredData['userid'])->first();
                                        $item++;
                                        @endphp
                                        <li class="" style="text-align:center">
                                            <a href="{{ URL('contentdetail/' . $filteredData['id']) }}" class="">
                                                <img src="{{ $filteredData['thumbnail'] }}" alt="thumb" width="450px" height="320px" style="width:450px;height:320px;" class="img-fluid magnific-popup">
                                            </a>
                                            <div class="badge-positioned" style="bottom: 65px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="badge badge-danger font-weight-bold">
                                                        <div class="I1wyK">
                                                            <div class="MLhH5 aWCtT">
                                                                <a href="{{ URL('contentdetail/' . $filteredData['id']) }}" class="user-link _1Zf8w">
                                                                    <span class="_36cte">{{ $filteredData['title'] }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a href="#">
                                                    @if (is_null($user->profile_pic))
                                                    <a href="/{{ $filteredData['userid'] }}/creatordashboard"><img src="/public/profilepic/defaultprofilepic.jpg" class="_3gigK" width="25px" height="25px" style="width:30px;height:30px;"></a>
                                                    @else
                                                    <a href="/{{ $filteredData['userid'] }}/creatordashboard"><img src="{{ $user->profile_pic }}" class="_3gigK" width="25px" height="25px" style="width:30px;height:30px;"></a>
                                                    @endif
                                                </a>

                                                <div class="ml-2"><a href="/{{ $filteredData['userid'] }}/creatordashboard">{{ $user->username }}</a></div>

                                                <div class="ml-auto">
                                                    <a data-hook="user_link" data-username="{{ $user->username}}" href="{{ URL('contentdetail/' . $filteredData['id']) }}" class="user-link _1Zf8w">
                                                        <span class="_36cte">{{ \Carbon\Carbon::parse($filteredData['created_at'])->format('d-m-Y') }}</span>
                                                        <span class="_3pMl0 _2179b" style="cursor:pointer" title="Core Member" aria-label="Core Member" role="img"></span>
                                                    </a>
                                                </div>
                                            </div>

                                        </li>
                                        @if (($index + 1) % 12 == 0 || $loop->last)
                                        <div class="special-image" style="margin-bottom:5%;">
                                            <img src="{{ asset('image1/test3.webp') }}" alt="Special Image">
                                        </div>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>

                            @else
                                <h3 class="text-center">No records found.</h3>
                            @endif
                  


                        </div>

                        <div class="col-xl-2 col-md-3">
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

            <!-- partial -->
        </div>
    </div>

    <script>
        $("#go").click(function() {
            var pageNum = $('#pageNum').val();

        });
    </script>
    <!-- inject:js -->
    <!-- End custom js for this page-->
</body>

</html>
