@extends('front.creator.uploadpage-layout.app')
@section('title', 'Featured Channel')
@section('bodyclass','green_theme')
@section('content')
    <div style="height: 100vh;">
        <div class="main-panel">
	        <div class="content-wrapper">
                <div class="container">
                    <div class="row aos-init aos-animate manage_feature" data-aos="fade-up">
                        <div class="col-sm-12">
                            <div class="manage_area ">
                                <h2>Featured Channels</h2>
                                <div class="manage_gallery_sect manage_feature_collect">
                                    <ul>
                                        <?php
                                        if(isset($UserData) && is_array($UserData) && count($UserData) > 0 ){
                                            foreach($UserData as $UserDataK => $UserDataV){
                                                ?>
                                                <li><a href="" target="_blank" class=""><img src="{{$UserDataV['profile_pic']}}" alt="thumb" class="img-fluid "></a></li>
                                                <?php 
                                            }
                                        }else{ ?> 
                                            <h3 class="text-center">You do not have any featured channels yet. Please add to view here</h3>
                                        <?php } ?>
                                    </ul>
                                    <div class="upload_delete info-btn">
                                        Create new
                                        <span class="plus">
                                            <svg style="width:50px;height:50px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                                            </svg>
                                        </span>
                                        <span class="small_font">New collection</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
		        </div>
            </div>
        </div>
    </div>
    <div class="popup-background" id="popup-background" style="z-index: 99;">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set">
                    <form class="sign_up_form" action="{{ route('setfeaturedchannel') }}" class="card mb-3" method="POST"   enctype="multipart/form-data" style="width:100%;">
                        @csrf
                        <span class="close-icon close-iconn">X</span>
                        <div class="row mb-3" style="height: 350px;overflow: scroll;">
                            <?php
                            if(isset($AllUserData) && is_array($AllUserData) && count($AllUserData) > 0 ){
                                foreach($AllUserData as $AllUserDataK => $AllUserDataV){
                                    ?>
                                    <div class="col-lg-3 relative-box">
                                        <input  type="checkbox" class="check-select" name="images[]" value="{{ $AllUserDataV['id'] }}" />
                                        <img for="test{{ $AllUserDataV['id'] }}" src="{{ $AllUserDataV['profile_pic'] }}" class="img-fluid" style="height:150px;" />
                                    </div><?php
                                }
                            } ?>
                        </div>
                        <div class="bottom-box">
                            <a href="#" class="close-btn close-iconn"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <button type="submit" class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection