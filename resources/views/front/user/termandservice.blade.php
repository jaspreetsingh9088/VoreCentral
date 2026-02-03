<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
   <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}" />
   <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
</head>
<body class="blue_theme bg_pattern">
    <header id="header" class="equal-menus">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="navbar-top">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <a class="navbar-brand" href="#">HOME</a>
                </div>
                <span class="noti-icon">
                    <a href="#" class=""><img src="assets/images/notification.png" alt=""/></a>
                </span>
              </div>
            </div>
            <div class="navbar-bottom">
              <div class="">

                <div>
                  <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto nav-justify text-center w-100">
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
                        @if(Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('forum')}}">Forums</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL('subscription/1') }}">MY ARTISTS</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>
                        </li>
                        @if (Auth::check())
                            @if(Auth::user()->creator == 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL('/dashboard')}}">My page</a>
                                </li>
                            @elseif(Auth::user()->creator == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL('/creatordashboard')}}">Creator Dashboard</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mytopics') }}">MY TOPICS</a>
                            </li>
                        @endif
                    </ul>
                  </div>
                </div>


              </div>
            </div>
          </nav>
        </div>
      </header>

<!-- main content start -->
<section class="viewhistory-wrapper">
  <div class="container-fluid">
       <div class="row">
           <div class="col-lg-1">
           </div>
            <div class="col-lg-10">
                <div class="news_archieve_wrapper mt-0 terms_page">
                    <div class="terms_privacy">
                      <p>Terms of Service smygplagiatmonster:</p>
                      <p>Please read these Terms of Service ("Terms") carefully. They contain the legal terms and conditions that govern your use of services provided to you by VoreCentral, including information, text, images, graphics, data or other materials ("Content") and products and services provided through <a href="www.vorecentral.com">www.vorecentral.com</a>, <a href="www.vorecentral.com/shop">www.vorecentral.com/shop</a> , and other FibreEclipse applications as well as all elements, software, programs and code forming or incorporated in to www.vorecentral.com (the "Service"). Our Website allows content providers to upload media files for purchase by other members of the Website, and this Agreement governs the terms related to Your Content and Our distribution of it to other Users. This Service is operated by FibreEclipse, Inc. ("FibreEclipse"). FibreEclipse is also referred to in these Terms as "we", "our", and "us".</p>
                      <p>By accessing, using or visiting <a href="www.vorecentral.com">www.vorecentral.com</a> (the "Website"), any of its content, functionalities and services, you signify your agreement to these Terms of Service and our Privacy Policy and incorporated herein by reference.</p>

                    </div>
                    <div class="pagination_subforums my-4 text-center">
                            <ul class="list-none">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                            </ul>
                        </div>
                     <div class="news_adsquare contact_ad mx-auto">
                         <img src="assets/images/add_b.webp" class="w-100" alt="">
                      </div>
                </div>
           </div>
            <div class="col-lg-1">
           </div>
      </div>
  </div>
</section>
<footer>
 <div class="footer-bottom">
    <div class="container">
       <div class="row">
          <div class="col-sm-12">
             <div class="d-sm-flex justify-content-between align-items-center">
                <div class="fs-14 font-weight-600">
                   <ul class="footer_menu">
                    <li>
                        <a href="{{ URL('contactus') }}">Contact us</a>
                    </li>

                    <li>
                        <a href="{{ URL('aboutus') }}">About us</a>
                    </li>

                    <li>
                        <a href="{{ route('privacypolicy') }}">Privacy Policy</a>
                    </li>

                    <li>
                        <a href="{{route('termsservice')}}">Terms of Service</a>
                    </li>
                   </ul>
                   © 2022. All rights reserved.
                </div>
                 <ul class="social-media mb-3">
                     <li>
                         <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                             <i class="mdi mdi-youtube"></i>
                             <span class="sr-only">{{ env('APP_NAME')  }} Youtube</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ env('APP_TWITTER_LINK', '#') }}">
                             <i class="mdi mdi-twitter"></i>
                             <span class="sr-only">{{ env('APP_NAME')  }} Twitter</span>
                         </a>
                     </li>
                 </ul>
             </div>
          </div>
       </div>
    </div>
 </div>
</footer>
</body>
</html>
