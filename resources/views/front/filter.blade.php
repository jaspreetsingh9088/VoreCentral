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
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}" />
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>

    <!-- endinject -->
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
    </style>
</head>
<livewire:cursor-style>
<body class="{{ $themes ? $themes : 'green_theme' }} gallery_audio" style="font-family:{{ $font }}">
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                        {{-- <a class="navbar-brand" href="{{ route('publicgallery.featured') }}">Gallery</a> --}}
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
                    </nav>
                </div>
            </header>

            <!-- partial -->
            <div class="flash-news-banner">
                <div class="container">
                    <div class="d-lg-flex align-items-center justify-content-between">
                    <form action="{{ route('publicgallery.gallerySerach') }}" method="GET" style="margin-top: 2%;">
                                @csrf
                                <div class="d-flex container search_box">
                                    <span class="mr-3 text-danger">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control rounded"
                                                placeholder="Search" aria-label="Search"
                                                aria-describedby="search-addon" required>
                                            <input type="hidden" name="filter" id="type">
                                            <input type="hidden" name="order" id="order">
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
                                    <option value="latest">Latest</option>
                                    <option value="recency">Prioritise Recency</option>
                                    <option value="relevancy">Prioritise Relevancy</option>
                                    <option value="prioritiseTags">Prioritise My Tags</option>
                                    <option value="prioritisePopularity">Prioritise Popularity</option>
                                </select>
                                 </li>
                                 <li class="nav-item">
                                    <a href="{{ route('publicgallery.creators') }}" class="nav-link" style="color: #fff;">Creators</a>
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
                                                @if($user->creator)
                                                <div class="ml-2"><a href="/{{ $filteredData['userid'] }}/creatordashboard">{{ $user->username }}</a></div>
                                                @else
                                                <div class="ml-2"><a href="/{{ $filteredData['userid'] }}/dashboard">{{ $user->username }}</a></div>
                                                @endif
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
                            @if($filter != 'prioritisePopularity' && $filter != 'prioritiseTags' && $filter != 'relevancy')
                                {{-- start pagination --}}
                                @if ($title == 'search')
                                    {{ $paginator->links() ?? '' }}
                                @else
                                    {{ $data->links() }}
                                @endif
                                {{-- end pagination --}}
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
            @include('front.layouts.footer')

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
