@extends('front.creator.layout.app')
@section('title', 'Creator Upload')
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
                <div class="col-lg-1">
                </div>
                <form class="" action="{{ route('update-content') }}" id="updateForm" class="card mb-3" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="col-lg-10" style="margin: 100px 0px;">
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif

                        <div class="upload-content-wrapper">
                            <input type="hidden" name="content_id" value="{{ $user_content_data->id }}">
                            <div class="upload-content-section">
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ $user_content_data->title }}" required>
                                <br>
                                <textarea class="form-control" placeholder="Description" name="description" required>{{ $user_content_data->description }}</textarea>
                            </div>

                            <div class="upload-content-item mb-5 mt-5">
                                <div class="outter-white">
                                    <div class="image-upload">
                                        <label for="file-input">
                                            Add Content, Video, Audio, JPG, GIF and etc
                                        </label>
                                    </div>
                                    {{-- <input id="file-input" type="file" name="content" accept="audio/*|video/*|image/*"> --}}
                                    <input type="hidden" name="content_file_name" id="content_file_name">
                                    <div id="filelist"></div>
                                    <br />
                                    <div id="container">
                                        <button type="button" id="pickfiles" class="btn btn-primary">Browse File</button>&nbsp;
                                        <button type="button" id="uploadfiles" class="btn btn-success">Upload Content</button>
                                    </div>
                                    <br />
                                    <video id="video" controls hidden style="display:none; margin-top:20px;"></video>

                                    <form id="screenshotForm">
                                    <div id="screenshots" style="margin-top: 20px;"></div>
                                    </form>

                                    <div id="filelist" style="margin-top: 20px;"></div>
                                    <div id="console"></div>
                                    <br />

                                    <!-- Progress bar -->
                                    <div class="progress" style="display: none;"></div>
                                    <pre id="console"></pre>

                                    @if ($user_content_data->content)
                                        <a href="{{ $user_content_data->content }}" target="_blank" class="btn btn-success mb-2">View File</a>
                                    @endif
                                </div>
                            </div>

                            <div class="upload-content-section mb-5 mt-5">
                                <label for="exampleInputEmail1">Youtube or third party URL </label>
                                <input type="text" class="form-control" placeholder="Video Url" name="video_url" value="{{ $user_content_data->original_video_url }}">
                            </div>

                            <div class="upload-content-thumb">
                                <div class="image-upload">
                                    <label for="thumbnail">
                                        Add Thumnail
                                    </label>
                                </div>
                                {{-- <input type="file" id="thumbnail" name="thumbnail" accept="image/*"> --}}
                                <input type="hidden" name="thumbnail_file_name" id="thumbnail_file_name">
                                <div id="filelistthumbnail"></div>
                                <br />
                                <div id="containerthumbnail">
                                    <button type="button" id="pickthumbnail" class="btn btn-primary">Browse File</button>&nbsp;
                                    <button type="button" id="uploadthumbnail" class="btn btn-success">Upload Thumnail</button>
                                </div>
                                <br />
                                <!-- Progress bar -->
                                <div class="progressthumbnail" style="display: none;"></div>
                                <pre id="consolethumbnail"></pre>

                                <img src="{{ $user_content_data->thumbnail }}" alt="thumb" class="img-fluid" style="height: 50px;">
                            </div><br>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">Add Tags</label>
                                <select class="select2" class="form-control" id="tags_select" name="tags[]" multiple="multiple"
                                    data-placeholder="Select..." data-dropdown-css-class="select2-purple"
                                    style="width: 100%;">
                                    @if(isset($TagData) && is_array($TagData) && count($TagData) > 0 )
                                        @foreach($TagData as $TagDataK => $TagDataV)
                                            <option value="{{ $TagDataV['id'] }}" {{ in_array($TagDataV['id'], $tags) ? 'selected' : '' }}>{{ $TagDataV['title'] }} </option>
                                        @endforeach
                                    @endif
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
                                    <option value="Literature" {{ $user_content_data->type == 'Literature' ? 'selected' : '' }}>Literature </option>
                                    <option value="Picture" {{ $user_content_data->type == 'Picture' ? 'selected' : '' }}>Picture </option>
                                    <option value="Comic" {{ $user_content_data->type == 'Comic' ? 'selected' : '' }}>Comic </option>
                                    <option value="Video" {{ $user_content_data->type == 'Video' ? 'selected' : '' }}>Video </option>
                                    <option value="Audio" {{ $user_content_data->type == 'Audio' ? 'selected' : '' }}>Audio </option>
                                    <option value="Interactive" {{ $user_content_data->type == 'Interactive' ? 'selected' : '' }}>Interactive </option>
                                </select>
                            </div><br>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">Pick a category</label>
                                <select class="select2" class="form-control" name="category[]" id="category_id"
                                    data-placeholder="Select..." data-dropdown-css-class="select2-purple"
                                    style="width: 100%;">
                                    <option value="Short" {{ $user_content_data->category == 'Short' ? 'selected' : '' }}>Short</option>
                                    <option value="story" {{ $user_content_data->category == 'story' ? 'selected' : '' }}>story</option>
                                    <option value="chapter" {{ $user_content_data->category == 'chapter' ? 'selected' : '' }}>chapter</option>
                                    <option value="other notification" {{ $user_content_data->category == 'other notification' ? 'selected' : '' }}>other notification</option>
                                    <option value="3D art" {{ $user_content_data->category == '3D art' ? 'selected' : '' }}>3D art</option>
                                    <option value="Photograhy" {{ $user_content_data->category == 'Photograhy' ? 'selected' : '' }}>Photograhy</option>
                                    <option value="Photomanip" {{ $user_content_data->category == 'Photomanip' ? 'selected' : '' }}>Photomanip</option>
                                    <option value="visual update" {{ $user_content_data->category == 'visual update' ? 'selected' : '' }}>visual update</option>
                                    <option value="Traditional art" {{ $user_content_data->category == 'Traditional art' ? 'selected' : '' }}>Traditional art</option>
                                    <option value="Digital art" {{ $user_content_data->category == 'Digital art' ? 'selected' : '' }}>Digital art</option>
                                </select>
                            </div><br>
                            <div class="upload-content-tags form-group">
                                <label for="">Select Content Type</label>
                                <div class="form-group">
                                    <input type="radio" id="vore" name="content_type" value="vore" {{ $user_content_data->content_type == 'vore' ? 'checked' : '' }}>
                                    <label class="pr-5" for="vore">Vore</label>

                                    <input type="radio" id="non_vore" name="content_type" value="non-vore" {{ $user_content_data->content_type == 'non-vore' ? 'checked' : '' }}>
                                    <label for="non_vore">Non Vore</label>
                                </div>
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
@push('scriptwithlink')
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="{{ url('public/assets/js/plupload/js/plupload.full.min.js') }}"></script>
    <script>
        $('.select2').select2();

        const video = document.getElementById("video");
        const screenshotsContainer = document.getElementById("screenshots");
        const form = document.getElementById("screenshotForm");
        const screenshotsData = [];

        function captureScreenshots(times) {
            screenshotsContainer.innerHTML = "";
            screenshotsData.length = 0;
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");

            let current = 0;
            function captureNext() {
            if (current >= times.length) return;

            video.currentTime = times[current];
            video.onseeked = () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                const dataURL = canvas.toDataURL("image/jpeg");
                screenshotsData.push(dataURL);

                const option = document.createElement("div");
                option.className = "screenshot-option";
                option.style.display = "inline-block";
                option.style.margin = "10px";

                const radio = document.createElement("input");
                radio.type = "radio";
                radio.name = "screenshot";
                radio.value = dataURL;
                if (current === 0) radio.checked = false;

                const img = document.createElement("img");
                img.src = dataURL;
                img.style.width = "200px";
                img.style.display = "block";

                option.appendChild(img);
                option.appendChild(radio);
                screenshotsContainer.appendChild(option);

                current++;
                captureNext();
            };
            }

            captureNext();
        }


        $(document).ready(function() {
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
        $("#updateForm").on('submit', function(e){
            e.preventDefault();

            // Content upload check
            if ($('#filelist').children().length > 0 && $('#content_file_name').val() == '') {
                $('.upload-button-wrap').html('<button class="upload-add-tag" type="submit">Upload</button>');
                $('#progress-container').show();
                $("#uploadStatus").html('<strong class="text-danger">Please upload the content before submitting the form.</strong>').show();
                setTimeout(() => {
                    $('#progress-container').hide();
                }, 3000);
                return false;
            }
             // Thumbnail upload check
            if ($('#filelistthumbnail').children().length > 0 && $('#thumbnail_file_name').val() == '') {
                $('.upload-button-wrap').html('<button class="upload-add-tag" type="submit">Upload</button>');
                $('#progress-container').show();
                $("#uploadStatus").html('<strong class="text-danger">Please upload the thumbnail before submitting the form.</strong>').show();
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
                url: '{{ route('update-content') }}',
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

                    if(resp.status == 413){
                        $('#uploadStatus').html('<strong class="text-danger">File upload failed. Maximum file size should be 1 GB.</strong>');
                    }

                    setTimeout(() => {
                        $('#progress-container').hide();
                    }, 2000);

                },
                success: function(resp){
                    if(resp.result == 'success'){
                        $('#updateForm')[0].reset();
                        $('#uploadStatus').html('<p style="color:#28A74B;">'+resp.msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            window.location='{{ route('edit-content') }}'
                        }, 2000);


                    }else if(resp.result == 'error'){
                        $('#uploadStatus').html('<p style="color:#EA4335;">'+resp.error_msg+'</p>');
                        setTimeout(() => {
                            $('#progress-container').hide();
                            // window.location='{{ route('creator.content.upload') }}'
                        }, 2000);

                    }
                }
            });
        });


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
                        const nativeFile = file.getSource && file.getSource().getSource ? file.getSource().getSource() : null;

                        document.getElementById('filelist').innerHTML =
                      `<div id="${file.id}">${file.name} (${plupload.formatSize(file.size)})</div>`;
                       if (nativeFile) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            video.src = e.target.result;
                            video.load();
                            video.style.display = "block";
                            video.onloadedmetadata = () => {
                            captureScreenshots([3, 6, 9]);
                            };
                        };
                        reader.readAsDataURL(nativeFile);
                        } else {
                        console.error("Unable to read file: native file not accessible.");
                        }
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
                },

                Error: function(up, err) {
                    document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
                }
            }
        });

        uploader.init();

        screenshotsContainer.addEventListener("change", function (e) {
            if (e.target && e.target.matches("input[name='screenshot']")) {
                const selectedImage = e.target.value;

                function base64ToBlob(base64Data, contentType = "image/jpeg") {
                const byteCharacters = atob(base64Data.split(",")[1]);
                const byteArrays = [];

                for (let i = 0; i < byteCharacters.length; i += 512) {
                    const slice = byteCharacters.slice(i, i + 512);
                    const byteNumbers = new Array(slice.length);
                    for (let j = 0; j < slice.length; j++) {
                    byteNumbers[j] = slice.charCodeAt(j);
                    }
                    const byteArray = new Uint8Array(byteNumbers);
                    byteArrays.push(byteArray);
                }

                return new Blob(byteArrays, { type: contentType });
                }

                const blob = base64ToBlob(selectedImage);

                const fakeFile = new plupload.File(
                plupload.guid(),
                "screenshot.jpg",
                blob.size
                );
                fakeFile.getSource = () => ({
                getSource: () => blob,
                });

                thumbnailUploader.files.length = 0;
                thumbnailUploader.addFile(blob, "screenshot.jpg");
                thumbnailUploader.start();
            }
            });
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
                },

                Error: function(up, err) {
                    document.getElementById('consolethumbnail').innerHTML += "\nError #" + err.code + ": " + err.message;
                }
            }
        });

        thumbnailUploader.init();

    </script>
@endpush
