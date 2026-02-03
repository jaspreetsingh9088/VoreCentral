@extends('front.layouts.app')
@php
    $title = 'Profile Post';
@endphp
@section('title', $title)
@section('content')
@include('front.layouts.profileview')
<section class="user-about-sctn user-pg">
    <div class="container">
        <div class="row">
            @include('front.layouts.usersidepanel')
            <div class="col-lg-8 pl-0">
                <div class="user-section1 auto-height" style="height:auto;">
                    <div class="middle-part-padding dashboard-mobile">
                        <div class="row mb-3 mt-3">
                            <div class="col-lg-2 col-md-2 col-3">
                                <img src="{{ $myData['profile_pic'] }}" alt="user_profile_image" class="img-fluid img-rounded">
                            </div>
                            <div class="col-lg-10 col-md-10 col-9 form-setting">
                                <form class="sign_up_form w-100" method="POST" action="{{ route('addpost') }}" redirect="{{ url()->current() }}">
                                    @csrf
                                    <textarea class="form-control mb-2" name="post" required style="border-radius: 5px; width : 95%;"></textarea>
                                    <input type="submit" value="Create post" style="border-radius: 5px; background : #0079ff; border : 1px solid #000;padding : 5px;">
                                </form>
                            </div>
                        </div>
                        <?php
                        if(isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0){
                            foreach($myPostdata as $myPostdataK => $myPostdataV){ ?>
                                <div class="row mb-5" id="profilepost{{$myPostdataV['id']}}">
                                    <div class="col-lg-2 col-md-2 col-3">
                                        <img src="{{ $myData['profile_pic'] }}" alt="user_profile_image" class="img-fluid img-rounded">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-9 comments-setting">
                                        <div style="background: blue; padding : 5px; border-radius : 5px; width : 95%;">
                                            <p style="border-bottom: 1px solid #000; padding-bottom : 5px; margin-bottom :0px; color : #000;">
                                                {{ $myPostdataV['post'] }}
                                            </p>
                                            <p style="margin-bottom :0px;">
                                                <a href="#">Like {{ $myPostdataV['likecount'] > 0 ? $myPostdataV['likecount'] :'' }}</a>
                                            </p>
                                        </div>
                                        <?php
                                        if(isset($myPostdataV['commentdata']) && is_array($myPostdataV['commentdata']) && count($myPostdataV['commentdata']) > 0){
                                            echo " <h4 style='color:#222;'> Comments </h4>";
                                            foreach($myPostdataV['commentdata'] as $commentDataK => $commentDataKV){ ?>
                                                <div style="background: white; padding : 5px; border-radius : 5px; width : 95%;" class="mb-1">
                                                    <p style="border-bottom: 1px solid #000; padding-bottom : 5px; margin-bottom :0px;">{{ $commentDataKV['comment'] }}</p>
                                                    <p style="margin-bottom: 0px;">
                                                        Added on {{ date('d-m-Y',strtotime($commentDataKV['created_at'])) }}
                                                        | Added by :
                                                        <a href="{{ $commentDataKV['dashboardlink'] }}">
                                                            {{ ucwords($commentDataKV['username']) }}
                                                        </a>
                                                        <a href="{{ URL('removecomment/'.$commentDataKV['id']) }}">
                                                            <i class="fa fa-trash" style="color:red;" aria-hidden="true"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                                <?php
                                            }
                                        } ?>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>


@endsection
@push('script')
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    <script src="{{ url('public/assets/js/formsubmit.js') }}"></script>

    <script>
        $(document).ready(function () {


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

@endpush
