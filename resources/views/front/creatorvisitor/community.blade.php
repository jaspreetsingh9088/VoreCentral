@extends('front.creatorvisitor.layout.app')
@section('title', 'Cummunity')
@section('bodyclass','green_theme gallery_audio')
@section('style')
    .hide_section {
        border: none;
        background: none;
    }
@endsection
@section('content')
    <div class="">
        <div class="main-panel">
            <div class="content-wrapper pt-0">
                <div class="container">
                    <div class="row creator_community creator-pg-pattern pt-4" data-aos="fade-up">
                        <div class="col-lg-12">
                            @if (Session::has('successful_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('successful_message') }}
                                </div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error_message') }}
                                </div>
                            @endif

                            <div class="community_add_banner">
                                <div class="ad_banner landscape">
                                    <div data-banner-id="425470"></div>
                                </div>
                            </div>
                            <ul class="navbar-top-right-menu" id="own-creater-nav-buttons" style="display: inline-flex;">
                                <li class="nav-item mr-2" style="width:120px; list-style:none;">
                                    <a href="{{ route('profilepost') }}" class="nav-link">Create Post</a>
                                </li>
                            </ul>
                            <div class="all_comment">
                                <?php
                                if(isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0){
                                    foreach($myPostdata as $myPostdataK => $myPostdataV){ ?>
                                        <div class="community_box">
                                            <div class="card mb-2">
                                                <div class="card-body p-2 p-sm-3">
                                                    <div class="media forum-item">
                                                        <a href="#" data-toggle="collapse" data-target="" class="community_img mr-3">
                                                            <img src="{{ url('public/assets/images/item-09.webp') }}" alt="thumb" class="img-fluid  rounded-circle">
                                                        </a>
                                                        <div class="media-body">
                                                            <h6>
                                                                <a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body"></a>
                                                            </h6>
                                                            <p class="text-secondary">{{ $myPostdataV['post'] }}</p>

                                                            <p class="text-muted">
                                                            <p>
                                                                <a href="{{URL($myPostdataV['id'].'/like')}}" class="like-btn">Like
                                                                </a>
                                                                {{ $myPostdataV['likecount'] > 0 ? $myPostdataV['likecount'] : '' }}
                                                                | <span class="reply-btn" style="cursor: pointer;">Reply </span>
                                                            </p>
                                                            <div class="comment-area form-setting" style="display:none; width:70%;">
                                                                {{-- <div class="close-icon float-right reply-close-icon"> --}}
                                                                <div class="reply-close-icon float-right">
                                                                    <i style="font-size: 20px" class="fa fa-times-circle mb-2" aria-hidden="true"></i>
                                                                </div>
                                                                <form class="" action="{{ route('addcomment') }}"  class="card mb-3" method="POST"  redirect="{{ url()->current() }}">
                                                                    @csrf
                                                                    <textarea class="form-control" name="comment"></textarea>
                                                                    <input type="hidden" value="{{$myPostdataV['id']}}" name="postid">
                                                                    <input type="submit" value="Add Comment" class="btn btn-secondary text-white" style="float: right;margin-top: 20px;">
                                                                </form>
                                                                <div style="clear:both"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="width: 100%;padding-left: 80px;">
                                                        <div class="all_comment">
                                                            <?php
                                                            if(isset($myPostdataV['commentdata']) && is_array($myPostdataV['commentdata']) && count($myPostdataV['commentdata']) > 0){
                                                                echo "<h4 style='color:#222;'> Comments </h4>";
                                                                foreach($myPostdataV['commentdata'] as $commentDataK => $commentDataKV){ ?>
                                                                    <p style="background:blue;color: #fff;border-radius: 10px;padding: 10px;">
                                                                        {{ $commentDataKV['comment'] }}
                                                                    </p>
                                                                    <p> Added on
                                                                        {{ date('d-m-Y', strtotime($commentDataKV['created_at'])) }} | Added
                                                                        by : {{ $commentDataKV['username'] }} | <span class="reply-to-btn" data-cid="{{ $commentDataKV['id'] }}" style="cursor: pointer;">Reply </span>
                                                                        @if($commentDataKV['userid'] == Auth::id() || $myPostdataV['userid'] == Auth::id())
                                                                        <button type="button" data-toggle="modal" data-target="#deleteCommentModal{{ $commentDataKV['id'] }}" class="hide_section">
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
                                                                    <!-- Modal -->
                                                                    @if($commentDataKV['userid'] == Auth::id() || $myPostdataV['userid'] == Auth::id())
                                                                    <div class="modal fade" id="deleteCommentModal{{ $commentDataKV['id'] }}" tabindex="-1"role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h2 class="hedding">Delete Comment</h2>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h5>Are You Sure You Want To Delete This Comment?</h5>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="{{ route('delete-comment', ['id' => $commentDataKV['id']]) }}" class="btn btn-primary">Delete</a>
                                                                                    <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal" style="color: #fff;">Cancel</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif

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
                                                                                        <p style="background:blue;color: #fff;border-radius: 10px;padding: 10px;">
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
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }else{ ?>
                                    <div class="community_box">
                                        <div class="card mb-2">
                                            <h3 class="text-center">It appears there are no posts here yet</h3>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

        $(".reply-btn").click(function(){
            $(this).parent().parent().find('.comment-area').show();
        });

        $(".reply-to-btn").click(function(){
            let cid = $(this).data('cid');
            $('#reply-to-area'+cid).show();
        });

        $('.cover-upload').hide();
        $('.profile-upload').hide();

        $(".user-profile-picture img").click(function() {
            $('.profile-upload').show();
        });

        $(".add-banner-image").click(function() {
            $('.cover-upload').show();
        });


        {{-- $(".close-icon").click(function() {
            $('.comment-area').hide();
        }); --}}

        $(".reply-close-icon").click(function() {
            $('.comment-area').hide();
        });

        $(".reply-to-close-icon").click(function() {
            $('.reply-to-area').hide();
        });




        $(".follow-unfollow").click(function() {
            $(this).text(function(i, text) {
                return text === "Follow" ? "Unfollow" : "Follow";
            })
        });
@endpush
