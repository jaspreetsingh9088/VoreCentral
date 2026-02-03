<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Webstore Manage</title>
        <meta name="description"
              content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <!-- plugin css for this page -->
        <link  rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}" />
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ url('public/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css')}}">
        <link rel="stylesheet" href="{{ asset('admin/css/fontawesome-free/css/fontawesome.min.css')}}">
        <!-- endinject -->
    </head>
    <body class="store_theme studio_theme">
        <div class="container">
            <div class="main-panel">
                <!-- partial:partials/_navbar.html -->
                <header id="header" class="studio_hd">
                    <h1>Webstore Studio</h1>
                </header>
                <!-- partial -->
                <div class="content-wrapper">
                    <div class="product_details_background">
                        <div class="file-upload" style="height: 160px;">
                            <div class="top_file p-0 m-0">
	                            <a class="file-upload-btn" href="{{ route('webStoremonetizeupload') }}">Upload</a>
                                <a class="file-upload-btn" href="{{ route('webstore.manage.content') }}">Manage</a>
	                            {{-- <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Upload</button> --}}
                                {{-- <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">  --}}
                                {{-- <button type ="submit" name="manage upload" class="manage_upload">Manage Upload</button> --}}
                            </div>
                            <div class="file-upload-content manges_cont">
                                <img class="file-upload-image" src="" alt="your image">
                                <div class="image-title-wrap">
                                </div>
                            </div>
                        </div>
                        <div class="manage_upload_details">
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
                            <div class="manage_area">
                                <h2>Delete Content</h2>
                                <div class="manage_gallery_sect">
                                    <ul>
                                        @if(count($deletecontent) > 0)
                                            @foreach($deletecontent as $dc)
                                                <li><a href="#"><img class="" src="{{ $dc->thumbnail }}" alt=""></a></li>
                                            @endforeach
                                        @else
                                            <li class="border-0 w-100 font-weight-600">You do not have any content yet. Please add to view here</li>
                                        @endif
                                    </ul>
                                    <div class="upload_delete" style="cursor: pointer;">
                                        <span data-toggle="modal" data-target="#deletemodal">
                                            <svg style="width:100px;height:100px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19M8,9H16V19H8V9M15.5,4L14.5,3H9.5L8.5,4H5V6H19V4H15.5Z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="manage_area">
                                <h2>Create Collections</h2>
                                <div class="manage_gallery_sect" >
                                    <div class="row">
                                        @if(count($collectiondata) > 0)
                                            @foreach($collectiondata as $cd)
                                                <div class="col-md-12">
                                                    <ul>
                                                        <span style="font-weight: 900; color : black; font-size : 18px;">{{ $cd['collection_name'] }}</span>
                                                    </ul>

                                                </div>
                                                <div class="col-md-12">
                                                    <ul>
                                                        @foreach($cd['content'] as $content)
                                                            <li><a href="#"><img class="" src="{{ $content['thumbnail'] }}" alt=""></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        @else
                                            <ul>
                                                <li class="border-0 w-100 font-weight-600">You do not have any content yet. Please add to view here</li>
                                            </ul>
                                        @endif
                                    </div>
                                        <div class="upload_delete" style="cursor: pointer;">
                                        Create new
                                        <span class="plus" data-toggle="modal" data-target="#collectionmodal">
                                            <svg style="width:50px;height:50px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
                                            </svg>
                                        </span>
                                        collection
                                    </div>
                                </div>
                            </div>
                            <div class="manage_area">
                                <h2>Edit Content</h2>
                                <div class="manage_gallery_sect">
                                    <ul style="padding : 30px 20px;">
                                        @if(count($allpaidcontent) > 0)
                                            @foreach($allpaidcontent as $apc)
                                                <li>
                                                    <a href="#"><img class="" src="{{ $apc->thumbnail }}" alt=""></a>
                                                    <a href="{{ route('paid.content.edit',[$apc->id]) }}" class="btn btn-sm btn-success position-absolute" style="margin-left: -76px; margin-top:71px;">Edit</a>
                                                </li>
                                            @endforeach
                                        @else
                                            {{-- <ul> --}}
                                                <li class="border-0 w-100 font-weight-600">You do not have any content yet. Please add to view here</li>
                                            {{-- </ul> --}}
                                        @endif
                                    </ul>
                                    <div class="upload_delete">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer>
                    <div class="footer-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <div class="fs-14 font-weight-600">
                                            <ul class="footer_menu">
                                                <li><a href="#">Contact us</a>	</li>
                                                <li><a href="#">About us</a></li>
                                                <li><a href="#">Privacy Policy</a></li>
                                                <li><a href="#">Terms of Service</a></li>
                                            </ul>
                                            © 2022. All rights reserved.
                                        </div>
                                        <ul class="social-media mb-3">
                                            <li>
                                                <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                                                    <i class="mdi mdi-youtube"></i>
                                                    <span class="sr-only">{{ env('APP_NAME')  }} Youtube</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ env('APP_TWITTER_LINK', '#')  }}">
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
            </div>
        </div>

        <div class="modal fade" id="deletemodal" data-backdrop="static" data-keyboard="false" tabindex="-1"  aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background: url({{ url('public/assets/images/purple_background.webp') }}) no-repeat;">
                    <div class="modal-header" style="padding :unset;">
                        <h5 class="modal-title ml-4 mt-3" style="margin-bottom:unset; line-height: unset;">Content</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin : 0px 0px 0px auto;">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <form action="{{ route('webstore.content.delete') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="manage_area">
                                <div class="manage_gallery_sect" style="background: unset; border : unset;">
                                    <ul>
                                        @if(count($paidcontent) > 0)
                                            @foreach($paidcontent as $pc)
                                                <li class="position-relative" onclick="selectimage(this)">
                                                    <a href="#">
                                                        <img class="" src="{{ asset('thumbnail/'.$pc->thumbnail) }}" alt="">
                                                    </a>
                                                    <input type="checkbox" name="content_id[]" value="{{$pc->id}}" style="position: absolute;right : 0px;">
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="border-0 w-100 position-relative">
                                                {{-- <a href="#"> --}}
                                                    You do not have any content yet. Please add to view here
                                                {{-- </a>                                                 --}}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if(count($paidcontent) > 0)
                                <button type="submit" class="btn btn-primary">Delete</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="collectionmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"  aria-labelledby="collectionmodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background: url({{ url('public/assets/images/purple_background.webp') }}) no-repeat;">
                    <div class="modal-header" style="padding :unset;">
                        <h5 class="modal-title ml-4 mt-3" style="margin-bottom:unset; line-height: unset;">Collections</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin : 0px 0px 0px auto;">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <form action="{{ route('webstore.content.collection') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="manage_area">
                                <div class="manage_gallery_sect" style="background: unset; border : unset;">
                                    <ul>
                                        @if(count($paidcontent) > 0)
                                            @foreach($paidcontent as $pc)
                                                <li class="position-relative" onclick="selectimage(this)">
                                                    <a href="#">
                                                        <img class="" src="{{ asset('thumbnail/'.$pc->thumbnail) }}" alt="">
                                                    </a>
                                                    <input type="checkbox" name="content_id[]" value="{{$pc->id}}" style="position: absolute;right : 0px;">
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="border-0 w-100 position-relative">
                                                {{-- <a href="#"> --}}
                                                    You do not have any content yet. Please add to view here
                                                {{-- </a>                                                 --}}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                @if(count($paidcontent) > 0)
                                    <div class="form-group">
                                        <label for="">Collection Name</label>
                                        <input type="text" name="collection_name" class="form-control" style="height: 20px;" required>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if(count($paidcontent) > 0)
                                <button type="submit" class="btn btn-primary">Submit</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- inject:js -->
        <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- plugin js for this page -->
        <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js')}}"></script>
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        <script src="{{ url('public/assets/js/demo.js')}}"></script>
        <script src="{{ url('public/assets/js/jquery.easeScroll.js')}}"></script>
        <script>
            function selectimage(row)
            {
                var firstInput = row.getElementsByTagName('input')[0];
                firstInput.checked = !firstInput.checked;
            }
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.image-upload-wrap').hide();

                        $('.file-upload-image').attr('src', e.target.result);
                        $('.file-upload-content').show();

                        $('.image-title').html(input.files[0].name);
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
        </script>
        <!-- End custom js for this page-->
    </body>
</html>
