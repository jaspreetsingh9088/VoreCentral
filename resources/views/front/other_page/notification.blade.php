@extends('front.other_page.layout.app')
@section('title', 'Notification')
@section('style')
    <style type="text/css">
        .notification-box{
            padding: 10px;
        }
        .notifications-list {
            position: absolute;
            background-color: #fff;
            z-index: 99;
            top: 80px;
            width: 348px;
        }
    </style>
@endsection
@section('content')
    <section class="viewhistory-wrapper latest-topics-sctn">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="view_history-outer">
                        <div class="view_histoy_dv">
                            <p class="news_top_text">Notification</p>
                        </div>
                        <div class="view_histoy_dv1"></div>
                        <div class="view_history_wrapper" style="padding:20px 40px 10px 10px;">
                            @if((count($notification)) > 0)
                                @foreach($notification as $row)
                                    <div class="notification-box @if($loop->index % 2 == 1) view_history_box2 @else view_history_box1 @endif">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{ $row->sender->profile_pic }}" style="max-width: 80px;margin-top: 10px;">
                                            </div>
                                            <div class="col-md-8">
                                                <p style="line-height: 80px;">{{ $row->message }}                                                
                                                    @if($row->type == 'usercontent')
                                                        @if($row->notification_type == 'like' || $row->notification_type == 'dislike')
                                                            @php $page_link = route('contentdetail',[$row->content_id]); @endphp
                                                        @elseif($row->notification_type == 'comment')
                                                            @php $page_link = route('contentdetail',[$row->content_id.'#comment'.$row->sender->username]); @endphp
                                                        @else
                                                            @php $page_link = 'javascript:;'; @endphp
                                                        @endif
                                                    @elseif($row->type == 'userpage')
                                                        @if($row->notification_type == 'follow')
                                                            @php $page_link = $row->sender->dashboard_link;  @endphp
                                                        @elseif($row->notification_type == 'comment reacts user page')
                                                            @php $page_link = url('profilepost#profilepost'.$row->content_id) @endphp
                                                        @elseif($row->notification_type == 'comment userpage')
                                                            @php $page_link = url('profilepost#profilepost'.$row->content_id) @endphp
                                                        @else
                                                            @php $page_link = 'javascript:;';  @endphp
                                                        @endif
                                                    @elseif($row->type == 'DLC')
                                                        @if($row->notification_type == 'DLC creators follow')
                                                            @php $page_link = url('dlc#dlccontent'.$row->content_id) @endphp
                                                        @elseif($row->notification_type == 'DLC reacts')
                                                            @php $page_link = url('dlc#dlccontent'.$row->content_id) @endphp
                                                        @elseif($row->notification_type == 'DLC download')
                                                            @php $page_link = url('dlc#dlccontent'.$row->content_id) @endphp
                                                        @else
                                                            @php $page_link = 'javascript:;';  @endphp
                                                        @endif
                                                    @elseif($row->type == 'forums')
                                                        @if($row->notification_type == 'quotes message')
                                                            @php
                                                                $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                                                $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$threadcomment->parent_id);
                                                            @endphp
                                                        @elseif($row->notification_type == 'thread like')
                                                            @php
                                                                $threadlike = App\Models\Threadcommentlike::where('id',$row->content_id)->first();
                                                                $threadcomment = App\Models\Threadcomment::where('id',$threadlike->comment_id)->first();
                                                                $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$threadlike->comment_id);
                                                            @endphp
                                                        @elseif($row->notification_type == 'post thread started')
                                                            @php
                                                                $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                                                $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$threadcomment->threadid);
                                                            @endphp
                                                        @elseif($row->notification_type == 'posted thread')
                                                            @php
                                                                $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                                                $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$row->content_id);
                                                            @endphp
                                                        @elseif($row->notification_type == 'mentions')
                                                            @php
                                                                $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                                                $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$row->content_id);
                                                            @endphp
                                                        @elseif($row->notification_type == 'post thread I follow')
                                                            @php
                                                                $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                                                $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$row->content_id);
                                                            @endphp
                                                        @else
                                                            @php $page_link = 'javascript:;';  @endphp
                                                        @endif
                                                    @elseif($row->type == 'subscription')
                                                        @if($row->notification_type == 'Subscribe upload webstore')
                                                            @php $page_link = route('buyablecontent',$row->content_id) @endphp
                                                        @elseif($row->notification_type == 'Subscription upload')
                                                            @php $page_link = route('contentdetail',$row->content_id) @endphp
                                                        @else
                                                            @php $page_link = 'javascript:;';  @endphp
                                                        @endif
                                                    @elseif($row->type == 'storecontent')
                                                        @if($row->notification_type == 'like' || $row->notification_type == 'dislike')
                                                            @php $page_link = route('buyablecontent',[$row->content_id]); @endphp
                                                        @else
                                                            @php $page_link = 'javascript:;'; @endphp
                                                        @endif
                                                    @else
                                                        @php $page_link = 'javascript:;';  @endphp
                                                    @endif                                                
                                                    <a href="{{ $page_link }}">Click here to view </a>
                                                </p>
                                            </div>
                                            <div class="col-md-2" style="padding:10px;">
                                                <p><span style="font-weight : bold;">Date :</span> {{ date('d/m/Y', strtotime($row->created_at)) }}</p>
                                                <p><span style="font-weight : bold;">Time :</span> {{ date('H:i', strtotime($row->created_at)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h3 class="text-center" style="color: black;">No records found.</h3>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(".toggle-menu").click(function () {
        $(this).toggleClass("nav-close");
        $(".nav-primary").slideToggle();
    });

    $('#close').click(function(){
        $('.nav-primary').slideToggle();
    });
@endpush
