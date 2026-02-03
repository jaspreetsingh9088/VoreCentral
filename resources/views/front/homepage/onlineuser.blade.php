@extends('front.homepage.layout.app')
@section('title', 'Online User')
@section('content')
    <section class="viewhistory-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="history_search_box mt-5 mb-5 user-online-search">
                        <form action="{{ route('onlineuser.search') }}">
                            @csrf
                            <input type="search" name="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </form>
                    </div>

                    <div class="advertisment-box" style="clear:both; text-align:center;">
                        <div class="ad_banner landscape">
                            <div data-banner-id="425470"></div>
                        </div>
                    </div>

                    <div class="view_history-outer p-0 mt-5" style="clear:both;">
                        <?php if(isset($AllUsersdata) && is_array($AllUsersdata) && count($AllUsersdata) > 0){
                            foreach($AllUsersdata as $AllUsersdataK => $AllUsersdataV){ ?>
                                <div class="user_online_odd">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="user_profile_fig">
                                                <img src="{{$AllUsersdataV['profile_pic']}}" class="w-100" alt=""/>
                                            </div>
                                            <div class="user_online_content">
                                                @if($AllUsersdataV['creator'] == 1)
                                                    <a href="{{URL($AllUsersdataV['id'].'/creatordashboard')}}">
                                                @else
                                                    <a href="{{ URL($AllUsersdataV['id'].'/dashboard/') }}">
                                                @endif
                                                    <h4>{{$AllUsersdataV['username']}}</h4>
                                                </a>
                                                <p>
                                                    Type of user :
                                                    @if($AllUsersdataV['creator'] == 1)
                                                        Creator
                                                    @else
                                                        User
                                                    @endif
                                                </p>
                                            @php
                                                $lastlogin = App\Models\Loginactivity::where('user_id',$AllUsersdataV['id'])->orderBy('id','DESC')->first();
                                                if(!is_null($lastlogin)){
                                                    if(date('Y-m-d') == date('Y-m-d', strtotime($lastlogin->created_at))){
                                                        $last_seen = 'Last Active ' . date('h:i a', strtotime($lastlogin->created_at));
                                                    }else{
                                                        $last_seen = 'Last Active ' . date('d/m/Y h:i a', strtotime($lastlogin->created_at));
                                                    }
                                                }
                                            @endphp
                                            @if(!is_null($lastlogin))
                                                <p>{{$last_seen}}</p>
                                            @endif
                                            <p>
                                                @if($AllUsersdataV['creator'] == 1)
                                                    <a href="{{URL($AllUsersdataV['id'].'/creatordashboard')}}">Creator Dashboard </a>
                                                @else
                                                    <a href="{{URL($AllUsersdataV['id'].'/dashboard/')}}">User Dashboard </a>
                                                @endif

                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                </div><?php
                            }
                        } ?>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>
@endsection
