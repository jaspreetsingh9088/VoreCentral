@extends('front.forum.layout.app')
@section('title', 'Forum')
@section('style')
    <style>
        .thread-box-with-image.pull-right {
            width: 280px;
        }
        .thread-box-with-image a {
            color: #000;
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            text-decoration: underline;
        }
        .thread-box-with-image a:last-child {
            margin: 0px;
        }
        .thread-box-with-image img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }
        .descrition{
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }
        .pages-custom .pg-left li{
            padding : 10px 20px !important;
        }
    </style>
@endsection
@section('content')
    <section class="forums-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-5"></div>
                <div class="col-lg-4">
                    <div class="search_box_forums">
                        <div class="d-flex search_box justify-content-end">
                            <span class="mr-3 text-danger">
                                <form class="input-group" action="{{ route('forum.search') }}" id="search_form">
                                    <div class="autocomplete" style="width:300px;">
                                        <input type="search" value="{{ $search }}" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" required>
                                    </div>
                                    <input type="submit" value="Search" class="search_btn">
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    @if(!is_null($news))
                        <div class="container news_square" style="max-width: unset !important;">
                            <div class="row">
                                <div class="col-md-2">
                                    <img class="img-fluid" src="{{ $news->image }}" alt="">
                                </div>
                                <div class="col-md-9">
                                    <a href="{{ route('news_detail',[$news->id]) }}" style="color: black;">
                                        <h3>{{ $news->title }}</h3>
                                        <p class="descrition">
                                            {{ strip_tags($news->description) }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="special-image" style="margin-bottom:5%;">
                        <img src="public/image1/test3.webp" alt="Special Image">
                    </div>
                    <div class="ad_banner landscape">
                        <div data-banner-id="425470"></div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-9">
                    <div class="forums-middle-wrapper">
                        @if(isset($ForumheadingData) && is_array($ForumheadingData) && count($ForumheadingData) > 0)
                            @foreach($ForumheadingData as $ForumheadingDataK => $ForumheadingDataV)
                                <div class="forums-dv">
                                    <p class="new-bg-r">{{ $ForumheadingDataV['name'] }}</p>
                                    <ul class="list-none">
                                        @if(isset($ForumheadingDataV['category']) && is_array($ForumheadingDataV['category']) && count($ForumheadingDataV['category']) > 0)
                                            @foreach($ForumheadingDataV['category'] as $categoryK => $categoryV)
                                                <li>
                                                    <a style="color:#222;" href="{{ URL('thread/' . $categoryV['id'] . '/1') }}">
                                                        <span class="pull-left">{{ $categoryV['name'] }}<br />
                                                            <span style="font-size:15px;">{{ $categoryV['description'] }} </span>
                                                        </span>
                                                        @if(isset($categoryV['threaddata']))
                                                            @php
                                                                $user = App\Models\User::where('id', $categoryV['threaddata']['userid'])->first();

                                                                $dashboard_link = 'javascript:;';
                                                                if(!is_null($user)) {
                                                                    if($user->creator == 1){
                                                                        $dashboard_link = route('creatorvisitordashboard',[$categoryV['threaddata']->userid]);
                                                                    }else{
                                                                        $dashboard_link = route('profiledashboard',[$categoryV['threaddata']->userid]);
                                                                    }

                                                                    $username = $user->username;
                                                                    $profile_pic = $user->profile_pic;
                                                                } else {
                                                                    $username = 'Admin';
                                                                    $profile_pic = '';
                                                                }
                                                            @endphp
                                                            <div class="thread-box-with-image pull-right">
                                                                <a href="{{ URL('/threaddetail/' . $categoryV['threaddata']['id'] . '/1') }}">
                                                                    <img src="{{ $profile_pic }}" class="pull-left" alt="">
                                                                    {{ $categoryV['threaddata']['topic'] }}
                                                                </a>
                                                                <a>
                                                                <a href="{{ URL( $dashboard_link) }}">{{ $username}}
                                                                </a>
                                                                <a href="{{ URL('/threaddetail/' . $categoryV['threaddata']['id'] . '/1') }}">
                                                                    {{ date('d M Y', strtotime($categoryV['threaddata']['created_at'])) }}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-lg-1">
                    <div class="ad_banner vertical">
                        <img src="public//image2/ver.webp" alt="Special Image" style="width:200px;margin-top:30px;">
                    </div>

                    <div class="ad_banner vertical">
                        <img src="public/image2/ver.webp" alt="Special Image" style="width:200px;margin-top:200px;">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-9">
                    <div class="pages-custom mb-5">
                        <div class="row">
                            <div class="col-lg-9 pg-left">
                                <ul class="list-none">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('forum') }}">Forum</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 text-right pg-right">
                                <ul class="list-none">
                                    <li style="padding : 10px;"><a href="{{ route('themeOption') }}">Change Theme</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
