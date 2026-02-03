
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Subscription</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
  <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css') }}">
    <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
   <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
   <style>
       .new-div{
           margin:0px 13px;
           width:165px;
           display: inline-block;
       }

   </style>
</head>
<livewire:cursor-style>
<body class="{{ $theme ? $theme : 'red_theme' }}" style="font-family:{{ $font }}">
    @include('front.layouts.header')
    <!-- secondary header-->
    @include('front.layouts.subscription_submenu')


<!-- main content start -->
<section class="dlc-wrapper">
    <div class="container-fluid">
         <div class="row">
            <div class="col-lg-2">
                <div class="subs-left">
                    <div class="subs-ad-top mb-4">
                        <img src="assets/images/long-add.webp" class="w-100" alt=""/>
                    </div>
                    <div class="subs-ad-bottom">
                        <img src="assets/images/add.webp" class="w-100" alt=""/>
                    </div>
                </div>
            </div>
             <div class="col-lg-8">
                <div class="subs-center">
                    <?php
                        $no_of_records_per_page = 20 ;
                        $offset = ($pageno-1) * $no_of_records_per_page;
                        $total_rows = $Usercontentdatacount ;
                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $counter = 0 ;
                            if(isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0 ){
                                foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){
                                    if($counter==0){
                                        echo '<div class="row">';
                                    }
                                    if($counter%5==0){
                                        echo '</div><div class="row">';
                                    }
                                    ?>
                                    <div class="new-div">
                                        <a href="{{URL('contentdetail/'.$UsercontentDataV['id'])}}">
                                            <div class="subs-boxx">
                                                <img src="{{$UsercontentDataV['thumbnail']}}" class="w-100" alt=""/>
                                                <h5 class="m-0">{{ucwords($UsercontentDataV['title'])}}</h5>
                                                <div class="clearfix subs-content">
                                                    <div class="float-left">
                                                        <span>{{$UsercontentDataV['username']}}</span>
                                                    </div>
                                                    <div class="float-right">
                                                        <span>{{ date('d M Y',strtotime($UsercontentDataV['created_at']))}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                    if(count($UsercontentData)==$UsercontentDataK+1){ echo '</div>';}
                                    $counter++ ;
                                }
                            }
                                ?>
                                <!-- row ends-->

                   <div class="pagination_subforums mt-5">
                          <ul class="list-none float-left">
                        <li><?php echo "Page ".$pageno." of ".$total_pages ?></li>
                        <li><a  style="color:#222;" href="{{URL('subscription/1')}}">First</a></li>
                        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                        <a style="color:#222;" href="<?php if($pageno <= 1){ echo '#'; } else { echo URL('subscription/'.$pageno-1); } ?>">Prev</a>
                        </li>

                        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a style="color:#222;" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo URL('subscription/'.$pageno+1); } ?>">Next</a>
                        </li>
                        <li><a style="color:#222;" href="{{URL('subscription/'.$total_pages)}}">Last</a></li>

                      </ul>

                  </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="subs-right">
                    <div class="subs-ad-top mb-4">
                        <img src="assets/images/long-add.webp" class="w-100" alt=""/>
                    </div>
                </div>
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
