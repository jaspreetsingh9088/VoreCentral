<html>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <meta name="description"
        content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @if(Route::current()->getName() != 'creatorjournal' && Route::current()->getName() != 'creator.content.upload' &&
    Route::current()->getName() != 'creator.dlc.upload')
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    @endif
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZFM1CHHHPH"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
    @yield('stylelink')
</head>

@php
$style = '';
if(isset($generalsetting)){
$custom_theme = $generalsetting->creator_pages_custom_theme;
if($custom_theme == 1){
$customebg = Auth::user()->themebg;
if($customebg != null){
$style = "body{background: url({$customebg}) 0% 0% / cover repeat !important;}";
$style .= ".creator-pg-pattern, .gallery_audio{background:url({$customebg}) 0 0/cover;}";
$style .= ".creator-jornal-pg{background:url({$customebg});}";
}
}
}
$attr = '';
$style1 = '';
if(Route::current()->getName() != 'creatorjournal'){
$attr = 'data-aos-easing="ease"
data-aos-duration="2000"
data-aos-delay="0"';
$style1 = 'style="background:url('.Auth::user()->themebg.') repeat; background-size:cover ; font-family:'.$font.';';
}
$customebg = Auth::user()->themebg;
if($customebg != null){
$style = 'background: url('.$customebg.') 0% 0% / cover repeat !important;';
}
@endphp
@if($style)
<style>
    {
            {
            $style
        }
    }

    #snackbar {
        display: none;
    }
</style>
@endif
<style>
    .creator_logo h2 {
        background: #fff;
        margin-top: 8px;
        padding: 48px 8px;
        font-size: 19px;
        margin: 0px;
    }

    .profile-pic {
        border-radius: 5px;
        height: 125px;
        width: 125px;
        background-size: cover;
        background-position: center;
        background-blend-mode: multiply;
        vertical-align: middle;
        text-align: center;
        color: transparent;
        transition: all .3s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .profile-pic:hover {
        background-color: rgba(0, 0, 0, .5);
        z-index: 10000;
        color: #fff;
        transition: all .3s ease;
        text-decoration: none;

    }

    .profile-pic span {
        display: inline-block;
        padding-bottom: 4.5em;
        padding-top: 4.5em;
        font-size: 12px;
    }

    .profile_pic_input {
        display: none;
        cursor: pointer;
    }

    .cover-change:hover {
        background: #fff;
        color: #1a541b;
    }

    .cover-image-remove:hover {
        background: #fff;
        color: #EA4335;
    }

    @media only screen and (min-width:761px) and (max-width:1023px) {
        .profile-pic {
            border-radius: 5px;
            height: 44px;
            width: 44px;
        }
    }

    header:hover .cover-change, header:hover .cover-image-remove {
        display: block;
        z-index: 999999;
    }

    .cover-change, .cover-image-remove {
        position: absolute;
        right: 0;
        color: white;
        border-radius: 50px;
        border: 1px solid white;
        padding: 10px;
        margin-right: 11px;
        display: none;
        top: 6px;
    }

    .cover-image-remove {
        right: 70px;
    }

    .banner_homebutton {
        background: #1c621e;
        color: black !important;
        padding: 14px 78px !important;
        position: absolute;
        font-weight: 900;
        line-height: 14px;
        font-size: 20px;
        z-index: 9999;
    }

    .banner_homebutton:hove {
        background: #1c621e !important;
    }

    .gallery_audio header .navbar-bottom .navbar-nav .nav-item .nav-link {
        border-right: 0px;
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

    .form-control {
        border: #000 solid 1px;
        border-radius: 0px !important;
    }

    .btn-outline-primary {
        background-color: #000;
        color: #FFFFFF;
        border-radius: 0px !important;
    }

    .notifications-list {
        top: 110px;
        right: 15px;
    }

    .navbar-top {
        padding: 46px 0 !important;
    }

    .banner_homebutton {
        background: #1c621e;
        color: black !important;
        padding: 14px 78px !important;
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

    @yield('style')
</style>
<livewire:cursor-style>

    <body class="@yield('bodyclass')" {{$attr}} style="{{$style}}">

        @include('front.creator.layout.header')

        @yield('content')

        @include('front.layouts.footer')

    </body>
    @if(Route::current()->getName() != 'creator.dlc.upload' && Route::current()->getName() != 'creator.content.upload')
    <script src="{{ url('public/assets/js/formsubmit.js') }}"></script>
    <script src="{{ url('public/assets/js/common.js')}}"></script>
    @endif
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>
    <script src="{{ url('public/assets/js/demo.js')}}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js')}}"></script>

    @stack('scriptwithlink')
    <script>
        @stack('script')
        $(document).ready(function () {
            $(".notifications-list").hide();
            $(".notification-icon").click(function () {
                $(".notifications-list").toggle();
            });
            $('#close').click(function () {
                $('.notifications-list').slideToggle();
            });
            $('.cover-upload').hide();
            $('.profile-upload').hide();
            $(".user-profile-picture img").click(function () {
                $('.profile-upload').show();
            });
            $(".cover-change").click(function () {
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
    <script>
        document.getElementById('fileToUpload').addEventListener('change', function () {
            var formData = new FormData(document.getElementById('upload-form'));
            var file = document.getElementById('fileToUpload').files[0];
            formData.append("file", file);
            $.ajax({
                url: '{{ route('updateprofilepic') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.code === 200) {
                        location.reload();
                    }
                }
            });
        });
    </script>
    <script>
        $('.sign_up_form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('updatecoverpic') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#response_message').html('<p style="color:#28A74B;">'+data.message+'</p>');
                    $('#response_message').show();
                    location.reload();
                },
                error:function(resp){
                    var errors = resp.responseJSON;
                    if(errors){
                        errorsHtml = '<strong class="text-danger">';
                        var sep = "";
                        $.each(errors.errors, function(k, v) {
                            errorsHtml += sep+v;
                            sep = ", ";
                        });
                        errorsHtml += '</strong>';
                        $('#response_message').html(errorsHtml);
                    }else{
                        $('#response_message').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    }

                    if(resp.status == 413){
                        $('#response_message').html('<strong class="text-danger">File upload failed. Maximum file size should be 10 MB.</strong>');
                    }
                    $('#response_message').show();
                }
            });
        });
    </script>

</html>
