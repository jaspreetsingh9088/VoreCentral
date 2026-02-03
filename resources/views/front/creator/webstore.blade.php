
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <title>Webstore</title>
        <meta name="description"
              content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <!-- plugin css for this page -->
        <link  rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ url('public/assets/css/style-3.css') }}">
        <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
        <!-- endinject -->
        <style>
            .navbar-top{
                padding: 46px 0 !important;
            }
            .banner_homebutton{
                background: #001bb2;
                color: black !important;
                padding: 14px 78px !important;
                position: absolute;
                font-weight: 900;
                line-height: 14px;
                font-size: 20px;
                z-index: 9999;
            }
            .banner_homebutton:hove{
                background: #001bb2 !important;
            }
            .market_theme .content-wrapper{
                margin-top : -41px;
            }
            .notifications-list{
                top: 60px;
                right: 8px;
            }
        </style>
    </head>
    <livewire:cursor-style>
    <body class="store_theme market_theme creator_store_theme" style="font-family:{{ $font }}">
        <div class="container">
            <div class="main-panel">
                <!-- partial:partials/_navbar.html -->
                <header id="header">
                    <a href="{{ route('home') }}" class="btn btn-success banner_homebutton">Home</a>
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="cart_button_sect mt-5">
                                    <ul class="button_cart_menu">
                                        <li class="nav-item">
                                            <a href="#" id="cartModal" data-toggle="modal" data-target=".bd-example-modal-lg" class="nav-link">Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('checkout.index') }}" class="nav-link">Checkout</a>
                                        </li>
                                        @include('front.layouts.navbar-top')
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-bottom">
                            <div class="">
                                <div>
                                    <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                            <li>
                                                <button class="navbar-close"> <img src="{{ url('public/assets/images/close.png') }}" alt=""></button>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{ route('publicstore.new') }}">Newest First</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><input type="text" name="search" class="form-control"></a>
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
                <div class="content-wrapper">
                    <div class="webstore_creator_store">
                        <div class="row">
                            <?php
                            if(count($CreatorcontentData) > 0){
                                foreach($CreatorcontentData as $CreatorcontentDataV){
                                    ?>
                                    <a href="{{ URL('webstoredetail/'.$CreatorcontentDataV->id) }}">
                                        <div class="col-sm-6">
                                            <div class="market_random_main">
                                                <div class="market_random_hd"><h5> {{ucwords(substr_replace($CreatorcontentDataV->title, "...", 30))}} </h5></div>
                                                <div class="market_random_middle">
                                                    <img alt="" src="{{ $CreatorcontentDataV->thumbnail }}">
                                                </div>
                                                <div class="market_random_bottom">
                                                    @php
                                                        $tags_id = explode(',',$CreatorcontentDataV->tag_id);
                                                        $tags = App\Models\Tag::whereIn('id',$tags_id)->pluck('title');
                                                    @endphp
                                                    <a href="#">Tag :
                                                        @foreach($tags as $tag)
                                                            {{ $tag}},
                                                        @endforeach
                                                    </a>
                                                </div>
                                                <div class="market_random_bottom">
                                                    <a href="#">Price : &#x20b9; {{$CreatorcontentDataV->price}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                }
                            }else{ ?>
                                <div class="col-md-12">
                                    <div class="market_random_main bg-transparent" style="height: 100vh;">
                                        <h3 class="text-center">You do not have any content yet. Please add to view here</h3>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        {{ $CreatorcontentData->links('vendor.pagination.tailwind') }}
		            </div>
                </div>
            </div>
        </div>
        @include('front.layouts.footer')
        @include('front.creatorvisitor.layout.modal')
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
        <!-- End custom js for this page-->
    </body>
    <script>
        $(document).ready(function() {
            $('.navbar-top-right-menu').addClass('button_cart_menu');
            $('.navbar-top-right-menu').addClass('second_ul');
            $('.second_ul').removeClass('navbar-top-right-menu');
            $('#cartModal').one('click', function() {
                var html = "";
                var total = "";
                var image = "";
                $(".cart_table").append(html);
                $(".total").append(total);
                $.ajax({
                    url: '{{ route('getCartItems') }}',
                    type: 'GET',
                    success: function(data) {
                        if (data.code === 200) {
                            $.each(data.cartItems, function(k, cartItem) {
                                image = "{{ asset('thumbnail') }}" + '/' + cartItem
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
                    error: function(xhr, status, error) {
                        // handle error response from the server
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click','#removeItem',function(){
                var id = $(this).data("id");
                $.ajax({
                    url: '{{ route('removeItem') }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(data) {
                        toastr.options = {
                            preventDuplicates: true,
                            timeOut: 4000,
                            progressBar: true,
                        }
                        if (data.code === 200) {
                            toastr.success(data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 4000);
                        } else {
                            toastr.error("Something went wrong.");
                        }

                    },
                    error: function(xhr, status, error) {
                        // handle error response from the server
                    }
                });
            });
        });
    </script>
</html>
