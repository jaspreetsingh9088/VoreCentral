@extends('front.layouts.app')
@php
$title = 'Journal';
@endphp
@section('title', $title)
@section('content')


@include('front.layouts.profileview')

<section class="user-about-sctn user-pg">
    <div class="container">
        <div class="row">

            @include('front.layouts.usersidepanel')

            <div class="col-lg-8 pl-0">
                 <div class="user-section1" style="height:425px;">

                    <div class="col-md-12 form-setting" style="padding: 20px;">
                    <form   class="sign_up_form" action="{{ route('createjournal') }}" class="card mb-3" method="POST"  redirect="{{ route('journal') }}" >
                    @csrf
                    <div class="form-group">
                    <label for="">Title</label>
                    <input type="text"  class="form-control" name="heading" aria-describedby="" placeholder="Title">
                    </div>

                    <div class="form-group">
                    <label for="">Write your journal</label>
                    <textarea  class="form-control" name="title" aria-describedby="" style="height:180px;" placeholder="Write your journal"></textarea>
                    </div>
                    <input type="submit" value="Create Journal">

                    </form>

                    </div>

                </div>



                <div class="user-section1" style="height:auto;margin-top:0px;">

                    <div class="col-md-10" style="padding: 20px;color: #fff;">
                    <ul>
                    <?php  if(isset($JournalData) && is_array($JournalData) && count($JournalData) > 0){foreach($JournalData as $JournalDataK => $JournalDataV){ ?>

                         <li>
                             {{$JournalDataV['heading']}}
                             <br>
                             {{$JournalDataV['title']}}
                        </li>
                     <?php }} ?>
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
