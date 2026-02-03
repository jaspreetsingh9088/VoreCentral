@extends('front.layouts.app')
@php
$title = 'Favoriteart Work';
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
                	<div class="middle-part-padding-1">

                    	<div class="row mb-5">
                        <?php
                        if(isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0 ){
                        foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){
                        ?>
                         <div class="col-lg-3" style="padding-top:2rem;">
                        	<div class="center-part-white" style="width: 100%;
    height: 30vh;"><img src="{{$UsercontentDataV['thumbnail']}}" alt="thumb" class="img-fluid " style="
    height: 30vh;
"></div>
                        </div>
                        <?php }} ?>
                    </div>

                    </div>
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
