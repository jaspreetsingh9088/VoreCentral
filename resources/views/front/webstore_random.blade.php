<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Webstore Random</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}"/>
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <!-- endinject -->
    <style>
        .banner_homebutton {
            background: #001bb2;
            color: black !important;
            padding: 14px 78px !important;
            position: absolute;
            font-weight: 900;
            font-size: 20px;
            z-index: 9999;
        }

        .banner_homebutton:hove {
            background: #001bb2 !important;
        }
        .content-wrapper{
            padding-bottom: 0;
        }
        .market_theme .navbar-bottom{
         width:auto;
        }
        .market_theme header{
        height:auto !important;
        }
    </style>
</head>
<livewire:cursor-style>
    <body class="store_theme market_theme random_theme" style="font-family:{{ $font }}">

    <div class="container">


        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            @include("front.layouts.headerstore")

            <!-- partial -->
            <div class="content-wrapper" style="background: #242424 !important; margin-top: 1%; !important;">
                <div class="market_random">
                    @if(!is_null($randomContent))
                        <a href="" class="random_bt">Random</a>
                        <div class="market_random_main">
                            <div style="align-items: center; display: flex;" class="market_random_hd">
                                <b>{{ $randomContent->title }}</b>
                            </div>
                            <div class="market_random_middle">
                                <a href="{{ route('buyablecontent', $randomContent->id) }}">
                                    <img style="max-width: 100%; object-fit:cover; max-height: 100%;"
                                         src="{{ $randomContent->thumbnail }}">
                                </a>
                            </div>
                            <div class="market_random_bottom">
                                @php
                                    $tagIds = explode(',', $randomContent->tag_id);
                                    $tags = App\Models\Tag::whereIn('id', $tagIds)->get();
                                @endphp
                                @foreach ($tags as $tag)
                                    <div>#{{ $tag->title }}&nbsp;&nbsp;</div>
                                @endforeach
                                <div class="random-price">
                                    Price: ${{ $randomContent->price }}
                                </div>
                            </div>
                        </div>
                    @else
                        <h3 class="text-center">No records found.</h3>
                    @endif
                </div>
            </div>
            @include('front.layouts.footer')
            @include('front.creatorvisitor.layout.modal')
        </div>
    </div>
    <!-- inject:js -->
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js')}}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- End custom js for this page-->
    </body>
@include('front.layouts.cartscript')

</html>
