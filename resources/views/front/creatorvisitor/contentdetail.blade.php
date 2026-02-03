<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Content Detail</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css"/>
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/lightbox/simple-lightbox.css?v2.8.0')}}"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
</head>

<body class="green_theme creator_main_theme gallery_audio" style="font-family:{{ $font }}">
<div class="">
    <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
        <header id="header">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><a class="navbar-brand" href="{{URL('creatordashboard')}}">Creator</a></div>
                                <ul class="list-none gallery-top-m">
                                    <li class="creator-btn"><a href="#">Became Creator</a></li>
                                    <li class="noti-icon">
                                        <a href="#" class=""><img src="{{ url('public/assets/images/notification.png')}}"
                                                                  alt=""></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="navbar-bottom">
                            <div class="">

                                <div>
                                    <button
                                        class="navbar-toggler"
                                        type="button"
                                        data-target="#navbarSupportedContent"
                                        aria-controls="navbarSupportedContent"
                                        aria-expanded="false"
                                        aria-label="Toggle navigation"
                                    >
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="navbar-collapse justify-content-center collapse"
                                         id="navbarSupportedContent">
                                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                            <li>
                                                <button class="navbar-close">
                                                    <img src="{{ url('public/assets/images/close.png') }}" alt="">
                                                </button>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL($creatore->id.'/gallery/new') }}">Latest</a>
                                            </li>

                                            <li class="nav-item active">
                                                <a class="nav-link"
                                                   href="{{ route('featuredgallery',[$creatore->id,'all']) }}">Featured</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('profile.visitore.media',[$creatore->id,'Literature']) }}">Literature</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('profile.visitore.media',[$creatore->id,'Picture']) }}">Pictures</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('profile.visitore.media',[$creatore->id,'Comic']) }}">Comics</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('profile.visitore.media',[$creatore->id,'Video']) }}">Video</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('profile.visitore.media',[$creatore->id,'Games']) }}">Games</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('profile.visitore.media',[$creatore->id,'Audio']) }}">Audio</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Gif</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Others</a>
                                                <ul class="submenu">
                                                    <li><a class=""
                                                           href="{{ route('visitores.gallery.prioritiseTags',[$creatore->id]) }}">Prioritise
                                                            my tags</a></li>
                                                    <li><a class=""
                                                           href="{{ route('visitores.gallery.recency',[$creatore->id]) }}">Prioritise
                                                            recency</a></li>
                                                    <li><a class=""
                                                           href="{{ route('visitores.gallery.prioritisePopularity',[$creatore->id]) }}">Prioritise
                                                            popularity</a></li>
                                                    <li><a class=""
                                                           href="{{ route('publicgallery.random') }}">RANDOM</a></li>
                                                    <li><a class="" href="{{ route('publicgallery.creators') }}">Creators</a>
                                                    </li>
                                                    <li><a class="" href="{{ URL('dlc') }}">DLC</a></li>
                                                    <li><a class="" href="{{ route('generalSetting') }}">Options</a>
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>


                                    </div>
                                </div>


                            </div>
                        </div>
                    </nav>

                </div>
            </div>
        </header>

        <!-- partial -->


        <div class="content-wrapper">
            <div class="container">

                <div class="row">

                    <div class="col-sm-8">
                        <div class="top_gallery creator_gallery_search">
                            <div class="d-flex search_box">
                                <span class="type-box-grn">Box For Changing<br> Type of Search</span>
                                <div class="input-group">
                                    <input type="search" class="form-control rounded" placeholder="Search"
                                           aria-label="Search" aria-describedby="search-addon">
                                    <button type="button" class="btn btn-outline-primary">search</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="row creator_community" data-aos="fade-up">

                    <div class="col-sm-2">
                        <div class="ad_banner vertical">
                            <div data-banner-id="425472"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 pr-5">
                        <div class="content_sect">

                            <?php
                            //dd($UsercontentData);
                            if (isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0){
                            foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV){
                                ?>
                            <div class="featured_img gallery">
                                <a href="{{ $UsercontentDataV['content'] }}">
                                    <img src="{{ $UsercontentDataV['content'] }}" alt="thumb" class="img-fluid"
                                         data-toggle="modal" data-target="#exampleModalCenter" type="button">
                                </a>
                            </div>


                            <div class="img_content">
                                <div class="name_content">
                                    <h2>Name of the artwork
                                        <span class="ar-like"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                        <span class="font-weight-bold text-black"> / </span><span class="ar-dislike"><i
                                                class="fa fa-thumbs-down" aria-hidden="true"></i></span> <a href="#"
                                                                                                            class="text-secondary font-weight-bold">Reply</a>
                                    </h2>
                                    <div class="media forum-item">
                                        <a href="#" data-toggle="collapse" data-target="" class="community_img mr-3">
                                            <img src="{{ url('public/assets/images/item-09.webp')}}" alt="thumb"
                                                 class="img-fluid  rounded-circle"></a>
                                        <div class="media-body"><h6><a href="#" data-toggle="collapse"
                                                                       data-target=".forum-content" class="text-body">Name
                                                    of the Artis</a></h6>
                                            <p class="text-secondary">{{date('d-m-Y',strtotime($UsercontentDataV['created_at']))}}</p>

                                        </div>
                                        <a href="#" class="text-secondary font-weight-bold">
                                        </a></div>
                                </div>

                                <div class="d-flex gallery_tab">
                                    <ul class="">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">Subscribe</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{URL('markgalleryfavorite/'.$UsercontentDataV['id'])}}"
                                               class="nav-link">
                                                    <?php if (isset($isfavourite) && $isfavourite > 0){ ?>
                                                <span style="color:#fff;">  <i class="fa fa-heart"
                                                                               aria-hidden="true"></i> Favorite </span>
                                                <?php }else{ ?>
                                                <i class="fa fa-heart-o" aria-hidden="true"></i> Favorite
                                                <?php } ?>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>

                        </div>


                        <div class="content_sect">
                            <h3 class="tittle">{{ $UsercontentDataV['description'] }}</h3>
                        </div>

                        <div class="content_sect">
                            <h3 class="tittle">{{ $UsercontentDataV['tags'] }}</h3>
                        </div>

                        <div class="row creator_community aos-init aos-animate" data-aos="fade-up">
                            <div class="col-lg-12">
                                <div class="community_box">
                                    <div class="card mb-2">
                                        <div class="card-body p-2 p-sm-3">
                                            <div class="media forum-item">
                                                <a href="#" data-toggle="collapse" data-target=""
                                                   class="community_img mr-3">
                                                    <img src="{{ url('public/assets/images/item-10.webp')}}" alt="thumb"
                                                         class="img-fluid  rounded-circle"></a>

                                                <div class="user_input">
                                                    <span class="add_comment">Add a Comment</span>
                                                    <form class="" action="{{ route('addgallerycomment') }}"
                                                          class="card mb-3" method="POST"
                                                          redirect="{{ url()->current(); }}">
                                                        @csrf
                                                        <input type="text" name="comment" class="form-control" id=""
                                                               aria-describedby="" placeholder="">
                                                        <input type="hidden" name="contentid"
                                                               value="{{$UsercontentDataV['id']}}">
                                                        <input type="submit" value="Submit Comment"
                                                               class="btn btn-primary"
                                                               style="float: right;margin-top: 10px;border-radius: 0px;">
                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="all_comment">
                                        <?php if (isset($UsercontentDataV['commentdata']) && is_array($UsercontentDataV['commentdata']) && count($UsercontentDataV['commentdata']) > 0){
                                    foreach ($UsercontentDataV['commentdata'] as $commentDataK => $commentDataKV){ ?>
                                    <div class="community_box">
                                        <div class="card mb-2">
                                            <div class="card-body p-2 p-sm-3">
                                                <div class="media forum-item">
                                                    <a href="#" data-toggle="collapse" data-target=""
                                                       class="community_img mr-3">
                                                        <img src="{{ url('public/assets/images/item-09.webp')}}" alt="thumb"
                                                             class="img-fluid  rounded-circle"></a>
                                                    <div class="media-body">
                                                        <div class="abc"><h6><a href="#" data-toggle="collapse"
                                                                                data-target=".forum-content"
                                                                                class="text-body">{{$commentDataKV['username']}}
                                                                    : {{date('d-m-Y',strtotime($commentDataKV['created_at']))}}</a>
                                                            </h6></div>
                                                        <p style="
    background: #fff;
    color: #222;
    border-radius: 10px;
    padding: 10px;
" class="text-secondary">{{$commentDataKV['comment']}}</p>
                                                    </div>
                                                    <a href="#" class="text-secondary font-weight-bold">
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                    } ?>

                                </div>
                                <a href="#" class="text-secondary font-weight-bold">
                                </a></div>
                            <a href="#" class="text-secondary font-weight-bold">

                            </a></div>
                        <?php }
                        } ?>

                        <nav aria-label="Page navigation example" class="clearfix">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>

                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                <li class="page-item"><a class="page-link" href="#" style="padding:6px 14px;">
                                        <div class="jumpto">
                                            <label>Jump to page #</label><input type="text" id="pageNum"><input
                                                type="submit" id="go" value="Go" class="button">
                                        </div>
                                    </a></li>
                            </ul>
                        </nav>
                    </div>


                    <div class="col-xl-3 card background_trns p-0">



                        <div class="right_cont latest_post latest_video green_right_theme">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="card-title">
                                    Related Art
                                </div>

                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-09.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-08.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-10.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-10.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>


                        </div>


                        <div class="right_cont green_right_theme">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="card-title">
                                    Same Author
                                </div>

                            </div>
                            <div class="border-bottom pb-3">
                                <div class="latest_upload">
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-11.webp')}}"
                                                                        alt="thumb" class="img-fluid "></a>
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-08.webp')}}"
                                                                        alt="thumb" class="img-fluid"></a>
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-09.webp')}}"
                                                                        alt="thumb" class="img-fluid"></a>
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-10.webp')}}"
                                                                        alt="thumb" class="img-fluid"></a>
                                    <a href="#" class="rotate-img "><img src="{{ url('public/assets/images/item-11.webp')}}"
                                                                         alt="thumb" class="img-fluid "></a>
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-08.webp')}}"
                                                                        alt="thumb" class="img-fluid"></a>
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-09.webp')}}"
                                                                        alt="thumb" class="img-fluid"></a>
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-10.webp')}}"
                                                                        alt="thumb" class="img-fluid"></a>
                                    <a href="#" class="rotate-img"><img src="{{ url('public/assets/images/item-11.webp')}}"
                                                                        alt="thumb" class="img-fluid "></a>
                                </div>

                            </div>


                        </div>

                        <div class="right_cont latest_post latest_video green_right_theme">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="card-title">
                                    Featured By the Author
                                </div>

                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-09.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-08.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-10.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div class="div-w-80 mr-3">
                                    <div class="rotate-img">
                                        <img src="{{ url('public/assets/images/item-10.webp')}}" alt="thumb"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <h3 class="font-weight-600 mb-0">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </h3>
                            </div>


                        </div>


                        <div class="right_cont">
                            <img src="{{ url('public/assets/images/add.webp')}}" alt="thumb" class="img-fluid">
                        </div>


                        <div class="right_cont">
                            <img src="{{ url('public/assets/images/add.webp')}}" alt="thumb" class="img-fluid">
                        </div>
                    </div>

                </div>


                <div class="row aos-init aos-animate" data-aos="fade-up">
                    <div class="col-sm-12">
                        <div class="ad_banner landscape">
                            <div data-banner-id="425470"></div>
                        </div>
                    </div>
                </div>



            </div>


        </div>
        <!-- main-panel ends -->
        <!-- container-scroller ends -->

        <!-- partial:partials/_footer.html -->
        <footer>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <div class="fs-14 font-weight-600">
                                    <ul class="footer_menu">
                                        <li>
                                            <a href="{{ URL('contactus') }}">Contact us</a>
                                        </li>

                                        <li>
                                            <a href="{{ URL('aboutus') }}">About us</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('privacypolicy') }}">Privacy Policy</a>
                                        </li>

                                        <li>
                                            <a href="{{route('termsservice')}}">Terms of Service</a>
                                        </li>
                                    </ul>


                                    © {{ date('Y') }}. All rights reserved.
                                </div>
                                <ul class="social-media mb-3">
                                    <li>
                                        <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                                            <i class="mdi mdi-youtube"></i>
                                            <span class="sr-only">{{ env('APP_NAME')  }} Youtube</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-twitter"></i>
                                            <span class="sr-only">{{ env('APP_NAME')  }} Twitter</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- partial -->
    </div>
</div>
<script src="{{ url('public/assets/js/common.js') }}"></script>
<script src="{{ url('public/assets/js/formsubmit.js') }}"></script>
<!-- inject:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="./assets/js/demo.js"></script>
<script src="./assets/js/jquery.easeScroll.js"></script>
<script src="{{ url('public/assets/lightbox/simple-lightbox.js?v2.8.0')}}"></script>
<script>
    (function () {
        var $gallery = new SimpleLightbox('.gallery a', {});
    })();
</script>
</body>
</html>
