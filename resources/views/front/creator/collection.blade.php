@extends('front.creator.layout.app')
@section('title', 'Collection')
@section('bodyclass','green_theme creator_main_theme gallery_audio')
@section('content')
@php
$customebg = Auth::user()->themebg;
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
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="top_gallery creator_search">
                        <div class="search_box">
                            <span class="text-danger">
                                <div class="input-group">
                                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                                    <button type="button" class="btn btn-outline-primary">search</button>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0 ){
                foreach($Owncollaction as $OwncollactionK => $OwncollactionV){ ?>
                    <div class="col-md-12">
                        <h1> {{ $OwncollactionV['collection_name'] }} </h1>
                    </div>
                    <div class="row creator_box_main create_collect aos-init aos-animate" data-aos="fade-up">
                        <div class="col-sm-12" style="background:#fff; border: 3px solid;">
                            <div class="">
                                <div class="row flex-nowrap" style="overflow-x: scroll;">
                                    <?php
                                    if(isset($OwncollactionV['contentData']) && is_array($OwncollactionV['contentData']) && count($OwncollactionV['contentData']) > 0 ){
                                        foreach($OwncollactionV['contentData'] as $UsercontentDataKK => $UsercontentDataVV){ ?>
                                            <div class="col-lg-3 col-md-4" style="padding: 1.5rem;">
                                                <div class="creator-inn">
                                                    <a href="{{ URL('contentdetail/' . $UsercontentDataVV['id']) }}">
                                                        <img src="{{ $UsercontentDataVV['thumbnail'] }}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <?php 
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }else{ ?>
                <div class="col-md-12">
                    <h3 class="text-center" style="color: black;">You do not have any content yet. Please add to view here</h3>
                </div>
            <?php } ?>
        </div>
    </div>
@endsection