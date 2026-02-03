<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="description"
              content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <title>@yield('title')</title>
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />

        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}" />
        <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
        <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">

        <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
        <!-- endinject -->
    </head>
    @php
        $customebg = Auth::user()->themebg;
        $style = '';
        $custom_bg = '';
        if($customebg != null){
            $style = 'background: url('.$customebg.') 0% 0% / cover repeat !important;';
            $customebg = ".add-custom-bg{background:url({$customebg}) repeat; background-size:cover;}";
        }
        if(isset($generalsetting)){
            $custom_theme = $generalsetting->creator_pages_custom_theme;
            if($custom_theme != 1){
                $style = '';
            }
        }
    @endphp
    @if($style)
        <style>
            body {
                {{ $style }}
            }
        </style>
    @endif
    <livewire:cursor-style>
    <style>
        {{$customebg}}
        .banner_homebutton{
            background: #1c621e;
            color: black !important;
            padding: 14px 85px !important;
            position: absolute;
            font-weight: 900;
            line-height: 14px;
            font-size: 20px;
            z-index: 9999;
        }
        .banner_homebutton:hove{
            background: #1c621e !important;
        }
        .creator_logo{
            margin-left : 200px;
        }
        #snackbar{
            display: none;
        }
        @yield('style')
    </style>
    <body class="@yield('bodyclass')"  style="font-family:{{ $font }}">

        @include('front.creator.uploadpage-layout.header')

        @yield('content')

        @include('front.layouts.footer')

    </body>
    <script>
        @stack('script')
        $(document).ready(function() {
            $('.profile-upload').hide();
            $(".open_popup").click(function(){
                $('.profile-upload').show();
            });
            $(".close-icon").click(function(){
                $(this).parent().parent().parent().parent().hide();
            });
            $('#popup-background').hide();
            $(".info-btn").click(function(){
                $('#popup-background').show();
                $('#popup-background').find('div:hidden').show();

            });

            $(".close-iconn").click(function(){
                $('#popup-background').hide();
            });



            $('#popup-background1').hide();
            $(".info-btn1").click(function(){
                $('#popup-background1').show();
                $('#popup-background1').find('div:hidden').show();

            });

            $(".close-iconn").click(function(){
                $('#popup-background1').hide();
            });

            $('#popup-background2').hide();
            $(".info-btn2").click(function(){
            $('#popup-background2').show();
            $('#popup-background2').find('div:hidden').show();

            });

            $(".close-iconn").click(function(){
            $('#popup-background2').hide();
            });


            $('#popup-background3').hide();
            $(".info-btn3").click(function(){
            $('#popup-background3').show();
            $('#popup-background3').find('div:hidden').show();

            });

            $(".close-iconn").click(function(){
            $('#popup-background3').hide();
            });


            $('#popup-background4').hide();
            $(".info-btn4").click(function(){
            $('#popup-background4').show();
            $('#popup-background4').find('div:hidden').show();
            });

            $(".close-iconn").click(function(){
            $('#popup-background5').hide();
            });
            $('#popup-background5').hide();

            $(".info-btn5").click(function(){
            $('#popup-background5').show();
            $('#popup-background5').find('div:hidden').show();

            });


            $(".close-iconn").click(function(){
            $('#popup-background4').hide();
            });

        });
    </script>
</html>
