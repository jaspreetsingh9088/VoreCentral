@extends('front.homepage.setting.layout.app')

@section('title', 'Theme Option')
@section('style')
    <style>
        .theme_option_block li{
        text-decoration:none;
        }
    </style>
@endsection
@section('content')
<section class="viewhistory-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <form method="post" action="{{ route('themeOptionStore')}}">
                    @csrf
                    <div class="news_archieve_wrapper">
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success w-50">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif
                        <div class="theme_option_block blue-b">
                            <h2>Homepage</h2>
                            <ul class="list-none">
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="homepage_theme" value="blue_theme" id="homepageblue"
                                    @if(isset($setting) && $setting->homepage_theme == 'blue_theme') checked @endif />
                                    <label for="homepageblue" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="homepage_theme" value="green_theme" id="homepagegreen"
                                    @if(isset($setting) && $setting->homepage_theme == 'green_theme') checked @endif/>
                                    <label for="homepagegreen" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="homepage_theme" value="orange_theme" id="homepageorange"
                                    @if(isset($setting) && $setting->homepage_theme == 'orange_theme') checked @endif/>
                                    <label for="homepageorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="homepage_theme" value="red_theme"  id="homepagered"
                                    @if(isset($setting) && $setting->homepage_theme == 'red_theme') checked @endif/>
                                    <label for="homepagered"    style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label>
                                </li>
                            </ul>
                        </div>
                        <div class="theme_option_block green-b">
                            <h2>Gallery</h2>
                            <ul class="list-none">
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="gallery_theme" value="blue_theme" id="galleryblue"
                                    @if(isset($setting) && $setting->gallery_theme == 'blue_theme') checked @endif />
                                    <label for="galleryblue" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="gallery_theme" value="green_theme" id="gallerygreen"
                                    @if(isset($setting) && $setting->gallery_theme == 'green_theme') checked @endif />
                                    <label for="gallerygreen" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="gallery_theme" value="orange_theme" id="galleryorange"
                                    @if(isset($setting) && $setting->gallery_theme == 'orange_theme') checked @endif />
                                    <label for="galleryorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="gallery_theme" value="red_theme"  id="galleryred"
                                    @if(isset($setting) && $setting->gallery_theme == 'red_theme') checked @endif />
                                    <label for="galleryred"    style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label>
                                </li>
                            </ul>
                        </div>
                        <div class="theme_option_block orange-b">
                            <h2>Forums</h2>
                            <ul class="list-none">
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="forums_theme" value="blue_theme" id="forumsblue"
                                    @if(isset($setting) && $setting->forums_theme == 'blue_theme') checked @endif />
                                    <label for="forumsblue" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="forums_theme" value="green_theme" id="forumsgreen"
                                    @if(isset($setting) && $setting->forums_theme == 'green_theme') checked @endif />
                                    <label for="forumsgreen" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="forums_theme" value="orange_theme" id="forumsorange"
                                    @if(isset($setting) && $setting->forums_theme == 'orange_theme') checked @endif />
                                    <label for="forumsorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="forums_theme" value="red_theme"  id="forumsred"
                                    @if(isset($setting) && $setting->forums_theme == 'red_theme') checked @endif />
                                    <label for="forumsred"    style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label>
                                </li>
                            </ul>
                        </div>
                        <div class="theme_option_block red-b">
                            <h2>Others</h2>
                            <ul class="list-none">
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="others_theme" value="blue_theme" id="othersblue"
                                    @if(isset($setting) && $setting->others_theme == 'blue_theme') checked @endif />
                                    <label for="othersblue" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Blue</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="others_theme" value="green_theme" id="othersgreen"
                                    @if(isset($setting) && $setting->others_theme == 'green_theme') checked @endif />
                                    <label for="othersgreen" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Green</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="others_theme" value="orange_theme" id="othersorange"
                                    @if(isset($setting) && $setting->others_theme == 'orange_theme') checked @endif />
                                    <label for="othersorange" style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Orange</label>
                                </li>
                                <li style="padding: 0px 23px;">
                                    <input type="radio" name="others_theme" value="red_theme"  id="othersred"
                                    @if(isset($setting) && $setting->others_theme == 'red_theme') checked @endif />
                                    <label for="othersred"    style="color: #fff;margin-left: 5px;margin-bottom: 0px;">Red</label>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12" style="text-align:right;">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn-info btn"  value="Submit" style="background: #fff;color: #a80000;font-weight: bold;padding: 15px 45px;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</section>
@endsection
