<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Public Store</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}"/>
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .banner_homebutton {
            background: #001bb2;
            color: black !important;
            padding: 14px 78px !important;
            position: absolute;
            font-weight: 900;
            line-height: 14px;
            font-size: 20px;
            z-index: 9999;
        }

        .banner_homebutton:hove {
            background: #001bb2 !important;
        }

        header .navbar-bottom .navbar-nav .nav-item .nav-link {
            padding: 6px 19px !important;
        }

        header .navbar-bottom .navbar-nav .nav-item .nav-link {
            line-height: 40px;
        }

        .rav-popup {
            background-image: url({{ url('public/assets/images/bg.webp') }});
        }

        .rav-popup h1, h3, h4, p, th, td {
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

        .banner_homebutton {
            background: #001bb2;
            color: black !important;
            padding: 14px 78px !important;
            position: absolute;
            font-weight: 900;
            line-height: 14px;
            font-size: 20px;
            z-index: 9999;
        }

        .banner_homebutton:hove {
            background: #001bb2 !important;
        }
    </style>
</head>
<livewire:cursor-style>
    <body class="store_theme star_background star_theme" style="font-family:{{ $font }}">
    <div class="left_back">
        <div class="border_left"></div>
    </div>
    <div class="right_back">
        <div class="border_right"></div>
    </div>
    <div class="container">


        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            @include("front.layouts.headerstore")
            <div class="content-wrapper">
                <div class="store_main_sect">
                @include("front.layouts.webstorefilters")
                    <marquee direction="up" height="500px">
                        @if(count($data) > 0)
                            @foreach ($data as $paidContent)

                            @php 
                                 if($paidContent->type=="Image" || $paidContent->type=="Comics"){
                                    $backgroundStyle="../public/assets/images/gold_back.webp";
                                 }

                                 elseif($paidContent->type=="Video" ){
                                    $backgroundStyle="../public/assets/images/silver_back.jpg";
 
                                 }

                                 elseif($paidContent->type=="Text" ){
                                    $backgroundStyle="../public/assets/images/white_pattern.webp";
 
                                 }
                                 elseif($paidContent->type=="Audio" ){
                                    $backgroundStyle="../public/assets/images/red_back.jpg";
 
                                 }
                            @endphp
                                <div class="creator_information_box" style="background:url(<?php echo $backgroundStyle; ?>) !important">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="creator_inf0">
                                                <div class="bbb_deals_image">
                                                    @if(!is_null($paidContent->user))
                                                        <img alt="" src="{{ $paidContent->user->profile_pic }}">
                                                    @else
                                                        <img alt="" src="{{ asset('default.webp') }}">
                                                    @endif
                                                </div>

                                                <div class="creator_info_details">
                                                    <h2>{{ $paidContent->username }}</h2>
                                                    <p>{{ $paidContent->role_preference }}</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <div class="creator_img1">
                                                <a href="{{ route('buyablecontent', $paidContent->id) }}">
                                                    <img alt="" src="{{ $paidContent->thumbnail }}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="doller_sect">
                                                <div class="doller_img"><img
                                                        src="{{ url('public/assets/images/doller_img.webp') }}" alt="thumb"
                                                        class="img-fluid "></div>
                                                <h3>{{ $paidContent->price }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-center" style="color: black;">No records found.</h3>
                        @endif
                    </marquee>
                </div>
            </div>
            @include('front.layouts.footer')
            @include('front.creatorvisitor.layout.modal')
        </div>
    </div>
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>

    <!-- End custom js for this page-->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Cart</button>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('front.layouts.cartscript')
    </body>

</html>
