@extends('front.profilevisitor.layout.app')
@php
$title = 'Journal';
@endphp
@section('title', $title)
@section('content')

<section class="user-about-sctn user-pg">
    <div class="container">
        <div class="row">
            @include('front.profilevisitor.layout.visitorusersidepanel')
            <div class="col-lg-8 pl-0">
                <div class="user-section1" style="padding: 20px;color: #fff;margin-top: 25px;height:auto;">
                    <div class="col-md-10" style="padding: 20px;color: #fff;">
                        <ul>
                            <?php  
                            if(isset($JournalData) && is_array($JournalData) && count($JournalData) > 0){
                                foreach($JournalData as $JournalDataK => $JournalDataV){ ?>
                                    <li>
                                        {{$JournalDataV['heading']}}
                                        <br>
                                        {{$JournalDataV['title']}}
                                    </li>
                                    <?php 
                                }
                            }else{ ?> 
                                <h3 class="text-center">Journal content not found.</h3>
                            <?php } ?>
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
