@extends('front.layouts.app')
@php
$title = 'Roleplay Status';
@endphp
@section('title', $title)
@section('content')

@include('front.layouts.profileview')

<section class="user-about-sctn user-pg">

    <div class="container">

        <div class="row">

            @include('front.layouts.usersidepanel')

             <div class="col-lg-8 pl-0">

               <div class="user-section1" style="height:400px;">

                    <div class="col-md-12 form-setting" style="padding: 20px;">
                    <form   class="sign_up_form" action="{{ route('updaterpstatus') }}" class="card mb-3" method="POST"  redirect="{{ route('rpstatus') }}">
                    @csrf
                    <div class="form-group">
                    <label for="">Write your Roleplay Status</label>
                    <textarea  class="form-control" style="height:180px;" name="rpstatus" aria-describedby="" placeholder="Write your Roleplay Status">{{$myData['rpstatus']}}</textarea>

                    </div>
                    <input type="submit" value="Update">
                    </form>

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
