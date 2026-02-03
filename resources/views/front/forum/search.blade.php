
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Content Search</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css')}}">
        <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
        <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
    </head>
    <livewire:cursor-style>
    <body class="{{ $theme ? $theme : 'orange_theme' }}" style="font-family:{{ $font }}">
        @include('front.layouts.header')
        <!-- main content start -->
        <section class="viewhistory-wrapper latest-topics-sctn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="view_history-outer">
                            <div class="history_search_wrapper">
                                <h2>Search Results</h2>
                                <p>Showing results for x</p>
                                <div class="history_search_box">
                                    <form action="{{ route('forum.search') }}">
                                        <input type="search" name="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon" required>
                                        <button type="submit" class="btn btn-outline-primary">search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="view_histoy_dv"></div>
                            <div class="view_histoy_dv1"></div>
                            <div class="view_history_wrapper">
                                @for($i =0; $i < count($searchdata); $i++)
                                    <div class="{{ $i % 2 == 0 ?'view_history_box1':'view_history_box2' }}" style="padding: 10px;min-height: auto;">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <span style="color:#fff;">{{$searchdata[$i]['title']}}</span><br><br>
                                                @if($forum_setting == 'include_userpage' && $searchdata[$i]['pagename'] == 'Thread Topic')
                                                    <a style="color:#fff;" href="javascript:;">
                                                       Thread Start : {{ $searchdata[$i]['thread_start'] }}
                                                    </a>
                                                    <br><br>
                                                @endif

                                                @if($forum_setting == 'include_userpage' && $searchdata[$i]['pagename'] == 'Thread Details')
                                                    <a style="color:#fff;" href="javascript:;">
                                                        Who Comment : {{ $searchdata[$i]['who_comment'] }}
                                                    </a>
                                                    <br><br>
                                                @endif
                                                <a style="color:#fff;" href="{{ $searchdata[$i]['pagelink'] }}">{{ $searchdata[$i]['pagename'] }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
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
    </body>
</html>
