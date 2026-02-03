<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}" />
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <!-- endinject -->
    <style>
        .file-upload-hide {
            position: relative;
            text-align: right;
            -moz-opacity: 0;
            filter: alpha(opacity: 0);
            opacity: 0;
            z-index: 2;
        }

        #progress-container {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%.-50%);
            -webkit-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
            width: 350px;
            min-height: 100px;
            z-index: 1;
            opacity: 0.9;
            margin: auto;
            background-color: #FFF;
            color: #333;
            padding: 12px;
            box-shadow: 0 0px 10px 1px rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
            font-size: 16px;
        }
        #progress-container h3{
            margin: 0 10px;
        }
        #progress {
            display: -ms-flexbox;
            display: flex;
            height: 20px;
            overflow: hidden;
            font-size: .75rem;
            background-color: #e9ecef;
            border-radius: .25rem;
            margin: 10px;
        }
        #progress-bar {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            overflow: hidden;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            background-color: #28a745;
            transition: width .6s ease;
            font-size: 16px;
            text-align: center;
        }

        #uploadStatus{
            padding: 10px 20px;
            margin-top: 10px;
            font-size:18px;
            text-align: center;
        }
    </style>
</head>
<livewire:cursor-style>
<body class="store_theme studio_theme">
    <div class="container">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header" class="studio_hd">
                <h1 class="">Webstore Studio</h1>
                @if (Session::has('successful_message'))
                    <div class="alert alert-success">
                        {{ Session::get('successful_message') }}
                    </div>
                @endif
            </header>
            <!-- partial -->
            <form class="sign_up_form card mb-3" id="uploadForm" action="{{ route('update.paidcontent',[$content->id]) }}" method="POST"
                enctype="multipart/form-data" style="width:100%;">
                @csrf
                <div class="content-wrapper">
                    <div class="product_details_background">
                        <div class="top_file">
                            <button class="file-upload-btn1" type="button">Upload</button>
                            <input class="file-upload-input" name="content" type="file" onchange="readURL(this,'image');">
                        </div>
                        <div class="file-upload">
                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )"></button>

                            @php
                                $ext = pathinfo($content->content, PATHINFO_EXTENSION);
                                $show_image = false;
                                $show_video = false;
                                if ($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'webp'){
                                    $show_image = true;
                                } elseif ($ext == 'mp4' || $ext == 'mkv' || $ext == 'flv' || $ext == 'avi') {
                                    $show_video = true;
                                }
                            @endphp
                            <div class="file-upload-content" style="@if($show_image || $show_video)display: block;@endif">
                                @if ($show_image)
                                    <img class="file-upload-image" src="{{ $content->content }}" alt="your image" onclick="select_image('image')" style="cursor: pointer;">
                                @endif
                                @if ($show_video)
                                    <video class="file-upload-video" width="100%" height="100%" controls style="cursor: pointer;" onclick="select_image('image')">
                                        <source class="video-file" src="{{ $content->content }}" type="video/{{ $ext }}">
                                    </video>
                                @endif
                                <div class="image-title-wrap"></div>
                            </div>
                        </div>
                        <div class="upload_details_content">
                            <div class="row">
                                <div class="col-sm-6 p-0">
                                    <div class="price_details">
                                        <h1>
                                            <img alt="" src="{{ url('public/assets/images/set_price.webp') }}">
                                        </h1>
                                        <input class="price_detailsInput" name="price" type="text" value="{{ $content->price."$" }}">
                                    </div>
                                </div>

                                <div class="col-sm-6 p-0 thumbnail_details">
                                    <div class="add_thumbnail">
                                        <div class="upload-btn-wrapper" style="cursor: pointer;" onclick="select_image('thum')" >
                                            <img class="thum-file-upload-image" src="{{ $content->thumbnail }}" alt="your image" >
                                            <input type="file" name="thumbnail" class="thum-upload-img-input" onchange="readURL(this,'thum');"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 p-0">
                                    <div class="cont_details pt-5 pr-5 pl-5">
                                        <input type="text" name="title" class="form-control" placeholder="Enter Name" value="{{ $content->title }}">
                                        <textarea name="description" class="form-control textarea" id="exampleFormControlTextarea5" rows="3" placeholder="Description">{{ $content->description }}</textarea>
                                        <div class="upload-content-tags mt-3">
                                           <label for="exampleInputEmail1">Add Tags</label>
                                           @php $explode_tag = explode(',',$content->tag_id); @endphp
                                            <select class="select2" class="form-control" name="tags[]" multiple="multiple" style="width: 100%;">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}" @if(in_array($tag->id,$explode_tag)) selected @endif>{{ $tag->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="upload-content-tags mt-3">
                                           <label for="">Select Content Type</label>
                                           <div class="form-group">
                                                <input type="radio"  name="content_type" value="vore" @if($content->content_type == 'vore') checked @endif>
                                                <label class="pr-5">Vore</label>

                                                <input type="radio" name="content_type" value="non-vore" @if($content->content_type == 'non-vore') checked @endif>
                                                <label for="">Non Vore</label>
                                           </div>
                                        </div>
                                     </div>
                                </div>
                                <div class="col-sm-6 p-0 upload_btn_details">
                                    <div class="file-upload-btn-area">
                                        <button class="file-upload-btn" type="submit">Upload</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>


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

    <div id="progress-container" style="display:none;">
        <h3>Uploading...</h3>
        <div id="progress">
            <div id="progress-bar"></div>
        </div>
        <div id="uploadStatus" style="display:none;"><img src="{{asset('assets/images/loading.gif') }}"></div>
    </div>
    @php $loading_image = asset('assets/images/loading.gif'); @endphp

    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- inject:js -->
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js')}}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js')}}"></script>
    <script src="{{ url('public/assets/js/jquery.caret.min.js') }}"></script>
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({});
        });
        $(".price_detailsInput").on('keyup',function(){
            var p = $(this).val().replace('$','');
            $(this).val(p+'$');
            $(this).caret(p.length);
        })
        function select_image(action) {
            if (action == 'image') {
                $('.file-upload-input').trigger('click');
            } else {
                $('.thum_image_url').trigger('click');
            }
        }
        function select_image(action){
            if(action == 'image'){
                $('.file-upload-input').trigger('click');
            }else{
                $('.thum_image_url').trigger('click');
            }
        }
        function readURL(input,action) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if(action == 'image'){
                        if(input.files[0].type.includes('video/')) {
                            $('.video-file').attr('src', e.target.result);
                            $('.video-file').attr('type', input.files[0].type);
                            $('.file-upload-video').show();
                            $('.file-upload-image').hide();
                            $('.file-upload-content').show();
                        } else {
                            $('.image-upload-wrap').hide();
                            $('.file-upload-image').attr('src', e.target.result);
                            $('.file-upload-content').show();
                            $('.image-title').html(input.files[0].name);
                            $('.file-upload-video').hide();
                        }
                    }else{
                        // $('.image-upload-wrap').hide();
                        $('.thum-file-upload-image').attr('src', e.target.result);
                        // $('.file-upload-content').show();
                    }
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });


        // File upload via Ajax
        $("#uploadForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = parseInt(((evt.loaded / evt.total) * 100));
                            $("#progress-bar").width(percentComplete + '%');
                            $("#progress-bar").html(percentComplete+'%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: '{{ route('update.paidcontent',[$content->id]) }}',
                data: new FormData(this),
                dataType:'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('#progress-container').show();
                    $("#progress-bar").width('0%');
                    $("#uploadStatus").html('<img src="{{$loading_image }}">').show();
                },
                error:function(data){

                    if(data.errors.length>0){
                        errorsHtml = '<strong class="text-danger">';
                        $.each(data.errors, function(k, v) {
                            errorsHtml += v + ', ';
                        });
                        errorsHtml += '</strong>';
                        $('#uploadStatus').html(errorsHtml);
                    }else{
                        $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    }

                    setTimeout(() => {
                        $('#progress-container').hide();
                        window.location='{{ route('paid.content.edit',[$content->id]) }}'
                    }, 2000);

                },
                success: function(resp){
                    if(resp.result == 'success'){
                        $('#uploadForm')[0].reset();
                        $('#uploadStatus').html('<p style="color:#28A74B;">'+resp.msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('webstore.manage.content') }}'
                        }, 2000);


                    }else if(resp.result == 'error'){
                        $('#uploadStatus').html('<p style="color:#EA4335;">'+resp.error_msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('paid.content.edit',[$content->id]) }}'
                        }, 2000);

                    }
                }
            });
        });
    </script>




    <!-- End custom js for this page-->
</body>

</html>
