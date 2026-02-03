<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="description"
              content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <title>Gallery Search</title>
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <!-- plugin css for this page -->
        <link rel="stylesheet"  href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}" />
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ url('public/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css')}}">
        <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- plugin js for this page -->
        <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        <script src="{{ url('public/assets/js/demo.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
        <!-- endinject -->
        <style>
            .item_photo{
                width: 250px !important;
            }
            .description {
                text-overflow: ellipsis;
                overflow: hidden;
                display: -webkit-box !important;
                -webkit-line-clamp: 8;
                -webkit-box-orient: vertical;
                white-space: normal;
            }
            header{
                background:url({{asset('assets/images/banner.png')}}) no-repeat !important;
                background-size: cover !important;
            }
        </style>
        <style>
            /*the container must be positioned relative:*/
            .autocomplete {
              position: relative;
              display: inline-block;
            }

            input {
              border: 1px solid transparent;
              background-color: #f1f1f1;
              padding: 10px;
              font-size: 16px;
            }

            input[type=text] {
              background-color: #f1f1f1;
              width: 100%;
            }

            input[type=submit] {
              background-color: DodgerBlue;
              color: #fff;
              cursor: pointer;
            }

            .autocomplete-items {
              position: absolute;
              border: 1px solid #d4d4d4;
              border-bottom: none;
              border-top: none;
              z-index: 99;
              /*position the autocomplete items to be the same width as the container:*/
              top: 100%;
              left: 0;
              right: 0;
            }

            .autocomplete-items div {
              padding: 10px;
              cursor: pointer;
              background-color: #fff;
              border-bottom: 1px solid #d4d4d4;
            }

            /*when hovering an item:*/
            .autocomplete-items div:hover {
              background-color: #e9e9e9;
            }

            /*when navigating through the items using the arrow keys:*/
            .autocomplete-active {
              background-color: DodgerBlue !important;
              color: #ffffff;
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
            #type_filter{
                height:40px;
            }
            #order_filter{
                height:40px;
            }
        </style>
    </head>
    <body class="subforums_page green_theme gallery_audio">
        <div class="">
            <div class="main-panel">
                <!-- partial:partials/_navbar.html -->
                <header id="header">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="navbar-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        {{-- <a class="navbar-brand" href="{{ route('publicgallery.featured') }}">Gallery</a> --}}
                                    </div>
                                    @include('front.layouts.navbar-top')
                                </div>
                            </div>
                            <div class="navbar-bottom"  >
                                <div class="">
                                    <div>
                                        <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                        <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent" >
                                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                            <li>
                                                <button class="navbar-close">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('publicgallery.pictures',['all','featured']) }}">Gallery</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('forum')}}">Forums</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('publicstore')}}">Store</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Misc</a>
                                                <ul class="submenu">
                                                    <li><a class="" href="{{URL('dlc')}}">DLC</a></li>
                                                    <li>
                                                        <a class="" href="{{route('generalSetting')}}">Options</a>
                                                    </li>
                                                    <li><a class="" href="{{URL('news_archieve')}}">News archive</a></li>
                                                    <li>
                                                        <a class="" href="{{ route('content.promoted.produced') }}">Content produced and promoted</a>
                                                    </li>
                                                    <li><a class="" href="{{ route('onlineuser') }}">Online Users</a></li>
                                                    <li><a class="" href="{{ route('myvault') }}">Purchased Content</a></li>
                                                    <li><a class="" href="{{ URL('publicgallery/pictures/latest') }}">Inner Gallery</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header>
                <!-- partial -->
                <div class="content-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                    <div class="top_gallery creator_gallery_search">
                                            <div class="d-flex search_box">
                                            @php
                                            $selectedType = request()->get('filter');
                                            $selectedOrder= request()->get('order');
                                            @endphp

                                            <div class="input-group">
                                                    {{-- <input type="search" class="form-control rounded search_textbox" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                                                                                            <button type="button" class="btn btn-outline-primary search_btn">search</button> --}}
                                                    {{-- <div class="autocomplete" style="width:300px;">
                                                <input id="myInput" type="text" class="search_textbox" placeholder="Search" value="{{$search}}" required>
                                                </div>
                                                <input type="submit" value="Search" class="search_btn"> --}}


                                                <form action="{{ route('publicgallery.gallerySerach') }}" method="GET">
                                                    @csrf
                                                    <div class="autocomplete" style="width:300px;">
                                                        <input id="myInput" name="search" type="text" class="search_textbox" placeholder="Search" value="{{$search}}" required>
                                                    </div>
                                                    <input type="hidden" name="filter" id="type" value="{{ $selectedType }}">
                                                    <input type="hidden" name="order" id="order" value="{{ $selectedOrder }}">
                                                    <input type="submit" value="Search" class="search_btn">
                                                    {{-- <button type="submit" class="btn btn-outline-primary">Search</button> --}}
                                                    <select id="type_filter">
                                                        <option value="">Select Type</option>
                                                        <option value="all" {{ $selectedType == 'all' ? 'selected' : '' }}>All Content</option>
                                                        <option value="Literature" {{ $selectedType == 'Literature' ? 'selected' : '' }}>Literature</option>
                                                        <option value="Comic" {{ $selectedType == 'Comic' ? 'selected' : '' }}>Comics</option>
                                                        <option value="Picture" {{ $selectedType == 'Picture' ? 'selected' : '' }}>Pictures</option>
                                                        <option value="Video" {{ $selectedType == 'Video' ? 'selected' : '' }}>Video</option>
                                                        <option value="Game" {{ $selectedType == 'Game' ? 'selected' : '' }}>Games</option>
                                                        <option value="Audio" {{ $selectedType == 'Audio' ? 'selected' : '' }}>Audio</option>
                                                    </select>

                                                    <select id="order_filter">
                                                        <option value="">Select Order</option>
                                                        <option value="featured" {{ $selectedOrder == 'featured' ? 'selected' : '' }}>Featured</option>
                                                        <option value="latest" {{ $selectedOrder == 'latest' ? 'selected' : '' }}>Latest</option>

                                                        <option value="recency" {{ $selectedOrder == 'recency' ? 'selected' : '' }}>Prioritise Recency</option>
                                                        <option value="relevancy" {{ $selectedOrder == 'relevancy' ? 'selected' : '' }}>Prioritise Relevancy</option>
                                                         <option value="prioritiseTags" {{ $selectedOrder == 'prioritiseTags' ? 'selected' : '' }}>Prioritise My Tags</option>
                                                        <option value="prioritisePopularity" {{ $selectedOrder == 'prioritisePopularity' ? 'selected' : '' }}>Prioritise Popularity</option>

                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                    </div>           
                            </div>
                        </div>
                        <div class="container">
                            <div class="row gallery_main gal_search aos-init aos-animate" data-aos="fade-up">
                                <div class="col-xl-3 p-0">
                                    <div class="row">
                                        <div class="gallery_featured_menu search_result_menu green_theme">
                                            <ul class="featured_menu">
                                                <li class="filter-item" data-filter="literature">
                                                    <a href="javascript:;"> <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Literature</a>
                                                </li>
                                                <li class="filter-item" data-filter="traditional art">
                                                    <a href="javascript:;"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Traditional Art</a>
                                                </li>
                                                <li class="filter-item" data-filter="photography">
                                                <a href="javascript:;">
                                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Photographies</a>
                                                </li>
                                                <li class="filter-item" data-filter="3D art">
                                                    <a href="javascript:;">
                                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                        </svg>3d Art
                                                    </a>
                                                </li>
                                                <li class="filter-item" data-filter="comic">
                                                    <a href="javascript:;"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Comics</a>
                                                </li>
                                                <li class="filter-item" data-filter="animated">
                                                    <a href="javascript:;"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Animated Video</a>
                                                </li>
                                                <li class="filter-item" data-filter="live Action">
                                                    <a href="javascript:;"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Live Action video</a>
                                                </li>
                                                <li class="filter-item" data-filter="interactive">
                                                    <a href="javascript:;"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Interactive</a>
                                                </li>
                                                <li class="filter-item" data-filter="audio">
                                                    <a href="javascript:;"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4,15V9H12V4.16L19.84,12L12,19.84V15H4Z"></path>
                                                    </svg>Audio</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9  grid-margin p-0">
                                    <div class="search_result">
                                        @if(count($data) > 0)
                                            @foreach($data as $sr)
                                                <div class="sr_result_item_sect">
                                                    <div class="row">
                                                        <div class="col-sm-4 result_item-lft">
                                                            <h1>{{ $sr->title }}</h1>
                                                            <div class="item_photo">
                                                               <a href="{{ route('contentdetail',$sr->id) }}"> <img src="{{ $sr->thumbnail }}" alt="thumb" class="img-fluid "></a>
                                                            </div>
                                                            <br>
                                                            @php
                                                                $islike = App\Models\Gallerylike::where('contentid', $sr->id)->count();
                                                                $isunlike = App\Models\Gallerydislike::where('contentid', $sr->id)->count();
                                                                $views = App\Models\Contentview::where('contentid', $sr->id)->count();
                                                            @endphp
                                                            <a style="color: white;text-decoration: unset;background: blue;"  name="views" class="view_bt">Views:  @php print($views); @endphp</a>
                                                            <a style="color: white;text-decoration: unset;"  name="likes" class="view_bt"> Likes: @php print($islike); @endphp</a>
                                                            <a style='color: white;text-decoration: unset; background: url("{{ url('public/assets/images/red_bg.webp') }}")'  name="likes" class="view_bt">Dislikes: @php print($isunlike); @endphp</a>
                                                        </div>
                                                        <div class="col-sm-4 result_item-center">
                                                            <div class="sr_bt_details">
                                                                <span class="create_date">Date : @php echo date('d.m.Y',strtotime($sr->created_at)) @endphp</span>
                                                            </div>
                                                            <div class="tags_area">
                                                                <b>Tags</b><br>
                                                                @if(isset($sr->tags))
                                                                    @php
                                                                        $tags = App\Models\Tag::whereIn('id',explode(',',$sr->tags))->get();
                                                                    @endphp
                                                                    @foreach($tags as $tag)
                                                                        {{$tag->title}},
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="description_area description">
                                                                <b>description</b><br>
                                                                {{ $sr->description }}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 result_item-right">
                                                            <a href="{{ url('/') }}/{{ $sr->user->id }}/creatordashboard" class="nav-link">
                                                                <div class="item_photo creator_picture">
                                                                    <img src="{{ $sr->user->profile_pic }}" alt="thumb" class="img-fluid ">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                               
                                            @endforeach
                                        @else
                                            <div class="row">
                                                <div class="col-sm-11 result_item-center">
                                                    <div class="sr_bt_details">
                                                        <span style="font-weight: bold;">Search Result</span>
                                                    </div>
                                                    <div class="description_area">
                                                        <b>Sorry Content not found...</b><br>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
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
                @include('front.layouts.footer')
                <!-- partial -->
            </div>
        </div>
        <input type="hidden" class="search" value="{{ $search }}">
        <input type="hidden" name="filter_type" class="filter_type" value="{{$filter_type}}">
        <script>
            $(document).ready(function() {
                var filter_type = $('.filter_type').val();
                if(filter_type != ''){
                    $('[data-filter="'+filter_type+'"]').trigger('click');
                }
            });
            $('.filter-item').click(function(){
                var filter = $(this).data('filter');
                var token = "{{ csrf_token() }}";
                var search = $('.search').val();
                $('.search_result').empty();
                $.ajax({
                    url: "{{ route('publicgallery.gallerySerach.ajax') }}",
                    data: { search : search, filter : filter, _token : token },
                    method: 'post',
                    dataType: 'JSON',
                    success: function(response) {
                        $('.search_result').html(response.content);
                    },
                });
            })

            // $('.search_btn').click(function(){
            //     var search = $('.search_textbox').val();
            //     var filter = '';
            //     var token = "{{ csrf_token() }}";
            //     // var search = $('.search').val();
            //     $('.search_result').empty();

            //     $.ajax({
            //         url: "{{ route('publicgallery.gallerySerach.ajax') }}",
            //         data: { search : search, filter : filter, _token : token },
            //         method: 'post',
            //         dataType: 'JSON',
            //         success: function(response) {
            //             $('.search_result').html(response.content);
            //         },
            //     });
            // })

        </script>
        <script>
            function autocomplete(inp, arr) {
                /*the autocomplete function takes two arguments,
                the text field element and an array of possible autocompleted values:*/
                var currentFocus;
                /*execute a function when someone writes in the text field:*/
                inp.addEventListener("input", function(e) {
                    var a, b, i, val = this.value;
                    /*close any already open lists of autocompleted values*/
                    closeAllLists();
                    if (!val) { return false;}
                    currentFocus = -1;
                    /*create a DIV element that will contain the items (values):*/
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    /*append the DIV element as a child of the autocomplete container:*/
                    this.parentNode.appendChild(a);
                    /*for each item in the array...*/
                    for (i = 0; i < arr.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                            /*create a DIV element for each matching element:*/
                            b = document.createElement("DIV");
                            /*make the matching letters bold:*/
                            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                            b.innerHTML += arr[i].substr(val.length);
                            /*insert a input field that will hold the current array item's value:*/
                            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                            /*execute a function when someone clicks on the item value (DIV element):*/
                            b.addEventListener("click", function(e) {
                                /*insert the value for the autocomplete text field:*/
                                inp.value = this.getElementsByTagName("input")[0].value;
                                /*close the list of autocompleted values,
                                (or any other open lists of autocompleted values:*/
                                closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                });
                /*execute a function presses a key on the keyboard:*/
                inp.addEventListener("keydown", function(e) {
                    var x = document.getElementById(this.id + "autocomplete-list");
                    if (x) x = x.getElementsByTagName("div");
                    if (e.keyCode == 40) {
                        /*If the arrow DOWN key is pressed,
                        increase the currentFocus variable:*/
                        currentFocus++;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 38) { //up
                        /*If the arrow UP key is pressed,
                        decrease the currentFocus variable:*/
                        currentFocus--;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 13) {
                        /*If the ENTER key is pressed, prevent the form from being submitted,*/
                        e.preventDefault();
                        if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                        }
                    }
                });
                function addActive(x) {
                    /*a function to classify an item as "active":*/
                    if (!x) return false;
                    /*start by removing the "active" class on all items:*/
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    /*add class "autocomplete-active":*/
                    x[currentFocus].classList.add("autocomplete-active");
                }
                function removeActive(x) {
                    /*a function to remove the "active" class from all autocomplete items:*/
                    for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                    }
                }
                function closeAllLists(elmnt) {
                    /*close all autocomplete lists in the document,
                    except the one passed as an argument:*/
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                    }
                }
                /*execute a function when someone clicks in the document:*/
                document.addEventListener("click", function (e) {
                    closeAllLists(e.target);
                });
            }

            /*An array containing all the country names in the world:*/
            var contenttitle = <?php echo json_encode($contenttitle ); ?>;
            /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
            autocomplete(document.getElementById("myInput"), contenttitle);
            document.getElementById("type_filter").addEventListener("change", function () {
            let selectedValue = this.value;
            document.getElementById("type").value = selectedValue;
            });

            document.getElementById("order_filter").addEventListener("change", function () {
            let selectedValue = this.value;
            document.getElementById("order").value = selectedValue;
            });

            </script>
    </body>
</html>
