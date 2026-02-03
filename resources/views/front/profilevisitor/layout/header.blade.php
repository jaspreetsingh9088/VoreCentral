@include("front.layouts.header");



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

                  <li class="nav-item active">

                    <a class="nav-link" href="{{URL($id.'/dashboard')}}">Activity</a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" href="{{URL($id.'/profilepost')}}">Profile Posts</a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" href="{{URL($id.'/about')}}">About</a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" href="{{URL($id.'/usergallery/all/latest')}}">Gallery</a>

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
