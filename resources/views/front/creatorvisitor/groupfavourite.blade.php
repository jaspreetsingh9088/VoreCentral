@extends('front.creatorvisitor.layout.app')
@section('title', 'Group Favourite')
@section('bodyclass','green_theme gallery_audio')
@section('content')
<div class="">
    <div class="main-panel">
        <div class="content-wrapper pt-0">
            <div class="container">
                <div class="row creator_community creator-pg-pattern pt-4" data-aos="fade-up">
                    <div class="col-lg-9">
                        <div class="group_creator">
                            <h2>Groups</h2>
                            <div class="group_img_listing" style="    padding: 0px;">
                                <ul class="row" style="display: flex;flex-direction: row;flex-wrap: nowrap;align-items: center;overflow-x: scroll;align-content: center;">
                                    <?php
                                    if(isset($GroupcontentData) && is_array($GroupcontentData) && count($GroupcontentData) > 0 ){
                                        foreach($GroupcontentData as $GroupcontentDataK => $GroupcontentDataV){
                                            ?>
                                            <li class="col-md-2">
                                                <a href="{{ URL('contentdetail/' . $GroupcontentDataV['id']) }}" target="_blank" class="">
                                                    <img src="{{ $GroupcontentDataV['thumbnail'] }}" alt="thumb" class="img-fluid ">
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }else{ ?>
                                        <div class="col-md-12">
                                            <h3 class="text-center" style="color: black;">You do not have any content yet. Please add to view here</h3>
                                        </div>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="group_creator">
                            <h2>Favorites</h2>
                            <div class="group_img_listing green_patter2" style="padding:0px">
                                <ul class="row" style="display: flex;flex-direction: row;flex-wrap: nowrap;align-items: center;overflow-x: scroll;align-content: center;">
                                    <?php
                                    if(isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0 ){
                                        foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){
                                            ?>
                                            <li class="col-md-2">
                                                <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}" target="_blank" class="">
                                                    <img src="{{ $UsercontentDataV['thumbnail'] }}" alt="thumb" class="img-fluid ">
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }else{ ?>
                                        <div class="col-md-12">
                                            <h3 class="text-center" style="color: black;">You do not have any content yet. Please add to view here</h3>
                                        </div>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="group_creator">
                            <h2>Featured Channels</h2>
                            <div class="group_img_listing" style="padding:0px">
                                <ul class="row" style="display: flex;flex-direction: row;flex-wrap: nowrap;align-items: center;overflow-x: scroll;align-content: center;">
                                    <?php
                                    if(isset($FollowingcontentData) && is_array($FollowingcontentData) && count($FollowingcontentData) > 0 ){
                                        foreach($FollowingcontentData as $FollowingcontentDataK => $FollowingcontentDataV){
                                            ?>
                                            <li class="col-md-2">
                                                <a href="" target="_blank" class="">
                                                    <img src="{{ $FollowingcontentDataV['profile_pic'] }}" alt="thumb" class="img-fluid ">
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }else{ ?>
                                        <div class="col-md-12">
                                            <h3 class="text-center" style="color: black;">You do not have any featured channerl. Please add to view here</h3>
                                        </div>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="ad_banner vertical">
                            <div data-banner-id="425472"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
