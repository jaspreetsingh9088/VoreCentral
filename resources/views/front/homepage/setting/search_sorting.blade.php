@extends('front.homepage.setting.layout.app')
@section('title', 'Search Sorting')
@section('content')
<section class="viewhistory-wrapper">
    <div class="container-fluid">
       <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="view_history-outer p-0 m-0">
                    <div class="news_archieve_wrapper tags_warp">
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success w-50">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif
                        <form action="{{route('search.sorting.store')}}" method="post">
                            @csrf
                            <div class="news_archieve_odd src-sort">
                                <div class="src_sort_box">
                                    <h2>Gallery Searches</h2>
                                    <div class="src_checks">
                                        @php
                                            if(isset($setting)){
                                                $gallery_search = $setting->gallery_search;
                                                $gs_nonevore = $setting->gs_nonevore;
                                            }else{
                                                $gallery_search = null;
                                                $gs_nonevore = null;
                                            }
                                        @endphp
                                        <div class="form-group">
                                            <input type="radio" id="default" name="gallery_search" value="default_setting"
                                            @if($gallery_search != null && $gallery_search == 'default_setting') checked @endif>
                                            <label for="default">Default settings</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="pritag" name="gallery_search" value="priortise_my_tag"
                                            @if($gallery_search != null && $gallery_search == 'priortise_my_tag') checked @endif>
                                            <label for="pritag">Priortise my tags</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="showv" name="gallery_search" value="priortise_popularity"
                                            @if($gallery_search != null && $gallery_search == 'priortise_popularity') checked @endif>
                                            <label for="showv">Priortise popularity</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="prir" name="gallery_search" value="priortise_recency"
                                            @if($gallery_search != null && $gallery_search == 'priortise_recency') checked @endif>
                                            <label for="prir">Priortise Recency</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="default1" name="gallery_search_nonvore" value="1"
                                            @if($gs_nonevore != null && $gs_nonevore == '1') checked @endif>
                                            <label for="default1">Show non-vore content</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="news_archieve_even src-sort">
                                <div class="src_sort_box">
                                    <h2>Forum Searches</h2>
                                    <div class="src_checks">
                                        @php
                                            if(isset($setting)){
                                                $forum_search = $setting->forum_search;
                                            }else{
                                                $forum_search = null;
                                            }
                                        @endphp
                                        <div class="form-group">
                                            <input type="radio" id="default21" name="forum_search" value="include_post_index"
                                            @if($forum_search != null && $forum_search == 'include_post_index') checked @endif>
                                            <label for="default21">Include posts in index</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="pritag22" name="forum_search" value="include_userpage"
                                            @if($forum_search != null && $forum_search == 'include_userpage') checked @endif>
                                            <label for="pritag22">Include userpages</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="showv23" name="forum_search" value="include_post_userpage"
                                            @if($forum_search != null && $forum_search == 'include_post_userpage') checked @endif>
                                            <label for="showv23">Include posts on userpages</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="default13" name="forum_search" value="include_homesite_material"
                                            @if($forum_search != null && $forum_search == 'include_homesite_material') checked @endif>
                                            <label for="default13">Include homesite material</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="news_archieve_odd src-sort">
                                <div class="src_sort_box">
                                    <h2>Webstore Searches</h2>
                                    <div class="src_checks">
                                        @php
                                            if(isset($setting)){
                                                $webstore_search = $setting->webstore_search;
                                                $ws_nonvore = $setting->ws_nonvore;
                                            }else{
                                                $webstore_search = null;
                                                $ws_nonvore = null;
                                            }
                                        @endphp
                                        <div class="form-group">
                                            <input type="radio" id="default12" name="webstore_search" value="use_webstore_algorithm"
                                            @if($webstore_search != null && $webstore_search == 'use_webstore_algorithm') checked @endif>
                                            <label for="default12">Use webstore algorithm</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="pritag1" name="webstore_search" value="use_gallery_algorithm"
                                            @if($webstore_search != null && $webstore_search == 'use_gallery_algorithm') checked @endif>
                                            <label for="pritag1">Use Gallery algorithm</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="showv1" name="webstore_search" value="include_only_creator"
                                            @if($webstore_search != null && $webstore_search == 'include_only_creator') checked @endif>
                                            <label for="showv1">Include only creators</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="prir24" name="webstore_search" value="index_every_creator"
                                            @if($webstore_search != null && $webstore_search == 'index_every_creator') checked @endif>
                                            <label for="prir24">Index every creator</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" id="default11" name="webstore_search_nonvore" value="1"
                                            @if($ws_nonvore != null && $ws_nonvore == '1') checked @endif>
                                            <label for="default11">Show non-vore content</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="text-align:right;">
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn-info btn"  value="Submit" style="background: #fff;color: #a80000;font-weight: bold;padding: 15px 45px;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</section>
 @endsection
