<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Webstore Lyrics</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet"
        href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .rav-popup {
            background-image: url({{ url('public/assets/images/bg.webp') }});
        }

        .rav-popup h1,
        h3,
        h4,
        p,
        th,
        td {
            color: white;
        }

        .rav-popup a {
            font-size: 18px !important;
            background: url({{ url('public/assets/images/Button-alternative2.webp') }}) no-repeat;
            border: #000 solid 2px;
            margin: 0 5px;
            margin-bottom: 0px;
        }

        .remove-from-cart {
            padding: 5px;
            color: white;
        }

        .rav-popup td {
            vertical-align: middle !important;
        }

        .rav-popup .float-right {
            padding-right: 10px;
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
            padding : 6px 19px !important;
        }
        .webstoreHeader{
            background-size: cover;
            position: relative;
            height: 200px;
        }
        .content-wrapper{
            padding-bottom: 0;
        }
    </style>
</head>

<body class="store_theme star_theme">
    <div class="left_back">
        <div class="border_left"></div>
    </div>
    <div class="right_back">
        <div class="border_right"></div>
    </div>
    <div class="container">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header class="webstoreHeader" id="header">
                <a href="{{ route('home') }}" class="btn btn-success banner_homebutton">Home</a>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="navbar-top">
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="cart_button_sect mt-5">
                                <ul class="button_cart_menu">
                                    <li class="nav-item">
                                        <a href="#" id="cartModal" data-toggle="modal"
                                            data-target=".bd-example-modal-lg" class="nav-link">Cart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('checkout.index') }}"
                                            class="nav-link">Checkout</a>
                                    </li>

                                </ul>

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
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link"
                                                href="{{ route('publicstore.new') }}">Newest First</a>
                                        </li>
                                        <form style="display: contents"
                                            action="{{ route('publicstore.search') }}">
                                            @csrf
                                            <li class="nav-item">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search" style="margin: 10px;">
                                            </li>
                                            <li>
                                                <button type="submit" class="btn-primary"
                                                    style="padding: 13px;margin: 10px;"> Search </button>
                                            </li>
                                        </form>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('browsecreator') }}">Browse
                                                Creators</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('webStoremonetizeupload') }}">Upload</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('random') }}">random</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </nav>

            </header>



            <!-- partial -->

            <div class="content-wrapper">
                <div class="store_main_sect">
                    <audio id="player" controls onended="playNext()">
                        <source
                            src="{{ asset('no_lyrics/Adeline Yeo (HP) - Back To The Eighties Throwback Instrumental - Adeline Yeo (HP).mp3') }}"
                            type="audio/mpeg">
                    </audio>
                    <button id="play-button">Play</button>
                    @foreach($data as $paidContent)
                        <div class="creator_information_box">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="creator_inf0">
                                        <div class="bbb_deals_image"><img alt=""
                                                src="{{ $paidContent->user->profile_pic }}">
                                        </div>

                                        <div class="creator_info_details">
                                            <h2>{{ $paidContent->username }}</h2>
                                            <p>{{ $paidContent->role_preference }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="creator_img1"><a
                                            href="{{ route('buyablecontent', $paidContent->id) }}"><img
                                                alt=""
                                                src="{{ $paidContent->thumbnail }}"></a>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="doller_sect">
                                        <div class="doller_img"><img
                                                src="{{ url('public/assets/images/doller_img.webp') }}"
                                                alt="thumb" class="img-fluid "></div>
                                        <h3>{{ $paidContent->price }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('front.layouts.footer')
            @include('front.creatorvisitor.layout.modal')
        </div>
    </div>
    <!-- inject:js -->
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>

    <!-- End custom js for this page-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @include('front.layouts.cartscript')
    <script>
        var currentTrack = 0;
        var tracks = [{
                src: "{{ asset('no_lyrics/Cullah - I See.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Cullah - Neurosis Of The Liver.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Cullah - To The Rhythm of the Funk.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Cullah - Where You Do Belong.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Delay 77 - Twenty-Five.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Juanitos - Exotica.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Keshco - Stock Share Shuffle.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Lorenzo_s Music - Just Had To Let You Know.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Lorenzo_s Music - Roulette.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Lorenzo_s Music - We All Fall Down.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/Mahogany Marie - Kick Back.mp3') }}",
                type: "audio/mpeg"
            },
            {
                src: "{{ asset('no_lyrics/MrJuan - Ultra Swing.mp3') }}",
                type: "audio/mpeg"
            },

            // { src: "{{ asset('music3.mp3') }}", type: "audio/mpeg" },
        ];



        document.getElementById("play-button").addEventListener("click", function() {
    var player = document.getElementById("player");
    player.src = tracks[currentTrack].src;
    player.type = tracks[currentTrack].type;
    player.load();
    player.play();
  });


//   window.onload = function(playNext()) {
//   }

  function playNext() {
    currentTrack = (currentTrack + 1) % tracks.length;
    var player = document.getElementById("player");
    player.src = tracks[currentTrack].src;
    player.type = tracks[currentTrack].type;
    player.load();
    player.play();
  }
  
  

    </script>
</body>

</html>
