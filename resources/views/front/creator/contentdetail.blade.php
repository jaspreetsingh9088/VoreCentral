<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Content Detail</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/lightbox/simple-lightbox.css?v2.8.0') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ url('public/assets/css/audiostyle.css') }}">
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
    

    <style>
        .card-body {
            padding: 0 !important;
        }
        .comment-box {
            background-color: #96ad399c;
            padding: 10px;
            border-radius: 3px;
        }
        .comment-box .community_img {
            margin-top: 20px;
        }
        .user-comment-shaddow {
            box-shadow: 0px 0px 10px #9cb33f;
            padding: 10px;
            border-radius: 3px;
        }
        .community_box {
            margin-bottom: 20px !important;
            margin-top: 30px !important;
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
        header{
            background:url({{asset('assets/images/banner.png')}}) no-repeat !important;
            background-size: cover !important;
        }
        .filter_dropdown{
            background: #195519;
            color: #fff;
            font-weight: 500;
            font-stretch: normal;
            font-style: normal;
            font-size: 17px;
            margin-left: 7px;
            padding: 11px 23px 7px 18px;
            display: block;
        }
        .top_gallery .search_box .form-control{
            margin-right: 0px;
        }
        .filter_button{
            background:#195519;
            color:#fff;
            font-weight: 500;
            font-stretch: normal;
            font-style: normal;
            font-size: 17px;
            margin-left: 0px;
            padding: 11px 23px 7px 18px;
        }
        .top_gallery.creator_gallery_search .search_box .btn-outline-primary{
            height: 37px;;
        }
        .file-view-link {
            font-weight: bold;
        }
        .hide_section {
            border: none;
            background: none;
        }
    </style>
</head>
<livewire:cursor-style>
<body class="{{$theme ? $theme : 'green_theme' }} " style="font-family:{{ $font }}">
    <div class="colo">
        <div class="main-panel">
         @include("front.layouts.header")
            @if($negative_content == true)
                <div class="content-wrapper">
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-8">
                            <div class="top_gallery creator_gallery_search">
                                <div class="d-flex search_box">
                                    <span class="type-box-grn">This content is hidden because it has negative like/dislike ratio. To view this, manage your settings from General option page</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(empty($UsercontentData))
                <div class="content-wrapper">
                    <div class="row d-flex justify-content-around">
                        <div class="col-sm-8">
                            <div class="top_gallery creator_gallery_search">
                                <div class="d-flex search_box">
                                    <span class="type-box-grn" style="width: 100%; color: #fff;">This content has been deleted.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($negative_content == false)
                <div class="content-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="top_gallery creator_gallery_search">
                                    <div class="d-flex search_box">


                                        <div class="dropdown">
                                            <span class="type-box-grn dropdown-toggle filter_button" data-toggle="dropdown" style="display: inline-block"> Box For Changing<br> Type of Search</span>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item filter-item" data-filter="" href="javascript:;" >All content</a>
                                                <a class="dropdown-item filter-item" data-filter="literature" href="javascript:;" >Literature</a>
                                                <a class="dropdown-item filter-item" data-filter="picture" href="javascript:;" >Pictures</a>
                                                <a class="dropdown-item filter-item" data-filter="photography" href="javascript:;" >Photographies</a>
                                                <a class="dropdown-item filter-item" data-filter="3D art" href="javascript:;" >3D Art</a>
                                                <a class="dropdown-item filter-item" data-filter="comic" href="javascript:;" >Comics</a>
                                                <a class="dropdown-item filter-item" data-filter="animated" href="javascript:;" >Animated Video</a>
                                                <a class="dropdown-item filter-item" data-filter="live Action" href="javascript:;" >Live Action</a>
                                                <a class="dropdown-item filter-item" data-filter="interactive" href="javascript:;" >Interactive</a>
                                                <a class="dropdown-item filter-item" data-filter="audio" href="javascript:;" >Audio</a>
                                            </div>
                                        </div>
                                        {{-- <div class=""> --}}
                                            <form action="{{ route('publicgallery.gallerySerach') }}" class="input-group">
                                                @csrf
                                                <input type="hidden" name="filter" class="filter-input">
                                                <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">

                                                <button type="submit" class="btn btn-outline-primary">search</button>
                                            </form>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row creator_community" data-aos="fade-up">
                            <div class="col-sm-1"></div>
                            <div class="col-lg-7 pr-10">
                                <div class="content_sect">
                                    @if (isset($UsercontentData))
                                        @php
                                            $striped_content = '';
                                            $content = '';
                                            $ext = pathinfo($UsercontentData['content'], PATHINFO_EXTENSION);
                                            $audiofilepath = '';
                                            $docxfilepath = '';
                                        @endphp
                                        @if (!empty($UsercontentData['video_url']))
                                            <iframe width="560" height="315" src="{{ $UsercontentData['video_url'] }}" title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                                            </iframe>
                                        @else
                                            @if ($ext == 'mp3' || $ext == 'wav')
                                                <div style="padding: 0.7em; max-height:800px; overflow-y: auto;background-color: #fff;border:0.3rem solid gray;">
                                                    <img src="{{ $UsercontentData['thumbnail'] }}" alt="" srcset="" width="100%">
                                                </div>
                                                <br>
                                            @endif

                                            <div style="padding: 0.7em; max-height:800px; overflow-y: auto;background-color: #fff;border:0.3rem solid gray;">
                                                @if ($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'webp' || $ext == 'jfif' || $ext == 'avif' || $ext == 'svg')
                                                    @php
                                                        $url = $UsercontentData['content'];
                                                        $lastSlashPos = strrpos($url, '/');
                                                        $fileName = substr($url, $lastSlashPos + 1);
                                                    @endphp
                                                    {{-- <a href="{{ asset('content/' . $fileName) }}" class="mfp-image">
                                                        <img src="{{ $UsercontentData['content'] }}" alt="" srcset="" width="100%">
                                                    </a> --}}
                                                    <a href="{{ $UsercontentData['content'] }}" data-fancybox data-caption="{{ $UsercontentData['title'] }}">
                                                        <img src="{{ $UsercontentData['content'] }}" alt="" srcset="" width="100%">
                                                    </a>
                                                @elseif($ext == 'mp3' || $ext == 'wav')
                                                    @php
                                                        $audiofilepath = $UsercontentData['content'];
                                                    @endphp
                                                    <div class="">
                                                        <div id="waveform"></div>
                                                        <div class="controls">
                                                            <img src="{{ asset('media/play.png') }}" alt="" id="playBtn">
                                                            <img src="{{ asset('media/stop.png') }}" alt="" id="stopBtn">
                                                            <img src="{{ asset('media/volume.png') }}" alt="" id="volumeBtn">
                                                        </div>
                                                    </div>
                                                @elseif($ext == 'webm' || $ext == 'mp4' || $ext == 'flv' || $ext == 'avi')
                                                    <video width="100%" height="100%" controls>
                                                        <source src="{{ $UsercontentData['content'] }}" type="video/{{ $ext }}">
                                                    </video>
                                                @elseif($ext == 'mkv')
                                                    <video width="100%" height="100%" controls>
                                                        <source src="{{ $UsercontentData['content'] }}" type="video/mp4">
                                                        <source src="{{ $UsercontentData['content'] }}" type="video/webm">
                                                    </video>
                                                @elseif($ext == 'txt')
                                                    @php
                                                        $url = $UsercontentData['content'];
                                                        $lastSlashPos = strrpos($url, '/');
                                                        $fileName = substr($url, $lastSlashPos + 1);
                                                        $contents = File::get(public_path('content/' . $fileName));
                                                    @endphp
                                                    {!! nl2br(e($contents)) !!}
                                                {{-- @elseif($ext == 'odt')
                                                    <a href="{{ $UsercontentData['content'] }}" class="file-view-link" target="_blank">Please click here to download the file</a> --}}
                                                @elseif($ext == 'rtf')
                                                    @php
                                                        $url = $UsercontentData['content'];
                                                        $lastSlashPos = strrpos($url, '/');
                                                        $fileName = substr($url, $lastSlashPos + 1);
                                                        $rtf = File::get(public_path('content/' . $fileName));
                                                        $document = new RtfHtmlPhp\Document($rtf);
                                                        // $formatter = new RtfHtmlPhp\Html\HtmlFormatter('UTF-8');
                                                        $formatter = new RtfHtmlPhp\Html\HtmlFormatter();
                                                        echo $formatter->Format($document);
                                                    @endphp
                                                    {{-- <a href="{{ $UsercontentData['content'] }}" class="file-view-link" target="_blank">Please click here to download the file</a> --}}
                                                @elseif($ext == 'docx')
                                                    @php
                                                        $docxfilepath = $UsercontentData['content'];
                                                    @endphp
                                                    <div class="" id="docstext"></div>
                                                @elseif($ext == 'doc' || $ext == 'odt')
                                                    @php
                                                        $url = $UsercontentData['content'];
                                                        // $lastSlashPos = strrpos($url, '/');
                                                        // $fileName = substr($url, $lastSlashPos + 1);
                                                        // $file = public_path('content/'.$fileName);
                                                        // if (($fh = fopen($file, 'r')) !== false) {
                                                        //     $headers = fread($fh, 0xa00);
                                                        //     // read doc from 0 to 255 characters
                                                        //     $n1 = ord($headers[0x21c]) - 1;
                                                        //     // read doc from 256 to 63743 charact   ers
                                                        //     $n2 = (ord($headers[0x21d]) - 8) * 256;
                                                        //     // read doc from 63744 to 16775423 characters
                                                        //     $n3 = ord($headers[0x21e]) * 256 * 256;
                                                        //     //read doc from 16775424 to 4294965504 characters
                                                        //     $n4 = ord($headers[0x21f]) * 256 * 256 * 256;
                                                        //     // Total length of text in the document
                                                        //     $textLength = $n1 + $n2 + $n3 + $n4;
                                                        //     ini_set('memory_limit', '-1');
                                                        //     $extracted_plaintext = fread($fh, abs($textLength));
                                                        //     // echo nl2br($extracted_plaintext);
                                                        // }
                                                        @endphp
                                                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{$url}}" width='100%' height='900px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
                                                @elseif($ext == 'pdf')
                                                    {{-- @php
                                                        $pdfParser = new \Smalot\PdfParser\Parser();
                                                        $url = $UsercontentData['content'];
                                                        $lastSlashPos = strrpos($url, '/');
                                                        $fileName = substr($url, $lastSlashPos + 1);
                                                        $pdf = $pdfParser->parseFile(public_path('content/' . $fileName));
                                                        $text = $pdf->getText();
                                                    @endphp
                                                    {!! nl2br(e($text)) !!} --}}
                                                    <iframe src="{{ $UsercontentData['content'] }}#toolbar=0" width="100%" height="750px" style="border:none"></iframe>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="img_content">
                                            <div class="name_content">
                                                <h2>{{ $UsercontentData['title'] }}
                                                    <span class="ar-like">
                                                        <a href="{{ URL('marklike/' . $UsercontentData['id']) }}">
                                                            @if (isset($islike) && $islike > 0)
                                                                <i class="fa fa-thumbs-up text-black" aria-hidden="true"></i>
                                                            @else
                                                                <i class="fa fa-thumbs-o-up text-black" aria-hidden="true"></i>
                                                            @endif
                                                        </a>
                                                    </span>
                                                    <span class="font-weight-bold text-black"> / </span>
                                                    <span class="ar-dislike">
                                                        <a href="{{ URL('markdislike/' . $UsercontentData['id']) }}">
                                                            @if (isset($isdislike) && $isdislike > 0)
                                                                <i class="fa fa-thumbs-down text-black" aria-hidden="true"></i>
                                                            @else
                                                                <i class='fa fa-thumbs-o-down text-black' aria-hidden="true"></i>
                                                            @endif
                                                        </a>
                                                    </span>
                                                    <!--<a href="#" class="text-secondary font-weight-bold">Reply</a>-->
                                                </h2>
                                                <div class="rate">
                                                    <style> .checked { color: orange; } </style>
                                                    <input type="hidden" class="content_id" value="{{ $UsercontentData['id'] }}">
                                                    <div class="rating-star">
                                                        @if(!is_null($rating))
                                                            @for($i = 1; $i <= $rating->rating; $i++)
                                                                <span class="fa fa-star fa-2x checked" id="rating-star-icon" data-index="{{$i}}"></span>
                                                            @endfor
                                                            @for($i = $rating->rating+1; $i <= 5; $i++)
                                                                <span class="fa fa-star fa-2x" id="rating-star-icon" data-index="{{$i}}"></span>
                                                            @endfor
                                                        @else
                                                            @for($i = 1; $i < 6; $i++)
                                                                <span class="fa fa-star fa-2x" id="rating-star-icon" data-index="{{$i}}"></span>
                                                            @endfor
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($viewerId == $userid)
                                                <div class="d-flex gallery_tab">
                                                    <ul class="">
                                                       <li class="nav-item">
                                                            <a href="{{ route('content-show', ['content_id' => $UsercontentData['id']]) }}" class="nav-link">Edit</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="{{ route('deleteContent', $UsercontentData['id']) }}" class="nav-link">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                <div class="d-flex gallery_tab">
                                                    <ul class="">
                                                        <li class="nav-item">
                                                            {{-- <a href="#" class="nav-link">Subscribe</a> --}}
                                                            @if($isFollowing)
                                                                <a style="text-decoration: unset; color:#fff;" href="{{ route('unfollow',[$UsercontentData['userid']]) }}" class="nav-link">Subscribed</a>
                                                            @else
                                                                <a style="text-decoration: unset; color:#fff;" href="{{ route('follow',[$UsercontentData['userid']]) }}" class="nav-link">Subscribe</a>
                                                            @endif
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="{{ URL('markgalleryfavorite/' . $UsercontentData['id']) }}" class="nav-link">
                                                                @if (isset($isfavourite) && $isfavourite > 0)
                                                                    <span style="color:#fff;"> <i class="fa fa-heart" aria-hidden="true"></i> Favorite </span>
                                                                @else
                                                                    <span style="color:#fff;"> <i class="fa fa-heart-o" aria-hidden="true"></i> Favorite </span>
                                                                @endif
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="media forum-item">
                                            @php
                                                $user = App\Models\User::find($UsercontentData['userid']);
                                                if($user->creator == 1){
                                                    $dashboard_url = route('creatorvisitordashboard',[$user->id]);
                                                }else{
                                                    $dashboard_url = route('profiledashboard',[$user->id]);
                                                }
                                            @endphp
                                            <a href="{{ $dashboard_url }}"  class="community_img mr-3">
                                                <img src="{{ $user->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle"></a>
                                            <div class="media-body">
                                                <h6>
                                                    <a href="{{ $dashboard_url }}" class="text-body">{{ $user->username }}</a>
                                                </h6>
                                                <p class="text-secondary">
                                                    {{ date('d-m-Y', strtotime($UsercontentData['created_at'])) }}
                                                </p>
                                            </div>
                                            <a href="#" class="text-secondary font-weight-bold"> </a>
                                        </div>
                                    </div>
                                    <div class="content_sect">
                                        <br>
                                        <div class="average-rating-star">
                                            @if(!is_null($average_rating))
                                                @for($i = 1; $i <= $average_rating; $i++)
                                                    <span class="fa fa-star fa-2x checked"></span>
                                                @endfor
                                                @for($i = $average_rating+1; $i <= 5; $i++)
                                                    <span class="fa fa-star fa-2x"></span>
                                                @endfor
                                            @endif
                                        </div>
                                        <br><br>
                                        <span class="review-no">{{$total_review}} reviews</span><br><br>
                                        <h3 class="tittle">{{ $UsercontentData['description'] }}</h3>
                                    </div>
                                    <div class="content_sect">
                                        @php
                                            $tagIds = explode(',', $UsercontentData['tags']);
                                            $tags = App\Models\Tag::whereIn('id', $tagIds)->get();
                                        @endphp
                                        <h3 class="tittle">
                                            @foreach ($tags as $tag)
                                                #{{ $tag->title }}&nbsp;&nbsp;
                                            @endforeach
                                        </h3>
                                    </div>
                                    <div class="row creator_community aos-init aos-animate" data-aos="fade-up" id="comments_box">
                                        <div class="col-lg-12">
                                            <div class="community_box">
                                                <div class="card mb-2">
                                                    <div class="card-body p-2 p-sm-3">
                                                        <div class="media forum-item comment-box">
                                                            {{-- @php
                                                                $user = App\Models\User::find(Auth::user()->id);
                                                            @endphp --}}
                                                            <a href="#" data-toggle="collapse" data-target="" class="community_img mr-3">
                                                                <img src="{{ Auth::user()->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle"></a>
                                                            <div class="user_input">
                                                                <span class="add_comment">Add a Comment</span>
                                                                <form class="comment-form" action="{{ route('addgallerycomment') }}" class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                                                    @csrf
                                                                    <input type="text" name="comment" class="form-control" id="" aria-describedby="" placeholder="">
                                                                    <input type="hidden" name="contentid" value="{{ $UsercontentData['id'] }}">
                                                                    <input type="submit" value="Submit Comment" class="btn btn-primary" style="float: right;margin-top: 10px;border-radius: 0px;">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="all_comment">
                                                @if (isset($UsercontentData['commentdata']) && is_array($UsercontentData['commentdata']) && count($UsercontentData['commentdata']) > 0)
                                                    @foreach ($commentData as $cd)
                                                        @isset($cd->user)
                                                            <div class="community_box user-comment-shaddow" id="@if(!is_null($cd->user)){{'comment'.$cd->user->username}}@endif">
                                                                <div class="card mb-2">
                                                                    <div class="card-body p-2 p-sm-3">
                                                                        <div class="media forum-item">
                                                                            <a href="{{ URL('dashboard/' . $cd['userid']) }}" class="community_img mr-3">
                                                                                <img src="{{ $cd->user->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <div class="abc">
                                                                                    <h6>
                                                                                        @if(!is_null($cd->user))
                                                                                            @if($cd->user->creator == 1)
                                                                                                @php $dashboard_link = route('creatorvisitordashboard',[$cd->user->id]) @endphp
                                                                                            @else
                                                                                                @php $dashboard_link = route('profiledashboard',[$cd->user->id]) @endphp
                                                                                            @endif
                                                                                        @else
                                                                                            @php $dashboard_link = 'javascript:;' @endphp
                                                                                        @endif
                                                                                        <a href="{{ $dashboard_link }}" class="text-body">
                                                                                            {{ $cd->user->username }} : {{ date('d-m-Y', strtotime($cd->created_at)) }}
                                                                                        </a>
                                                                                        | <span class="reply-to-btn" data-cid="{{ $cd->id }}" style="cursor: pointer;">Reply </span>
                                                                                        @if ($UsercontentData['userid'] == Auth::id() || $cd->userid == Auth::id())
                                                                                            <button type="button" data-toggle="modal" data-target="#exampleModal{{ $cd->id }}" class="hide_section">
                                                                                                <i class="fa fa-trash" style="color:red;" aria-hidden="true"></i>
                                                                                            </button>
                                                                                            <button type="button" data-toggle="modal"  class="hide_section edit-btn" data-cid="{{ $cd->id }}">
                                                                                                <i class="fa fa-edit" style="color:red;" aria-hidden="true"></i>
                                                                                            </button>
                                                                                        @endif
                                                                                    </h6>
                                                                                </div>
                                                                                <p class="text-secondary" id="edit-text{{ $cd->id }}">
                                                                                    {{ $cd->comment }}
                                                                                </p>
                                                                                <!-- Edit Form -->
                                                                                <div id="edit-area{{ $cd->id }}" class="edit-area form-setting" style="display:none;">
                                                                                    <div class="edit-close-icon float-right">
                                                                                        <i style="font-size: 20px" class="fa fa-times-circle mb-2" aria-hidden="true"></i>
                                                                                    </div>
                                                                                    <form class="comment-form" action="{{ route('updateGalleryComment') }}" class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                                                                        @csrf
                                                                                        <input type="text" name="comment" class="form-control" id="" value="{{ $cd->comment }}" aria-describedby="" placeholder="">
                                                                                        <input type="hidden" name="contentid" value="{{ $UsercontentData['id'] }}">
                                                                                        <input type="hidden" value="{{$cd->id}}" name="comment_id">
                                                                                        <input type="submit" value="Edit" class="btn btn-primary" style="float: right;margin-top: 10px;border-radius: 0px;">
                                                                                    </form>
                                                                                    <div style="clear:both"></div>
                                                                                </div>
                                                                            </div>
                                                                            <a href="#" class="text-secondary font-weight-bold"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Reply To Form -->
                                                            <div id="reply-to-area{{ $cd->id }}" class="reply-to-area form-setting" style="display:none;">
                                                                <div class="reply-to-close-icon float-right">
                                                                    <i style="font-size: 20px" class="fa fa-times-circle mb-2" aria-hidden="true"></i>
                                                                </div>
                                                                <form class="comment-form" action="{{ route('addgallerycomment') }}" class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                                                    @csrf
                                                                    <input type="text" name="comment" class="form-control" id="" aria-describedby="" placeholder="">
                                                                    <input type="hidden" name="contentid" value="{{ $UsercontentData['id'] }}">
                                                                    <input type="hidden" value="{{$cd->id}}" name="comment_id">
                                                                    <input type="submit" value="Submit Comment" class="btn btn-primary" style="float: right;margin-top: 10px;border-radius: 0px;">
                                                                </form>
                                                                <div style="clear:both"></div>
                                                            </div>
                                                            <!-- Button trigger modal -->
                                                            <!-- Modal -->
                                                            @if ($UsercontentData['userid'] == Auth::id() || $cd->userid == Auth::id())
                                                            <div class="modal fade" id="exampleModal{{ $cd->id }}" tabindex="-1"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <h2 class="hedding">Delete Comment</h2>
                                                                        <div class="modal-header">
                                                                            <h5 class="" id="exampleModalLabel">Are You Sure You Want To Delete This Comment?</h5>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="{{ route('removegallerycomment', ['id' => $cd->id]) }}" class="btn btn-primary">Delete</a>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff;">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif

                                                            <!-- Reply Section -->
                                                            @if(isset($cd['reply_data']) && count($cd['reply_data']) > 0)
                                                                <div class="all_comment">
                                                                    <div class="panel-group">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4 class="panel-title">
                                                                                    <a data-toggle="collapse" href="#collapse{{ $cd->id }}">Replies ({{ count($cd['reply_data']) }})</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div id="collapse{{ $cd->id }}" class="panel-collapse collapse">
                                                                                @foreach($cd['reply_data'] as $reply_data)

                                                                                    <div class="community_box user-comment-shaddow" id="@if(!is_null($reply_data->user)){{'comment'.$reply_data->user->username}}@endif">
                                                                                        <div class="card mb-2">
                                                                                            <div class="card-body p-2 p-sm-3">
                                                                                                <div class="media forum-item">
                                                                                                    <a href="{{ URL('dashboard/' . $reply_data->userid) }}" class="community_img mr-3">
                                                                                                        <img src="{{ $reply_data->user->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle">
                                                                                                    </a>
                                                                                                    <div class="media-body">
                                                                                                        <div class="abc">
                                                                                                            <h6>
                                                                                                                @if(!is_null($reply_data->user))
                                                                                                                    @if($reply_data->user->creator == 1)
                                                                                                                        @php $dashboard_link = route('creatorvisitordashboard',[$reply_data->user->id]) @endphp
                                                                                                                    @else
                                                                                                                        @php $dashboard_link = route('profiledashboard',[$reply_data->user->id]) @endphp
                                                                                                                    @endif
                                                                                                                @else
                                                                                                                    @php $dashboard_link = 'javascript:;' @endphp
                                                                                                                @endif
                                                                                                                <a href="{{ $dashboard_link }}" class="text-body">
                                                                                                                    {{ $reply_data->user->username }} : {{ date('d-m-Y', strtotime($reply_data->created_at)) }}
                                                                                                                </a>
                                                                                                                @if ($UsercontentData['userid'] == Auth::id() || $reply_data->userid == Auth::id())
                                                                                                                    <button type="button" data-toggle="modal" data-target="#deleteCommentReplyModal{{ $reply_data->id }}" class="hide_section">
                                                                                                                        <i class="fa fa-trash" style="color:red;" aria-hidden="true"></i>
                                                                                                                    </button>
                                                                                                                     <button type="button" data-toggle="modal"  class="hide_section edit-btn" data-cid="{{ $reply_data->id }}">
                                                                                                                        <i class="fa fa-edit" style="color:red;" aria-hidden="true"></i>
                                                                                                                    </button>
                                                                                                                @endif
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                        <p class="text-secondary" id="edit-text{{ $reply_data->id }}">
                                                                                                            {{ $reply_data->comment }}
                                                                                                        </p>

                                                                                                        <div id="edit-area{{ $reply_data->id }}" class="edit-area form-setting" style="display:none;">
                                                                                                            <div class="edit-close-icon float-right">
                                                                                                                <i style="font-size: 20px" class="fa fa-times-circle mb-2" aria-hidden="true"></i>
                                                                                                            </div>
                                                                                                            <form class="comment-form" action="{{ route('updateGalleryComment') }}" class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                                                                                                @csrf
                                                                                                                <input type="text" name="comment" class="form-control" id="" value="{{ $reply_data->comment }}" aria-describedby="" placeholder="">
                                                                                                                <input type="hidden" value="{{ $reply_data->id }}" name="comment_id">
                                                                                                                <input type="submit" value="Edit" class="btn btn-primary" style="float: right;margin-top: 10px;border-radius: 0px;">
                                                                                                            </form>
                                                                                                            <div style="clear:both"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <a href="#" class="text-secondary font-weight-bold"></a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- Modal -->
                                                                                    @if($UsercontentData['userid'] == Auth::id() || $reply_data->userid == Auth::id())
                                                                                    <div class="modal fade" id="deleteCommentReplyModal{{ $reply_data->id }}" tabindex="-1"role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h2 class="hedding">Delete Comment</h2>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <h5>Are You Sure You Want To Delete This Comment?</h5>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <a href="{{ route('removegallerycomment', ['id' => $reply_data->id]) }}" class="btn btn-primary">Delete</a>
                                                                                                    <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal" style="color: #fff;">Cancel</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                            @endif
                                                            <!-- Reply Section END -->

                                                        @endisset
                                                    @endforeach
                                                @endif
                                            </div>
                                            <a href="#" class="text-secondary font-weight-bold">
                                            </a>
                                        </div><a href="#" class="text-secondary font-weight-bold">
                                        </a>
                                    </div>
                                @endif
                                <nav aria-label="Page navigation example" class="clearfix">
                                    {{-- {{ $commentData->links('vendor.pagination.content-details-pagination') }} --}}
                                    {{ $commentData->links('vendor.pagination.bootstrap-5') }}
                                </nav>
                            </div>
                            <div class="col-xl-3 card background_trns p-0">
                                @if($UsercontentData['monetise']==1)
                                    @if ($advertisement)
                                <!--<div class="ad_banner vertical">
                                    @if($advertisement->content2!="")
                                        {!!$advertisement->content2!!}
                                    @elseif(!is_null($advertisement->getRawOriginal('image2')) && $advertisement->getRawOriginal('image2')!="")
                                        <img src="{{ $advertisement->image2 }}" alt="thumb" class="img-fluid"  >
                                    @endif
                                </div>-->
                                    @endif
                                @endif
                                <div class="right_cont latest_post latest_video green_right_theme">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="card-title">
                                            Related Art
                                        </div>
                                    </div>
                                    @foreach($relatedart as $ra)
                                        <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                                            <div class="div-w-80 mr-3">
                                                <div class="rotate-img">
                                                    <a href="{{ route('contentdetail',[$ra->id]) }}">
                                                        <img src="{{ $ra->thumbnail }}" alt="thumb" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                            <h3 class="font-weight-600 mb-0">
                                                <a style="color: black; text-decoration: unset;" href="{{ route('contentdetail',[$ra->id]) }}">
                                                    {{ $ra->title }}
                                                </a>
                                            </h3>
                                        </div>
                                    @endforeach
                                    {{-- <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                        <div class="div-w-80 mr-3">
                                            <div class="rotate-img">
                                                <img src="{{ url('public/assets/images/item-09.png') }}" alt="thumb" class="img-fluid">
                                            </div>
                                        </div>
                                        <h3 class="font-weight-600 mb-0">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </h3>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                        <div class="div-w-80 mr-3">
                                            <div class="rotate-img">
                                                <img src="{{ url('public/assets/images/item-08.png') }}" alt="thumb" class="img-fluid">
                                            </div>
                                        </div>
                                        <h3 class="font-weight-600 mb-0">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </h3>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                        <div class="div-w-80 mr-3">
                                            <div class="rotate-img">
                                                <img src="{{ url('public/assets/images/item-10.png') }}" alt="thumb" class="img-fluid">
                                            </div>
                                        </div>
                                        <h3 class="font-weight-600 mb-0">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </h3>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                        <div class="div-w-80 mr-3">
                                            <div class="rotate-img">
                                                <img src="{{ url('public/assets/images/item-10.png') }}" alt="thumb" class="img-fluid">
                                            </div>
                                        </div>
                                        <h3 class="font-weight-600 mb-0">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </h3>
                                    </div> --}}
                                </div>
                                <div class="right_cont green_right_theme">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="card-title">
                                            Same Author
                                        </div>
                                    </div>
                                    <div class="border-bottom pb-3">
                                        <div class="latest_upload">
                                            @foreach($sameauthor as $sa)
                                                <a href="{{ route('contentdetail',[$sa->id]) }}" class="rotate-img">
                                                    <img src="{{ $sa->thumbnail }}" alt="thumb" class="img-fluid ">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="right_cont latest_post latest_video green_right_theme">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="card-title">
                                            Featured By the Author
                                        </div>
                                    </div>
                                    @foreach($authorfeatured as $af)
                                        <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                                            <div class="div-w-80 mr-3">
                                                <div class="rotate-img">
                                                    <a href="{{ route('contentdetail',[$af->id]) }}">
                                                        <img src="{{ $af->thumbnail }}" alt="thumb" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                            <h3 class="font-weight-600 mb-0">
                                                <a style="color: black; text-decoration: unset;" href="{{ route('contentdetail',[$af->id]) }}">{{ $af->title }}</a>
                                            </h3>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if ($advertisement)
                        <div class="row aos-init aos-animate" data-aos="fade-up">
                            <div class="col-sm-12">
                                @if($UsercontentData['monetise']==1)
                                <!--<div class="ad_banner landscape">
                                    @if($advertisement->content1!="")
                                        {!!$advertisement->content1!!}
                                    @elseif(!is_null($advertisement->getRawOriginal('image1')) && $advertisement->getRawOriginal('image1')!="")
                                        <img src="{{ $advertisement->image1 }}" alt="thumb" class="img-fluid">
                                    @endif
                                </div>-->
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endif
            @include('front.layouts.footer')
        </div>
    </div>
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    {{-- <script src="{{ url('public/assets/js/formsubmit.js') }}"></script> --}}
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
    <script src="{{ url('public/assets/lightbox/simple-lightbox.js?v2.8.0') }}"></script>
    <script src="https://unpkg.com/wavesurfer.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.26.2/docxtemplater.js"></script>
    <script src="{{ url('public/assets/js/docxtemplater.js') }}"></script>
    <script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip.js"></script>
    <script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip-utils.js"></script>
    <script type="text/javascript" src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="{{ url('public/assets/js/docx-preview.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $('.filter-item').click(function(){
            var filtervalue = $(this).data('filter');
            //$("form.input-group").attr("action","/publicgallery/"+filtervalue+"/latest");
            $('.filter-input').val(filtervalue);
        })
        let spiner = `<div class="spinner-border text-light size-px-24" role="status"><span class="sr-only">Loading...</span></div>`;
        $(".comment-form").on("submit", function (event) {
            event.preventDefault();
            $(".validation-errors").remove();
            $(".comment-form").find(":input,:radio,:checkbox,select").removeClass("in-valid");
            var form = $(this);
            data = new FormData(this);
            var redirecturl = $(this).attr("redirect");
            var submitBtn = $(this).find("button:submit");
            var table = $(this).attr("table");
            var modal = $(this).attr("modal");
            addLoader(submitBtn);
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (redirecturl) {
                        window.location.replace(redirecturl);
                    }
                    if (response.code==200) {
                        if (submitBtn) {
                            removeLoader(submitBtn);
                            showSnackbar(response.message);
                        }

                    }

                },
            });
        });
        function addLoader(e) {
            var button = $(e);
            $(e).data("btn", button.html());
            button.html(spiner).attr("disabled", "disabled");
        }

        function removeLoader(e) {
            var button = $(e);
            button.html($(e).data("btn")).attr("disabled", false);
        }
        function showSnackbar(msg) {
            var x = document.getElementById("snackbar");
            x.innerHTML = msg ;
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    </script>
@if($negative_content == false && isset($UsercontentData))
    <script>
        $("[data-fancybox]").fancybox({
            margin : [44, 0],
            toolbar : true,
        });
        (function() {
            // gettext();
            PreviewWordDoc();
            var $gallery = new SimpleLightbox('.gallery a', {});
        })();
        var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: '#000',
            progressColor: '#f00',
            barWidth: 4,
            height: 90,
            responsive: true,
            hideScrollbar: true,
            barRadius: 4,
        });
        let ext = '{{ $ext }}'
        if (ext == 'mp3' || ext == 'wav') {
            let audiofilepath = "{{ $audiofilepath }}"
            if (audiofilepath !== null || audiofilepath !== "") {
                wavesurfer.load(audiofilepath);
                let playBtn = document.getElementById('playBtn');
                let stopBtn = document.getElementById('stopBtn');
                let volumeBtn = document.getElementById('volumeBtn');
                playBtn.onclick = function() {
                    wavesurfer.playPause();
                    if (playBtn.src.includes("play.png")) {
                        playBtn.src = "{{ asset('media/pause.png') }}"
                    } else {
                        playBtn.src = "{{ asset('media/play.png') }}"
                    }
                }
                stopBtn.onclick = function() {
                    wavesurfer.stop();
                    playBtn.src = "{{ asset('media/play.png') }}"
                }
                volumeBtn.onclick = function() {
                    wavesurfer.toggleMute();
                    if (volumeBtn.src.includes("volume.png")) {
                        volumeBtn.src = "{{ asset('media/mute.png') }}"
                    } else {
                        volumeBtn.src = "{{ asset('media/volume.png') }}"
                    }
                }
                wavesurfer.on('finish', function() {
                    playBtn.src = "{{ asset('media/play.png') }}"
                    wavesurfer.stop();
                });
            }
        }
        function loadFile(url, callback) {
            PizZipUtils.getBinaryContent(url, callback);
        }
        function gettext() {
            loadFile(
                "{{ $docxfilepath }}",
                function(error, content) {
                    if (error) {
                        throw error;
                    }
                    var zip = new PizZip(content);
                    var doc = new window.docxtemplater(zip, {
                        linebreaks: true
                    });
                    var text = doc.getFullText();
                    document.getElementById("docstext").innerHTML = text;
                }
            );
        }
        function PreviewWordDoc() {
            //Read the Word Document data from the File Upload.
            // var doc = document.getElementById("files").files[0];
            // console.log(doc);
            //If Document not NULL, render it.
            // if (doc != null) {
            //Set the Document options.
            var docxOptions = Object.assign(docx.defaultOptions, {
                useMathMLPolyfill: true
            });
            //Reference the Container DIV.
            var container = document.querySelector("#docstext");
            toDataUrl("{{ $docxfilepath }}", function(x) {
                docx.renderAsync(x, container, null, docxOptions);
            })
            //Render the Word Document.
            // }
        }
        function toDataUrl(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                callback(xhr.response);
            };
            xhr.open('GET', url);
            xhr.responseType = 'blob';
            xhr.send();
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.mfp-image').magnificPopup({
                type: 'image'
            });

            $(".reply-to-btn").click(function(){
                let cid = $(this).data('cid');
                $('#reply-to-area'+cid).show();
            });
            $(".edit-btn").click(function(){
                let cid = $(this).data('cid');
                $('#edit-text'+cid).hide();
                $('#edit-area'+cid).show();
            });

            $(".reply-to-close-icon").click(function() {
                $('.reply-to-area').hide();
            });
            $(".edit-close-icon").click(function() {
                $('.edit-area').hide();
            });
        });
    </script>
@endif
<script>
    $(document).on('click','#rating-star-icon',function(){
        var rating = $(this).data('index');
        var content_id = $('.content_id').val();
        $.ajax({
                url: '{{ route('usercontent.ratings') }}',
                type: 'POST',
                data : { content_id : content_id, rating : rating, _token : "{{csrf_token()}}" },
                success: function(data) {
                    if (data.code === 200) {
                        var rating_design = '';
                        var average_rating_design = '';
                        for(var i = 1; i <= rating; i++){
                            rating_design += '<span class="fa fa-star fa-2x checked" id="rating-star-icon" data-index="'+i+'"></span>';
                        }

                        for (let index = rating+1; index <= 5; index++) {
                            rating_design += '<span class="fa fa-star fa-2x" id="rating-star-icon" data-index="'+index+'"></span>';
                        }
                        $('.rating-star').html(rating_design);

                        $('.review-no').html(data.total_review +' reviews');

                        for(var ai = 1; ai <= data.average_rating; ai++){
                            average_rating_design += '<span class="fa fa-star fa-2x checked"></span>';
                        }
                        for(var aj = 1; aj <= 5-data.average_rating; aj++) {
                            average_rating_design += '<span class="fa fa-star fa-2x"></span>';
                        }
                        $('.average-rating-star').html(average_rating_design);

                        toastr.success(data.message);
                    } else {
                        toastr.error("Something went wrong.");
                    }
                },
                error: function(xhr, status, error) {
                    // handle error response from the server
                }
            });
    })
</script>
</body>
</html>
