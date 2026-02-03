<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Buy Content</title>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
/>
</head>
<style>
    body{
        color:white;
    }
    .rav-popup {
        background-image: url({{ url('public/assets/images/bg.webp') }});
    }
    .rav-popup h1,h3,h4,p,th,td {
        color: white;
    }

    .rav-popup a {
        font-size: 18px !important;
        background: url({{ url('public/assets/images/Button-alternative2.webp') }}) no-repeat;
        border: #000 solid 2px;
        margin: 0 5px;
        margin-bottom: 0px;
    }

    .remove-from-cart {
        padding: 5px;
        color: white;
    }

    .rav-popup td {
        vertical-align: middle !important;
    }

    .rav-popup .float-right {
        padding-right: 10px;
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
    header .navbar-bottom .navbar-nav .nav-item .nav-link{
        padding : 6px 19px !important;
    }
    .preview-pic{
        height: auto;
    }
    .text-body{
        color:white!important;
    }
    .image-col img {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }

    .heading {
        font-size: 2rem;
        font-weight: bold;
    }

    .subheading {
        font-size: 1.25rem;
        font-weight: 600;
        color: #444;
    }

    .subtext {
        font-size: 1rem;
        color: black;
    }
    .custom-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; 
    }
    .custom-gallery-related-content{
    display: flex;
    flex-wrap: wrap;
    gap: 10px; 
    }
    .gallery-item {
    width: calc(20% - 8px); 
    }
    .gallery-related-item {
    width: calc(20% - 8px);
    }
    .gallery-item img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 6px;
    }
    .gallery-related-item  img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 6px;
    }
    .tab-pane {
    display: none;
    background:url(../images/Button-alternative2.webp) no-repeat;
    }
    .tab-content{
        background:url("../public/assets/images/purple_background.webp");

    }
    .tab-pane.show {
        background:url("../public/assets/images/purple_background.webp");

    display: block;

    }
    .text-muted{
        color:white !important
    }
    .product_details_background{
        background:none!important;
        background-color: rgb(28, 20, 43) !important;
    }
    #product-description,#product-tags{
        background:url("../public/assets/images/purple_background.webp");
        padding-top: 20px;
        padding-left:40px;
        padding-right: 40px;;
        padding-bottom:20px;
        color:black;
    }
    .subscrib_bt{
        margin:0px 5px;
    }
    #tab1-tab,#tab2-tab{
        background:url("../public/assets/images/Button-alternative2.webp") no-repeat;
        color:black;
    }
    .product-title-price{
        color:white !important;
        font-size: 20px !important;
        margin-bottom:20px;
    }
    .custom-gallery img,
    .custom-gallery-related-content img {
        width: 200px;
        height: 200px;
        object-fit: cover; 
        border-radius: 8px;
        display: block;
        margin: 0;
        padding: 0;
    }
    .custom-gallery .gallery-item,
    .custom-gallery-related-content .gallery-related-item {
        display: inline-block;
    }
    @media (max-width: 600px) {
    .custom-gallery img {
        width: 100px;
        height: 100px;
    }
}
    .details{
        background: rgb(28, 20, 43) !important;
    }
    .text-body, .text-secondary{
        color:white !important;
    }
    .community_box{
        margin-bottom: 5px !important;
        margin-top: 5px !important;
    }
    .rate{
    display:flex;
    justify-content:end;
    }
    #review-section-submit,#comment-section-submit{
    display:flex;
    justify-content:end;
    margin-top:5px;
    }

</style>
<livewire:cursor-style>
<body class="store_theme" style="font-family:{{ $font }}">
    <div class="container">
        <div class="main-panel">
        @include("front.layouts.headerstore")
            <!-- partial -->
            <div class="content-wrapper">
                <div class="product_details_background">
                <div class="container my-5">
             <div class="row custom-row">
            <div class="col-md-12">
                <div class="media forum-item mb-2">
                    <a href="{{ route('creatorvisitorwebstore',[$data->user->id]) }}" class="community_img mr-3">
                        <img src="{{ $data->user->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle">
                    </a>
                    <div class="media-body">
                        <h6>
                            <a href="{{ route('creatorvisitorwebstore',[$data->user->id]) }}" class="text-body">{{ $data->user->username
                                }}</a>
                        </h6>
                        <p class="text-muted small mb-0">
                            Number of Items:{{ $user_items }} &nbsp;|&nbsp; Number of Followers:{{ $user_followers }}
                        </p>
                    </div>
                </div>
            </div>
        <div class="col-md-6 image-col">
        <div class="preview ">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger w-50">
                                    <strong>{{ $error }}</strong>
                                </div>
                            @endforeach
                        @endif
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success w-50">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif
                        <div class="preview-pic">
                        <span class="swiper mySwiper">
  <span class="swiper-wrapper">
                                @if (isset($data) )
                                @if ($paid_status)

                                            @php
                                                $striped_content = '';
                                                $content = '';
                                                $ext = pathinfo($data->content, PATHINFO_EXTENSION);
                                                $audiofilepath = '';
                                                $docxfilepath = '';

                                            @endphp
                                            @if (!empty($data->video_url))
                                                <iframe width="560" height="315" src="{{ $data->video_url }}" title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                                                </iframe>
                                            @else
                                                <div style="padding: 0.7em; max-height:800px; overflow-y: auto;background-color: #fff;border:0.3rem solid gray;">
                                                    @if ($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'webp')
                                                        @php
                                                            $url = $data->content;
                                                            $lastSlashPos = strrpos($url, '/');
                                                            $fileName = substr($url, $lastSlashPos + 1);
                                                        @endphp
                                                        {{-- <a href="{{ asset('content/' . $fileName) }}" class="mfp-image" data-lightbox="gallery">
                                                            <img src="{{ $data->content }}" alt="" srcset="" width="100%">
                                                        </a> --}}
                                                        <a href="{{ $data->content }}" data-fancybox data-caption="{{ $data->title }}" data-lightbox="gallery">
                                                            <img src="{{ $data->content }}" alt="" srcset="" width="100%">
                                                        </a>
                                                        @php
                                                        $otherFiles=explode(',',$data->other_files);
                                                        foreach(array_slice($otherFiles, 1) as $otherFile){
                                                        @endphp
                                                        <a href="{{ asset('content/' . $otherFile) }}" data-lightbox="gallery" data-caption="{{ asset('content/' . $otherFile) }}">
                                                            <img src="{{ asset('content/' . $otherFile) }}" alt="" srcset="" width="100%" data-lightbox="gallery" class="d-none">
                                                        </a>
                                                   @php } @endphp
                                                   @elseif($ext == 'mp3' || $ext == 'wav')
                                                        @php
                                                            $audiofilepath = $data->content;
                                                        @endphp
                                                        <div class="">
                                                            <div id="waveform"></div>
                                                            <audio controls>
                                                                <source src="{{ $data->content }}" type="audio/ogg">
                                                                <source src="{{ $data->content }}" type="audio/mpeg">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        @php
                                                        $otherFiles=explode(',',$data->other_files);
                                                        foreach(array_slice($otherFiles, 1) as $otherFile){
                                                        @endphp
                                                        <audio controls>
                                                                <source src="{{ asset('content/' . $otherFile) }}" type="audio/ogg">
                                                                <source src="{{ asset('content/' . $otherFile) }}" type="audio/mpeg">
                                                                Your browser does not support the audio element.
                                                        </audio>
                                                   @php } @endphp
                                                        </div>
                                                    @elseif($ext == 'webm' || $ext == 'mp4')
                                                        <video width="100%" height="100%" controls controlsList="nodownload">
                                                            <source src="{{ $data->content }}" type="video/{{ $ext }}">
                                                        </video>
                                                    @elseif($ext == 'mkv')
                                                        <video width="100%" height="100%" controls>
                                                            <source src="{{ $data->content }}" type="video/mp4">
                                                            <source src="{{ $data->content }}" type="video/webm">
                                                        </video>
                                                    @elseif($ext == 'txt')
                                                        @php
                                                            $url = $data->content;
                                                            $lastSlashPos = strrpos($url, '/');
                                                            $fileName = substr($url, $lastSlashPos + 1);
                                                            $contents = File::get(public_path('content/' . $fileName));
                                                        @endphp
                                                        {!! nl2br(e($contents)) !!}
                                                        @php
                                                        $otherFiles=explode(',',$data->other_files);
                                                        foreach(array_slice($otherFiles, 1) as $otherFile){
                                                            $ext = pathinfo($otherFile, PATHINFO_EXTENSION);
                                                            if($ext=="txt"){
                                                            $url = $otherFile;
                                                            $lastSlashPos = strrpos($url, '/');
                                                            $fileName = substr($url, $lastSlashPos);
                                                            $filePath=public_path('content/' . $fileName);
                                                            // Check if file exists before reading
                                                        if (File::exists($filePath)) {
                                                            $contents = File::get($filePath);
                                                            echo "<br><br><br><br>";
                                                        } else {
                                                            $contents = "File not found!";
                                                        }
                                                        @endphp
                                                        {!! nl2br(e($contents)) !!}

                                                        @php }
                                                     } @endphp
                                                    @elseif($ext == 'rtf')
                                                        @php
                                                            $url = $data->content;
                                                            $lastSlashPos = strrpos($url, '/');
                                                            $fileName = substr($url, $lastSlashPos + 1);
                                                            $rtf = File::get(public_path('content/' . $fileName));
                                                            $document = new RtfHtmlPhp\Document($rtf);
                                                            $formatter = new RtfHtmlPhp\Html\HtmlFormatter('UTF-8');
                                                            echo $formatter->Format($document);
                                                        @endphp
                                                    @elseif($ext == 'docx')
                                                        @php
                                                            $docxfilepath = $data->content;
                                                        @endphp
                                                        <div class="" id="docstext"></div>
                                                    @elseif($ext == 'doc' || $ext == 'docx')
                                                        @php
                                                            $url = $data->content;
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
                                                        @php
                                                            $pdfParser = new \Smalot\PdfParser\Parser();
                                                            $url = $data->content;
                                                            $lastSlashPos = strrpos($url, '/');
                                                            $fileName = substr($url, $lastSlashPos + 1);
                                                            $pdf = $pdfParser->parseFile(public_path('content/' . $fileName));
                                                            $text = $pdf->getText();
                                                        @endphp
                                                        {!! nl2br(e($text)) !!}
                                                    @endif
                                                </div>
                                            @endif

                                    @else
                                      @php
                                      $ext = pathinfo($data->thumbnail, PATHINFO_EXTENSION);
                                      if($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'webp'){ @endphp
                                          <span class="swiper-slide">

                                        <a href="{{ $data->thumbnail }}"  data-caption="{{ $data->title }}" data-lightbox="gallery" >
                                            <img src="{{ $data->thumbnail }}" alt="" srcset="" width="100%">
                                        </a>
                                         </span>

                                     @php }else{ @endphp
                                        <video width="100%" height="100%" controls controlsList="nodownload">
                                            <source src="{{ $data->thumbnail }}" type="video/{{ $ext }}">
                                        </video>
                                     @php } @endphp
                                  @php
                                     $otherFiles=explode(',',$data->other_thumbnails);
                                    foreach(array_slice($otherFiles, 1) as $otherFile){
                                  @endphp
                                      <span class="swiper-slide">

                                  <a href="{{ asset('thumbnail/' . $otherFile) }}"  data-caption="{{ $data->title }}" data-lightbox="gallery">
                                                            <img src="{{ asset('thumbnail/' . $otherFile) }}" alt="" srcset="" width="100%" >
                                                        </a>    </span>

                                  @php } @endphp
                                    @endif
                                @endif
                            </span>

  <!-- Swiper Buttons -->
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="product-title-price" style="color: black">{{ $data->title ?? 'Not Available' }}</div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div style="color: black" class="product-title-price">Current Price: <span>${{ $data->price }}</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                
                                <div class="left-section">
                                    <div class="rating mb-2">
                                        @if(!is_null($average_product_rating))
                                            @for($i = 1; $i <= $average_product_rating; $i++)
                                                <span class="fa fa-star fa-2x checked"></span>
                                            @endfor
                                            @for($i = $average_product_rating+1; $i <= 5; $i++)
                                                <span class="fa fa-star fa-2x"></span>
                                            @endfor
                                        @endif
                                    </div>

                                <div class="likes">
                                    <a href="{{ URL('buyablecontentlike/'.$data->id) }}" class="like_btn mr-2" title="Like" style="font-size: 20px; color: unset;">
                                        @if($islike > 0)
                                            <i class="fa fa-thumbs-up text-white"></i>
                                        @else
                                            <i class="fa fa-thumbs-o-up text-white"></i>
                                        @endif
                                    </a><strong>({{ $like_count }})</strong>

                                    <a href="{{ URL('buyablecontentdislike/'.$data->id) }}" class="dislike_btn ml-3" title="Dislike" style="font-size: 20px; color: unset;">
                                        @if($isdislike > 0)
                                            <i class="fa fa-thumbs-down text-white"></i>
                                        @else
                                            <i class="fa fa-thumbs-o-down text-white"></i>
                                        @endif
                                    </a><strong>({{ $dislike_count }})</strong>
                                </div>
                             </div>

                                <div class="right-section d-flex align-items-center">
                                @if(Auth::check() && Auth::id() != $data->user->id )
                                                            @if($isFollowing)
                                                                <a style="text-decoration: unset;" href="{{ route('unfollow',[$data->user_id]) }}" class="subscrib_bt">Subscribed</a>
                                                            @else
                                                                <a style="text-decoration: unset;" href="{{ route('follow',[$data->user_id]) }}" class="subscrib_bt">Subscribe</a>
                                                            @endif
                                                            @if($paid_status!=1)
                                                            <button name="rating" class="buy_bt" @if(Auth::id()) id="content_buy" @else id="buy_bt_notlogin" @endif>Buy Now</button>
                                                            @endif
                                                        @endif
                                </div>

                                    </div>
                                </div>
                                        </div>

                                    <div class="col-md-6 text-col d-flex flex-column justify-content-top">
                                        <div class="text-block mb-4" id="product-tags">
                                            <h2 class="subheading">Tags:</h2>
                                            <p class="subtext">{{ $tags }}</p>
                                        </div>
                                        <div class="text-block" id="product-description">
                                            <h4 class="subheading">Description</h4>
                                            <p class="subtext">{{ $data->description }} </p>
                                        </div>
                                    </div>
                                

                                    </div>
                                </div>
                                @if(count($same_creator_content) || count($related_content))

                                <ul class="nav nav-tabs mt-4" id="imageTab" role="tablist">
                                @if(count($same_creator_content))
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab">More from this Creator</a>
                                </li>
                                @endif
                                @if(count($related_content))

                                <li class="nav-item">
                                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab">Related Content</a>
                                </li>
                                @endif

                                </ul>

                                <div class="tab-content border p-3" id="imageTabContent" style="max-height: 300px;">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                <div class="custom-gallery">
                                    @foreach($same_creator_content as $creator_content)
                                    <div class="gallery-item">
                                        <a href="{{ route('buyablecontent', $creator_content->id) }}" data-caption="{{ $creator_content->title }}" >
                                        <img src="{{ $creator_content->thumbnail }}" alt="{{ $creator_content->title }}" width="150px" height="150px">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                </div>

                                <div class="tab-pane fade" id="tab2" role="tabpanel">
                                <div class="custom-gallery-related-content">
                                    @foreach($related_content as $related_content)
                                    <div class="gallery-related-item">
                                        <a href="{{ route('buyablecontent', $related_content->id) }}" data-caption="{{ $related_content->title }}" >
                                        <img src="{{ $related_content->thumbnail }}" alt="{{ $related_content->title }}" width="150px" height="150px">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                    </div>
                                </div>
                                @endif
                                </div>
                        <div class="product_button">
                            <style> .checked { color: orange; } </style>
                            <input type="hidden" class="content_id" value="{{ $data->id }}">

                        </div>
                        <div class="details p-2" style="margin : 10px 0 30px;">
                            <div class="all_comment mt-5" id="comments_box">
                                <h1>Reviews </h1>

                                @if (isset($reviews) && count($reviews) > 0 )
                                    @foreach ($reviews as $cd)
                                        <div class="community_box user-comment-shaddow mb-3 mt-0" >
                                            <div class="card mb-2">
                                                <div class="card-body p-2 p-sm-3">
                                                    <div class="media forum-item">
                                                        @if(!is_null($cd->user))
                                                            @if($cd->user->creator == 1)
                                                                @php $dashboard_link = route('creatorvisitordashboard',[$cd->user->id]) @endphp
                                                            @else
                                                                @php $dashboard_link = route('profiledashboard',[$cd->user->id]) @endphp
                                                            @endif
                                                        @else
                                                            @php $dashboard_link = 'javascript:;' @endphp
                                                        @endif
                                                        <a href="{{ $dashboard_link }}" class="community_img mr-3">
                                                            <img src="{{ $cd->user->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle">
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="abc">
                                                                <h6 >
                                                                    <a href="{{ $dashboard_link }}" class="text-body" style="color : white !important;">
                                                                        {{ $cd->user->username }} : {{ date('d-m-Y', strtotime($cd->created_at)) }}
                                                                    </a>
                                                                    @if(!is_null($cd->user))
                                                                        @if(Auth::check() && Auth::id() == $cd->user->id)
                                                                            <a href="{{ route('remove.webstore.comment',[$cd->id]) }}" style="color:red;float:right; margin-left : 20px;">
                                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                            <p class="text-secondary" style="color : white !important;">
                                                                {{ $cd->comment }}
                                                            </p>

                                                        <span class="ar-like" id="like{{ $cd->id }}">
                                                            <a href="{{ route('buyablecontentlike', [$data->id, $cd->id]) }}#like{{ $cd->id }}">
                                                                @if ($cd['comment_like_count'] > 0)
                                                                    <i class="fa fa-thumbs-up text-white" aria-hidden="true">({{ $cd['comment_like_count'] }})</i>
                                                                @else
                                                                    <i class="fa fa-thumbs-o-up text-white" aria-hidden="true">({{ $cd['comment_like_count'] }})</i>
                                                                @endif
                                                            </a>
                                                        </span>

                                                        <span class="font-weight-bold text-black"> / </span>
                                                        <span class="ar-dislike" id="disklike{{ $cd->id }}">
                                                            <a href="{{ route('buyablecontentdislike', [$data->id, $cd->id]) }}#dislike{{ $cd->id }}">
                                                                @if ($cd['comment_dislike_count'] > 0)
                                                                    <i class="fa fa-thumbs-down text-white"
                                                                        aria-hidden="true">({{ $cd['comment_dislike_count'] }})</i>
                                                                @else
                                                                    <i class='fa fa-thumbs-o-down text-white'
                                                                        aria-hidden="true">({{ $cd['comment_dislike_count'] }})</i>
                                                                @endif
                                                            </a>
                                                        </span>
                                                          @if($data->user_id == Auth()->id())
                                                        | <span class="reply-to-btn" data-cid="{{ $cd->id }}" style="cursor: pointer;">Reply</span>
                                                          @endif
<!-- Rating System Start -->
<div class="rate">
                                                    <style> .checked { color: orange; } </style>
                                                    <input type="hidden" class="content_id" value="{{$data->id}}">
                                                    <input type="hidden" class="comment_id" value="{{$cd->id}}">

                                                    <span class="rating-star">
                                                        @if($cd['comment_average_rating'])
                                                            @for($i = 1; $i <=  $cd['comment_average_rating']; $i++)
                                                                <span class="fa fa-star fa-2x checked rating-star-icon"  data-comment-rating-id="{{$i}}" id="rating-id{{$cd->id}}" data-comment-id="{{$cd->id}}"></span>
                                                            @endfor
                                                            @for($i = $cd['comment_average_rating']+1; $i <= 5; $i++)
                                                                <span class="fa fa-star fa-2x rating-star-icon"  data-comment-rating-id="{{$i}}" id="rating-id{{$cd->id}}" data-comment-id="{{$cd->id}}"></span>
                                                            @endfor
                                                        @else
                                                            @for($i = 1; $i < 6; $i++)
                                                                <span class="fa fa-star fa-2x rating-star-icon"  data-comment-rating-id="{{$i}}" id="rating-id{{$cd->id}}"  data-comment-id="{{$cd->id}}"></span>
                                                            @endfor
                                                        @endif
                                                    </div>
<!-- Rating System End -->                                
                                                        <!-- Like Script end -->

                                                        <div id="reply-to-area{{ $cd->id }}" class="reply-to-area form-setting" style="display:none;">
                                                            <div class="reply-to-close-icon float-right">
                                                                <i style="font-size: 20px" class="fa fa-times-circle mb-2" aria-hidden="true"></i>
                                                            </div>
                                                            <form class="comment-form" action="{{ route('paid.content.comment', [$cd->id]) }}#collapse{{ $cd->id }}" class="card mb-3"
                                                                method="POST" redirect="{{ url()->current() }}">
                                                                @csrf
                                                                <input type="text" name="comment" class="form-control" id="" aria-describedby=""
                                                                    placeholder="">
                                                                <input type="hidden" name="contentid" value="{{ $cd->content_id }}">
                                                                <input type="hidden" value="{{ $cd->id }}" name="comment_id">
                                                                <input type="submit" value="Submit Comment" class="btn btn-primary"
                                                                    style="float: right;margin-top: 10px;border-radius: 0px;">
                                                            </form>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <!-- Reply Section -->
                                                        @if (isset($cd['reply_data']) && count($cd['reply_data']) > 0)

                                                            <div class="all_comment">
                                                                <div class="panel-group">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" href="#collapsee{{ $cd->id }}" >Replies
                                                                                    (@php echo count($cd['reply_data']); @endphp)</a>
                                                                            </h4>
                                                                        </div>

                                                                        <div id="collapsee{{ $cd->id }}" class="panel-collapse collapse">

                                                                            <!-- Comment Replies loop start -->
                                                                            @foreach ($cd['reply_data'] as $reply_data)

                                                                                <div class="community_box user-comment-shaddow"
                                                                                    id="@if (!is_null($reply_data->user)) {{ 'comment' . $reply_data->user->username }} @endif">
                                                                                    <div class="card mb-2">
                                                                                        <div class="card-body p-2 p-sm-3">
                                                                                            <div class="media forum-item">

                                                                                                <!-- Comment Reply username --->

                                                                                                <a href="{{ URL('dashboard/' . $reply_data->userid) }}"
                                                                                                    class="community_img mr-3">
                                                                                                    <img src="{{ $reply_data->user->profile_pic }}" alt="thumb"
                                                                                                        class="img-fluid  rounded-circle">
                                                                                                </a>


                                                                                                <div class="media-body">

                                                                                                    <div class="abc">
                                                                                                        <h6>
                                                                                                            @if (!is_null($reply_data->user))
                                                                                                                @if ($reply_data->user->creator == 1)
                                                                                                                    @php $dashboard_link = route('creatorvisitordashboard',[$reply_data->user->id]) @endphp
                                                                                                                @else
                                                                                                                    @php $dashboard_link = route('profiledashboard',[$reply_data->user->id]) @endphp
                                                                                                                @endif
                                                                                                            @else
                                                                                                                @php $dashboard_link = 'javascript:;' @endphp
                                                                                                            @endif
                                                                                                            <a href="{{ $dashboard_link }}" class="text-body">
                                                                                                                {{ $reply_data->user->username }} :
                                                                                                                {{ date('d-m-Y', strtotime($reply_data->created_at)) }}
                                                                                                            </a>

                                                                                                        </h6>


                                                                                                    </div>

                                                                                                    <p class="text-secondary">
                                                                                                        {{ $reply_data->comment }}
                                                                                                    </p>

                                                                                                </div>


                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                            <!-- Comment Replies loop end -->

                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                            </div>

                                                            </div>
                                                        @endif
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        @if (isset($comment))
                                                            <nav aria-label="Page navigation example" class="clearfix">
                                                                {{ $comment->links() }}
                                                            </nav>
                                                        @endif
                                                        </div>
                                                        @if (Auth::check()) 
                                                            <span class="add_comment">Add a Review</span>
                                                            <form class="" action="{{ route('paid.content.comment', [$data->id]) }}#comments_box"
                                                                class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                                                @csrf
                                                                <input type="hidden" name="type" value="reviews">
                                                                <textarea type="text" name="comment" class="form-control" style="border:1px solid black;" cols="2"></textarea>
                                                                <div id="review-section-submit">
                                                                <input type="submit" value="Submit" class="btn btn-primary"
                                                                    style="float: right;margin-bottom: 20px;border-radius: 0px;">
                                                                </div>
                                                            </form>
                                                        @endif
                                                        </div>
                                                        </div>                        

                                                    <!-- Reviews Section End -->    

                                                        <!-- comments section -->

            <div class="details p-2" style="margin : 10px 0 30px;">
                            <div class="all_comment mt-5" id="comments_box">
                            <h1>Comments </h1>

                                @if (isset($comment) && count($comment) > 0 )
                                    @foreach ($comment as $cd)
                                        <div class="community_box user-comment-shaddow mb-3 mt-0" >
                                            <div class="card mb-2">
                                                <div class="card-body p-2 p-sm-3">
                                                    <div class="media forum-item">
                                                        @if(!is_null($cd->user))
                                                            @if($cd->user->creator == 1)
                                                                @php $dashboard_link = route('creatorvisitordashboard',[$cd->user->id]) @endphp
                                                            @else
                                                                @php $dashboard_link = route('profiledashboard',[$cd->user->id]) @endphp
                                                            @endif
                                                        @else
                                                            @php $dashboard_link = 'javascript:;' @endphp
                                                        @endif
                                                        <a href="{{ $dashboard_link }}" class="community_img mr-3">
                                                            <img src="{{ $cd->user->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle">
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="abc">
                                                                <h6 >
                                                                    <a href="{{ $dashboard_link }}" class="text-body" style="color : white !important;">
                                                                        {{ $cd->user->username }} : {{ date('d-m-Y', strtotime($cd->created_at)) }}
                                                                    </a>
                                                                    @if(!is_null($cd->user))
                                                                        @if(Auth::check() && Auth::id() == $cd->user->id)
                                                                            <a href="{{ route('remove.webstore.comment',[$cd->id]) }}" style="color:red;float:right; margin-left : 20px;">
                                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                            <p class="text-secondary" style="color : white !important;">
                                                                {{ $cd->comment }}
                                                            </p>

                                                        <span class="ar-like" id="like{{ $cd->id }}">
                                                            <a href="{{ route('buyablecontentlike', [$data->id, $cd->id]) }}#like{{ $cd->id }}">
                                                                @if ($cd['comment_like_count'] > 0)
                                                                    <i class="fa fa-thumbs-up text-white" aria-hidden="true">({{ $cd['comment_like_count'] }})</i>
                                                                @else
                                                                    <i class="fa fa-thumbs-o-up text-white" aria-hidden="true">({{ $cd['comment_like_count'] }})</i>
                                                                @endif
                                                            </a>
                                                        </span>

                                                        <span class="font-weight-bold text-black"> / </span>
                                                        <span class="ar-dislike" id="disklike{{ $cd->id }}">
                                                            <a href="{{ route('buyablecontentdislike', [$data->id, $cd->id]) }}#dislike{{ $cd->id }}">
                                                                @if ($cd['comment_dislike_count'] > 0)
                                                                    <i class="fa fa-thumbs-down text-white"
                                                                        aria-hidden="true">({{ $cd['comment_dislike_count'] }})</i>
                                                                @else
                                                                    <i class='fa fa-thumbs-o-down text-white'
                                                                        aria-hidden="true">({{ $cd['comment_dislike_count'] }})</i>
                                                                @endif
                                                            </a>
                                                        </span>
                                                        | <span class="reviews-reply-to-btn" data-cid="{{ $cd->id }}" style="cursor: pointer;">Reply </span>

                                                        <!-- Like Script end -->

                                                        <div id="reviews-reply-to-area{{ $cd->id }}" class="reviews-reply-to-area form-setting" style="display:none;">
                                                            <div class="reply-to-close-icon float-right">
                                                                <i style="font-size: 20px" class="fa fa-times-circle mb-2" aria-hidden="true"></i>
                                                            </div>
                                                            <form class="comment-form" action="{{ route('paid.content.comment', [$cd->id]) }}#collapse{{ $cd->id }}" class="card mb-3"
                                                                method="POST" redirect="{{ url()->current() }}">
                                                                @csrf
                                                                <input type="text" name="comment" class="form-control" id="" aria-describedby=""
                                                                    placeholder="">
                                                                <input type="hidden" name="contentid" value="{{ $cd->content_id }}">
                                                                <input type="hidden" value="{{ $cd->id }}" name="comment_id">
                                                                <input type="submit" value="Submit Comment" class="btn btn-primary"
                                                                    style="float: right;margin-top: 10px;border-radius: 0px;">
                                                            </form>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <!-- Reply Section -->
                                                        @if (isset($cd['reply_data']) && count($cd['reply_data']) > 0)

                                                            <div class="all_comment">
                                                                <div class="panel-group">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" href="#collapse{{ $cd->id }}" >Replies(@php echo count($cd['reply_data']); @endphp)</a>
                                                                            </h4>
                                                                        </div>

                                                                        <div id="collapse{{ $cd->id }}" class="panel-collapse collapse">

                                                                            <!-- Comment Replies loop start -->
                                                                            @foreach ($cd['reply_data'] as $reply_data)

                                                                                <div class="community_box user-comment-shaddow"
                                                                                    id="@if (!is_null($reply_data->user)) {{ 'comment' . $reply_data->user->username }} @endif">
                                                                                    <div class="card mb-2">
                                                                                        <div class="card-body p-2 p-sm-3">
                                                                                            <div class="media forum-item">

                                                                                                <!-- Comment Reply username --->

                                                                                                <a href="{{ URL('dashboard/' . $reply_data->userid) }}"
                                                                                                    class="community_img mr-3">
                                                                                                    <img src="{{ $reply_data->user->profile_pic }}" alt="thumb"
                                                                                                        class="img-fluid  rounded-circle">
                                                                                                </a>


                                                                                                <div class="media-body">

                                                                                                    <div class="abc">
                                                                                                        <h6>
                                                                                                            @if (!is_null($reply_data->user))
                                                                                                                @if ($reply_data->user->creator == 1)
                                                                                                                    @php $dashboard_link = route('creatorvisitordashboard',[$reply_data->user->id]) @endphp
                                                                                                                @else
                                                                                                                    @php $dashboard_link = route('profiledashboard',[$reply_data->user->id]) @endphp
                                                                                                                @endif
                                                                                                            @else
                                                                                                                @php $dashboard_link = 'javascript:;' @endphp
                                                                                                            @endif
                                                                                                            <a href="{{ $dashboard_link }}" class="text-body">
                                                                                                                {{ $reply_data->user->username }} :
                                                                                                                {{ date('d-m-Y', strtotime($reply_data->created_at)) }}
                                                                                                            </a>

                                                                                                        </h6>


                                                                                                    </div>

                                                                                                    <p class="text-secondary">
                                                                                                        {{ $reply_data->comment }}
                                                                                                    </p>

                                                                                                </div>


                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                            <!-- Comment Replies loop end -->

                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                           
                                                        @endif
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        @if (isset($comment))
                                                            <nav aria-label="Page navigation example" class="clearfix">
                                                                {{ $comment->links() }}
                                                            </nav>
                                                        @endif
                                                        </div>
                                                        @if (Auth::check())
                                                            <span class="add_comment">Add a Comment</span>
                                                            <form class="" action="{{ route('paid.content.comment', [$data->id]) }}#comments_box"
                                                                class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                                                @csrf
                                                                <textarea type="text" name="comment" class="form-control" style="border:1px solid black;" cols="2"></textarea>
                                                                <div id="review-section-submit">
                                                                <input type="submit" value="Submit" class="btn btn-primary"
                                                                    style="float: right;margin-top: 10px;border-radius: 0px;">
                                                                </div>
                                                            </form>
                                                        @endif
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div> 
                                                        </div>
                                                        </div>

<!-- Comments Section end -->

            <form class="d-none cart">
                <input name="paidcontent_id" value="{{ $data->id }}">
                <input name="price" value="{{ $data->price }}">
            </form>
        </div>
    </div>
    <div style="margin-top:20%;"> </div>
    @include('front.layouts.footer')
    @include('front.creatorvisitor.layout.modal')
    <!-- inject:js -->
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
    <!-- End custom js for this page-->
    {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Cart</button> --}}

    @include('front.layouts.cartscript')
    <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Lightbox2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<script>
  const swiper = new Swiper(".mySwiper", {
    
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    loop: true,
  });
</script>

    <script>
        $(document).ready(function() {
            $(".reply-to-btn").click(function(){
                let cid = $(this).data('cid');
                $('#reply-to-area'+cid).show();
            });

            $(".reply-to-close-icon").click(function() {
                $('.reply-to-area').hide();
            });
        });

          $(document).ready(function() {
            $(".reviews-reply-to-btn").click(function(){
                let cid = $(this).data('cid');
                $('#reviews-reply-to-area'+cid).show();
            });

            $(".reply-to-close-icon").click(function() {
                $('.reviews-reply-to-area').hide();
            });
        });
    </script>
    <script>
        $(document).on('click','.rating-star-icon',function(){
               console.log("we are here");
            var rating = $(this).data('comment-rating-id');
            var content_id = $('.content_id').val();
            var comment_id = $(this).data('comment-id');;
            $.ajax({
                    url: '{{ route('ratings') }}',
                    type: 'POST',
                    data : { content_id : content_id,comment_id : comment_id, rating : rating, _token : "{{csrf_token()}}" },
                    success: function(data) {
                        if (data.code === 200) {
                            var rating_design = '';
                            for(var i = 1; i <= rating; i++){
                                rating_design += '<span class="fa fa-star fa-2x checked" id="rating-id'+comment_id+'" data-index="'+i+'"></span>';
                            }

                            for (let index = rating+1; index <= 5; index++) {
                                rating_design += '<span class="fa fa-star fa-2x" id="rating-id'+comment_id+'" data-index="'+index+'"></span>';
                            }
                            $('.rating-star').html(rating_design);
                            toastr.success(data.message);
                            window.location.reload();
                        } else {
                            toastr.error("Something went wrong.");
                        }
                    },
                    error: function(xhr, status, error) {
                        // handle error response from the server
                    }
                });
        })
        $(document).ready(function() {
            $(document).on('click','#removeItem',function(){
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ route('removeItem') }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(data) {
                        toastr.options = {
                            preventDuplicates: true,
                            timeOut: 4000,
                            progressBar: true,
                        }
                        if (data.code === 200) {
                            toastr.success(data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 4000);
                        } else {
                            toastr.error("Something went wrong.");
                        }

                    },
                    error: function(xhr, status, error) {
                        // handle error response from the server
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#buy_bt_notlogin').click(function() {
                toastr.options = {
                    preventDuplicates: true,
                    timeOut: 4000,
                    progressBar: true,
                }
                toastr.error('You are not login. Please first login');
            });
            $('#content_buy').click(function() {
                var formData = $('.cart').serialize();
                formData += "&_token=" + "{{ csrf_token() }}";
                $.ajax({
                    url: '{{ route('add_to_cart') }}',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        toastr.options = {
                            preventDuplicates: true,
                            timeOut: 4000,
                            progressBar: true,
                        }
                        if (data.code === 200) {
                            toastr.success(data.message);
                        } else {
                            toastr.error("Something went wrong.");
                        }
                    },
                    error: function(xhr, status, error) {
                        // handle error response from the server
                    }
                });
            });
            $(document).bind("contextmenu",function(e){
                return false;
            });
        });

    </script>
</body>

</html>
