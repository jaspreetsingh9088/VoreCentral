@extends('front.forum.layout.app')
@section('title', 'Thread')
@section('style')
    <style>
        .subforums-threads-wrapper {
            background: var(--watchclip-bg);
            padding: 15px 15px 15px 30px;
            outline: 3px solid #000;
            margin-right: 0px;
        }

        span.new-forum-popup {
            border: 2px solid #000;
            padding: 10px 10px;
            display: inline-block;
            font-weight: bold;
            cursor: pointer;
        }

        span.new-forum-popup:hover {
            border: 2px solid #000;
            padding: 10px 10px;
            display: inline-block;
            font-weight: bold;
            cursor: pointer;
            background-color: #000000;
            color: #FFFFFF;
        }

        .popup-background {
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        .popup-background-outter {
            display: table;
            width: 100%;
            height: 100%;
        }

        .popup-background-center {
            display: table-cell;
            vertical-align: middle;
        }

        .popup-set {
            background-color: #000;
            max-width: 720px;
            width: 40%;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }

        span.close-icon {
            background-color: #fea803;
            width: 30px;
            height: 30px;
            position: absolute;
            top: -13px;
            right: -13px;
            text-align: center;
            font-style: normal;
            line-height: 30px;
            color: #fff;
            border-radius: 30px;
            cursor: pointer;
        }

        .bottom-box {
            text-align: right;
        }

        .bottom-box a.close-btn {
            background-color: #f00;
            color: #fff;
            width: 25px;
            height: 25px;
            display: inline-block;
            text-align: center;
            line-height: 25px;
            margin-right: 20px;
        }

        .bottom-box a.tick-btn {
            background-color: #43a047;
            color: #fff;
            width: 25px;
            height: 25px;
            display: inline-block;
            text-align: center;
            line-height: 25px;
        }

        .popup-background {
            display: none;
        }

        .relative-box {
            position: relative;
        }

        .white-bg {
            background-color: #FFFFFF;
        }

        .upload-box {
            border: 1px solid #d1d1d1;
            border-top: 0px;
            padding: 10px;
            margin-bottom: 30px;
        }

        input.forum-input-box {
            border: 1px solid #d1d1d1;
            width: 100%;
            padding: 10px;
            margin-bottom: 25px;
        }

        .popup-set label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        button.preview-thread-btn {
            background-color: #fff;
            border: 1px solid #000;
            padding: 10px 15px;
            margin-right: 10px;
        }

        button.preview-thread-btn:hover {
            background-color: #000;
            color: #FFFFFF;
        }

        button.submit-thread-btn {
            background-color: #fea803;
            border: 1px solid #000;
            padding: 10px 15px;
            font-weight: bold;
        }

        button.submit-thread-btn:hover {
            background-color: #ed9b00;
            border: 1px solid #ed9b00;
            color: #FFFFFF;
        }

        input#input-file-box {
            display: none;
        }

        ul.social-icons {
            text-align: right;
            margin-top: 30px;
            padding: 0px;
        }

        .navbar-nav li:hover>ul.dropdown-menu {
            display: block;
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
        }

        /* rotate caret on hover */
        .dropdown-menu>li>a:hover:after {
            text-decoration: underline;
            transform: rotate(-90deg);
        }

        ul.dropdown-menu {
            margin: 0px;
            border-radius: 0px;
            padding: 0px;
            border: 0px;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            border-bottom: 1px solid #e3e3e3;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #123e12;
            color: #fff;
        }

        .buttons-container {
            text-align: right;
            margin-top: -40px;
        }

        .creator_logo h2 {
            background: #fff;
            margin-top: 8px;
            padding: 48px 8px;
            font-size: 19px;
            margin: 0px;
        }

        .orange_theme .all-notifications {
            background-color: #d2470e;
        }

        .thread-box-with-image.pull-right {
            width: 250px;
        }

        .thread-box-with-image a {
            color: #000;
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        .thread-box-with-image a:last-child {
            margin: 0px;
        }

        .thread-box-with-image img {
            width: 50px;
            height: 50px;
            margin-left: 15px;
        }
        .descrition{
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }
        .pages-custom .pg-left li{
            padding : 10px 20px !important;
        }
        #post-body-error{
            color:red;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('bodyclass','subforums_page')
@section('content')
    <section class="subforums-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-5"></div>
                <div class="col-lg-4">
                    <div class="search_box_forums">
                        <div class="d-flex search_box justify-content-end">
                            <span class="mr-3 text-danger">
                                <form class="input-group" action="{{ route('thread.search',[$id,$pageno]) }}">
                                    <div class="autocomplete" style="width:300px;">
                                        <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                                    </div>
                                    <input type="submit" value="Search" class="search_btn">
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="subforums-threads-outer">
                        @if(!is_null($news))
                            <div class="container news_square" style="max-width: unset !important;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img class="img-fluid"   src="{{ $news->image }}" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <a href="{{ route('news_detail',[$news->id]) }}" style="color: black;">
                                            <h3>{{ $news->title }}</h3>
                                            <p class="descrition">
                                                {{ strip_tags($news->description) }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <p class="sb-para">
                            <?php
                                if (isset($categoryData) && is_array($categoryData) && count($categoryData) > 0) {
                                    echo $categoryData[0]['name'];
                                }
                            ?>
                        </p>

                        <div class="subforums-adspace">
                            <div class="ad_banner landscape">
                                <div data-banner-id="425470"></div>
                            </div>
                        </div>


                        <?php
                            $no_of_records_per_page = 10;
                            $offset = ($pageno - 1) * $no_of_records_per_page;
                            $total_rows = $Threaddatacount;
                            $total_pages = ceil($total_rows / $no_of_records_per_page);

                        ?>
                        <div class="pagination_subforums pagi-top mb-3" style="display:inline-block; width:100%">
                            <ul class="list-none float-left">
                                <li><?php echo 'Page ' . $pageno . ' of ' . $total_pages; ?></li>
                                <li><a style="color:#222;" href="{{ URL('thread/' . $id . '/1') }}">First</a></li>
                                <li class="<?php if ($pageno <= 1) {
                                    echo 'disabled';
                                } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno <= 1) {
                                        echo '#';
                                    } else {
                                        echo URL('thread/' . $id . '/' . $pageno - 1);
                                    } ?>">Prev</a>
                                </li>

                                <li class="<?php if ($pageno >= $total_pages) {
                                    echo 'disabled';
                                } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno >= $total_pages) {
                                        echo '#';
                                    } else {
                                        echo URL('thread/' . $id . '/' . $pageno + 1);
                                    } ?>">Next</a>
                                </li>
                                <li><a style="color:#222;" href="{{ URL('thread/' . $id . '/' . $total_pages) }}">Last</a></li>
                            </ul>
                            <div class="btn-form float-right">
                                @php
                                    $currenturl = request()->segment(2);
                                    $userid = request()->segment(1);
                                @endphp
                                @if($currenturl != 2)
                                    @if(Auth::check())<span class="new-forum-popup">New Forum Thread</span>@endif
                                @endif
                            </div>
                        </div>
                        <div class="subforums-threads-wrapper">
                            <p>Threads</p>
                            <ul class="list-none">
                                <?php
                                $latestCount=1;
                                if(isset($ThreadData) && is_array($ThreadData) && count($ThreadData) > 0){
                                    foreach($ThreadData as $ThreadDataK => $ThreadDataV){
                                        if($latestCount==1){
                                            $latestPostId=$ThreadDataV['id'];
                                        }
                                        $latestCount++;
                                        $latestThreadPost = App\Models\Threadcomment::where('threadid',$ThreadDataV['id'])->latest('created_at')->first();
                                        $totalComments = App\Models\Threadcomment::where('threadid',$ThreadDataV['id'])->count();
                                        $latestThreadPostUser = App\Models\User::where('id', $latestThreadPost['userid'])->first();
                                        $latestThreadPostUserName=$latestThreadPostUser->username;
                                        $latestRecordPageNumber=ceil($totalComments/15);
                                        ?>
                                        <li>
                                            <div class="clearfix">
                                                @php
                                                    $dashboard_link = '';
                                                    $dashboard_link_latest='';
                                                    $user = App\Models\User::where('id', $ThreadDataV['userid'])->first();

                                                    if(!is_null($user)) {
                                                        if($user->creator == 1){
                                                            $dashboard_link = route('creatorvisitordashboard',[$user->id]);
                                                        }else{
                                                            $dashboard_link = route('profiledashboard',[$user->id]);
                                                        }

                                                        $username = $user->username;
                                                        $profile_pic = $user->profile_pic;
                                                    } else {
                                                        $username = 'Admin';
                                                        $profile_pic = asset('assets/images/item-09.webp');
                                                    }
                                                @endphp
                                                
                                                
                                                    <div class="float-left">
                                                        <a style="color:#222;" href="{{ URL('threaddetail/' . $ThreadDataV['id'] . '/1') }}"><span>
                                                                <?php echo stripslashes($ThreadDataV['topic']); ?>
                                                            </span> 
                                                        </a>
                                                            <br />
                                                        <a style="color:#222;"
                                                        href="{{ URL( $dashboard_link) }}">
                                                        {{ $username }},
                                                        </a>
                                                        <a style="color:#222;"
                                                        href="{{ URL('threaddetail/' . $ThreadDataV['id'] . '/1') }}"> {{ date('d M Y', strtotime($ThreadDataV['created_at'])) }} </a>

                                                    </div>
                                                <div class="thread-box-with-image pull-right clearfix">
                                                     @if(!is_null($latestThreadPostUser ))
                                                        @if($latestThreadPostUser->creator == 1)
                                                            @php $dashboard_link_latest = route('creatorvisitordashboard',[$latestThreadPostUser->id]); @endphp
                                                        @else
                                                            @php $dashboard_link_latest = route('profiledashboard',[$latestThreadPostUser->id]); @endphp
                                                        @endif

                                                    @endif
                                                    <a href="{{ URL( $dashboard_link_latest) }}">
                                                        <img src="{{ $profile_pic }}" class="pull-right" />
                                                        {{ ucwords($latestThreadPostUserName) }}
                                                    </a>
                                                    <br>
                                                    <a href="{{ URL('/threaddetail/' . $ThreadDataV['id'] . '/'.$latestRecordPageNumber.'/#threadcomment'.$latestThreadPost->id) }}">
                                                        {{ date('d M Y H:i:s', strtotime($ThreadDataV['created_at'])) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                } ?>
                                <li></li>
                            </ul>
                        </div>
                        <div class="pagination_subforums mt-5">
                            <ul class="list-none float-left">
                                <li><?php echo 'Page ' . $pageno . ' of ' . $total_pages; ?></li>
                                <li><a style="color:#222;" href="{{ URL('thread/' . $id . '/1') }}">First</a></li>
                                <li class="<?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno <= 1) { echo '#'; } else { echo URL('thread/' . $id . '/' . $pageno - 1); } ?>">Prev</a>
                                </li>
                                <li class="<?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno >= $total_pages) { echo '#'; } else { echo URL('thread/' . $id . '/' . $pageno + 1); } ?>">Next</a>
                                </li>
                                <li><a style="color:#222;" href="{{ URL('thread/' . $id . '/' . $total_pages) }}">Last</a> </li>
                            </ul>
                        </div>
                        <div class="subforums-adspace mt-5">
                            <img src="assets/images/add_b.webp" class="w-100" alt="" />
                        </div>
                        <div class="pages-custom">
                            <div class="row">
                                <div class="col-lg-9 pg-left">
                                    <ul class="list-none">
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('forum') }}">Forum</a></li>
                                        <li>
                                            <a href="{{ URL('thread/' . $id . '/1') }}">
                                                @if (isset($categoryData) && is_array($categoryData) && count($categoryData) > 0)
                                                    {{$categoryData[0]['name']}}
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 text-right pg-right">
                                    <ul class="list-none">
                                        <li style="padding : 10px;"><a href="{{ route('themeOption') }}">Change Theme</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-linkss">
                        <div class="row">
                            <div class="col-lg-9 float-left">
                                <ul class="list-none">
                                    <li><a href="{{ route('aboutus') }}">About Us</a></li>
                                    <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                                    <li><a href="{{ route('helpandsupport') }}">Help</a></li>
                                    <li><a href="{{ route('thread',[2,1]) }}">Rules</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 text-right">
                                <ul class="list-none">
                                    <li><a href="{{ route('themeOption') }}">Change Themes</a></li>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>
    <div class="popup-background">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set white-bg">
                    <span class="close-icon">X</span>
                    <form class="sign_up_form" action="{{ route('createthread') }}" class="card mb-3"
                        method="POST" enctype="multipart/form-data"  onsubmit="return validateForm()">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label>Topic:</label>
                                <input type="text" class="forum-input-box" name="topic" required />
                            </div>

                            <div class="col-12">
                                <label>Post:</label>
                                <textarea required="required" id="sample-editor" name="comment" ></textarea>
                                <div class="upload-box"><label for="input-file-box"><i class="fa fa-plus"
                                            aria-hidden="true"></i> Add Media</label><input type="file"
                                        id="input-file-box" name="media" onchange="previewImage(event)" /></div>
                            </div>
                            <div class="col-12">
                                <div id="post-body-error">Post Body is required.</div>
                                <div id="image-preview-container" style="display: none;">
                                    <img id="image-preview" src="" alt="Image Preview" style="width: 100px; height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                </div>
                            </div>

                            <input type="hidden" name="cid" value="{{ $id }}" />
                            <div class="col-12">
                                <button type="button" class="preview-thread-btn">Preview</button><button
                                    type="submit" class="submit-thread-btn">Submit Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
    function previewImage(event) {
        var input = event.target;
        var previewContainer = document.getElementById("image-preview-container");
        var previewImage = document.getElementById("image-preview");

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = "block";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

    <script>
           function validateForm() {
            var editorData = CKEDITOR.instances['sample-editor'].getData().trim();
            if (editorData === '') {
                $("#post-body-error").show();
                return false;
            }
            return true;
        }
        $(document).ready(function() {
            document.getElementById("image-preview-container").text="";
            $("#post-body-error").hide();
            CKEDITOR.replace('sample-editor');
            $('.popup-background').hide();
            $(".new-forum-popup").click(function() {
                $('.popup-background').show();
            });

            $(".close-icon").click(function() {
                $('.popup-background').hide();
            });

        });
    </script>
@endpush
