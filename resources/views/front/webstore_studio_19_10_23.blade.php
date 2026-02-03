<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Webstore Upload</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}"/>
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}"/>
    <!-- endinject -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />
    <link rel="stylesheet" href="{{ url('public/assets/js/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css') }}" type="text/css" />
    <style>
        .file-upload-hide {
            position: relative;
            text-align: right;
            -moz-opacity: 0;
            filter: alpha(opacity:0);
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

        #console, #consolethumbnail {
            color: #EA4335;
            font-weight: bold;
        }

        .file-upload-content {
            display: inline-block;
            height: 67%;
            border: 1px solid #000;
            position: relative;
        }

        .progressthumbnail {
            display: flex;
            height: 1rem;
            font-size: .75rem;
            background-color: #e9ecef;
            border-radius: 0.25rem;
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
            <form action="{{ route('saveStoreUpload') }}" id="uploadForm" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                @endif

                <div class="content-wrapper">
                    <div class="product_details_background">
                        <div class="top_file p-0 m-0">
                            <a class="file-upload-btn" href="{{ route('webStoremonetizeupload') }}">Upload</a>
                            <a class="file-upload-btn" href="{{ route('webstore.manage.content') }}">Manage</a>
                        </div>
                        <div class="file-upload">
                            {{-- <div id="uploader"></div> --}}

                            {{-- <button class="file-upload-btn1" type="button">Upload</button>
                            <input class="file-upload-input" name="content" type="file"
                                   onchange="readURL(this,'image');" accept="video/*|image/*">
                            <button class="file-upload-btn" type="button"
                                    onclick="$('.file-upload-input').trigger( 'click' )"></button>
                            <div class="file-upload-content" style="display: block;"
                                 onclick="$('.file-upload-input').trigger( 'click' )">
                                <img class="file-upload-image" src="" alt="your image" onclick="select_image('image')"
                                     style="cursor: pointer; display:none;">
                                <video class="file-upload-video" width="100%" height="100%" controls style="cursor: pointer; display:none;">
                                    <source class="video-file" src="" type="video/mp4">
                                </video>
                                <div class="image-title-wrap"></div>
                            </div> --}}


                            <div class="file-upload-content">
                                <span id="content-label">
                                    <video width="100%" height="100%" controls id="video_file" style="display:none;"></video>
                                </span>
                            </div>

                            <input type="hidden" name="content_file_name" id="content_file_name">
                            <div id="filelist"></div>
                            <div id="container">
                                <button type="button" id="pickfiles" class="btn btn-primary">Browse File</button>&nbsp;
                                <button type="button" id="uploadfiles" class="btn btn-success">Upload</button>
                            </div>
                            <pre id="console"></pre>
                            <!-- Progress bar -->
                            <div class="progress" style="display: none;"></div>

                        </div>
                        <div class="upload_details_content">
                            <div class="row">
                                <div class="col-sm-6 p-0">
                                    <div class="price_details">
                                        <h1>
                                            <img alt="" src="{{ url('public/assets/images/set_price.webp') }}">
                                        </h1>
                                        <input class="price_detailsInput" name="price" type="text" value="">
                                    </div>
                                </div>

                                <div class="col-sm-6 p-0 thumbnail_details">

                                    <div class="add_thumbnail" style="height: 300px; margin-top: 50px !important;">
                                        {{-- <div class="upload-btn-wrapper" id="pickthumbnail" style="cursor: pointer;"
                                             onclick="select_image('thum')">
                                            <img class="thum-file-image" src="" alt="your image" style="display: none;">
                                            <span class="btn">Add thumbnail</span>
                                            <input type="file" name="thumbnail" style="font-size: 0%;width: 100%;height: 238px;cursor: pointer;" class="thum-upload-img-input"
                                                   accept="image/*" onchange="readURL(this,'thum');"/>
                                        </div> --}}

                                        <div class="upload-btn-wrapper" style="height: 68% !important;">
                                            <span class="btn" id="thumbnail-label" style="font-size: 52px !important;">Add thumbnail</span>
                                        </div>

                                        <input type="hidden" name="thumbnail_file_name" id="thumbnail_file_name">
                                        <div id="filelistthumbnail"></div>
                                        <div id="containerthumbnail">
                                            <button type="button" id="pickthumbnail" class="btn btn-primary">Browse File</button>&nbsp;
                                            <button type="button" id="uploadthumbnail" class="btn btn-success">Upload</button>
                                        </div>
                                        <pre id="consolethumbnail"></pre>
                                        <!-- Progress bar -->
                                        <div class="progressthumbnail" style="display: none;"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 p-0">
                                    <div class="cont_details pt-5 pr-5 pl-5">
                                        <input type="text" name="title" class="form-control" placeholder="Enter Name"
                                               value="">
                                        <textarea name="description" class="form-control textarea"
                                                  id="exampleFormControlTextarea5" rows="3"
                                                  placeholder="Description"></textarea>
                                        <div class="upload-content-tags mt-3">
                                            <label for="exampleInputEmail1">Add Tags</label>
                                            <select class="select2" class="form-control" name="tags[]"
                                                    multiple="multiple" style="width: 100%;">
                                                @if (isset($tags) && is_array($tags) && count($tags) > 0)
                                                    @foreach ($tags as $tagsK => $tagsV)
                                                        <option
                                                            value="{{ $tagsV['id'] }}">{{ $tagsV['title'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="upload-content-tags mt-3">
                                            <label for="">Select Content Type</label>
                                            <div class="form-group">
                                                <input type="radio" name="content_type" value="vore">
                                                <label class="pr-5">Vore</label>

                                                <input type="radio" name="content_type" value="non-vore">
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
                                    <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
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
    {{-- <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js')}}"></script> --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js')}}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js')}}"></script>
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.caret.min.js') }}"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="{{ url('public/assets/js/plupload/js/plupload.full.min.js') }}"></script>
    <script src="{{ url('public/assets/js/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js') }}"></script>
    <script>
       $('.select2').select2({});
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

        function readURL(input, action) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (action == 'image') {
                        if(input.files[0].type.includes('video/')) {
                            $('.video-file').attr('src', e.target.result);
                            // $('.video-file').attr('type', input.files[0].type);
                            $('.file-upload-video').show();
                            $('.file-upload-image').hide();
                            $('.file-upload-content').show();
                        } else {
                            $('.image-upload-wrap').hide();
                            $('.file-upload-image').attr('src', e.target.result);
                            $('.file-upload-image').show();
                            $('.file-upload-content').show();
                            $('.image-title').html(input.files[0].name);
                            $('.file-upload-video').hide();
                        }
                    } else {
                        // $('.image-upload-wrap').hide();
                        $('.thum-file-image').attr('src', e.target.result);
                        $('.thum-file-image').show();
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

        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
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
                url: '{{ route('saveStoreUpload') }}',
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
                error:function(resp){

                    var errors = resp.responseJSON;
                    console.log(errors);
                    if(errors){
                        errorsHtml = '<strong class="text-danger">';
                        var sep = "";
                        $.each(errors.errors, function(k, v) {
                            errorsHtml += sep+v;
                            sep = ", ";
                        });
                        errorsHtml += '</strong>';
                        $('#uploadStatus').html(errorsHtml);
                    }else{
                        $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    }
                    setTimeout(() => {
                        $('#progress-container').hide();
                        // window.location='{{ route('webStoremonetizeupload') }}'
                    }, 2000);

                },
                success: function(resp){
                    if(resp.result == 'success'){
                        $('#uploadForm')[0].reset();
                        $('#uploadStatus').html('<p style="color:#28A74B;">'+resp.msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('webStoremonetizeupload') }}'
                        }, 2000);


                    }else if(resp.result == 'error'){
                        $('#uploadStatus').html('<p style="color:#EA4335;">'+resp.error_msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            // window.location='{{ route('webStoremonetizeupload') }}'
                        }, 2000);

                    }
                }
            });
        });

        // $(function() {
        //     $("#uploader").plupload({
        //         // General settings
        //         runtimes : 'html5,flash,silverlight,html4',
        //         url : "{{ route("upload-thumbnail-file") }}",

        //         multi_selection: false,
        //         chunk_size: '2mb',

        //         // add X-CSRF-TOKEN in headers attribute to fix this issue
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },

        //         // Maximum file size
        //         max_file_size : '1gb',

        //         // Resize images on clientside if we can
        //         resize : {
        //             width : 200,
        //             height : 200,
        //             quality : 90,
        //             crop: true // crop to exact dimensions
        //         },

        //         // Specify what files to browse for
        //         filters : [
        //             {title : "Image files", extensions : "jpg,jpeg,gif,png,svg"}
        //         ],

        //         // Rename files by clicking on their titles
        //         rename: true,

        //         // Sort files
        //         sortable: true,

        //         // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        //         dragdrop: true,

        //         // Views to activate
        //         views: {
        //             list: true,
        //             thumbs: true, // Show thumbs
        //             active: 'thumbs'
        //         },

        //         // Flash settings
        //         flash_swf_url : '{{ url("assets/js/plupload/js/Moxie.swf") }}',

        //         // Silverlight settings
        //         silverlight_xap_url : '{{ url("assets/js/plupload/js/Moxie.xap") }}'
        //     });
        // });

        // Chunk Content File Upload
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',

            browse_button : 'pickfiles', // you can pass in id...
            container: document.getElementById('container'), // ... or DOM Element itself

            url : "{{ route("upload-content-file") }}",

            multi_selection: false,
            chunk_size: '2mb',

            // add X-CSRF-TOKEN in headers attribute to fix this issue
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            filters : {
                max_file_size : '1gb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,jpeg,gif,png,svg,jfif"},
                    {title : "Video files", extensions : "mp4,mkv,flv,avi"},
                    {title : "Audio files", extensions : "mp3,wav"},
                    {title : "Document files", extensions : "pdf,txt,docx,doc,rtf,odt"}
                ]
            },

            // Flash settings
            flash_swf_url : '{{ url("assets/js/plupload/js/Moxie.swf") }}',

            // Silverlight settings
            silverlight_xap_url : '{{ url("assets/js/plupload/js/Moxie.xap") }}',

            init: {
                PostInit: function() {
                    document.getElementById('filelist').innerHTML = '';

                    document.getElementById('uploadfiles').onclick = function() {
                        uploader.start();
                        return false;
                    };
                },

                FilesAdded: function(up, files) {
                    document.getElementById('console').innerHTML = '';

                    // Remove files except current file
                    if(up.files.length > 1) {
                        up.files.splice(0, (parseInt(up.files.length) - 1));
                    }

                    plupload.each(files, function(file) {
                        document.getElementById('filelist').innerHTML = '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                    });
                },

                UploadProgress: function(up, file) {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    $('.progress').show();
                    document.querySelector(".progress").innerHTML = '<div class="progress-bar" style="width: '+file.percent+'%;">'+file.percent+'%</div>';
                },

                FileUploaded: function(up, file, result) {
                    var responseData = JSON.parse(result.response);
                    $('#content_file_name').val(responseData.filename);
                    document.getElementById('console').innerHTML = '';

                    showFilePreview(file, responseData.filename);
                },

                Error: function(up, err) {
                    document.getElementById('console').innerHTML = "\nError #" + err.code + ": " + err.message;
                }
            }
        });

        uploader.init();

        // Chunk Thumbnail File Upload
        var thumbnailUploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',

            browse_button : 'pickthumbnail', // you can pass in id...
            container: document.getElementById('containerthumbnail'), // ... or DOM Element itself

            url : "{{ route("upload-thumbnail-file") }}",

            multi_selection: false,
            chunk_size: '2mb',

            // add X-CSRF-TOKEN in headers attribute to fix this issue
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            filters : {
                max_file_size : '1gb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,jpeg,gif,png,svg"}
                ]
            },

            // Flash settings
            flash_swf_url : '{{ url("assets/js/plupload/js/Moxie.swf") }}',

            // Silverlight settings
            silverlight_xap_url : '{{ url("assets/js/plupload/js/Moxie.xap") }}',

            init: {
                PostInit: function() {
                    document.getElementById('filelistthumbnail').innerHTML = '';

                    document.getElementById('uploadthumbnail').onclick = function() {
                        thumbnailUploader.start();
                        return false;
                    };
                },

                FilesAdded: function(up, files) {
                    document.getElementById('consolethumbnail').innerHTML = '';

                    // Remove files except current file
                    if(up.files.length > 1) {
                        up.files.splice(0, (parseInt(up.files.length) - 1));
                    }

                    plupload.each(files, function(file) {
                        document.getElementById('filelistthumbnail').innerHTML = '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                    });
                },

                UploadProgress: function(up, file) {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    $('.progressthumbnail').show();
                    document.querySelector(".progressthumbnail").innerHTML = '<div class="progress-bar" style="width: '+file.percent+'%;">'+file.percent+'%</div>';
                },

                FileUploaded: function(up, file, result) {
                    var responseData = JSON.parse(result.response);
                    $('#thumbnail_file_name').val(responseData.filename);
                    document.getElementById('consolethumbnail').innerHTML = '';

                    showImagePreview(file);
                },

                Error: function(up, err) {
                    document.getElementById('consolethumbnail').innerHTML = "\nError #" + err.code + ": " + err.message;
                }
            }
        });

        thumbnailUploader.init();

        // Image Preview load
        function showImagePreview( file ) {

            $('#thumbnail-label').remove();
            var image = $( new Image() ).appendTo( $(".upload-btn-wrapper") );

            // Create an instance of the mOxie Image object. This
            // utility object provides several means of reading in
            // and loading image data from various sources.
            // --
            // Wiki: https://github.com/moxiecode/moxie/wiki/Image
            var preloader = new moxie.image.Image();

            // Define the onload BEFORE you execute the load()
            // command as load() does not execute async.
            preloader.onload = function() {

                // This will scale the image (in memory) before it
                // tries to render it. This just reduces the amount
                // of Base64 data that needs to be rendered.
                preloader.downsize( 300, 300 );

                // Now that the image is preloaded, grab the Base64
                // encoded data URL. This will show the image
                // without making an Network request using the
                // client-side file binary.
                image.prop( "src", preloader.getAsDataURL() );

                // NOTE: These previews "work" in the FLASH runtime.
                // But, they look seriously junky-to-the-monkey.
                // Looks like they are only using like 256 colors.

            };

            // Calling the .getSource() on the file will return an
            // instance of mOxie.File, which is a unified file
            // wrapper that can be used across the various runtimes.
            // --
            // Wiki: https://github.com/moxiecode/plupload/wiki/File
            preloader.load( file.getSource() );

        }

        function showFilePreview( file, filename )
        {
            $('#video_file').hide();

            if (file.type.includes("image/")) {
                var image = $( new Image() ).appendTo( $(".file-upload-content") );

                var preloader = new moxie.image.Image();

                preloader.onload = function() {

                    preloader.downsize( 300, 300 );

                    image.prop( "src", preloader.getAsDataURL() );

                };

                preloader.load( file.getSource() );

            } else {
                let url = "{{ url('/content') }}/"+filename;
                $('#video_file').show();
                let video = document.querySelector("#video_file");
                video.setAttribute("src", url)
                video.play();
            }
        }


    </script>


    <!-- End custom js for this page-->
    </body>

</html>
