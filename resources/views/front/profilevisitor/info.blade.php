@extends('front.profilevisitor.layout.app')
@php
$title = 'Info';
@endphp
@section('title', $title)
@section('content')
<section class="user-about-sctn user-pg">
    <div class="container">
        <div class="row">
              @include('front.profilevisitor.layout.visitorusersidepanel')
            <div class="col-lg-8 pl-0">
                <div class="user-section1 auto-height" style="height:auto ; padding:30px;">
                	<div class="middle-part-padding">
                		<h2 class="profile-info-heading">Profile info</h2>
                        {{-- <div class="row mb-3"> --}}
                            <ul class="profile-listing">
                                @php
                                    if(!is_null($general_setting)){
                                        if($general_setting->general_privacy != null){
                                            $general_privacy = json_decode($general_setting->general_privacy);
                                        }else{
                                            $general_privacy = null;
                                        }
                                    }else{
                                        $general_privacy = null;
                                    }
                                @endphp
                                <li><strong>Profile rank  <span style="float:right;">{{ $userinfo['profile_rank'] }}</span></strong></li>
                                <li>
                                    <strong>Profile Type <span style="float:right;">{{ $userinfo['profile_type'] }}</span></strong>
                                </li>
                                <li>
                                    <strong>Administration Status <span style="float:right;">None</span></strong>
                                </li>
                                <li>
                                    <strong>Number of uploads <span style="float:right;">{{ $userinfo['upload_count'] }}</span></strong>
                                </li>
                                <li>
                                    <strong>Number of threads started <span style="float:right;">{{ $userinfo['thread_count'] }}</span></strong>
                                </li>
                                <li>
                                    <strong>Number of comments <span style="float:right;">{{ $userinfo['total_comment'] }}</span></strong>
                                </li>
                                <li>
                                    <strong>Has been a member for <span style="float:right;">{{ $userinfo['hasbeenmember'] }} Days</span></strong>
                                </li>
                                <li>
                                    <strong>Gender <span style="float:right;">{{ucwords($myData[0]['gender'])}}</span></strong>
                                </li>
                                @if($general_privacy != null && in_array('show_vorerole_preference',$general_privacy))
                                    <li><strong>Pred/prey/Switch/Observer/None <span style="float:right;">{{ ucwords($myData[0]['role_preference']) }}</span></strong></li>
                                @endif
                                @if($general_privacy != null && in_array('show_orientation',$general_privacy))
                                    <li>
                                        <strong>Sexual orientation
                                            <span style="float:right;">{{ ucwords($myData[0]['sexual_orientation']) }}</span>
                                        </strong>
                                    </li>
                                @endif
                            </ul>
                    </div>
                </div>
             </div>
        </div>
    </div>
</section>


@endsection
@push('script')
<script src="{{ asset('admin/js/common.js') }}"></script>
<script src="{{ asset('admin/js/formsubmit.js') }}"></script>
@endpush
