@extends('front.creator.layout.app')
@section('title', 'Community')
@section('bodyclass','green_theme creator_main_theme gallery_audio')
@section('style')
    .hide_section {
        border: none;
        background: none;
    }

    .modal-dialog {
        padding-top: 12rem;
    }

    .hedding {
        background: #032a63;
        padding: 10px;
        /* margin-bottom: 14px; */
        margin: -1px;
        color: #fff;
    }
    .modal-dialog {
        max-width: 500px;
        margin: 30px auto;
    }
@endsection
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
    .creator-pg-pattern, .gallery_audio{
        {{ $style }}
    }
</style>
@endif
    <div class="">
        <div class="main-panel">
            <div class="content-wrapper pt-0">
                <div class="container">
                    <div class="row creator_community creator-pg-pattern pt-4" data-aos="fade-up">
                        <div class="col-lg-12">
                            <div class="community_add_banner">
                                <div class="ad_banner landscape">
                                    <div data-banner-id="425470"></div>
                                </div>
                            </div>
                            <div class="community_box">
                                <div class="card mb-2">
                                    <div class="card-body p-2 p-sm-3">
                                        <div class="media forum-item">
                                            <a href="#" data-toggle="collapse" data-target="" class="community_img mr-3">
                                                @if($myData['profile_pic'])
                                                    <img src="{{ $myData['profile_pic'] }}" alt="thumb" class="img-fluid  rounded-circle"></a>
                                                @else
                                                    <img src="{{ url('public/assets/images/item-10.webp') }}" alt="thumb" class="img-fluid  rounded-circle"></a>
                                                @endif

                                            <div class="user_input" style="width:75%;">
                                                <form class="" action="{{ route('addpost') }}" class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                                    @csrf
                                                    <textarea class="form-control" name="post" required></textarea>
                                                    <input type="submit" value="Create post" class="btn btn-primary" style="float: right;margin-top: 20px;">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="all_comment">
                                <div class="community_box">
                                    <?php
                                    if(isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0){
                                        foreach($myPostdata as $myPostdataK => $myPostdataV){ ?>
                                            <div class="card mb-2">
                                                <div class="card-body p-2 p-sm-3">
                                                    <div class="media forum-item">
                                                        <a href="#" data-toggle="collapse" data-target="" class="community_img mr-3">
                                                            @if($myData['profile_pic'])
                                                                <img src="{{ $myData['profile_pic'] }}" alt="thumb" class="img-fluid  rounded-circle">
                                                            @else
                                                                <img src="{{ url('public/assets/images/item-09.webp') }}" alt="thumb" class="img-fluid  rounded-circle">
                                                            @endif
                                                        </a>
                                                        <div class="media-body" style="color:#fff;">
                                                            <h6>
                                                                <a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body"></a>
                                                            </h6>
                                                            <p class="" style="background: blue; border-radius: 10px; padding: 10px;">
                                                                {{ $myPostdataV['post'] }}
                                                            </p>
                                                            <p class="text-muted">
                                                            <p style="color: #000;">
                                                                Like : {{ $myPostdataV['likecount'] > 0 ? $myPostdataV['likecount'] : '' }} |
                                                                Added on {{ date('d-m-Y', strtotime($myPostdataV['created_at'])) }}
                                                            </p>

                                                            {{-- <p class="position-absolute" style="margin-left : 15px; margin-top : 75px;"> Like
                                                                </a>
                                                            </p> --}}
                                                        </div>
                                                    </div>
                                                    <div style="width: 100%;padding-left: 80px;">
                                                        <?php
                                                        if(isset($myPostdataV['commentdata']) && is_array($myPostdataV['commentdata']) && count($myPostdataV['commentdata']) > 0){
                                                            echo "<h4 style='color:#222;'> Comments </h4>";
                                                            foreach($myPostdataV['commentdata'] as $commentDataK => $commentDataKV){ ?>
                                                                <p style="background:#fff;color: #000;border-radius: 10px;padding: 10px;">
                                                                    {{ $commentDataKV['comment'] }}
                                                                </p>
                                                                <p> Added on
                                                                    {{ date('d-m-Y', strtotime($commentDataKV['created_at'])) }} | Added
                                                                    by : {{ $commentDataKV['username'] }}
                                                                    | <span class="reply-to-btn" data-cid="{{ $commentDataKV['id'] }}" style="cursor: pointer;">Reply </span>
                                                                    @if($commentDataKV['userid'] == Auth::id() || $myPostdataV['userid'] == Auth::id())
                                                                        <button type="button" data-toggle="modal" data-target="#exampleModal{{ $commentDataKV['id'] }}" class="hide_section">
                                                                            <i class="fa fa-trash" style="color:red;" aria-hidden="true"></i>
                                                                        </button>
                                                                    @endif
                                                                </p>
                                                                <!-- Reply To Form -->
                                                                <div id="reply-to-area{{ $commentDataKV['id'] }}" class="reply-to-area form-setting" style="display:none; width:70%;">
                                                                    <div class="reply-to-close-icon float-right">
                                                                        <i style="font-size: 20px" class="fa fa-times-circle mb-2" aria-hidden="true"></i>
                                                                    </div>
                                                                    <form class="" action="{{ route('addcomment') }}"  class="card mb-3" method="POST"  redirect="{{ url()->current() }}">
                                                                        @csrf
                                                                        <textarea class="form-control" name="comment"></textarea>
                                                                        <input type="hidden" value="{{$myPostdataV['id']}}" name="postid">
                                                                        <input type="hidden" value="{{$commentDataKV['id']}}" name="comment_id">
                                                                        <input type="submit" value="Add Comment" class="btn btn-secondary text-white" style="float: right;margin-top: 20px;">
                                                                    </form>
                                                                    <div style="clear:both"></div>
                                                                </div>
                                                                <!-- Button trigger modal -->
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal{{ $commentDataKV['id'] }}" tabindex="-1"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <h2 class="hedding">Delete Comment</h2>
                                                                            <div class="modal-header">
                                                                                <h5 class="" id="exampleModalLabel">Are You Sure You Want To Delete This Comment?</h5>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <a href="{{ route('delete-comment', ['id' => $commentDataKV['id']]) }}" class="btn btn-primary">Delete</a>
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff;">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Reply Section -->
                                                                @if(isset($commentDataKV['reply_data']) && count($commentDataKV['reply_data']) > 0)
                                                                    <div class="all_comment">
                                                                        <div class="panel-group">
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading">
                                                                                    <h4 class="panel-title">
                                                                                        <a data-toggle="collapse" href="#collapse{{ $commentDataKV['id'] }}">Replies ({{ count($commentDataKV['reply_data']) }})</a>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapse{{ $commentDataKV['id'] }}" class="panel-collapse collapse">
                                                                                    @foreach($commentDataKV['reply_data'] as $reply_data)
                                                                                        <p style="background:#fff;color: #000;border-radius: 10px;padding: 10px;">
                                                                                            {{ $reply_data->comment }}
                                                                                        </p>
                                                                                        <p> Added on
                                                                                            {{ date('d-m-Y', strtotime($reply_data->created_at)) }} | Added
                                                                                            by : {{ $reply_data->username }}

                                                                                            @if($reply_data->userid == Auth::id() || $myPostdataV['userid'] == Auth::id())
                                                                                                <button type="button" data-toggle="modal" data-target="#deleteCommentReplyModal{{ $reply_data->id }}" class="hide_section">
                                                                                                    <i class="fa fa-trash" style="color:red;" aria-hidden="true"></i>
                                                                                                </button>
                                                                                            @endif
                                                                                        </p>
                                                                                        <!-- Modal -->
                                                                                        @if($reply_data->userid == Auth::id() || $myPostdataV['userid'] == Auth::id())
                                                                                        <div class="modal fade" id="deleteCommentReplyModal{{ $reply_data->id }}" tabindex="-1"role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
                                                                                            <div class="modal-dialog" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h2 class="hedding">Delete Comment</h2>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <h5>Are You Sure You Want To Delete This Comment?</h5>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <a href="{{ route('delete-comment', ['id' => $reply_data->id]) }}" class="btn btn-primary">Delete</a>
                                                                                                        <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal" style="color: #fff;">Cancel</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                @endif
                                                                <!-- Reply Section END -->

                                                                <?php
                                                            }
                                                        } ?>
                                                    </div>
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
            </div>
        </div>
    </div>
@endsection
@push('script')

    $(".reply-to-btn").click(function(){
        let cid = $(this).data('cid');
        $('#reply-to-area'+cid).show();
    });

    $(".reply-to-close-icon").click(function() {
        $('.reply-to-area').hide();
    });

@endpush
