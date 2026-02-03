<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title></title>
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset("assets/vendors/mdi/css/materialdesignicons.min.css")}}"/>
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ url('public/assets/lightbox/simple-lightbox.css?v2.8.0')}}"/>
</head>

<body class="store_theme" style="font-family:{{ $font }}">

<div class="container">


    <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
        <header id="header">

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="navbar-top">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="cart_button_sect mt-5">
                            <ul class="button_cart_menu">
                                <li class="nav-item">
                                    <a href="#" id="cartModal" data-toggle="modal"
                                       data-target=".bd-example-modal-lg" class="nav-link">Cart</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('checkout.index') }}" class="nav-link">Checkout</a>
                                </li>

                            </ul>

                        </div>


                    </div>
                </div>

                <div class="navbar-bottom">
                    <div class="">

                        <div>
                            <button
                                class="navbar-toggler"
                                type="button"
                                data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent"
                                aria-expanded="false"
                                aria-label="Toggle navigation"
                            >
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div
                                class="navbar-collapse justify-content-center collapse"
                                id="navbarSupportedContent"
                            >
                                <ul
                                    class="navbar-nav d-lg-flex justify-content-between align-items-center"
                                >
                                    <li>
                                        <button class="navbar-close">
                                            <img src="{{ url('public/assets/images/close.png') }}" alt="">
                                        </button>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ route('publicstore.new') }}">Newest First</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><input type="text" name="search"
                                                                            class="form-control"></a>
                                    </li>
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


                <div class="preview col-md-8">
                    <?php
                    if (isset($CreatorcontentData) && is_array($CreatorcontentData) && count($CreatorcontentData) > 0){
                    foreach ($CreatorcontentData as $CreatorcontentDataK => $CreatorcontentDataV){

                        ?>
                    <div class="preview-pic">
                        <div class="tab-pane active gallery" id="pic-1">
                            <a href="{{ $CreatorcontentDataV['content'] }}"><img alt=""
                                                                                 src="{{$CreatorcontentDataV['content']}}"></a>

                        </div>

                    </div>


                    <div class="product_button">
                        <button type="submit" name="rating" class="rating_bt">Rating in Star</button>
                        <div class="product_right">
                            <a href="{{URL('markgalleryfavorite/'.$CreatorcontentDataV['id'])}}"
                               class="nav-link subscrib_bt">
                                    <?php if (isset($isfavourite) && $isfavourite > 0){ ?>
                                <span style="color:#fff;">  <i class="fa fa-heart"
                                                               aria-hidden="true"></i> Favorite </span>
                                <?php }else{ ?>
                                <i class="fa fa-heart-o" aria-hidden="true"></i> Favorite
                                <?php } ?>
                            </a>
                            <button type="submit" name="rating" class="buy_bt">Buy Now</button>
                        </div>
                    </div>

                    <div class="user_input">
                        <span class="add_comment">Add a Review</span>
                        <form class="" action="{{ route('addgallerycomment') }}" class="card mb-3" method="POST"
                              redirect="{{ url()->current(); }}">
                            @csrf
                            <input type="text" name="comment" class="form-control" id="" aria-describedby=""
                                   placeholder="">
                            <input type="hidden" name="contentid" value="{{$CreatorcontentDataV['id']}}">
                            <input type="submit" value="Submit Reviewl" class="btn btn-primary"
                                   style="float: right;margin-top: 10px;border-radius: 0px;">
                        </form>
                    </div>
                        <?php if (isset($CreatorcontentDataV['commentdata']) && is_array($CreatorcontentDataV['commentdata']) && count($CreatorcontentDataV['commentdata']) > 0){
                    foreach ($CreatorcontentDataV['commentdata'] as $commentDataK => $commentDataKV){ ?>
                    <div class="details">
                        <h3 class="product-title">{{$commentDataKV['username']}}</h3>
                        <div class="rating">
                            <div class="stars">

                            </div>

                        </div>
                        <p class="product-description">{{$commentDataKV['comment']}}</p>
                        <h4 class="price">Date: <span>{{date('d-m-Y',strtotime($commentDataKV['created_at']))}}</span>
                        </h4>


                    </div>
                    <?php }
                    } ?>

                    <?php }
                    } ?>
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
@include('front.creatorvisitor.layout.modal')
<script src="{{ url('public/assets/js/common.js') }}"></script>
<script src="{{ url('public/assets/js/formsubmit.js') }}"></script>
<!-- inject:js -->
<script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="a{{ asset('ssets/vendors/aos/dist/aos.js/aos.js')}}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->

<script src="{{ asset("assets/js/jquery.easeScroll.js")}}"></script>

<script src="{{ url('public/assets/lightbox/simple-lightbox.js?v2.8.0')}}"></script>
<script>
    $(document).ready(function () {
        $('#cartModal').one('click', function () {
            var html = "";
            var total = "";
            var image = "";
            $(".cart_table").append(html);
            $(".total").append(total);
            $.ajax({
                url: '{{ route('getCartItems') }}',
                type: 'GET',
                success: function (data) {
                    if (data.code === 200) {
                        $.each(data.cartItems, function (k, cartItem) {
                            image =
                                "{{ asset('thumbnail') }}" +
                                '/' + cartItem
                                    .paidcontent.thumbnail;
                            html =
                                '<tr><td data-th="Product"><div class="row"><div class="col-md-3 text-left"><img src=' +
                                image +
                                ' alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow"></div><div class="col-md-9 text-left mt-sm-2"><h4>' +
                                cartItem.paidcontent.title +
                                '</h4><p class="font-weight-light"></p></div></div></td><td data-th="Price">$' +
                                cartItem.paidcontent.price +
                                '</td><td class="text-center"><a class="remove-from-cart" id="removeItem" data-id="' +
                                cartItem.id +
                                '" href="javascript:void(0);" data-toggle="tooltip" title="" data-original-title="Remove item">Remove</a></td></tr>';
                            $(".cart_table").append(html);
                        });
                        total = "$" + data.total;
                        $(".total").append(total);
                    } else {
                        toastr.error("Something went wrong.");
                    }
                },
                error: function (xhr, status, error) {
                    // handle error response from the server
                }
            });
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('#removeItem').click(function () {
            alert(123);
            var id = $(this).data("id");
            $.ajax({
                url: '{{ route('removeItem') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (data) {
                    toastr.options = {
                        preventDuplicates: true,
                        timeOut: 4000,
                        progressBar: true,
                    }
                    if (data.code === 200) {
                        toastr.success(data.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 4000);
                    } else {
                        toastr.error("Something went wrong.");
                    }

                },
                error: function (xhr, status, error) {
                    // handle error response from the server
                }
            });
        });
    });

</script>
<script>
    (function () {
        var $gallery = new SimpleLightbox('.gallery a', {});
    })();
</script>

<!-- End custom js for this page-->
</body>
</html>
