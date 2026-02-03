<!DOCTYPE html>
<html lang="zxx">
<script> window.href="https://www.vorecentral.com/publicgallery/all/latest"; </script>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Public Gallery</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    {{-- <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.3.67/css/materialdesignicons.min.css" integrity="sha512-nRzny9w0V2Y1/APe+iEhKAwGAc+K8QYCw4vJek3zXhdn92HtKt226zHs9id8eUq+uYJKaH2gPyuLcaG/dE5c7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/style-1.css') }}">

    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script> --}}
    {{-- <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script> --}}
    <style>
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
        header{
            background:url({{asset('assets/images/banner.png')}}) no-repeat !important;
            background-size: cover !important;
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
    </style>
</head>
<livewire:cursor-style>
<body class= "{{ $theme ? $theme : 'green_theme' }}" style="font-family:{{ $font }}">
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <a href="{{ route('home') }}" class="btn btn-success banner_homebutton">Home</a>
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    {{-- <a class="navbar-brand" href="{{route('publicgallery.featured')}}">Gallery</a> --}}
                                    @if(Auth::check())
                                        <br>
                                        <h3 style="color: #fff;"><strong>Welcome {{ Auth::user()->username }}</strong></h3>
                                    @endif
                                </div>
                                @include('front.layouts.navbar-top')
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
                                    <a class="nav-link" href="{{ route('publicgallery.featured') }}">Gallery</a>
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

                                   <!--      <li><a class="" href="{{ URL('aboutus') }}">About us</a></li>
                                        <li><a class="" href="{{ URL('contactus') }}">Contact us</a></li> -->
                                        <li>
                                            <a class="" href="{{ route('content.promoted.produced') }}">Content produced and promoted</a>
                                        </li>
                                      <!--   <li>
                                            <a class="" href="{{ route('creator.information.monetisation') }}">Creator Information and Monetisation</a>
                                        </li> -->
                                      <!--   <li><a class="" href="{{ route('helpandsupport') }}">Help and Support</a></li>
                                        <li>
                                            <a class="" href="{{ route('information.different.subject') }}">Information about different subjects</a>
                                        </li> -->
                                        <li><a class="" href="{{ route('onlineuser') }}">Online Users</a></li>
                                        <li><a class="" href="{{ route('myvault') }}">Purchased Content</a></li>
                                        <li><a class="" href="{{ URL('publicgallery/pictures/latest') }}">Inner Gallery</a></li>
                                     <!--    <li><a class="" href="{{URL('ourstaff')}}">Our staff</a></li>
                                        <li>
                                            <a class="" href="{{ route('privacypolicy') }}">Privacy Policy</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{route('termsservice')}}">Terms and Service</a>
                                        </li> -->
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
                        <div class="d-flex gallery_tab">
                            <ul class="">
                                <li class="nav-item">
                                    <a href="{{ route('publicgallery.creators') }}" class="nav-link" style="color: #fff;">Creators</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('publicgallery.random') }}" class="nav-link" style="color: #fff;">Random</a>
                                </li>
                                <li class="nav-item">
                                <select id="type_filter">
                                    <option value="">Select Type</option>
                                    <option value="{{ route('publicgallery.pictures',['all','latest']) }}">All Content</option>
                                    <option value="{{ route('publicgallery.pictures',['literatures','latest']) }}">Literature</option>
                                    <option value="{{ route('publicgallery.pictures',['comics','latest']) }}">Comics</option>
                                    <option value="{{ route('publicgallery.pictures',['pictures','latest']) }}">Pictures</option>
                                    <option value="{{ route('publicgallery.pictures',['videos','latest']) }}">Video</option>
                                    <option value="{{ route('publicgallery.pictures',['games','latest']) }}">Games</option>
                                    <option value="{{ route('publicgallery.pictures',['Audio','latest']) }}">Audio</option>
                                </select>

                                    
                                 </li>

                                 <li class="nav-item">
                                 <select id="order_filter">
                                    <option value="">Select Order</option>
                                    <option value="featured">Featured</option>
                                    <option value="recency">Prioritise Recency</option>
                                    <option value="relevancy">Prioritise Relevancy</option>
                                    <option value="prioritisePopularity">Prioritise My Tags</option>
                                    <option value="prioritiseTags">Prioritise Popularity</option>
                                </select>
                                    
                                 </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <script>
document.getElementById('type_filter').addEventListener('change', function() {
    document.getElementById('type').value=document.getElementById('type_filter');
    let orderFilter = document.getElementById('order_filter').value || 'latest'; // Default to 'latest' if empty
    if (this.value) {
        let updatedUrl = this.value.replace('latest', orderFilter); // Replace 'latest' with selected sorting
        window.location.href = updatedUrl;
    }
});

document.getElementById('order_filter').addEventListener('change', function() {
    let orderFilter1 = document.getElementById('type_filter').value;
    if (orderFilter1) {
        let updatedUrl = orderFilter1.replace(/(featured|recency|relevancy|prioritisePopularity|prioritiseTags|latest)/, this.value || 'latest'); // Replace sorting value
        window.location.href = updatedUrl;
    }
});

// Function to preselect values from the URL
function preselectValues() {
    let currentUrl = window.location.href;
    let type_filter = document.getElementById('type_filter');
    let orderFilter = document.getElementById('order_filter');

    // Extract category and sorting from the URL
    let urlParts = currentUrl.split('/publicgallery/')[1]?.split('/') || [];
    let selectedCategory = urlParts[0]; // Example: 'pictures'
    let selectedSorting = urlParts[1] || 'latest'; // Example: 'prioritiseTags' or 'latest'

    // Preselect sorting dropdown
    orderFilter.value = selectedSorting !== 'latest' ? selectedSorting : '';

    // Preselect the first dropdown (order_filter)
    for (let option of type_filter.options) {
        if (option.value.includes(selectedCategory)) {
            type_filter.value = option.value;
            break;
        }
    }
}

// Run on page load
window.onload = preselectValues;
</script>
            <div class="content-wrapper">
                <div class="container">
                    <div class="row gallery_main" data-aos="fade-up">
                    <!--     <div class="col-xl-3 col-md-4 p-1">
                            <div class="gallery_featured_menu">
                                <ul class="featured_menu">
                                    <li><a href="{{ route('publicgallery.featured') }}"> Featured</a></li>
                                    <li><a href="{{ route('publicgallery.recency') }}">Prioritise Recency</a></li>
                                    <li><a href="{{ route('publicgallery') }}">Prioritise Relevancy</a></li>
                                    <li><a href="{{ route('publicgallery.prioritiseTags') }}">Prioritise My Tags</a></li>
                                    <li><a href="{{ route('publicgallery.prioritisePopularity') }}">Prioritise popularity</a></li>
                                </ul>
                            </div>
                        </div> -->
                        <div class="col-xl-12 col-md-12 grid-margin">
                            <div class="top_gallery">
                                <form action="{{ route('publicgallery.gallerySerach') }}" method="GET">
                                    @csrf
                                    <div class="d-flex search_box">
                                        <span class="mr-3 text-danger">
                                            <div class="input-group">
                                                <input type="search" name="search" class="form-control rounded"
                                                    placeholder="Search" aria-label="Search"
                                                    aria-describedby="search-addon" required>
                                                <input type="text" name="type" id="type">
                                                <button type="submit" class="btn btn-outline-primary">search</button>
                                            </div>
                                        </span>
                                    </div>
                                </form>
                                <div class="gallery_audio_listing">
                                    <ul>
                                        @if (isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0)
                                        
                                            @foreach (array_slice($UsercontentData, 0, 8) as $UsercontentDataV)
                                                <li>
                                                    <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}" class="">
                                                        <img src="{{ $UsercontentDataV['thumbnail'] }}" alt="thumb" style="width: 200px;height:200px;" class="img-fluid magnific-popup">
                                                    </a>
                                                    <div class="badge-positioned" style="bottom: 65px;">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="badge badge-danger font-weight-bold">
                                                                <div class="I1wyK">
                                                                    <div class="MLhH5 aWCtT">
                                                                        <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}" class="user-link _1Zf8w">
                                                                            <span class="_36cte">{{ $UsercontentDataV['title'] }}</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="badge-positioned">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="badge badge-danger font-weight-bold">
                                                                <div class="I1wyK">
                                                                    <div class="MLhH5 _20813" style="width:50px;">
                                                                        @php
                                                                            // $user = App\Models\User::select('username', 'profile_pic','id','creator')
                                                                            //     ->where('id', $UsercontentDataV['userid'])
                                                                            //     ->first();

                                                                            if($UsercontentDataV['user']['creator'] == 1){
                                                                                $dashboard_link = route('creatorvisitordashboard',[$UsercontentDataV['userid']]);
                                                                            }else if($UsercontentDataV['user']['creator'] == 0){
                                                                                // dd($UsercontentDataV['user']['id']);
                                                                                if(!is_null($UsercontentDataV['user']['id'])){
                                                                                    $dashboard_link = route('profiledashboard', [$UsercontentDataV['userid']]);
                                                                                }else{
                                                                                    $dashboard_link = 'javascript:;';
                                                                                }
                                                                            }else{
                                                                                $dashboard_link = 'javascript:;';
                                                                            }

                                                                            $viewCount = App\Models\Contentview::where('contentid', $UsercontentDataV['id'])->count();
                                                                        @endphp
                                                                        <a href="#" class="">
                                                                            {{-- <img src="{{ $user->profile_pic }}" class="_3gigK" width="25" height="25"> --}}
                                                                            <img src="{{ $UsercontentDataV['user']['profile_pic'] }}" class="_3gigK" width="25" height="25">
                                                                        </a>
                                                                    </div>
                                                                    <div class="MLhH5 aWCtT">
                                                                        <a data-hook="user_link" data-username="{{ $UsercontentDataV['user']['username'] }}" data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.png?4"
                                                                            data-usertype="core_access" data-userid="{{ $UsercontentDataV['userid'] }}" data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                            href="{{ $dashboard_link }}" class="user-link _1Zf8w">
                                                                            <span class="_36cte">{{ $UsercontentDataV['user']['username'] }}</span>
                                                                            <span class="_3pMl0 _2179b" style="cursor:pointer" title="Core Member" aria-label="Core Member" role="img"></span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <h3 class="text-center" style="color: #fff;">No records found.</h3>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
   
                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-12 text-center">
                            <div class="ad_banner landscape">
                                <div data-banner-id="425470"></div>
                            </div>
                        </div>
                    </div>

                    <div class="top_gallery_listing bottom_gallery">
                        <ul>
                            <li class="back_none">
                            </li>
                            @if (isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0)
                                @foreach (array_slice($UsercontentData, 9, count($UsercontentData)) as $UsercontentDataV)
                                    <li>
                                        <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}" class="">
                                            <img src="{{ $UsercontentDataV['thumbnail'] }}" alt="thumb" class="img-fluid ">
                                        </a>
                                        <div class="badge-positioned" style="bottom: 65px;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="badge badge-danger font-weight-bold">
                                                    <div class="I1wyK">
                                                        <div class="MLhH5 aWCtT">
                                                            <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}" class="user-link _1Zf8w">
                                                                <span class="_36cte">{{ $UsercontentDataV['title'] }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="badge-positioned">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="badge badge-danger font-weight-bold">
                                                    <div class="I1wyK">
                                                        <div class="MLhH5 _20813">
                                                            @php
                                                                // $user = App\Models\User::select('username', 'profile_pic','id','creator')
                                                                //     ->where('id', $UsercontentDataV['userid'])
                                                                //     ->first();
                                                                if($UsercontentDataV['user']['creator'] == 1){
                                                                    $dashboard_link = route('creatorvisitordashboard',[$UsercontentDataV['userid']]);
                                                                }else if($UsercontentDataV['user']['creator'] == 0){

                                                                    if(!is_null($UsercontentDataV['user']['id'])){
                                                                        $dashboard_link = route('profiledashboard', [$UsercontentDataV['userid']]);
                                                                    }else{
                                                                        $dashboard_link = 'javascript:;';
                                                                    }
                                                                }else{
                                                                    $dashboard_link = 'javascript:;';
                                                                }
                                                            @endphp
                                                            <a href="{{ $dashboard_link }}" class=""><img src="{{ $UsercontentDataV['user']['profile_pic'] }}" class="_3gigK" width="25" height="25"></a>
                                                        </div>
                                                        <div class="MLhH5 aWCtT">
                                                            <a data-hook="user_link" data-username="{{ $UsercontentDataV['user']['username'] }}"
                                                                data-icon="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}"
                                                                data-usertype="core_access" data-userid="{{ $UsercontentDataV['userid'] }}"
                                                                data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a" href="{{ $dashboard_link }}" class="user-link _1Zf8w">
                                                                <span class="_36cte">{{ $UsercontentDataV['user']['username'] }}</span>
                                                                <span class="_3pMl0 _2179b" style="cursor:pointer" title="Core Member" aria-label="Core Member" role="img"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dd">
                                                    <div class="_2rLSm">
                                                        @php
                                                            $commentsCount = App\Models\Gallerycomment::where('contentid', $UsercontentDataV['id'])->count();
                                                        @endphp
                                                        <div class="_2-4qx">{{ $commentsCount }}</div><span
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
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    {{-- <nav aria-label="...">
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
                    </nav> --}}
                </div>
            </div>
            @include('front.layouts.footer')
            @include('front.layouts.script')
            <!-- partial -->
        </div>
    </div>

</body>

</html>
