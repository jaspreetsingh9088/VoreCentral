@extends('front.creator.layout.app')
@section('title', 'Featured Gallery')
@section('bodyclass','green_theme creator_main_theme gallery_audio')
@section('content')
@php
// $customebg = Auth::user()->themebg;
$customebg = Auth::user()->toArray()['themebg'];
$style = '';
$custom_bg = '';
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
</style>
@endif
    <div class="">
        <div class="main-panel">
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
                                <input type="text" placeholder="Search.." style="width:77%; ">
                                <button type="button" class="btn btn-outline-primary" style="height: 46px; margin: left 4px;background: #195519; font-weight: 500; font-stretch: normal; font-style: normal; font-size: 17px;">Search</button>
                                <div class="dropdown">
                                    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" style="background:#195519; color:#fff;      font-weight: 500; font-stretch: normal; font-style: normal;font-size: 17px; margin-left: 7px;padding: 11px 23px 7px 18px;">
                                        Filter
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/new') }}">Newest first </a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/view') }}">Most Viewed</a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/old') }}">Oldest First</a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/fav') }}">Most favorited</a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/random') }}">Random Order</a>
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
                                        <h3 class="text-center" style="color: #000;">You do not have any content yet. Please add to view here</h3>
                                    @endif
                                </ul>
                            </div>
                            <!--Pagination-->
                            @if($UsercontentData)
                                {{ $UsercontentData->links('vendor.pagination.bootstrap-5') }}
                            @endif
                            <!--End-->
                        </div>

                        <div class="col-xl-2">
                            <div class="add_banner1">
                                <div class="ad_banner vertical">
                                    <div data-banner-id="425472"></div>
                                </div>
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
        </div>
    </div>
@endsection
