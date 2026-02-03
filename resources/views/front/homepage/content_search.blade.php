@extends('front.homepage.setting.layout.app')
@section('title', 'Content Search')
@section('content')
        <section class="viewhistory-wrapper latest-topics-sctn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="view_history-outer">
                            <div class="history_search_wrapper">
                                <h2 style="color: #fff;">Search Results</h2>
                                <p style="color: #fff;">Showing results for "{{ $search_key }}"</p>
                                <div class="history_search_box">
                                    <form action="{{ route('content.search') }}">
                                        <input type="search" name="search" value="{{ $search_key }}" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                                        <button type="submit" class="btn btn-outline-primary">search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="view_histoy_dv"></div>
                            <div class="view_histoy_dv1"></div>
                            <div class="view_history_wrapper">
                                @for($i =0; $i < count($searchdata); $i++)
                                    <div class="{{ $i % 2 == 0 ?'view_history_box1':'view_history_box2' }}" style="padding: 10px;min-height: auto;">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <span style="color:#fff;">{{$searchdata[$i]['title']}}</span><br><br>
                                                <a style="color:#fff;" href="{{ $searchdata[$i]['pagelink'] }}">{{ $searchdata[$i]['pagename'] }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </section>
@endsection
