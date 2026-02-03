<html>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
        content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZFM1CHHHPH"></script>
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
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.21.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.21.0/firebase-analytics.js";
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
</head>
<style>
    @yield('style') .creator_main_theme header .navbar-bottom .navbar-nav .nav-item .nav-link {
        padding: 18px 7px;
        line-height: 22px;
    }

    ul.social-icons {
        text-align: right;
        margin-top: 30px;
        padding: 0px;
    }

    .navbar-nav li:hover>ul.dropdown-menu {
        display: block;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
    }

    /* rotate caret on hover */
    .dropdown-menu>li>a:hover:after {
        text-decoration: underline;
        transform: rotate(-90deg);
    }

    ul.dropdown-menu {
        margin: 0px;
        border-radius: 0px;
        padding: 0px;
        border: 0px;
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
        border-bottom: 1px solid #e3e3e3;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: #123e12;
        color: #fff;
    }

    .buttons-container {
        text-align: right;
        margin-top: -40px;
    }

    .creator_logo h2 {
        background: #fff;
        margin-top: 8px;
        padding: 48px 8px;
        font-size: 19px;
        margin: 0px;
    }

    .banner_homebutton {
        background: #1c621e;
        color: black !important;
        padding: 14px 85px !important;
        position: absolute;
        font-weight: 900;
        line-height: 14px;
        font-size: 20px;
        z-index: 9999;
    }

    .banner_homebutton:hove {
        background: #1c621e !important;
    }

    @media only screen and (min-width: 761px) and (max-width: 1023px) {
        .banner_homebutton {
            top: 30px;
            right: 50%;
        }
    }
</style>
@php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
$id = request()->route('id');
 if ($id) {
    $customebg = User::find($id)?->themebg ?? Auth::user()->themebg;
 } else {
    $customebg = Auth::user()->themebg;
 }

if($customebg != null){
$style = 'background: url('.$customebg.') 0% 0% / cover repeat !important;';
}
@endphp
<body class="@yield('bodyclass')" data-aos-easing="ease" data-aos-duration="2000" data-aos-delay="0"
style="<?php echo $style; ?>">

    @include('front.creatorvisitor.layout.header')

    @yield('content')

    @include('front.layouts.footer')

</body>
<!-- inject:js -->
<script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{ url('public/assets/js/demo.js')}}"></script>
<script src="{{ url('public/assets/js/jquery.easeScroll.js')}}"></script>

<!-- End custom js for this page-->
<script src="{{ url('public/assets/js/formsubmit.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        @stack('script')
        $('.cover-upload').hide();
        $('.profile-upload').hide();

        $(".user-profile-picture img").click(function () {
            $('.profile-upload').show();
        });
        $(".add-banner-image").click(function () {
            $('.cover-upload').show();
        });
        $(".close-icon").click(function () {
            $(this).parent().parent().parent().parent().hide();
        });
        $(".follow-unfollow").click(function () {
            $(this).text(function (i, text) {
                return text === "Follow" ? "Unfollow" : "Follow";
            })
        });

    });
</script>

</html>
