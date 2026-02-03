@extends('front.homepage.layout.app')
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
                            @foreach($notification as $row)
                                <div class="notification-box @if($loop->index % 2 == 1) view_history_box2 @else view_history_box1 @endif">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ $row->sender->profile_pic }}" style="max-width: 80px;margin-top: 10px;">
                                        </div>
                                        <div class="col-md-8">
                                            <p style="line-height: 80px;">{{ $row->message }}
                                                @php $route = 'javascript:;'; @endphp
                                                {{-- @if($row->notification_type == 'Subscription upload')
                                                    @php $route = route('contentdetail',[$row->content_id]) @endphp
                                                @elseif($row->notification_type == 'thread like')

                                                @endif --}}
                                                <a href="{{ $route }}">Click here to view </a>
                                            </p>
                                        </div>
                                        <div class="col-md-2" style="padding:10px;">
                                            <p><span style="font-weight : bold;">Date :</span> {{ date('d/m/Y', strtotime($row->created_at)) }}</p>
                                            <p><span style="font-weight : bold;">Time :</span> {{ date('H:i', strtotime($row->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
