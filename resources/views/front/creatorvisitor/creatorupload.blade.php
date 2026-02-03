<!DOCTYPE html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="description"
    content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
  <title>Creatore Upload</title>
  <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}" />
  <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">



  <!-- inject:css -->
  <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css')}}">
  <link rel="stylesheet" href="{{ url('public/assets/css/style.css')}}">

  <style>
    .popup-background {
      background: rgba(0, 0, 0, 0.5);
      position: fixed;
      top: 0;
      width: 100%;
      height: 100%;
    }

    .popup-background-outter {
      display: table;
      width: 100%;
      height: 100%;
    }

    .popup-background-center {
      display: table-cell;
      vertical-align: middle;
    }

    .popup-set {
      background-color: #000;
      max-width: 720px;
      width: 100%;
      margin: auto;
      padding: 20px;
      box-sizing: border-box;
      position: relative;
    }

    span.close-icon {
      background-color: #184589;
      width: 30px;
      height: 30px;
      position: absolute;
      top: -13px;
      right: -13px;
      text-align: center;
      font-style: normal;
      line-height: 30px;
      color: #fff;
      border-radius: 30px;
      cursor: pointer;
    }

    .bottom-box {
      text-align: right;
    }

    .bottom-box a.close-btn {
      background-color: #f00;
      color: #fff;
      width: 25px;
      height: 25px;
      display: inline-block;
      text-align: center;
      line-height: 25px;
      margin-right: 20px;
    }

    .bottom-box a.tick-btn {
      background-color: #43a047;
      color: #fff;
      width: 25px;
      height: 25px;
      display: inline-block;
      text-align: center;
      line-height: 25px;
    }

    .popup-background {
      display: none;
    }

    .relative-box {
      position: relative;
    }

    .check-select {
      position: absolute;
      bottom: 0;
    }

    .info-btn {
      cursor: pointer;
    }

    .relative-box img {
      background-image: url(assets/images/cool-calm-yellow-water-background.webp);
      padding-top: 10px;
      border-radius: 5px;
    }

    ul.social-icons {
      text-align: right;
      margin-top: 30px;
      padding: 0px;
    }

    .navbar-nav li:hover>ul.dropdown-menu {
      display: block;
    }

    .dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -6px;
    }

    /* rotate caret on hover */
    .dropdown-menu>li>a:hover:after {
      text-decoration: underline;
      transform: rotate(-90deg);
    }

    ul.dropdown-menu {
      margin: 0px;
      border-radius: 0px;
      padding: 0px;
      border: 0px;
    }

    .dropdown-item {
      padding: 0.5rem 1.5rem;
      border-bottom: 1px solid #e3e3e3;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
      background-color: #123e12;
      color: #fff;
    }

    .buttons-container {
      text-align: right;
      margin-top: -40px;
    }

    .creator_logo h2 {
      background: #fff;
      margin-top: 8px;
      padding: 48px 8px;
      font-size: 19px;
      margin: 0px;
    }
  </style>
  <!-- endinject -->
</head>

<body class="green_theme" style="font-family:{{ $font }}">
  <div class="">
    <div class="main-panel">
      <!-- partial:partials/_navbar.html -->
      <header id="header">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="navbar-top">
              <div class="d-flex justify-content-between align-items-center">
                <div><!-- <a class="navbar-brand" href="#">Upload</a>-->
                  <div class="creator_logo">
                    <label for="creator-logo">
                      <h2 class="mt-0">Creator Logo</h2>
                    </label>
                    <input type="file" id="creator-logo" style="display:none;" />
                  </div>
                </div>
                <div class="right-bar">


                  <ul class="navbar-top-right-menu">

                    <li class="nav-item">
                      <a href="#" class="nav-link">Message</a>
                    </li>
                    <li class="relative-notification">

                      <a href="javascript:void(0)" style="background:none !important;" class="notification-icon"><img
                          src="assets/images/notification.png" alt=""></a>

                      <div class="notifications-list" style="display: none;">
                        <div class="all-notifications"><span class="no-of-notifications">Notifications</span><span
                            class="pull-right">View All</span></div>
                        <div class="overflow-notifications">
                          <ul>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <div class="notification-show-box">
                                  <div class="profile-image"><img src="assets/images/user_profile_image.webp"></div>
                                  <div class="notification-side-text"><strong>Username</strong> like your post<br><span
                                      class="light-color">3 seconds ago</span></div>
                                </div>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">Logout</a>
                    </li>
                  </ul>
                  <ul class="social-icons">
                    <li><a href="{{ env('APP_YOU_TUBE_LINK', '#')  }}"><i class="fa fa-youtube-play"
                          aria-hidden="true"></i></a></li>
                    <li><a href="{{ env('APP_TWITTER_LINK', '#')  }}""><i class=" fa fa-twitter"
                        aria-hidden="true"></i></a></li>
                  </ul>
                </div>


              </div>
            </div>
            <div class="navbar-bottom">
              <div class="">

                <div>
                  <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> </button>
                  <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                    @include('front.creatorvisitor.layout.menu')
                    {{-- <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                      <li>
                        <button class="navbar-close"><img src="{{ url('public/assets/images/close.png') }}" alt=""></button>
                      </li>

                      <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle">upload</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{URL('userupload')}}">Free upload </a></li>
                          <li><a class="dropdown-item" href="{{URL('monetizeupload')}}">Monetize upload</a></li>
                        </ul>
                      </li>

                      <li class="nav-item active"><a class="nav-link" href="#">Manage Featured</a></li>

                      <li class="nav-item">
                        <a class="nav-link" href="#">My Groups</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Featured Channels</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Add Custom background</a>


                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Change theme</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="#">Make Journal Entry</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Create custom theme</a>
                      </li>

                    </ul> --}}
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>

      <!-- partial -->


      <div class="content-wrapper">
        <div class="container">
          <div class="row manage_feature">
            <div class="col-sm-12">
              <div class="feature_item_section">
                <img src="assets/images/news_banner2.webp" alt="thumb" class="img-fluid">
                <a href="#" class="close_bt"><svg style="width:40px;height:40px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M19,3H16.3H7.7H5A2,2 0 0,0 3,5V7.7V16.4V19A2,2 0 0,0 5,21H7.7H16.4H19A2,2 0 0,0 21,19V16.3V7.7V5A2,2 0 0,0 19,3M15.6,17L12,13.4L8.4,17L7,15.6L10.6,12L7,8.4L8.4,7L12,10.6L15.6,7L17,8.4L13.4,12L17,15.6L15.6,17Z">
                    </path>
                  </svg></a>
              </div>

            </div>

          </div>


          <div class="row aos-init aos-animate manage_feature" data-aos="fade-up">
            <div class="col-sm-12">
              <div class="manage_area ">
                <h2>Own Collections</h2>
                <div class="manage_gallery_sect manage_feature_collect">
                  <ul>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>

                  </ul>

                  <div class="upload_delete info-btn">
                    Create new
                    <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                      </svg></span>
                    <span class="small_font">New collection</span>
                  </div>


                </div>

              </div>





              <div class="manage_area ">
                <h2>Featured Content</h2>
                <div class="manage_gallery_sect back_b">
                  <ul>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>

                  </ul>

                  <div class="upload_delete info-btn">
                    Add
                    <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                      </svg></span>
                    An Item
                  </div>


                </div>

              </div>




              <div class="manage_area ">
                <h2>Featured Collections</h2>
                <div class="manage_gallery_sect manage_feature_collect">
                  <ul>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>

                  </ul>

                  <div class="upload_delete info-btn">
                    Add
                    <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                      </svg></span>
                    <span class="small_font">A collection</span>
                  </div>


                </div>

              </div>



              <div class="manage_area ">
                <h2>Favoritemade Collections from other creators</h2>
                <div class="manage_gallery_sect back_b">
                  <ul>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>
                    <li><a href="#"><img class="" src="assets/images/519704.webp" alt=""></a></li>

                  </ul>

                  <div class="upload_delete info-btn">
                    Create new
                    <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                      </svg></span>
                    <span class="small_font">New collection</span>
                  </div>


                </div>

              </div>









            </div>
          </div>




        </div>

      </div>
      <!-- main-panel ends -->
      <!-- container-scroller ends -->

      <!-- partial:partials/_footer.html -->
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


                    © {{ date('Y') }}. All rights reserved.
                  </div>
                  <ul class="social-media mb-3">
                    <li>
                      <a href="{{ env('APP_YOU_TUBE_LINK', '#')  }}">
                        <i class="mdi mdi-youtube"></i>
                        <span class="sr-only">{{ env('APP_NAME') }} Youtube</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ env('APP_TWITTER_LINK', '#')  }}">
                        <i class="mdi mdi-twitter"></i>
                        <span class="sr-only">{{ env('APP_NAME') }} Twitter</span>
                      </a>
                    </li>
                  </ul>

                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <!-- partial -->
    </div>
  </div>


  <div class="popup-background">
    <div class="popup-background-outter">
      <div class="popup-background-center">
        <div class="popup-set">
          <span class="close-icon">X</span>
          <div class="row mb-3">
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
            <div class="col-lg-3 relative-box">
              <input type="checkbox" class="check-select" />
              <img src="assets/images/item-09.webp" class="img-fluid" />
            </div>
          </div>

          <div class="bottom-box">
            <a href="#" class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></a><a href="#"
              class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i></a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- inject:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="./assets/js/demo.js"></script>
  <script src="./assets/js/jquery.easeScroll.js"></script>

  <!-- End custom js for this page-->

  <script>
    $(document).ready(function () {

      $('.popup-background').hide();
      $(".info-btn").click(function () {
        $('.popup-background').show();
      });

      $(".close-icon").click(function () {
        $('.popup-background').hide();
      });

    });
  </script>

</body>

</html>
