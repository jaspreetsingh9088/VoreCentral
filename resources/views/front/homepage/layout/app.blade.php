<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <meta name="6a97888e-site-verification" content="02058f755c6c7f32cfd5bd0f42e44bdb">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{url('url/images/favicon.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style-2.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <script src="{{ asset('url/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZFM1CHHHPH"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('url/js/jquery-3.6.0.min.js') }}"></script>

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
    <style>
        #snackbar {
            display: none;
        }

        header {
            background: url({{asset('assets/images/business/main_page.webp')}}) !important;
            background-size: cover !important;
        }
        header .navbar-bottom .navbar-nav .nav-item .submenu{
            --navbar-bg: url(../images/button_pattern.webp);
        }
        .threadcomment img{
            width:300px !important;
        }
    </style>
</head>
<livewire:cursor-style>
   <body class={{$theme ? $theme : 'blue_theme' }}  style="font-family:{{ $font }};background-color:#1c142b">
    @include('front.layouts.header')
    @yield('content')
    @include('front.layouts.footer')

    <div id="cookiePopup" class="hide">
        <h3>Cookie Consent</h3>
        <p>
            By continuing to browse or by clicking 'Accept', you agree to the storing of cookies on your device to enhance your site experience and for analytical purposes. To learn more about how we use the cookies, please see our cookis policy.Our website uses cookies to provide your browsing experience and
            relevant information. Before continuing to use our website, you agree &
            accept of our <a href="#">Cookie Policy & Privacy.</a>
        </p>
        <button id="acceptCookie">Accept</button>
    </div>
    <div id="agePopup" class="hide">
        <h3>Are you above 18?</h3>
        <p>
            By continuing to browse or by clicking 'Accept', you agree to the storing of cookies on your device to enhance your site experience and for analytical purposes. To learn more about how we use the cookies, please see our cookis policy.Our website uses cookies to provide your browsing experience and
            relevant information. Before continuing to use our website, you agree &
            accept of our <a href="#">Cookie Policy & Privacy.</a>
        </p>
        <button id="above18yes">Yes</button>
        <button id="above18no">No</button>
    </div>
    </body>

    @include('front.layouts.script')
    <script async src="{{asset('assets/js/cookie.js')}}"></script>
    <script>
        $(".toggle-menu").click(function () {
            $(this).toggleClass("nav-close");
            $(".nav-primary").slideToggle();
        });

        $('#close').click(function () {
            $('.nav-primary').slideToggle();
        });
    </script>
@stack('script')
<style>
body{
background:rgb(28, 20, 43) !important;
}
</style>
</html>
