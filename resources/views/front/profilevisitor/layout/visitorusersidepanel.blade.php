  <div class="col-lg-4 pr-0">

                <div class="user-profile-picture dashboard-66-picture">
                    
                    <img src="{{$myData[0]['profile_pic']}}" alt=""/>

                </div>



                <div class="user_about_sidebar">
                <div style="text-align:center;color:white;margin-bottom:10px;">{{$myData[0]['username']}} </div>

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
                                            <a href="{{URL('dashboard/'.$AllFollowingV['follow_to'])}}">
                                                <img src="{{$AllFollowingV['profile_pic']}}" class="mr-4" alt=""/>
                                            </a>
                                        </div>
                                        <div class="follower-intro">
                                            <h5>
                                                <a href="{{URL('dashboard/'.$AllFollowingV['follow_to'])}}">{{$AllFollowingV['username']}}</a>
                                            </h5>
                                        </div>
                                        <div class="follower-btn">
                                            <a href="#">Following</a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            } ?>
                        </ul>
                    </div>
                     <div class="user_about">

                         <h4>About</h4>

                         <p>{{$myData[0]['about']}}</p>

                     </div>

                     <div class="user_profile_info">

                         <h4>Profile Info</h4>
                        <ul class="list-none">
                            @isset($myData[0]['achivement'])
                                <li>
                                    <i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>
                                    Profile rank
                                    <span style="float:right;">{{ $myData[0]['achivement'] }}</span>
                                </li>
                            @endif
                            @php
                                use Carbon\Carbon;
                                $daysAgo = Carbon::parse($myData[0]['created_at'])->diffInDays(Carbon::now());
                            @endphp
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Profile Type <span style="float:right;">User</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Administration Status <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of uploads <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of threads started <span style="float:right;">None</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Number of comments <span style="float:right;">0</span></li>
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Has been a member of {{ $daysAgo }} days <span style="float:right;">None</span></li>
                            @php
                                if($general_setting){
                                    if($general_setting->general_privacy != null){
                                        $general_privacy = json_decode($general_setting->general_privacy);
                                    }else{
                                        $general_privacy = null;
                                    }
                                }else{
                                    $general_privacy = null;
                                }
                            @endphp
                            @if($general_privacy != null && in_array('show_gender',$general_privacy))
                            <li><i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Gender <span style="float:right;">{{ucwords($myData[0]['gender'])}}</span></li>
                            @endif
                            @if($general_privacy != null && in_array('show_vorerole_preference',$general_privacy))
                                <li>
                                    <i class="fa fa-angle-double-right mr-4" aria-hidden="true"></i>Pred/prey/Switch/Observer/None
                                    <span style="float:right;">{{ ucwords($myData[0]['role_preference']) }}</span>
                                </li>
                            @endif

                        </ul>

                     </div>

                </div>

             </div>
