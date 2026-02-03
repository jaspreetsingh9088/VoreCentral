@extends('front.homepage.layout.app')
@section('title', 'Home')
@section('style')
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <style>
         .notification-side-text{
          color:black;
         }
        .description {
            color: white;
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }

        .carousel-control-prev,
        .carousel-control-next {
            top: 48%;
            right: 11px;
            width: 4%;
            height: 9%;
            opacity: 0.6;
            background: black;
            border-radius: 30px;
        }

        .carousel-control-prev {
            left: 11px;
        }
    </style>
@endsection
@section('content')
    <div class="flash-news-banner">
        <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <p class="mb-0"></p>
                </div>
                <div class="d-flex search_box">
                    <span class="mr-3 text-danger">
                        <form class="input-group" action="{{ route('content.search') }}">
                            <input type="search" name="search" class="form-control rounded" placeholder="Search"
                                aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </form>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="container">
            <div class="row homepage-intro" data-aos="fade-up">
                <div class="col-xl-4">
                    <div class="group-image">
                        <div class="left">
                            <div class="item bg-1">
                                <img src="{{ url('public/assets/images/item-12.webp') }}" loading="lazy" alt="Monteno"
                                    width="100%" height="100%" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 grid-margin">
                    <div class="position-relative about_cont">
                        <p>
                            Welcome to VoreCentral! We aim to be the prime location to visit for discovering and
                            experiencing, and interacting with human pred vore. For this purpose, you may have a look at
                            our Forum for interactions and community-building, have a look in the Webstore for
                            purchasing items from our many talented creators, or, probably most importantly, view the
                            Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We
                            offer vore media in the form of litterature, images, even video, and, which we would like to
                            promote also audio as we believe it to be quite an underrated avenue for experiencing
                            vore-content. So, we hope you have a fantastic time browsing our site, and... most
                            importanly try not to get eaten!!
                        </p>
                    </div>
                </div>
            </div>
            <style>
                .carousel-caption p,
                .carousel-caption p a {
                    color: white;
                }
            </style>
                   <div class="row homepage-ad1" data-aos="fade-up">
                <div class="col-sm-12">
                    <div class="ad_banner landscape">
                     </div>
                </div>
            </div>
            <div class="row slider_carousal" data-aos="fade-up">
                <div class="col-sm-12">
                    <div id="demo" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            @foreach ($news as $row)
                                <div class="carousel-item @if ($loop->index == 1) active @endif">
                                    <a href="{{ route('news_detail', [$row->id]) }}" style="text-decoration: unset;">
                                        <img src="{{ $row->image }}" alt="thumb" class="img-fluid" loading="lazy"
                                            width="100%" height="100%" />
                                        <div class="carousel-caption">
                                            <h3 style="color: white;">{{ $row->title }}</h3>
                                            {!! $row->description !!}
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="sr-only">{{ env('APP_NAME') . ' News' }}</span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="sr-only">{{ env('APP_NAME') . ' News' }}</span>
                        </a>
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
            <div class="row" data-aos="fade-up">
                <div class="col-sm-12 grid-margin">
                    <div class="card background_trns">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="featured_section">
                                        <div class="card-title">Latest Featured</div>
                                        <div class="row">
                                            <div class="col-sm-12 grid-margin">
                                                <div class="position-relative">
                                                    <div class="ad_banner landscape">
                                                       
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($featured_content as $fc)
                                        <div class="featured_section">
                                            <div class="card-title">Latest Featured</div>
                                            <div class="row">
                                                <div class="col-sm-12 grid-margin">
                                                    <div class="position-relative">
                                                        <div class="rotate-img featured_img">

                                                            <img src="{{ $fc->thumbnail }}" alt="thumb"
                                                                class="img-fluid" loading="lazy" width="100%"
                                                                height="100%" />


                                                        </div>
                                                        <div class="badge-positioned">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="badge badge-danger font-weight-bold">
                                                                    <a href="{{ route('contentdetail', [$fc->id]) }}"
                                                                        style="text-decoration: unset; color : white;">
                                                                        <h2 class="_1fIHu">{{ $fc->title }}</h2>
                                                                    </a>
                                                                    <div class="I1wyK">
                                                                        <div class="MLhH5 _20813">
                                                                            <a href="#" class="">
                                                                                <img alt="FrankAtt's avatar"
                                                                                    src="{{ $fc->user->profile_pic }}"
                                                                                    loading="lazy" class="_3gigK"
                                                                                    width="25" height="25" />
                                                                            </a>
                                                                        </div>
                                                                        <div class="MLhH5 aWCtT">
                                                                            <a data-hook="user_link"
                                                                                data-username="FrankAtt"
                                                                                data-icon="{{ $fc->user->profile_pic }}"
                                                                                data-usertype="core_access"
                                                                                data-userid="20723266"
                                                                                data-useruuid="3d733837-eae3-48b0-883b-955ce7172d8a"
                                                                                href="{{ route('profiledashboard', $fc->user->id) }}"
                                                                                class="user-link _1Zf8w">
                                                                                <span
                                                                                    class="_36cte">{{ $fc->user->username }}</span>
                                                                                <span class="_3pMl0 _2179b"
                                                                                    style="cursor: pointer"
                                                                                    title="Core Member"
                                                                                    aria-label="Core Member"
                                                                                    role="img"></span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="dd">
                                                                    <div class="_2rLSm">
                                                                        <div class="_2-4qx">
                                                                            {{ count($fc->gallerycomments) }}</div>
                                                                        <span class="_2FP2V _2Gw-F _272Qs">
                                                                            <svg style="width: 20px; height: 20px"
                                                                                viewBox="0 0 24 24">
                                                                                <path fill="currentColor"
                                                                                    d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                    <div class="_2rLSm">
                                                                        <div class="_2-4qx">{{ count($fc->like) }}</div>
                                                                        <span class="_2FP2V _2Gw-F _272Qs">
                                                                            <svg style="width: 20px; height: 20px"
                                                                                viewBox="0 0 24 24">
                                                                                <path fill="currentColor"
                                                                                    d="M12,1L9,9L1,12L9,15L12,23L15,15L23,12L15,9L12,1Z" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="featured_section">
                                        <div class="row">
                                            <div class="col-sm-12 grid-margin">
                                                <div class="position-relative">
                                                    <div class="ad_banner landscape">
                                                         
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="featured_section">
                                        <div class="row">
                                            <div class="col-sm-12 grid-margin">
                                                <div class="position-relative">
                                                    <div class="ad_banner landscape">
                                                         
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 latest_video">
                                     <div class="d-flex justify-content-between align-items-center">
                                        <div class="card-title">Latest Upload</div>
                                    </div>
                                    <div class="right_cont">
                                        <div class="border-bottom pb-3">
                                            <div class="latest_upload">
                                                <?php
                                                if (!is_null($Usercontent)){
                                                foreach ($Usercontent as $UsercontentV){
                                                    ?>
                                                <a href="{{ URL('contentdetail/' . $UsercontentV->id) }}"
                                                    class="rotate-img">
                                                    <img src="{{ $UsercontentV->thumbnail }}" alt="thumb"
                                                        class="img-fluid" loading="lazy" width="100%"
                                                        height="100%" />
                                                </a>
                                                <?php
                                                }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="right_cont latest_post">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="card-title">Latest Topics</div>
                                        </div>
                                        @foreach ($latest_thread as $lt)
                                            <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                                                <div class="div-w-80 mr-3">
                                                    <div class="rotate-img">
                                                        <img src="{{ $lt->media }} " alt="thumb" class="img-fluid"
                                                            loading="lazy" width="100%" height="100%" />
                                                    </div>
                                                </div>
                                                <h3 class="font-weight-600 mb-0">
                                                    <a href="{{ route('thread', [$lt->cid, 1]) }}" style="color: white;">
                                                        {{ $lt->topic }}
                                                    </a>
                                                </h3>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="right_cont latest_post">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="card-title">Latest Posts</div>
                                        </div>
                                        @foreach ($latest_thread_comment as $ltc)
                                            <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                                                <div class="div-w-80 mr-3">
                                                    <div class="rotate-img">
                                                        <img src="{{ $ltc->image_url }} " alt="thumb"
                                                            class="img-fluid" loading="lazy" width="100%"
                                                            height="100%" />
                                                    </div>
                                                </div>
                                                <style>
                                                    .threadcomment {
                                                        text-overflow: ellipsis;
                                                        overflow: hidden;
                                                        display: -webkit-box !important;
                                                        -webkit-line-clamp: 2;
                                                        -webkit-box-orient: vertical;
                                                        white-space: normal;
                                                    }
                                                </style>
                                                <a href="{{ route('threaddetail', [$ltc->threadid, 1]) }}"
                                                    style="text-decoration: unset; color : white;">
                                                    <h3 class="font-weight-600 mb-0 threadcomment">{!! $ltc->comment !!}
                                                    </h3>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                     <div class="ad_banner vertical">
                                        <div data-banner-id="425472"></div>
                                    </div>

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
  

    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
@endpush
