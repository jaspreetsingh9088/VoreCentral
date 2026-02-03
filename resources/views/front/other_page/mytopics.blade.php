@extends('front.other_page.layout.app')
@section('title', 'MY Topic')
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
            color: #fff;
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
    </style>
@endsection
@section('content')
    <section class="viewhistory-wrapper latest-topics-sctn">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="view_history-outer">
                        <div class="history_search_wrapper">
                            <h2>Search Results</h2>
                            <p>Showing results for x</p>
                            <div class="history_search_box">
                                <form action="{{ route('mytopics.search') }}">
                                    <input name="search" type="search" class="form-control" placeholder="Search"
                                        aria-label="Search" aria-describedby="search-addon">
                                    <button type="submit" class="btn btn-outline-primary">search</button><br>
                                    <a href="{{ route('mytopics') }}" class="btn btn-outline-primary">Back My Topic</a>
                                </form>
                            </div>
                        </div>
                        <div class="view_histoy_dv"></div>
                        <div class="view_histoy_dv1"></div>
                        <div class="view_history_wrapper">
                            <?php
                            if(isset($ThreadData) && is_array($ThreadData) && count($ThreadData) > 0){
                                foreach($ThreadData as $ThreadDataK => $ThreadDataV){
                                    ?>
                            <div class="{{ $ThreadDataK % 2 == 0 ? 'view_history_box1' : 'view_history_box2' }}"
                                style="padding: 10px;min-height: auto;">
                                <div class="clearfix">
                                    <a style="color:#fff;" href="{{ URL('threaddetail/' . $ThreadDataV['id'] . '/1') }}">
                                        <div class="float-left">
                                            <span>
                                                <?php echo stripslashes($ThreadDataV['topic']); ?>
                                            </span>
                                            <br />
                                            {{ Auth::user()->username }},
                                            {{ date('d M Y', strtotime($ThreadDataV['created_at'])) }}
                                        </div>
                                    </a>
                                    <div class="thread-box-with-image pull-right clearfix">
                                        <a href="{{ URL('/dashboard/' . $ThreadDataV['userid']) }}">
                                            <img src="{{ Auth::user()->toArray()['profile_pic'] }}" class="pull-right" />
                                            {{ ucwords(Auth::user()->username) }}
                                        </a>
                                        <br>
                                        <a href="{{ URL('/threaddetail/' . $ThreadDataV['id'] . '/1') }}">
                                            {{ date('d M Y H:i:s', strtotime($ThreadDataV['created_at'])) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            }else{ ?>
                            <h3 class="text-center" style="color: #000000;">No records found.</h3>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>
@endsection
