@extends('front.personal_message.layout.app')
@section('title', 'Send Message')
@section('style')
        <style>
            .pm-inbox-row-right {
                width: 100%;
                margin-top: -65px;
                float: left;
                text-align: right;
            }
        </style>
@endsection
@section('content')
<section class="pm-inbox-wrapper">
    <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3 pr-0">
                <div class="pm-inbox-left">
                    <div class="pminbox_sidebar">
                        <ul class="list-none">
                            <li><a href="{{ route('pminbox')}}">Inbox</a></li>
                            <li class="page_active" ><a href="{{ route('pmsendmessage')}}">Sent messages</a></li>
                            <li><a href="{{route('newpm')}}">New PM</a></li>
                            <li><a href="{{route('pmsendmessage')}}">Message users</a></li>
                            <li><a href="{{route('pmfriends')}}">Friends</a></li>
                            <li ><a href="{{route('pmdraft')}}">Drafts</a></li>
                            <li><a href="{{ route('socialOption')}}">Social Options</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                 <div class="pm-inbox-adspace">
                
                    <div class="ad_banner landscape">
                        <div data-banner-id="425470"></div>
                    </div>


                 </div>
                 <div class="row">
                    <div class="col-lg-8 p-0">
                        <div class="pm-inbox-middle pm-friends">
                            <ul class="list-none">
                                <ul class="list-none">
                                    @if(count($data) > 0)
                                        @foreach ($data as $messages)
                                            <li>
                                                <div class="pm-inbox-main">
                                                    <div class="pm-friends-row pm-inbox-row-left">
                                                        <div class="friend-image">
                                                            @if(!is_null($messages->user))
                                                                <img src={{ $messages->user->profile_pic }} alt=""/>
                                                            @endif
                                                        </div>
                                                        <div class="friend-content">
                                                            <h4 class="m-0">{{$messages->username}}</h4>
                                                            <p class="m-0">{{$messages->role_preference}}</p>
                                                            <p class="m-0">{{$messages->subject}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="pm-inbox-row-right">
                                                        <a href="{{route('pminbox_message_view', $messages->id)}}" class="inbox-view-message">View message</a>
                                                        @php
                                                            // ****************************************** START POSTS ON PM SETTING ******************************************
                                                                $setting_radio_group = App\Models\NotificationPrivacyOption::where('user_id',$messages->uid)->pluck('radio_group')->first();
                                                                $radio_group = 1;
                                                                if($setting_radio_group == 'followers'){
                                                                    $radio_group  = App\Models\Follow::where('follow_by',$messages->uid)->where('follow_to',Auth::id())->count();
                                                                }else if($setting_radio_group == 'followed'){
                                                                    $radio_group = App\Models\Follow::where('follow_to',$messages->uid)->where('follow_by',Auth::id())->count();
                                                                }else if($setting_radio_group == 'all'){
                                                                    $radio_group = 1;
                                                                }
                                                            // ****************************************** END POSTS ON PM SETTING ******************************************
                                                        @endphp
                                                        @if($radio_group == 1)
                                                            <a href="{{route('sendMsgtoUser', $messages->id)}}" class="inbox-view-message">Send message</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <h3 class="text-center">Does not any send message </h3>
                                    @endif
                                </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 pl-0">
                        <div class="pm-inbox-right">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
