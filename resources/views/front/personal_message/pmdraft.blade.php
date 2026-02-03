@extends('front.personal_message.layout.app')
@section('title', 'Draft')
@section('content')
    <section class="pm-inbox-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 pr-0">
                    <div class="pm-inbox-left">
                        <div class="pminbox_sidebar">
                            <ul class="list-none">
                                <li><a href="{{ route('pminbox')}}">Inbox</a></li>
                                <li><a href="{{ route('pmsendmessage')}}">Sent messages</a></li>
                                <li><a href="{{route('newpm')}}">New PM</a></li>
                                <li><a href="{{route('pmsendmessage')}}">Message users</a></li>
                                <li><a href="{{route('pmfriends')}}">Friends</a></li>
                                <li class="page_active" ><a href="{{route('pmdraft')}}">Drafts</a></li>
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
                                        @if(count($draft) > 0)
                                            @foreach($draft as $drafts)
                                                <li>
                                                    <div class="pm-inbox-main">
                                                        <div class="pm-friends-row pm-inbox-row-left">
                                                            <div class="friend-image">
                                                                @if(!is_null($drafts->user))
                                                                    <img src={{ $drafts->user->profile_pic }} alt=""/>
                                                                @endif
                                                            </div>
                                                            <div class="friend-content">
                                                                <h4 class="m-0">{{$drafts->username}}</h4>
                                                                <p class="m-0">{{$drafts->role_preference}}</p>
                                                                <p class="m-0">{{$drafts->subject}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="pm-inbox-row-right">
                                                            @php
                                                                // ****************************************** START POSTS ON PM SETTING ******************************************
                                                                    $setting_radio_group = App\Models\NotificationPrivacyOption::where('user_id',$drafts->uid)->pluck('radio_group')->first();
                                                                    $radio_group = 1;
                                                                    if($setting_radio_group == 'followers'){
                                                                        $radio_group  = App\Models\Follow::where('follow_by',$drafts->uid)->where('follow_to',Auth::id())->count();
                                                                    }else if($setting_radio_group == 'followed'){
                                                                        $radio_group = App\Models\Follow::where('follow_to',$drafts->uid)->where('follow_by',Auth::id())->count();
                                                                    }else if($setting_radio_group == 'all'){
                                                                        $radio_group = 1;
                                                                    }
                                                                // ****************************************** END POSTS ON PM SETTING ******************************************
                                                            @endphp
                                                            @if($radio_group == 1)
                                                                <a href="{{route('sendMsgtoUser', $drafts->id)}}" class="inbox-view-message">Send message</a>
                                                            @endif
                                                            {{-- <a href="{{route('sendMsgtoUser', $drafts->id)}}" class="inbox-view-message">Send message</a> --}}
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <h3 class="text-center">Not any draft message</h3>
                                        @endif
                                    </ul>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 pl-0">
                            <div class="pm-inbox-right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
