<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description" content="{{ env('APP_NAME')  }}"/>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <title>@yield('title')</title>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}"/>
    
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
 
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-ZFM1CHHHPH');
    </script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import {initializeApp} from "https://www.gstatic.com/firebasejs/9.21.0/firebase-app.js";
        import {getAnalytics} from "https://www.gstatic.com/firebasejs/9.21.0/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyC3X3xIe_RdiynrDxXTPBxuw2GhiU1fT9A",
            authDomain: "vore-fetish.firebaseapp.com",
            projectId: "vore-fetish",
            storageBucket: "vore-fetish.appspot.com",
            messagingSenderId: "1010073502150",
            appId: "1:1010073502150:web:8c721819a7d184f06732c7",
            measurementId: "G-3M4FMGE1G3"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>
    @yield('style')

    <?php
    $excludeuri = array("{id}/favoriteartwork", "pm", "dlcupload", "userupload", "{id}/info", "{id}/journal", "{id}/rpstatus", "{id}/profilepost", "{id}/about", "dashboard/{id}", "dashboard", "profilepost", "about", "rpstatus", "favoriteartwork", "info", "journal");
    $theme = "blue_theme";
    if (request()->route()->uri == "userupload" || request()->route()->uri == "dlcupload") {
        $theme = "green_theme";
    }
    if (request()->route()->uri == "pm") {
        $theme = "orange_theme";
    }
    if (in_array(request()->route()->uri, $excludeuri)){
        ?>
    {{-- <link rel="stylesheet" href="{{ url('public/assets/css/style-2.css') }}" /> --}}
        <?php
    } else if (request()->route()->uri == "pm"){
        ?>
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}"/>
        <?php
    } else{
        ?>
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}"/>
        <?php
    }
    ?>
    {{--    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">--}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #ffffff;
            color: #222;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }
            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }
            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }
            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }
            to {
                bottom: 0;
                opacity: 0;
            }
        }

        .user-profile-picture {
            width: 400px;
            height: 227px;
        }

        .user-pg .user-profile-picture img {
            width: 100%;
            height: 100%;
        }
        body{
            background: url(/public/assets/images/green_backgroun_pattern.webp);
        }
        .user-about-sctn.user-pg{
            background: url(/public/assets/images/green_backgroun_pattern.webp);

        }
        .navbar-top-right-menu li a{
            background: url(/public/assets/images/green_button_pattern.webp) 0 0/cover !important;
            color:black;
        }

        header .navbar-bottom{
            background: url(/public/assets/images/green_button_pattern.webp) !important;
        }

        #own-creator-hearder {
            background:
                url('/public/assets/images/banner.png') top center no-repeat,
                #000;
            background-size: 100% 50%, 100% 100%;
            height: auto;
        }

    </style>
</head>
<livewire:cursor-style>
    <body class="" style="font-family:{{ $font }}">
    <div class="">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <?php
            if (request()->route()->uri == "userupload" || request()->route()->uri == "dlcupload"){ ?>
            @include('front.layouts.header1')
                <?php
            }else if (request()->route()->uri == "pm"){
                ?>
            @include('front.layouts.header2')
                <?php
            }else if (in_array(request()->route()->uri, $excludeuri)){

            }else{
                ?>
            @include('front.layouts.header')
                <?php
            }
////            ?><!----><!---->
            <!-- partial -->
            @yield('content')
            <!-- main-panel ends -->
            <!-- container-scroller ends -->

            

            <!-- partial:partials/_footer.html -->
            @include('front.layouts.footer')
            <!-- partial -->
        </div>
    </div>
    @include('front.layouts.script')
    @stack('script')
    {{-- <script>
        $(".notifications-list").hide();
        $(".notification-icon").click(function() {
            $(".notifications-list").toggle();
        });

        $('#close').click(function(){
            $('.notifications-list').slideToggle();
        });
    </script> --}}
    </body>
</html>
