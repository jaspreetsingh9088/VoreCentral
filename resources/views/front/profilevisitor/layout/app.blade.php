<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="64x64" />
        <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
        <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
        <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
        <style>
            @yield('style')
            .user-profile-picture{
                width: 400px;
                height: 227px;
            }
            .user-pg .user-profile-picture img{
                width: 100%;
                height: 100%;
            }
        </style>
    </head>
    <livewire:cursor-style>
    <body class="blue_theme bg_pattern" style="font-family:{{ $font }}">
        @include('front.profilevisitor.layout.header')



        @yield('content')

        @include('front.layouts.footer')
    </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        @stack('script')
        <script>
            $(".toggle-menu").click(function () {
                $(this).toggleClass("nav-close");
                $(".nav-primary").slideToggle();
            });

            $('#close').click(function(){
                $('.nav-primary').slideToggle();
            });
        </script>
        @yield('script')
</html>
