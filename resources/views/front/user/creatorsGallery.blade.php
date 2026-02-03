<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Public Gallery Creators</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}" />
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
</head>

<body class="green_theme" style="font-family:{{ $font }}">
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if(Auth::check())
                                        <h3 style="color: #fff;"><strong>Welcome {{ Auth::user()->username }}</strong></h3>
                                    @endif
                                    <a class="navbar-brand" href="{{ route('publicgallery.featured') }}">Gallery</a>
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
                                    <div class="navbar-collapse justify-content-center collapse"
                                        id="navbarSupportedContent">
                                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                            <li>
                                                <button class="navbar-close">
                                                    <img src="{{ url('public/assets/images/close.png') }}" alt="">
                                                </button>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{ route('publicgallery.featured') }}">Featured</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.latest') }}">Latest</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.pictures',['literatures','latest']) }}">Literature</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.pictures',['pictures','latest']) }}">Pictures</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.pictures',['comics','latest']) }}">Comics</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.pictures',['videos','latest']) }}">videos</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.pictures',['games','latest']) }}">Games</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.pictures',['Audio','latest']) }}">Audio</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Others</a>
                                                <ul class="submenu">
                                                    <li> <a class=""
                                                            href="{{ route('publicgallery.prioritiseTags') }}">Prioritise
                                                            my tags</a></li>
                                                    <li> <a class=""
                                                            href="{{ route('publicgallery.recency') }}">Prioritise
                                                            recency</a></li>
                                                    <li> <a class=""
                                                            href="{{ route('publicgallery.prioritisePopularity') }}">Prioritise
                                                            popularity</a>
                                                    </li>
                                                    <li> <a class=""
                                                            href="{{ route('publicgallery.random') }}">RANDOM, </a>
                                                    </li>
                                                    <li> <a class=""
                                                            href="{{ route('publicgallery.creators') }}">Creators</a>
                                                    </li>
                                                    <li> <a class="" href="{{ route('dlc') }}">DLC</a></li>
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
                                    <a href="{{ route('publicgallery.creators') }}" class="nav-link">Creators</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('publicgallery.random') }}" class="nav-link">Random</a>
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
                                    <li><a href="{{ route('publicgallery.featured') }}"> Featured</a></li>
                                    <li><a href="{{ route('publicgallery.recency') }}">Prioritise Recency</a></li>
                                    <li><a href="{{ route('publicgallery') }}">
                                            {{-- <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z" /></svg> --}}
                                            Prioritise Relevancy</a></li>
                                    <li><a href="{{ route('publicgallery.prioritiseTags') }}">Prioritise My Tags</a>
                                    </li>
                                    <li><a href="{{ route('publicgallery.prioritisePopularity') }}">Prioritise
                                            popularity</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-9  grid-margin">
                            <div class="top_gallery">
                                <form action="{{ route('publicgallery.searchCreator') }}" method="GET">
                                    @csrf
                                    <div class="d-flex search_box">
                                        <span class="mr-3 text-danger">
                                            <div class="input-group">
                                                <input type="search" name="search" class="form-control rounded"
                                                    value="{{ isset($search_key) ? $search_key : '' }}"
                                                    placeholder="Search" aria-label="Search"
                                                    aria-describedby="search-addon">
                                                <button type="submit" class="btn btn-outline-primary">search</button>
                                            </div>
                                        </span>
                                    </div>
                                </form>
                                <div class="top_gallery_listing">
                                    <ul>

                                        @if (isset($users) && count($users) > 0)
                                            @foreach ($users->slice(0, 8) as $user)

                                                <li>
                                                    <a href="{{ route('profiledashboard', $user->id) }}"
                                                        class=""><img src="{{ $user->profile_pic }}"
                                                            alt="thumb" class="img-fluid magnific-popup"></a>
                                                    <div class="badge-positioned">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="badge badge-danger font-weight-bold">
                                                                <div class="I1wyK">
                                                                    <div class="MLhH5 _20813">
                                                                        <a href="#" class="">
                                                                            <img src="{{ $user->profile_pic }}" class="_3gigK" width="25" height="25">
                                                                        </a>
                                                                    </div>
                                                                    <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                                        data-username="{{ $user->username }}"
                                                                        data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.webp?4"
                                                                        data-usertype="core_access"
                                                                        data-userid="{{ $user->id }}"
                                                                        data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                        href="{{ route('profiledashboard', $user->id) }}"
                                                                        class="user-link _1Zf8w"><span
                                                                            class="_36cte">{{ $user->username }}</span><span
                                                                            class="_3pMl0 _2179b"
                                                                            style="cursor:pointer"
                                                                            title="Core Member"
                                                                            aria-label="Core Member"
                                                                            role="img"></span></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
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
                            @if (isset($users) && count($users) > 0)
                                @foreach ($users->slice(9, count($users)) as $user)
                                    <li><a href="{{ route('profiledashboard', $user->id) }}" class="">
                                        <img src="{{ $user->profile_pic }}" alt="thumb" class="img-fluid magnific-popup"></a>
                                        <div class="badge-positioned">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="badge badge-danger font-weight-bold">
                                                    <div class="I1wyK">
                                                        <div class="MLhH5 _20813">
                                                            <a href="#" class="">
                                                                <img src="{{ $user->profile_pic }}" class="_3gigK" width="25" height="25">
                                                            </a>
                                                        </div>
                                                        <div class="MLhH5 aWCtT"><a data-hook="user_link"
                                                                data-username="{{ $user->username }}"
                                                                data-icon="https://a.deviantart.net/avatars-big/f/r/frankatt.webp?4"
                                                                data-usertype="core_access"
                                                                href="{{ route('profiledashboard', $user->id) }}"
                                                                class="user-link _1Zf8w"><span
                                                                    class="_36cte">{{ $user->username }}</span><span
                                                                    class="_3pMl0 _2179b" style="cursor:pointer"
                                                                    title="Core Member" aria-label="Core Member"
                                                                    role="img"></span></a></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
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


                                        © {{ date('Y') }}. All rights reserved.
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
        integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    {{-- <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script> --}}
</body>

</html>
