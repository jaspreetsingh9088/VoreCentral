@extends('front.creatorvisitor.layout.app')
@section('title', 'Media')
@section('bodyclass','green_theme gallery_audio')
@section('content')
    <div class="">
        <div class="main-panel">
            <!-- partial -->
            <div class="content-wrapper">
                <div class="container">

                    <div class="row gallery_audio_sect" data-aos="fade-up">
                        <div class="col-lg-2 p-1">
                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>
                        </div>



                        <div class="col-lg-8  grid-margin">

                            <div class="input-group">
                                <input type="search" class="form-control rounded" placeholder="Search"
                                    aria-label="Search" aria-describedby="search-addon">
                                <button type="button" class="btn btn-outline-primary"
                                    style="height: 52px;">search</button>

                                <ul class="media-audio-list" style="width: 135px;padding: 10px;margin: 0px 10px;">
                                    <li><a href="{{ URL('gallery/new') }}"> Newest first </a></li>
                                    <li><a href="{{ URL('gallery/view') }}">Most Viewed</a></li>
                                    <li><a href="{{ URL('gallery/old') }}">Oldest First</a></li>
                                    <li><a href="{{ URL('gallery/fav') }}">Most favorited</a></li>
                                    <li><a href="{{ URL('gallery/random') }}">Random Order</a></li>
                                </ul>
                            </div>

                            <div class="gallery_audio_listing">
                                <ul>
                                    @if (isset($UsercontentData) && count($UsercontentData) > 0)
                                        @foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV)
                                            <li>
                                              <a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}"
                                                    class=""><img src="{{ $UsercontentDataV['thumbnail'] }}"
                                                        alt="thumb" class="img-fluid "></a>
                                            </li>
                                        @endforeach
                                    @else
                                        <h3 class="text-center">This creator does not have any content.</h3>
                                    @endif
                                </ul>
                            </div>
                            {{ $UsercontentData->links() }}
                        </div>

                        <div class="col-lg-2">
                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>
                        </div>

                    </div>

                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-12">
                            <div class="ad_banner landscape">
                                <div data-banner-id="425470"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
@endsection
