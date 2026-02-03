@extends('front.homepage.layout.app')
@php
    $title = 'User Upload';
@endphp
@section('title', $title)
@section('style')
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}" />
    <style>
        label,.form-group label,.upload-content-tags p,.src_checks .form-group label{
            color : white;
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
@endsection
@section('content')

    <section class="dlc-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <form class="sign_up_form mb-3" action="{{ route('uploadcontent') }}" id="uploadForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-10" style="margin: 100px 0px;">
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif

                        <div class="upload-content-wrapper">
                            <div class="upload-content-section">
                                <input type="text" class="form-control" placeholder="Title" name="title" required>
                                <br>
                                <textarea class="form-control" placeholder="Description" name="description" required></textarea>
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

                            <div class="upload-content-section mb-5 mt-5">
                                <label for="exampleInputEmail1">Youtube or third party URL </label>
                                <input type="text" class="form-control" placeholder="Video Url" name="video_url">
                            </div>

                            <div class="upload-content-thumb">
                                <div class="image-upload">
                                    <label for="thumbnail">
                                        Add Thumnail
                                    </label>
                                </div>
                                <input type="file" id="thumbnail" name="thumbnail" accept="image/*">
                            </div><br>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">Add Tags</label>
                                <select class="select2" class="form-control" id="tags_select" name="tags[]" multiple="multiple"
                                    data-placeholder="Select..." data-dropdown-css-class="select2-purple"
                                    style="width: 100%;">
                                    <?php
                                    if(isset($TagData) && is_array($TagData) && count($TagData) > 0 ){
                                        foreach($TagData as $TagDataK => $TagDataV){
                                            ?>
                                            <option value="{{ $TagDataV['id'] }}">{{ $TagDataV['title'] }} </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">This item is part of this series / work / some thing</label>
                                <select class="select2" class="form-control" name="series[]" multiple="multiple"
                                    data-placeholder="Select..." data-dropdown-css-class="select2-purple"
                                    style="width: 100%;">
                                <?php
                                    if(isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0 ){
                                    foreach($Owncollaction as $OwncollactionK => $OwncollactionV){ ?>
                                        <option value="{{ $OwncollactionV['id'] }}">{{ $OwncollactionV['collection_name'] }}
                                        </option>
                                    <?php }} ?>
                                </select>
                            </div><br>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">Pick a type</label>
                                <select class="select2" class="form-control" name="type[]" id="type_id"
                                    data-placeholder="Pick a type" data-dropdown-css-class="select2-purple"
                                    style="width: 100%;">
                                    <option value="">Pick a type </option>
                                    <option value="Literature">Literature </option>
                                    <option value="Picture">Picture </option>
                                    <option value="Comic">Comic </option>
                                    <option value="Video">Video </option>
                                    <option value="Audio">Audio </option>
                                    <option value="Interactive">Interactive </option>
                                </select>
                            </div><br>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">Pick a category</label>
                                <select class="select2" class="form-control" name="category[]" id="category_id"
                                    data-placeholder="Select..." data-dropdown-css-class="select2-purple"
                                    style="width: 100%;">
                                    <option value="Short">Short</option>
                                    <option value="story">story</option>
                                    <option value="chapter">chapter</option>
                                    <option value="other notification">other notification</option>
                                    <option value="3D art">3D art</option>
                                    <option value="Photograhy">Photograhy</option>
                                    <option value="Photomanip">Photomanip</option>
                                    <option value="visual update">visual update</option>
                                    <option value="Traditional art">Traditional art</option>
                                    <option value="Digital art">Digital art</option>
                                </select>
                            </div><br>
                            <div class="upload-content-tags form-group">
                                <label for="">Select Content Type</label>
                                <div class="form-group">
                                    <input type="radio" id="vore" name="content_type" value="vore">
                                    <label class="pr-5" for="vore">Vore</label>

                                    <input type="radio" id="non_vore" name="content_type" value="non-vore">
                                    <label for="non_vore">Non Vore</label>
                                </div>
                            </div>
                            <!--<div class="upload-content-tags">
                                <div class="monetise-box">
                                    <div class="form-group">
                                        <input type="checkbox" id="default1300" checked="" name="monetise" value="1">
                                        <label for="default1300">Monetise Item?</label>
                                    </div>
                                    <p>Warning that you are only allowed to monetise content that belongs to you breaking this
                                        rule will result in a ban</p>
                                </div>
                            </div>-->
                            <div class="accept-terms privacy_box my-5">
                                <div class="src_checks">
                                    <div class="form-group">
                                        <input type="checkbox" id="default130" checked="">
                                        <label for="default130">Accept terms of condition?</label>
                                    </div>
                                </div>
                            </div>
                            <!-- recapta box-->
                            {{-- <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{env("G_RECAPTCHA_KEY")}}"></div>
                                <br />
                            </div> --}}
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
@push('script')
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    {{-- <script src="{{ url('public/assets/js/formsubmit.js') }}"></script> --}}
    <script>
        $('.select2').select2();

        $(document).ready(function() {
            // $(".notifications-list").hide();
            // $(".notification-icon").click(function() {
            //     $(".notifications-list").toggle();
            // });
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

            $('#type_id').change(function() {
                $("#category_id").select2({
                    data: [{
                        id: '',
                        text: ''
                    }]
                });
                $("#category_id").select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ url('/') }}" + "/get_project_cat ",
                        type: "POST",
                        dataType: 'json',
                        //delay: 300,
                        data: function(params) {
                            var query = {
                                "_token": "{{ csrf_token() }}",
                                type_id: $('#type_id').val(), // search term
                            };
                            return query;
                        },
                        processResults: function(response) {
                            return {
                                results: response,
                            };
                        },
                        //cache: true
                    }
                });
            }); // type change

            $('#tags_select').select2({
                tags: true,
                tokenSeparators: [','],
            });
        });

        // File upload via Ajax
        $("#uploadForm").on('submit', function(e){
            e.preventDefault();

            var fileToUpload = document.getElementById("file-input").files[0];
            var fileThumbnail = document.getElementById("thumbnail").files[0];
            var maxFileSize = 1024 * 1024 * 1024; // 1 GB
            var totalFileSize = fileToUpload.size + fileThumbnail.size;
            if(totalFileSize > maxFileSize) {
                $('#progress-container').show();
                $("#progress-bar").width('0%');
                $("#uploadStatus").html('<strong class="text-danger">Total file size should not be more than 1GB.</strong>').show();
                setTimeout(() => {
                    $('#progress-container').hide();
                }, 3000);
                return false;
            }

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
                url: '{{ route('uploadcontent') }}',
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
                // error: function(resp, textStatus, errorThrown) {
                //     console.log(resp +" "+ textStatus);
                //     console.log(errorThrown);
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

                    if(resp.status == 413){
                        $('#uploadStatus').html('<strong class="text-danger">File upload failed. Maximum file size should be 1 GB.</strong>');
                    }

                    setTimeout(() => {
                        $('#progress-container').hide();
                        // window.location='{{ route('userupload') }}'
                    }, 2000);

                },
                success: function(resp){
                    if(resp.result == 'success'){
                        $('#uploadForm')[0].reset();
                        $('#uploadStatus').html('<p style="color:#28A74B;">'+resp.msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('userupload') }}'
                        }, 2000);


                    }else if(resp.result == 'error'){
                        $('#uploadStatus').html('<p style="color:#EA4335;">'+resp.error_msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('userupload') }}'
                        }, 2000);

                    }
                }
            });
        });
    </script>
@endpush
