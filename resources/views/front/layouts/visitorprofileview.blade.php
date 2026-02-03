 <header id="own-creator-hearder" class="user-header">
          <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light">
                
              <div class="navbar-top">

                <div class="d-flex justify-content-between align-items-center">

              <div>
                    <a class="navbar-brand" href="#">User</a>
                  </div>

                    <ul class="navbar-top-right-menu">
                    	<li class="nav-item">
                    	    <?php if($isFollowing){ ?>
                    		<a href="{{URl('unfollow/'.$id)}}" class="nav-link">Un-Follow</a>
                    		<?php }else{ ?>
                    		<a href="{{ URl('follow/'.$id) }}" class="nav-link">Follow</a>
                    		<?php } ?>
                    	</li>
                        @include('front.layouts.navbar-top')
                   	</ul>


                </div>

              </div>

              <div class="navbar-bottom">

                <div class="">



                  <div>

                    <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                      <span class="navbar-toggler-icon"></span>

                    </button>

                    <div class="navbar-collapse justify-content-start collapse" id="navbarSupportedContent">

                      <ul class="navbar-nav d-lg-flex justify-content-around align-items-center w-100">

                        <li>

                          <button class="navbar-close">

                            <img src="{{ url('public/assets/images/close.png') }}" alt="">

                          </button>

                        </li>

                        <li class="nav-item active">

                          <a class="nav-link" href="{{ route('home') }}">Home</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{ route('publicgallery.featured') }}">gallery</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{ route('forum') }}">Forums</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{URL('subscription/1')}}">Subscription</a>

                        </li>



                        <li class="nav-item">

                          <a class="nav-link" href="{{ URL('dashboard') }}">My page</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{route('publicstore')}}">Store</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{route('generalSetting')}}">Options</a>

                        </li>



                        <li class="nav-item">

                          <a class="nav-link" href="#">Misc</a>

                              <ul class="submenu">

                               <li> <a class="" href="{{URL('aboutus')}}">About us</a></li>

                              <li> <a class="" href="{{URL('contactus')}}">Contact us</a></li>

                              <li> <a class="" href="#">Content produced and promoted </a></li>

                              <li> <a class="" href="#">Creator Information and Monetasation</a></li>

                              <li> <a class="" href="#">Help and Support</a></li>

                              <li> <a class="" href="#">Information about different subjects</a></li>

                              <li> <a class="" href="{{URL('news_archieve')}}">News archive</a></li>

                              <li> <a class="" href="{{URL('ourstaff')}}">Our staff</a></li>

                              <li> <a class="" href="{{route('privacypolicy')}}">Privacy Policy and Terms of service</a></li>

                              </ul>

                        </li>

                      </ul>

                    </div>

                  </div>





                </div>

              </div>

            </nav>

          </div>

        </header>



<!-- main content start -->

<!-- user about banner-->

<section class="about-banner cover-banner" style="background:url({{$myData[0]['cover_pic']}});" >

</section>

<!-- user about banner-->

<!--second naigation start -->

<div class="profile-nav">

    <div class="container">

    <nav class="navbar navbar-expand-lg navbar-light">

              <div class="navbar-bottom ml-auto">

                <div class="">



                  <div>

                    <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                      <span class="navbar-toggler-icon"></span>

                    </button>

                    <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">

                      <ul class="navbar-nav d-lg-flex justify-content-between align-items-center w-100">

                        <li>

                          <button class="navbar-close">

                            <img src="{{ url('public/assets/images/close.png') }}" alt="">

                          </button>

                        </li>

                        <li class="nav-item active">

                          <a class="nav-link" href="{{URL('dashboard/'.$id)}}">Activity</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{URL($id.'/profilepost')}}">Profile Posts</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{URL($id.'/about')}}">About</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{URL($id.'/gallery/all')}}">Gallery</a>

                        </li>



                        <li class="nav-item">

                          <a class="nav-link" href="{{URL($id.'/rpstatus')}}">RP-Status</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{URL($id.'/favoriteartwork')}}">Favorited Artwork</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{URL($id.'/info')}}">Info</a>

                        </li>

                        <li class="nav-item">

                          <a class="nav-link" href="{{URL($id.'/journal')}}">Journal</a>

                        </li>

                      </ul>

                    </div>

                  </div>





                </div>

              </div>

            </nav>

            <!-- second navigation end-->

        </div>

</div>
