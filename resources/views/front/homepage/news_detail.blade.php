@extends('front.homepage.layout.app')
@section('title', 'News Details')
@section('content')
        <!-- main content start -->
        <section class="viewhistory-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="view_history-outer">
                        <div class="title-of-news_wrapper">
                            <div class="show__picture" style="margin: auto;width: 50%;padding: 10px;">
                                <img src="{{$news->image}}" alt="" style="height: 200px;width: 100%;">
                            </div>
                            <div class="title__and__description ">

                            </div>
                            <div class="news_archieve_wrapper about_content" style="margin-top: 10px;">
                                <h2 style="color: black">{{$news->title}}</h2>
                                <p>{!!$news->description!!}</p>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
