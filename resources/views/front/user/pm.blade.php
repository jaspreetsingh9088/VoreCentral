@extends('front.layouts.app')
@php
$title = 'Personal Message';
@endphp
@section('title', $title)
@section('content')



<section class="pm-inbox-wrapper">
    <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3 pr-0">
                <div class="pm-inbox-left">
                    <div class="pminbox_sidebar">
                        <ul class="list-none">
                            <li><a href="#">Inbox</a></li>
                            <li><a href="#">Sent messages</a></li>
                            <li><a href="#">New PM</a></li>
                            <li><a href="#">Message users</a></li>
                            <li><a href="#">Friends</a></li>
                            <li><a href="#">Drafts</a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#">Social Options</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                 <div class="pm-inbox-adspace">
                     <img src="assets/images/add_b.webp" class="w-100" alt="">
                 </div>
                 <div class="row">
                    <div class="col-lg-8 p-0">
                        <div class="pm-inbox-middle">
                             <ul class="list-none">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                             </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 pl-0">
                        <div class="pm-inbox-right">

                        </div>
                    </div>
                 </div>
            </div>

         </div>
    </div>
</section>

@endsection
@push('script')
<script src="{{ url('public/assets/js/select2.js') }}"></script>
<script src="{{ url('public/assets/js/common.js') }}"></script>

<script>
 $('.select2').select2();

$( document ).ready(function() {

$(".notifications-list").hide();
$(".notification-icon").click(function(){
	$(".notifications-list").toggle();
});


$('.cover-upload').hide();
$('.profile-upload').hide();

$(".user-profile-picture a").click(function(){
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
