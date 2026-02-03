@extends('front.creator.layout.app')
@section('title', 'Featured Gallery')
@section('bodyclass','green_theme gallery_audio')
@section('style')
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
    .navbar-top{
        padding: 46px 0 !important;
    }
@endsection

@section('content')
@php
$customebg = Auth::user()->themebg;
$style = '';
if($customebg != null){
    $style = 'background: url('.$customebg.') 0% 0% / cover repeat !important;';
    $customebg = ".add-custom-bg{background:url({$customebg}) repeat; background-size:cover;}";
} else {
    $customebg = "var(--body-bg)";
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

    .creator-pg-pattern, .gallery_audio{
        {{ $style }}
    }
</style>
@endif
    <div class="">
        <div class="main-panel">
            <!-- partial -->
            <div class="content-wrapper">
                <div class="container">

                    <div class="row gallery_audio_sect" data-aos="fade-up">

                        <div class="col-xl-2 p-1">
                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>
                        </div>



                        <div class="col-xl-8  grid-margin">

                            <div class="input-group">
                                <input type="search" class="form-control rounded" placeholder="Search"
                                    aria-label="Search" aria-describedby="search-addon">
                                <button type="button" class="btn btn-outline-primary"
                                    style="height: 52px;">search</button>


                                <div class="dropdown">
                                    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" style="background:#195519; color:#fff;      font-weight: 500; font-stretch: normal; font-style: normal;font-size: 17px; margin-left: 7px;padding: 11px 23px 7px 18px;">
                                        Filter
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ URL('media/'.$media_type.'/?sort=new') }}">Newest first </a>
                                        <a class="dropdown-item" href="{{ URL('media/'.$media_type.'/?sort=view') }}">Most Viewed</a>
                                        <a class="dropdown-item" href="{{ URL('media/'.$media_type.'/?sort=old') }}">Oldest First</a>
                                        <a class="dropdown-item" href="{{ URL('media/'.$media_type.'/?sort=fav') }}">Most favorited</a>
                                        <a class="dropdown-item" href="{{ URL('media/'.$media_type.'/?sort=random') }}">Random Order</a>
                                    </div>
                                </div>
                            </div>

                            <div class="gallery_audio_listing">
                                <ul>
                                    @if (isset($UsercontentData) && count($UsercontentData) > 0)
                                        @foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV)
                                            <li>
                                                <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}" class="">
                                                    <img src="{{ $UsercontentDataV['thumbnail'] }}" alt="thumb" class="img-fluid ">
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <h3 class="text-center">Content not found.</h3>
                                    @endif
                                </ul>
                            </div>
                            {{ $UsercontentData->links() }}
                        </div>

                        <div class="col-xl-2">
                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>
                        </div>

                    </div>

                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-12">
                            <div class="ad_banner landscape">
                                <div data-banner-id="425470"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
@endsection
