@extends('front.creator.layout.app')
@section('title', 'Creator Dashboard')
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
            <div class="row creator_upload aos-init aos-animate" data-aos="fade-up">
                <div class="col-xl-8  grid-margin">
                    <div class="featured_section featured_photo">
                        <div class="card-title mt-4">
                            Featured Upload
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12 grid-margin">
                                <div class="position-relative">
                                    <div class="rotate-img featured_img">
                                        @if (isset($SingleFeaturedcontentData) && is_array($SingleFeaturedcontentData) && count($SingleFeaturedcontentData) > 0)
                                            <img src="{{ $SingleFeaturedcontentData[0]['thumbnail'] }}" alt="thumb" class="img-fluid">
                                        @else
                                            <img src="{{ url('public/assets/images/default-image.jpg') }}" alt="thumb" class="img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="right_creator">
                        <!-- <h2>Profile Information about creator etc</h2> -->
                        <!--<div class="buttons-container"><button type="button" class="red_theme_bt" style="position:relative; margin-right:5px;">Subscribe</button></div>-->

                        <ul class="profile-listing-creator">
                      		<li>    <a href="#">Number of followers:            {{$AllFollower}}                                </a>    </li>
                        	<li>    <a href="#">Profile rank :                  {{ $userinfo['profile_rank'] }}                 </a>    </li>
                            <li>    <a href="#">Profile Type :                  {{ $userinfo['profile_type'] }} </a>    </li>
                            <li>    <a href="#">Administration Status :         {{ ($myData['moderator']==1)?'Moderator':'None' }} </a>    </li>
                            <li>    <a href="#">Number of uploads :             {{ $userinfo['upload_count'] }}                 </a>    </li>
                            <li>    <a href="#">Number of threads started :     {{ $userinfo['thread_count'] }}                 </a>    </li>
                            <li>    <a href="#">Number of comments :            {{ $userinfo['total_comment'] }}                </a>    </li>
                            <li>    <a href="#">Has been a member for :         {{ $userinfo['hasbeenmember'] }} Days           </a>    </li>
                            <li>    <a href="#">Gender :                        {{ucwords($myData['gender'])}}               </a>    </li>
                            <li>    <a href="#">Pred/prey/Switch/Observer/None :{{ ucwords($myData['role_preference']) }}    </a>    </li>
                            <li>    <a href="#">Sexual orientation :            {{ ucwords($myData['sexual_orientation']) }} </a>    </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row creator_upload aos-init" data-aos="fade-up">
                <div class="col-xl-8  grid-margin">
                    <div class="recent_photo recent_upload">
                        <?php
                        if(isset($RecentUsercontent) && is_array($RecentUsercontent) && count($RecentUsercontent) > 0 ){
                            foreach($RecentUsercontent as $RecentUsercontentK => $RecentUsercontentV){ ?>
                                <div class="featured_section">
                                    <div class="card-title">
                                        Recent Upload
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 grid-margin">
                                            <div class="position-relative">
                                                <div class="rotate-img featured_img">
                                                    <img src="{{ $RecentUsercontentV['thumbnail']}}" alt="thumb" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                    <div class="recent_photo">
                        <div class="featured_section">
                            <div class="card-title">
                                Featured Collection
                            </div>
                            <?php
                            if(isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0 ){
                                foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){ ?>
                                    <div class="row creator_box_main create_collect aos-init aos-animate" data-aos="fade-up">
                                        <div class="col-sm-12">
                                            <div class="creator_box">
                                                <div class="row flex-nowrap" style="overflow-x: scroll;">
                                                    <?php
                                                    if(isset($UsercontentDataV) && is_array($UsercontentDataV) && count($UsercontentDataV) > 0 ){
                                                        foreach($UsercontentDataV as $UsercontentDataKK => $UsercontentDataVV){
                                                            ?>
                                                            <div class="col-lg-3 col-md-4">
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
                            }else{
                                ?>
                                <div class="right_creator">
                                    <ul class="profile-listing-creator">
                                        <li><a href="#">You do not have any featured collection yet. Please add to view here</a></li>
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3  text-right">
                    <div class="ad_banner vertical">
                        <div data-banner-id="425472"></div>
                    </div>
                </div>

            </div>
            <div class="row aos-init" data-aos="fade-up">
                <div class="col-sm-12">
                    <div class="ad_banner landscape">
                        <div data-banner-id="425470"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-panel ends -->
    <!-- container-scroller ends -->

    <!-- partial:partials/_footer.html -->
    <div class="cover-upload">
        <div class="cover-inner">
            <div class="cover-box-upload">
                <div class="upload-file-container">
                    <div class="close-icon">X</div>
                    <form class="sign_up_form" enctype='multipart/form-data' class="card mb-3">
                        @csrf

                        <img class="thum-file-image" src="" alt="cover image" style="width: 270px; margin-bottom: 10px; display: none;">
                        <input type="file" name="cover_pic" accept="image/*" onchange="readURL(this);" style="color: #000;" />
                        <input type="submit" value="upload">
                    </form>
                    <div id="response_message" style="display:none;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeBannerModal" tabindex="-1"role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="hedding">Remove Banner</h2>
                </div>
                <div class="modal-body">
                    <h5>Are You Sure You Want To Remove This Banner?</h5>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('remove-picture', ['type' => 'banner']) }}" class="btn btn-primary">Remove</a>
                    <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal" style="color: #fff;">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="removeProfileImageModal" tabindex="-1"role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="hedding">Remove Profile Picture</h2>
                </div>
                <div class="modal-body">
                    <h5>Are You Sure You Want To Remove This Profile Picture?</h5>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('remove-picture', ['type' => 'profile_picture']) }}" class="btn btn-primary">Remove</a>
                    <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal" style="color: #fff;">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->
    </div>
    </div>
@endsection
@push('script')
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.thum-file-image').attr('src', e.target.result);
                $('.thum-file-image').show();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }
@endpush
