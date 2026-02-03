@extends('front.profilevisitor.layout.app')
@php
$title = 'Profile Post';
@endphp
@section('title', $title)
@section('content')
<section class="user-about-sctn user-pg">
    <div class="container">
        <div class="row">
            @include('front.profilevisitor.layout.visitorusersidepanel')
             <div class="col-lg-8 pl-0">
               <div class="user-section1 auto-height" style="height: auto !important; padding : 30px;">
                	<div class="middle-part-padding dashboard-66">
                        <!-- Repeatable Div Started here -->
                        <?php 
                        if(isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0){ 
                            foreach($myPostdata as $myPostdataK => $myPostdataV){ ?>
                                <div class="row mb-3" style="border: 2px solid #000;padding: 10px;" id="profilepost{{$myPostdataV['id']}}">
                                    <div class="col-lg-2 col-md-2 col-3">
                                        <img src="{{$myData[0]['profile_pic']}}" alt="user_profile_image" class="img-fluid img-rounded">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-9 comments-setting" style="color: #000;">
                                        <div style="background: blue; padding : 5px; border-radius : 5px;">
                                            <p style="border-bottom: 1px solid #000; padding-bottom : 5px; margin-bottom :0px;">{{$myPostdataV['post']}}</p>
                                            @if($post_access == 1)
                                                <p style="color : #000; margin-bottom :0px;">
                                                    <a href="{{URL($myPostdataV['id'].'/like')}}" class="like-btn" style="color : #000;">
                                                        <i class="fa fa-thumbs-up" aria-hidden="true" style=""></i> Like {{$myPostdataV['likecount'] > 0 ? $myPostdataV['likecount'] :''}}
                                                    </a> |
                                                    <a href="javascript:void(0)" class="reply-btn" style="color : #000;">Reply</a>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="comment-area form-setting" style="display:none">
                                            <div class="close-icon">X</div>
                                            <form   class="sign_up_form" action="{{ route('addcomment') }}"  class="card mb-3" method="POST"  redirect="{{ url()->current() }}">
                                            @csrf
                                            <textarea class="form-control" name="comment"></textarea>
                                            <input type="hidden" value="{{$myPostdataV['id']}}" name="postid">
                                            <input type="submit" value="Add a comment">
                                            </form>
                                            <div style="clear:both"></div>
                                        </div>
                                    <?php 
                                        if(isset($myPostdataV['commentdata']) && is_array($myPostdataV['commentdata']) && count($myPostdataV['commentdata']) > 0){ 
                                            echo " <h4 style='color:#222;'> Comments </h4>"; 
                                            foreach($myPostdataV['commentdata'] as $commentDataK => $commentDataKV){ ?>
                                                <div style="background: white; padding : 5px; border-radius : 5px;" class="mb-1">
                                                    <p style="border-bottom: 1px solid #000; padding-bottom : 5px; margin-bottom :0px;">{{$commentDataKV['comment']}}</p>                                            
                                                    <p style="margin-bottom: 0px;"> 
                                                        Added on {{date('d-m-Y',strtotime($commentDataKV['created_at']))}} | 
                                                        Added by : 
                                                        <a href="{{ $commentDataKV['dashboardlink'] }}">
                                                            {{$commentDataKV['username']}}
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
                        }else{ ?> 
                            <h3 class="text-center">Profile post not found</h3>
                        <?php } ?>
                    </div>
                </div>

             </div>

        </div>

    </div>

</section>





</div>
@endsection
@push('script')
<script src="{{ url('public/assets/js/common.js') }}"></script>
<script src="{{ url('public/assets/js/formsubmit.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

$( document ).ready(function() {
$('.comment-area').hide();
$('.fa-thumbs-up').hide();

$(".reply-btn").click(function(){
  $(this).parent().parent().parent().find('.comment-area').show();
});

$(".close-icon").click(function(){
  $(this).parent().hide();
});

$(".like-btn").click(function(){
  $(this).find('.fa-thumbs-up').show();
});


$(".replies-btn").click(function () {
	$(this).text(function(i, text){
		return text === "Expand" ? "Collapse" : "Expand";
	})
	$(this).parent().parent().find('.expand-collapse').toggle();
//	$(".notifications-list").toggle();
});

});


</script>

@endpush
