<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Order Success</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href={{ url('public/assets/css/style.css') }}>
    <script src="https://js.stripe.com/v3/"></script>

    <!-- endinject -->
    <style>
        .stripe-button-el {
            background: url({{ url('public/assets/images/Button-alternative2.webp')}}) no-repeat !important;
            border: #000 solid 2px !important;
            color: #fff;
            padding: 8px 5px !important;
            font-size: 20px;
            font-weight: 600;
            width: 100% !important;
        }

        .stripe-button-el span {
            visibility: hidden !important;
            min-height: 60px;
        }

        .stripe-button-el span:before {
            content: "Checkout";
            font-size: 18px;
            visibility: visible !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<livewire:cursor-style>
    <body class="store_theme" style="font-family:{{ $font }}">

    <div class="container">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header class="webstoreHeader" id="header">

                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="navbar-top">
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="cart_button_sect mt-5">
                                
                            </div>
                        </div>
                    </div>

                    <div class="navbar-bottom">
                        <div class="">
                            <div>
                                <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent"
                                        aria-controls="navbarSupportedContent" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="navbar-collapse justify-content-center collapse"
                                     id="navbarSupportedContent">
                                    <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                        <li>
                                            <button class="navbar-close">
                                                <img src="{{ url('public/assets/images/close.png') }}" alt="">
                                            </button>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{ route('publicstore.new') }}">Newest First</a>
                                        </li>
                                        <form style="display: contents" action="{{ route('publicstore.search') }}">
                                            @csrf
                                            <li class="nav-item">
                                                <input type="text" name="search" class="form-control"
                                                       placeholder="Search" style="margin: 10px;">
                                            </li>
                                            <li>
                                                <button type="submit" class="btn-primary"
                                                        style="padding: 13px;margin: 10px;"> Search
                                                </button>
                                            </li>
                                        </form>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('browsecreator') }}">Browse Creators</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('webStoremonetizeupload') }}">Upload</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('random') }}">random</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

            </header>

            <!-- partial -->

            <div class="content-wrapper">
                <div class="product_details_background">
                    <form class="shopping-cart cart" action="{{ route('home') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="text-danger">{{$error}}</div>
                            @endforeach
                        @endif
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="items">
                                            @foreach ($cartItems as $cartItem)
                                                <div class="product">

                                                    <div class="row">
                                                        
                                                        <div class="col-md-12 mt-100">
                                                            <h2>Payment Successful</h2>
                                                            <div class="info mb-5">
                                                                Thank you very much for your purchase! <br />You will be redirected to your vault page, where you can view or download all of your items...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                              
                                    </div>

                                </div>
                            
                        </div>

                    </form>
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

            <!-- partial -->
        </div>
    </div>
    <!-- inject:js -->
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <script>
        $(document).ready(function () {
            setTimeout(function() {
                window.location.href = '{{ route('myvault') }}';
            }, 5 * 1000);
        });
    </script>
    <!-- End custom js for this page-->
    </body>

</html>
