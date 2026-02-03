@extends('front.layouts.app')
@php
$title = 'Info';
@endphp
@section('title', $title)
@section('content')


@include('front.layouts.profileview')

<section class="user-about-sctn user-pg">
    <div class="container">
        <div class="row">
              @include('front.layouts.usersidepanel')
              <div class="col-lg-8 pl-0">
                <div class="user-section1 auto-height" style="height:auto ; padding:30px;">
                	<div class="middle-part-padding">
                		<h2 class="profile-info-heading">Profile info</h2>
                        <ul class="profile-listing">
                        	<li>
                                <strong>Profile rank  <span style="float:right;">{{ $userinfo['profile_rank'] }}</span></strong>
                            </li>
                            <li>
                                <strong>Profile Type <span style="float:right;">{{ $userinfo['profile_type'] }}</span></strong>
                            </li>
                            <li>
                                <strong>Administration Status <span style="float:right;">None</span></strong>
                            </li>
                            <li>
                                <strong>Number of uploads <span style="float:right;">{{ $userinfo['upload_count'] }}</span></strong>
                            </li>
                            <li>
                                <strong>Number of threads started <span style="float:right;">{{ $userinfo['thread_count'] }}</span></strong>
                            </li>
                            <li>
                                <strong>Number of comments <span style="float:right;">{{ $userinfo['total_comment'] }}</span></strong>
                            </li>
                            <li>
                                <strong>Has been a member for <span style="float:right;">{{ $userinfo['hasbeenmember'] }} Days</span></strong>
                            </li>
                            <li>
                                <strong>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></strong>
                            </li>
                            <li>
                                <strong>Pred/prey/Switch/Observer/None <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></strong>
                            </li>
                        </ul>
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
$( document ).ready(function() {
$('.cover-upload').hide();
$('.profile-upload').hide();

$(".user-profile-picture img").click(function(){
	$('.profile-upload').show();
});

$(".add-banner-image").click(function(){
	$('.cover-upload').show();
});


$(".close-icon").click(function(){
	$(this).parent().parent().parent().parent().hide();
});




$(".follow-unfollow").click(function () {
      $(this).text(function(i, text){
          return text === "Follow" ? "Unfollow" : "Follow";
      })
   });

});
</script>

@endpush
