<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
        <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
        <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
        @yield('style')
        <style>
            header {
                background:url({{asset('assets/images/business/main_page.webp')}}) !important;
                background-size: cover !important;
            }
        </style>
    </head>
    <livewire:cursor-style>
    <body class="{{ $theme ? $theme : 'blue_theme' }} bg_pattern" style="font-family:{{ $font }}">
        @include('front.layouts.header')

        @include('front.homepage.setting.layout.secondary-header')

        @yield('content')

        @include('front.layouts.footer')
    </body>
         @include('front.layouts.script')
        <script>
            $(".toggle-menu").click(function () {
                $(this).toggleClass("nav-close");
                $(".nav-primary").slideToggle();
            });

            $('#close').click(function(){
                $('.nav-primary').slideToggle();
            });
        </script>
        @stack('script')
</html>
