@extends('front.homepage.setting.layout.app')

@section('title', 'Notification and Privacy')
@section('style')
    <style>
        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
@endsection
@section('content')
    <section class="viewhistory-wrapper">
        <div class="container-fluid">
            <form method="post" action="{{ route('notificationOptionStore')}}">
                <input type="hidden" name="_token" value="dxVqHESe1xqX4vlRNrmEmugrGzkHQazOchOnS9qd">
                @csrf
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="view_history-outer p-0 m-0">
                            <div class="news_archieve_wrapper tags_warp">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="news_archieve_odd privacy_box">
                                            <div class="src_sort_box">
                                                <h2>Who can view my profile:</h2>
                                                <div class="mt-3">
                                                    <div class="form-group">
                                                        <input type="radio" id="test1" value="Everyone" name="profileview_access"
                                                        @if(isset($setting) && $setting->profileview_access != null && $setting->profileview_access == 'Everyone') checked @endif>
                                                        <label for="test1">Everyone</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="radio" id="test2" value="registered" name="profileview_access"
                                                        @if(isset($setting) && $setting->profileview_access != null && $setting->profileview_access == 'registered') checked @endif>
                                                        <label for="test2">Registered users</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="radio" id="test3" value="followers" name="profileview_access" @if(isset($setting) && $setting->profileview_access != null && $setting->profileview_access == 'followers') checked @endif>
                                                        <label for="test3">Followers only</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="radio" id="test4" value="Nobody" name="profileview_access" @if(isset($setting) && $setting->profileview_access != null && $setting->profileview_access == 'Nobody') checked @endif>
                                                        <label for="test4">Nobody(private)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="news_archieve_even privacy_box">
                                            <div class="src_sort_box">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h2>Gallery Notifications</h2>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    @php
                                                        if(isset($setting)){
                                                            $gallery_noti = json_decode($setting->gallary_notification);
                                                        }else{
                                                            $gallery_noti = null;
                                                        }
                                                    @endphp
                                                    <div class="form-group">
                                                        <input type="checkbox" id="default21" name="gallary_notification[]" value="like"
                                                        @if($gallery_noti != null && in_array('like',$gallery_noti)) checked @endif>
                                                        <label for="default21">Someone likes my item</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" id="default21" name="gallary_notification[]" value="dislike"
                                                        @if($gallery_noti != null && in_array('dislike',$gallery_noti)) checked @endif>
                                                        <label for="default21">Someone dislikes my item</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" id="pritag22" name="gallary_notification[]" value="comment"
                                                        @if($gallery_noti != null && in_array('comment',$gallery_noti)) checked @endif>
                                                        <label for="pritag22">Someone comments on my item</label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class=" mt-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="default13" name="gallary_notification[]" value="newitem"
                                                                    @if($gallery_noti != null && in_array('newitem',$gallery_noti)) checked @endif>
                                                                    <label for="default13">New item with more than 75% of my tags is uploaded</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- row ends-->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="news_archieve_even privacy_box">
                                            <div class="src_sort_box">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h2>Activity:</h2>
                                                        <div class=" mt-3">
                                                            @php
                                                                if(isset($setting)){
                                                                    $activity = $setting->activity;
                                                                }else{
                                                                    $activity = null;
                                                                }
                                                            @endphp
                                                            <div class=" mt-3">
                                                                <div class="form-group w-100 d-block">
                                                                    <input type="radio" id="default133" name="activity" value="showlikes"
                                                                    @if($activity != null && $activity == 'showlikes') checked @endif>
                                                                    <label for="default133">Show my likes and favorites</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="radio" id="test11" name="activity" value="showall"
                                                                @if($activity != null && $activity == 'showall') checked @endif>
                                                                <label for="test11">Show all</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="radio" id="test31" name="activity" value="hideProfileStatus"
                                                                @if($activity != null && $activity == 'hideProfileStatus') checked @endif>
                                                                <label for="test31">Hide profile stats</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="news_archieve_odd privacy_box">
                                            <div class="src_sort_box">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h2>Subscriptions Notifications:</h2>
                                                    </div>
                                                </div>
                                                <div class=" mt-3">
                                                    @php
                                                        if(isset($setting)){
                                                            $subscription = json_decode($setting->subscription);
                                                        }else{
                                                            $subscription = null;
                                                        }
                                                    @endphp
                                                    <div class="form-group">
                                                        <input type="checkbox" id="default231" name="subscription[]" value="subscribe_uploads"
                                                        @if($subscription != null && in_array('subscribe_uploads',$subscription)) checked @endif>
                                                        <label for="default231">Subscribee uploads</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" id="pritag232" name="subscription[]" value="uploads_webstore"
                                                        @if($subscription != null && in_array('uploads_webstore',$subscription)) checked @endif>
                                                        <label for="pritag232">Subscribe uploads to the webstore</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- row ends-->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="news_archieve_odd privacy_box">
                                            <div class="col-lg-12">
                                                <div class="src_sort_box p-0">
                                                    <h2>Posts on userpage:</h2>
                                                    <div class=" mt-3">
                                                        <div class="form-group">
                                                            <input type="radio" id="test33" name="post_access" value="followers"
                                                            @if(isset($setting) && $setting->post_access != null && $setting->post_access == 'followers') checked @endif>
                                                            <label for="test33">Followers</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="radio" id="test44" name="post_access" value="followed"
                                                            @if(isset($setting) && $setting->post_access != null && $setting->post_access == 'followed') checked @endif>
                                                            <label for="test44">People I follow</label>
                                                        </div>
                                                        <div class="form-group m-0">
                                                            <input type="radio" id="test12" name="post_access" value="all"
                                                            @if(isset($setting) && $setting->post_access != null && $setting->post_access == 'all') checked @endif>
                                                            <label for="test12">People I follow, & followers</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="news_archieve_even privacy_box">
                                            <div class="src_sort_box">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h2>General Privacy:</h2>
                                                    </div>
                                                </div>
                                                <div class=" mt-3">
                                                    @php
                                                        if(isset($setting)){
                                                            $general_privacy = json_decode($setting->general_privacy);
                                                        }else{
                                                            $general_privacy = null;
                                                        }
                                                    @endphp
                                                    <div class="form-group">
                                                        <input type="checkbox" name="general_privacy[]" id="default130" value="show_vorerole"
                                                        @if($general_privacy != null && in_array('show_vorerole',$general_privacy)) checked @endif>
                                                        <label for="default130">Show vorerole preference</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="general_privacy[]" value="show_gender" id="default210"
                                                        @if($general_privacy != null && in_array('show_gender',$general_privacy)) checked @endif>
                                                        <label for="default210">Show gender</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="general_privacy[]" value="show_orientation" id="pritag220"
                                                        @if($general_privacy != null && in_array('show_orientation',$general_privacy)) checked @endif>
                                                        <label for="pritag220">Show orientation</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- row ends-->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="news_archieve_even privacy_box">
                                            <div class="src_sort_box p-0">
                                                <div class="col-lg-12">
                                                    <h2 class="">PM Settings:</h2>
                                                    <div class=" mt-3">
                                                        <div class="form-group">
                                                            <input type="radio" id="test033" name="radio_group" value="followers"
                                                            @if(isset($setting) && $setting->radio_group != null && $setting->radio_group == 'followers') checked @endif>
                                                            <label for="test033">Followers</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="radio" id="test044" name="radio_group" value="followed"
                                                            @if(isset($setting) && $setting->radio_group != null && $setting->radio_group == 'followed') checked @endif>
                                                            <label for="test044">People I follow</label>
                                                        </div>
                                                        <div class="form-group m-0">
                                                            <input type="radio" id="test012" name="radio_group" value="all"
                                                            @if(isset($setting) && $setting->radio_group != null && $setting->radio_group == 'all') checked @endif>
                                                            <label for="test012">People I follow, & Followers</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="news_archieve_even privacy_box">
                                            <div class="src_sort_box p-0">
                                                <div class="col-lg-12">
                                                    <h2 class="">Notifications Userpage:</h2>
                                                </div>
                                                <div class=" mt-3">
                                                    <div class="col-lg-12">
                                                        @php
                                                            if(isset($setting)){
                                                                $notification_userpage = json_decode($setting->notification_userpage);
                                                            }else{
                                                                $notification_userpage = null;
                                                            }
                                                        @endphp
                                                        <div class="form-group">
                                                            <input type="checkbox" id="default214" name="notification_userpage[]" value="comment_on_userpage"
                                                            @if($general_privacy != null && in_array('comment_on_userpage',$notification_userpage)) checked @endif>
                                                            <label for="default214">Comments on my userpage</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" id="pritag224" name="notification_userpage[]" value="update_from_user_i_follow"
                                                            @if($general_privacy != null && in_array('update_from_user_i_follow',$notification_userpage)) checked @endif>
                                                            <label for="pritag224">Status updates from users I follow</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" id="pritag234" name="notification_userpage[]" value="comment_like_on_my_userpage"
                                                            @if($general_privacy != null && in_array('comment_like_on_my_userpage',$notification_userpage)) checked @endif>
                                                            <label for="pritag234">Comments and likes on my userpage comments</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- row ends-->
                                <!-- row ends-->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="news_archieve_odd privacy_box">
                                            <div class="src_sort_box p-0">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h2 class="">Notifications forums:</h2>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            @php
                                                                if(isset($setting)){
                                                                    $notification_forum = json_decode($setting->notification_forum);
                                                                }else{
                                                                    $notification_forum = null;
                                                                }
                                                            @endphp
                                                            <div class="form-group ">
                                                                <input type="checkbox" id="default216" name="notification_forum[]" value="userquote_my_message"
                                                                @if($notification_forum != null && in_array('userquote_my_message',$notification_forum)) checked @endif>
                                                                <label for="default216">Userquotes my message</label>
                                                            </div>
                                                            <div class="form-group ">
                                                                <input type="checkbox" id="pritag226" name="notification_forum[]" value="user_mention_me"
                                                                @if($notification_forum != null && in_array('user_mention_me',$notification_forum)) checked @endif>
                                                                <label for="pritag226">User @mentions me</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="default216" name="notification_forum[]" value="post_in_thread_i_have_posted"
                                                                @if($notification_forum != null && in_array('post_in_thread_i_have_posted',$notification_forum)) checked @endif>
                                                                <label for="default216">Post in thread I've posted in</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="pritag226" name="notification_forum[]" value="post_in_thread_i_followed"
                                                                @if($notification_forum != null && in_array('post_in_thread_i_followed',$notification_forum)) checked @endif>
                                                                <label for="pritag226">Post in thread I follow</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="pritag236" name="notification_forum[]" value="post_in_thread_i_started"
                                                                @if($notification_forum != null && in_array('post_in_thread_i_started',$notification_forum)) checked @endif>
                                                                <label for="pritag236">Post in thread I've started</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="checkbox" id="pritag246" name="notification_forum[]" value="user_likes_my_post"
                                                                @if($notification_forum != null && in_array('user_likes_my_post',$notification_forum)) checked @endif>
                                                                <label for="pritag246">User likes my post</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="col-md-12">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="news_archieve_odd privacy_box">
                                            <div class="src_sort_box p-0">
                                                <div class="col-lg-12">
                                                    <h2 class="">Notifications DLC:</h2>
                                                </div>
                                                <div class=" mt-3">
                                                    <div class="col-lg-12">
                                                        @php
                                                            if(isset($setting)){
                                                                $notification_dlc = json_decode($setting->notification_dlc);
                                                            }else{
                                                                $notification_dlc = null;
                                                            }
                                                        @endphp
                                                        <div class="form-group">
                                                            <input type="checkbox" id="default215" name="notification_dlc[]" value="new_dlc_from_creators_i_follow"
                                                            @if($notification_dlc != null && in_array('new_dlc_from_creators_i_follow',$notification_dlc)) checked @endif>
                                                            <label for="default215">New DLC from creators I follow</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" id="pritag225" name="notification_dlc[]" value="somebody_download_my_dlc"
                                                            @if($notification_dlc != null && in_array('somebody_download_my_dlc',$notification_dlc)) checked @endif>
                                                            <label for="pritag225">Somebody downloads my DLC</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" id="pritag235" name="notification_dlc[]" value="somebody_reacts_to_my_dlc"
                                                            @if($notification_dlc != null && in_array('somebody_reacts_to_my_dlc',$notification_dlc)) checked @endif>
                                                            <label for="pritag235">Somebody reacts to my DLC</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group " style="padding: 40px 0px;">
                                            <input type="submit" name="submit" class="btn-info btn" value="Submit">
                                        </div>
                                    </div>
                                </div><!-- row ends-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </form>
        </div>
    </section>
@endsection