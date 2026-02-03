@extends('front.creator.layout.app')
@section('title', 'Journal')
@section('bodyclass','creator_main_theme green_theme gallery_audio')
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
    .creator-jornal-pg{
        {{ $style }}
    }
</style>
@endif
<section class="dlc-wrapper">
    <div class="container">
        <div class="creator-jornal-pg">
            <div class="row">
                <div class="col-lg-8">
                     <div class="creator-jornal-left" style="min-height:auto;">
                        <div class="col-md-12 form-setting" style="padding: 20px;">

                    <form   class="sign_up_form" action="{{ route('creatorcreatejournal') }}" class="card mb-3" method="POST"  redirect="{{ route('creatorjournal') }}" >

                    @csrf



                    <div class="form-group">

                    <label for="">Title</label>

                    <input type="text"  class="form-control" name="heading" aria-describedby="" placeholder="Title">

                    </div>



                    <div class="form-group">

                    <label for="">Write your journal</label>

                    <textarea  class="form-control" name="title" aria-describedby="" style="height:180px;" placeholder="Write your journal"></textarea>



                    </div>

                    <input type="submit" value="Create Journal" class="btn btn-primary ">



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

                <div class="col-lg-4">

                    <div class="creator-jornal-right pt-4">

                         <h4>Journal History</h4>


                         <div class="ad_banner vertical">
                            <div data-banner-id="425472"></div>
                        </div>


                         {{-- <img src="assets/images/add.webp" class="mt-4" alt=""/> --}}

                     </div>

                </div>

            </div>

         </div>

    </div>

</section>
@endsection
