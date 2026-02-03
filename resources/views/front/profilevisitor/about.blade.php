@extends('front.profilevisitor.layout.app')
@php
$title = 'About';
@endphp
@section('title', $title)
@section('content')
<section class="user-about-sctn user-pg">

    <div class="container">

        <div class="row">

            @include('front.profilevisitor.layout.visitorusersidepanel')

             <div class="col-lg-8 pl-0">

               <div class="user-section1" style="height:400px;">

                    <div class="col-md-12 form-setting" style="padding: 20px;color:#ffffff;">
                        @if(isset($myData[0]['about']))
                            <p> {{$myData[0]['about']}} </p>
                        @else
                            <h4 class="text-center">User about not found.</h4>
                        @endif

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
