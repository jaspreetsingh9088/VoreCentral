@extends('front.creator.layout.app')
@section('title', 'DLC Upload')
@section('bodyclass','bg_pattern green_theme')
@section('stylelink')
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}" />
@endsection
@section('content')
    <style>
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
    <section class="dlc-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <form class="col-lg-8 mb-3" action="{{ route('uploaddlccontent') }}" id="uploadForm" method="POST" enctype="multipart/form-data" redirect="{{ url()->current() }}">
                    @csrf
                    <div style="margin: 100px 0px;">
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif
                        <div class="upload-content-wrapper">
                            <div class="upload-content-section">
                                <input type="text" class="form-control" placeholder="Title" name="title" required>
                            </div>
                            <div class="upload-content-item mb-5 mt-5">
                                <div class="outter-white">
                                    <div class="image-upload">
                                        <label for="file-input">
                                            Add Content, Video, Audio, JPG, GIF and etc
                                        </label>
                                    </div>
                                    <input id="file-input" type="file" name="content" accept="audio/*|video/*|image/*">
                                </div>
                            </div>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">Pick a type</label>
                                <select class="select2" class="form-control" name="type" id="type_id"
                                    data-placeholder="Pick a type" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option value="">Pick a type </option>
                                    <option value="Literature">Literature </option>
                                    <option value="Picture">Picture </option>
                                    <option value="Comic">Comic </option>
                                    <option value="Video">Video </option>
                                    <option value="Audio">Audio </option>
                                    <option value="Game">Game </option>
                                    <option value="Interactive">Interactive </option>
                                </select>
                            </div>

                            <div class="accept-terms privacy_box my-5">
                                <div class="src_checks">
                                    <div class="form-group">
                                        <input type="checkbox" id="default130" checked="">
                                        <label for="default130">Accept terms of condition?</label>
                                    </div>
                                </div>
                            </div>
                            <!-- recapta box-->
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{env("G_RECAPTCHA_KEY")}}"></div>
                                <br />
                            </div>
                            <!-- upload button -->
                            <div class="upload-button-wrap">
                                <button class="upload-add-tag" type="submit">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-1">
                </div>
            </div>
        </div>
    </section>

    <div id="progress-container" style="display:none;">
        <h3>Uploading...</h3>
        <div id="progress">
            <div id="progress-bar"></div>
        </div>
        <div id="uploadStatus" style="display:none;"><img src="{{asset('assets/images/loading.gif') }}"></div>
    </div>
    @php $loading_image = asset('assets/images/loading.gif'); @endphp

@endsection
@push('scriptwithlink')
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    <script>
        $('.select2').select2();
        $(document).ready(function() {
            $('.cover-upload').hide();
            $('.profile-upload').hide();

            $(".user-profile-picture a").click(function() {
                $('.profile-upload').show();
            });

            $(".add-banner-image").click(function() {
                $('.cover-upload').show();
            });

            $(".close-icon").click(function() {
                $(this).parent().parent().parent().parent().hide();
            });
            $(".follow-unfollow").click(function() {
                $(this).text(function(i, text) {
                    return text === "Follow" ? "Unfollow" : "Follow";
                })
            });

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
                url: '{{ route('uploaddlccontent') }}',
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
                        window.location='{{ route('creator.dlc.upload') }}'
                    }, 2000);

                },
                success: function(resp){
                    if(resp.result == 'success'){
                        $('#uploadForm')[0].reset();
                        $('#uploadStatus').html('<p style="color:#28A74B;">'+resp.msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('creator.dlc.upload') }}'
                        }, 2000);


                    }else if(resp.result == 'error'){
                        $('#uploadStatus').html('<p style="color:#EA4335;">'+resp.error_msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('creator.dlc.upload') }}'
                        }, 2000);

                    }
                }
            });
        });
    </script>
@endpush
