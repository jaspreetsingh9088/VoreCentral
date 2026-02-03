
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
  <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
  <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
</head>
<body class="blue_theme bg_pattern">
    @include('front.layouts.header')

    <!-- main content start -->
    <section class="viewhistory-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                    <div class="news_archieve_wrapper about_content">
                        <p>Welcome to VoreCentral!!&nbsp; &nbsp;  We're happy to have you interested in viewing our website. At the moment, we are doing closed alpha testing for the website, so in case you have been invited, just enter the code you've been given below and you're good to go! In any case, we will be opening to everyone within a few months to be sure, so keep an eye out and we'd love to have</p>
                        <p class=" pb-5">YOU as one of our visitors, users, or creators!! Cheers!</p>

                        <p><a href="{{route('signupview')}}" class="archieve_btn">Register new user</a></p>
                        <p><a href="{{route('login')}}" class="archieve_btn">Log in as existing user</a></p>
                        <div class="visitor-ad-box">
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
                   {{-- <ul class="social-media mb-3">
                       <li>
                           <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                           <img src="{{ url('public/assets/images/youtube.png') }}" alt="">
                           </a>
                       </li>
                       <li>
                           <a href="{{ env('APP_TWITTER_LINK', '#') }}">
                           <img src="{{ url('public/assets/images/twitter.png') }}" alt="">
                           </a>
                       </li>
                   </ul> --}}
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
@include('front.layouts.script')
</body>
</html>
