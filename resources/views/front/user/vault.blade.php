
<!DOCTYPE html>

<html lang="en">

<head>

  <title>Vault</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
   <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css')}}">
   <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>

</head>
<livewire:cursor-style>
<body class="{{ $theme ? $theme : 'red_theme' }}" style="font-family:{{ $font }}">
    @include("front.layouts.headerstore")
    @include("front.layouts.webstorefilters")
    <!-- secondary header-->
    @include('front.layouts.subscription_submenu')
    <!-- main content start -->
<section class="red_wrapper">
    <div class="container">
        <h1>MY VAULT</h1>
        <?php
            foreach($CreatorcontentData as $CreatorcontentDataK => $CreatorcontentDataV){
                ?>
                <div class="watch-clip-box">
                    <div class="row">
                        <div class="col-lg-2">
                            <img  style="width: 110px;height: 110px;" src="{{ $CreatorcontentDataV->paidcontent->thumbnail }}" class="clip-image" alt=""/>
                        </div>
                        <div class="col-lg-7">
                            <div class="watch-clip-content">
                                <p class="font-weight-bold">{{ $CreatorcontentDataV->paidcontent->title }}</p>
                                <p><a href="{{ URL('webstoredetail/'.$CreatorcontentDataV['id']) }}">View Details</a></p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="watch-clip-right float-right">
                                <p>
                                    <a href="{{ URL('likevault/'.$CreatorcontentDataV['id']) }}"><img src="assets/images/like-icon.webp" alt=""></a>
                                    <a href="{{ URL('dislikevault/'.$CreatorcontentDataV['id']) }}"><img src="assets/images/dislike-icon.webp" alt=""></a>
                                </p>
                                <p class="mt-4"><a href="{{URL('donwload-file/',$CreatorcontentDataV['content'])}}">Download</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
        <!-- watch list end-->
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
                    © {{ date('Y') }}.  All rights reserved.
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

