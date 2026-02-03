@section('style')
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <style>
        .about-banner:hover .cover-change, .about-banner:hover .cover-image-remove {
            display: block;
            z-index: 999999;
        }
        .cover-change, .cover-image-remove {
            position: absolute;
            right: 115px;
            color: white;
            border-radius: 50px;
            border: 1px solid white;
            padding: 10px;
            margin-right: 11px;
            display: none;
            top: 35px;
        }
        .cover-image-remove {
            right: 170px;
        }
        .profile-pic{
            width: 100%;
            position: relative;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-blend-mode: multiply;
            vertical-align: middle;
            text-align: center;
            color: transparent;
            transition: all .3s ease;
            text-decoration: none;
            cursor: pointer;
        }
        .profile-pic:hover {
            background-color: rgba(0, 0, 0, .5);
            z-index: 10000;
            color: #fff;
            transition: all .3s ease;
            text-decoration: none;

        }

        .profile-pic span {
            display: inline-block;
            padding-bottom: 4.5em;
            padding-top: 4.5em;
            font-size: 12px;
        }

        .profile_pic_input {
            display: none;
            cursor: pointer;
        }
        .fileToUpload{
            width : 100%;
            height: 100%;
            position: absolute;
        }
        .profile-image-remove {
            display: block;
            z-index: 999999;
            color: #EA4335;
        }
        .profile-image-remove:hover {
            color: #EA4335;
        }

    </style>
@endsection
<div class="col-lg-4 pr-0">

        <div class="user_about_sidebar">
            <div class="user_followers">
                <h4>Followers</h4>
                          <ul class="list-none">
                            <?php
                            if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
                            {
                            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                            ?>
                              <li>
                                  <div class="follower-image">
                                      <a href="{{URL('dashboard/'.$AllFollowerV['follow_by'])}}"><img src="{{$AllFollowerV['profile_pic']}}" class="mr-4" alt=""/></a>
                                  </div>
                                  <div class="follower-intro">
                                      <h5><a href="{{URL('dashboard/'.$AllFollowerV['follow_by'])}}">{{$AllFollowerV['username']}}</a></h5>
                                  </div>
                                   <div class="follower-btn">

                                      <a href="#">Following</a>

                                  </div>
                              </li>
                            <?php }} ?>


                          </ul>

                     </div>

                     <div class="user_following">

                        <h4>Following</h4>

                        <ul class="list-none">
                             <?php
                            if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
                            {
                            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
                            ?>
                              <li>

                                  <div class="follower-image">

                                      <a href="{{URL('dashboard/'.$AllFollowingV['follow_to'])}}"><img src="{{$AllFollowingV['profile_pic']}}" class="mr-4" alt=""/></a>

                                  </div>

                                  <div class="follower-intro">

                                      <h5><a href="{{URL('dashboard/'.$AllFollowingV['follow_to'])}}">{{$AllFollowingV['username']}}</a></h5>
                                  </div>

                                  <div class="follower-btn">

                                      <a href="#">Following</a>

                                  </div>

                              </li>
                            <?php }} ?>
                          </ul>

                     </div>

                     <div class="user_about">

                         <h4>About</h4>

                         <p>{{$myData['about']}}</p>

                     </div>

                     <div class="user_profile_info">

                         <h4>Profile Info</h4>
                         @if($general_privacy = '["show_orientation","show_vorerole_preference","show_gender" ]')
                        <ul class="list-none">

                          	<li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile rank  <span style="float:right;">{{ $myData['achivement'] }}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">{{($myData['creator']==1)?'creator':'User'}}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">{{($myData['moderator']==1)?'Moderator':'None'}}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of X <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Vore-Role <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></li>

                        </ul>
                    @elseif($general_privacy == '["show_orientation","show_gender"]' )
                        <ul class="list-none">

                          	<li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile rank  <span style="float:right;">{{ $myData['achivement'] }}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">User</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of X <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></li>
                            <!-- <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Vore-Role <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></li> -->

                        </ul>

                    @elseif($general_privacy == '["show_orientation","show_vorerole_preference"]')
                        <ul class="list-none">

                          	<li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile rank  <span style="float:right;">{{ $myData['achivement'] }}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">User</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of X <span style="float:right;">None</span></li>
                            <!-- <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></li> -->
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Vore-Role <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></li>

                        </ul>

                    @elseif($general_privacy == '["show_gender","show_vorerole_preference"]')
                        <ul class="list-none">

                          	<li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile rank  <span style="float:right;">{{ $myData['achivement'] }}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">User</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of X <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Vore-Role <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></li>

                        </ul>

                    @elseif($general_privacy == '["show_orientation"]')
                       <ul class="list-none">

                          	<li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile rank  <span style="float:right;">{{ $myData['achivement'] }}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">User</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of X <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Vore-Role <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></li>

                        </ul>

                    @elseif($general_privacy ==  '["show_vorerole_preference"]')
                        <ul class="list-none">

                          	<li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile rank  <span style="float:right;">{{ $myData['achivement'] }}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">User</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of X <span style="float:right;">None</span></li>
                            <!-- <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></li> -->
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Vore-Role <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></li>

                        </ul>

                    @elseif($general_privacy == '["show_gender"]')
                        <ul class="list-none">

                          	<li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile rank  <span style="float:right;">{{ $myData['achivement'] }}</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">User</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of X <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData['gender'])}}</span></li>
                            <!-- <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Vore-Role <span style="float:right;">{{ ucwords($myData['role_preference']) }}</span></li> -->

                        </ul>


                    @endif
                     </div>

                </div>

             </div>
@push('script')
    {{-- <script src="{{ url('public/assets/js/common.js') }}"></script> --}}
    {{-- <script src="{{ url('public/assets/js/formsubmit.js') }}"></script> --}}
    {{-- <script src="{{ url('public/assets/js/pusher.js') }}"></script> --}}
    <script>
        $('.cover-change').click(function(){
            $('.cover-upload').show();
        })
        $(document).ready(function() {
            $('.cover-upload').hide();
            $('.profile-upload').hide();
            $(".user-profile-picture a").click(function() {
                $('.profile-upload').show();
            });
            $(".add-banner-image").click(function() {
                $('.cover-upload').show();
            });
            $(".close-icon").click(function() {
                $(this).parent().parent().parent().parent().hide();
            });
            $(".follow-unfollow").click(function() {
                $(this).text(function(i, text) {
                    return text === "Follow" ? "Unfollow" : "Follow";
                })
            });
        });
        // var pusher = new Pusher('d3986ff37b338af68d24', {
        //     encrypted: true
        // });
        // var channel = pusher.subscribe('comment-notification');
        // channel.bind('App\\Events\\CommentNotification', function(data) {
        //     // this is called when the event notification is received...
        //     console.log(data);
        // });
    </script>
    <script>
        document.getElementById('fileToUpload').addEventListener('change', function() {
            var formData = new FormData(document.getElementById('upload-form'));
            var file = document.getElementById('fileToUpload').files[0];
            formData.append("file", file);
            $.ajax({
                url: '{{ route('updateprofilepic') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.code === 200) {
                        location.reload();
                    }
                }
            });
        });
    </script>
@endpush
