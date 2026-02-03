@extends('front.homepage.layout.app')
@section('title', 'New Archieve')
@section('style')
    <style type="text/css">
        article {
            height:60%;
            /* background:red; */
            position:absolute;
        }

        .description {
            color: black;
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }
    </style>
@endsection
@section('content')
        <section class="viewhistory-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-10">
                        <div class="view_history-outer pt-5">
                            <div class="view_histoy_dv">
                                <p style="font-weight: bold; font-size : 30px;" class="news_top_text">News Archieve</p>
                            </div>
                            {{-- <div class="view_histoy_dv1"></div> --}}
                            <div class="news_archieve_wrapper">
                                @if(count($news) > 0)
                                    @foreach($news as $row)
                                        <div class="@if($loop->index % 2 == 1) news_archieve_odd @else news_archieve_even @endif">
                                            <div class="row">
                                                <div class="col-md-2" style="padding: 30px;">
                                                    <img src="{{ $row->image }}" style="max-width: 140px;">
                                                </div>
                                                <div class="col-md-10 ">
                                                    <a href="{{ route('news_detail',[$row->id]) }}">
                                                        <h4 style=" font-weight: bold;color: black; !important;">{{ $row->title }}</h4>
                                                    </a>
                                                    <p class="description" style="color : black;">
                                                        {!! $row->description !!}
                                                    </p>
                                                    <a style="color: cyan;" href="{{ route('news_detail',[$row->id]) }}">Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="news_archieve_odd">
                                        <h3 class="text-center" style="color: black;">News record not found.</h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                    </div>
                </div>
            </div>
        </section>
@endsection
