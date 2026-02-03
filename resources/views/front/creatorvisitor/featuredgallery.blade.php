@extends('front.creatorvisitor.layout.app')
@section('title', 'Featured Gallery')
@section('bodyclass','green_theme gallery_audio')
@section('style')
    .gallery_audio header .navbar-bottom .navbar-nav .nav-item .nav-link {
        border-right: 0px;
    }

    .navbar-nav li:hover>ul.dropdown-menu {
        display: block;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
    }

    /* rotate caret on hover */
    .dropdown-menu>li>a:hover:after {
        text-decoration: underline;
        transform: rotate(-90deg);
    }

    ul.dropdown-menu {
        margin: 0px;
        border-radius: 0px;
        padding: 0px;
        border: 0px;
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
        border-bottom: 1px solid #e3e3e3;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: #123e12;
        color: #fff;
    }

    .buttons-container {
        text-align: right;
        margin-top: -40px;
    }

    .creator_logo h2 {
        background: #fff;
        margin-top: 8px;
        padding: 48px 8px;
        font-size: 19px;
        margin: 0px;
    }

    .form-control {
        border: #000 solid 1px;
        border-radius: 0px !important;
    }

    .btn-outline-primary {
        background-color: #000;
        color: #FFFFFF;
        border-radius: 0px !important;
    }
    .navbar-top{
        padding: 46px 0 !important;
    }
    .banner_homebutton{
        background: #001bb2;
        color: black !important;
        padding: 14px 78px !important;
        position: absolute;
        font-weight: 900;
        line-height: 14px;
        font-size: 20px;
        z-index: 9999;
    }
    .banner_homebutton:hove{
        background: #001bb2 !important;
    }
    @media only screen and (min-width: 761px) and (max-width: 1023px) {
    .banner_homebutton {
        top: 30px;
        right: 50%;
    }
}
@endsection
@section('content')
    <div class="">
        <div class="main-panel">
            <!-- partial -->
            <div class="content-wrapper">
                <div class="container">

                    <div class="row gallery_audio_sect" data-aos="fade-up">
                        <div class="col-lg-2 p-1">
                            <div class="add_banner1">
                                <img src="{{ url('public/assets/images/right_banner.webp') }}" alt="thumb"
                                    class="img-fluid">

                            </div>

                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>


                        </div>


                        <div class="col-lg-8  grid-margin">

                            <div class="input-group">
                                <input type="text" placeholder="Search.." style="width:77%; ">
                                <button type="button" class="btn btn-outline-primary"
                                    style="height: 46px; margin: left 4px;background: #195519; font-weight: 500;
                                                                                   font-stretch: normal;
                                                                                                        font-style: normal;
                                                                                                     font-size: 17px;">Search</button>
                                <div class="dropdown">
                                    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown"
                                        style="background:#195519;
                                    color:#fff;      font-weight: 500;
                                    font-stretch: normal;
                                    font-style: normal;font-size: 17px; margin-left: 7px;padding: 11px 23px 7px 18px;">
                                        Filter
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/new') }}">Newest first
                                        </a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/view') }}">Most
                                            Viewed</a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/old') }}">Oldest
                                            First</a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/fav') }}">Most
                                            favorited</a>
                                        <a class="dropdown-item" href="{{ URL('featuredgallery/random') }}">Random
                                            Order</a>
                                    </div>
                                </div>
                            </div>

                            <div class="gallery_audio_listing">
                                <ul>
                                    @if (isset($UsercontentData) && count($UsercontentData) > 0)
                                        @foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV)
                                            <li><a href="{{ URL('contentdetail/' . $UsercontentDataV['id']) }}"
                                                    class=""><img src="{{ $UsercontentDataV['thumbnail'] }}"
                                                        alt="thumb" class="img-fluid "></a></li>
                                        @endforeach
                                    @else
                                        <h3 class="text-center">This creator does not have any content.</h3>
                                    @endif
                                </ul>
                            </div>
                            <!--Pagination-->
                            @if (isset($UsercontentData) && count($UsercontentData) > 0)
                                {{ $UsercontentData->links() }}
                            @endif

                            <!--End-->

                        </div>

                        <div class="col-lg-2">
                            <div class="add_banner1">
                                <img src="{{ url('public/assets/images/right_banner.webp') }}" alt="thumb"
                                    class="img-fluid">

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
