
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Technical Option</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="description"
             content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
      <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
      <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
      <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
      <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
</head>
<livewire:cursor-style>
   <body class="blue_theme bg_pattern">
      <header id="header" class="equal-menus">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
               <div class="navbar-top">
                  <div class="d-flex justify-content-between align-items-center">
                     <div>
                        <a class="navbar-brand" href="{{ route('home') }}">HOME</a>
                     </div>
                     @include('front.layouts.navbar-top')
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
                              <li><button class="navbar-close"><img src="{{ url('public/assets/images/close.png') }}" alt=""></button> </li>
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
                        </div>
                     </div>
                  </div>
               </div>
            </nav>
         </div>
      </header>
      <!-- secondary header-->
      @include('front.setting.layout.secondary-header')
      <!-- main content start -->
      <section class="viewhistory-wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-1">
               </div>
               <div class="col-lg-10">
                  <div class="view_history-outer p-0 m-0">
                     <div class="news_archieve_wrapper technical_content">
                       <p>Users might wanan be able to pick resolutionrate and settings that affect how quickly the website runs etc. Other than that, if theres any settings that youve always wished all websites should have, that you get annoyed when websites dont have, here is where youd get to put those in! If not, just one for resolutionrate and one for like, performance should do</p>
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
