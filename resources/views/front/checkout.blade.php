<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title>Checkout</title>
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

        #payment-btn {
            margin-top: 20px;
            padding: 15px 0;
        }
    </style>
</head>
<livewire:cursor-style>
    <body class="store_theme" style="font-family:{{ $font }}">

    <div class="container">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            @include("front.layouts.headerstore")


            <!-- partial -->

            <div class="content-wrapper">
                <div class="product_details_background">
                @include("front.layouts.webstorefilters")

                    @if (Session::has('error_message'))
                        <div class="alert alert-danger">
                            {{ Session::get('error_message') }}
                        </div>
                    @endif

                    @if(count($customer_cards)>0)
                    <form class="shopping-cart cart" action="{{ route('checkout') }}" method="POST">
                        @csrf
                    @else
                    <form class="shopping-cart cart">
                    @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="text-danger">{{$error}}</div>
                            @endforeach
                        @endif
                        <div class="content">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="items">
                                            @foreach ($cartItems as $cartItem)
                                                <div class="product">

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <img class="img-fluid mx-auto d-block image"
                                                                 src="{{ $cartItem->paidcontent->thumbnail }}">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-md-7 product-name">
                                                                        <div class="product-name">
                                                                            <a
                                                                                href="{{ route('buyablecontent', $cartItem->paidcontent->id) }}">
                                                                                {{ $cartItem->paidcontent->title }}</a>
                                                                            <div class="product-info">
                                                                                <div class="m-t-sm pt-2">
                                                                                    <span id="removeItem"
                                                                                          data-id={{ $cartItem->id }}
                                                                                        class="text-muted"><i
                                                                                            class="fa fa-trash"
                                                                                            aria-hidden="true"></i>Remove
                                                                                        item</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="col-md-3 quantity">
                                                                    <label for="quantity">Quantity:</label>
                                                                    <input id="quantity" type="number" value="1"
                                                                        class="form-control quantity-input">
                                                                </div> --}}
                                                                    <div class="col-md-2 price">
                                                                        <span>${{ $cartItem->paidcontent->price }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="view_history-outer p-0 m-0">
                                                <div class="news_archieve_odd src-sort p-3">
                                                    <div class="row">
                                                        @if(count($customer_cards)>0)
                                                        @foreach($customer_cards as $cc)
                                                            <div class="col-md-6">
                                                                <style>
                                                                    .card-radio input:checked ~ span .product {
                                                                        border: #00a379 2px solid;
                                                                    }
                                                                </style>
                                                                <label class="card-radio">
                                                                
                                                                    <span class="mb-2">
                                                                  
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="{{ route('technicalOption')  }}"
                                                       class="btn-info btn addcard_btn"
                                                       style="background: #3390b4;color: black;font-weight: bold;padding: 15px 45px;">
                                                        Add Card
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="summary">
                                        <h3>Summary</h3>
                                        <div class="summary-item"><span class="text">MRP</span><span
                                                class="price">${{ number_format($total,2,'.') }}</span></div>
                                        <div class="summary-item"><span class="text">Subtotal</span><span
                                                class="price">${{ number_format($total,2,'.') }}</span></div>

                                        <div class="summary-item"><span class="text">Total</span><span
                                                class="price">${{ number_format($total,2,'.') }}</span></div>
{{--                                        <script--}}
                                        {{--                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"--}}
                                        {{--                                            data-key="{{ env('STRIPE_PUBLIC_KEY')  }}"--}}
                                        {{--                                            data-amount="{{ $total*100  }}"--}}
                                        {{--                                            data-name="{{ env('APP_NAME')  }}"--}}
                                        {{--                                            data-description=""--}}
                                        {{--                                            data-client-reference-id="{{ $customer_id }}"--}}
                                        {{--                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"--}}
                                        {{--                                            data-locale="auto"--}}
                                        {{--                                            data-currency="usd">--}}
                                        {{--                                        </script>--}}

                                        @if(count($customer_cards)>0)
                                            <button type="submit" id="checkout" class="btn subscrib_bt btn-lg btn-block">Pay via Stripe</button>
                                        @else
                                            <a href="javascript:void()" id="payment-btn" class="btn subscrib_bt btn-lg btn-block" data-toggle="modal" data-target="#paymentModal">Pay via Stripe</a>
                                            @endif
                                            <div id="paypal-button-container" style="margin-top:10px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <input name="total" type="hidden" value="{{ $total }}" id="total">
                        <input name="cart_id" type="hidden" value="{{ Session::get('cart_id') }}">
                    </form>
                </div>
            </div>
            <!-- main-panel ends -->
            <!-- container-scroller ends -->
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Card Details</h4>
                        </div>
                        <form id="payment-form" action="{{ route('checkout') }}" method="post">
                            @csrf

                            <input name="total" type="hidden" value="{{ $total }}">
                            <input name="cart_id" type="hidden" value="{{ Session::get('cart_id') }}">
                            <div class="modal-body">
                                <div id="card-element">
                                    <!-- Elements will create input elements here -->
                                </div>
                                <!-- We'll put the error messages in this element -->
                                <div id="card-errors" role="alert" style="color: #d1011c;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff;">Close</button>
                                <button id="card-button" class="btn btn-primary">Pay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
    {{-- <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('public/assets/js/demo.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery.easeScroll.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    
    <!-- Stripe Payment -->
    <script>
        const stripe = Stripe('pk_test_51LpL5yLpE2nvK4R4hIlXRKOeIcMhh44mjJ2cN2xN4LbaWC6WP4jatNNv1nVIKZgAcLwZnJyDoNSJFZfC4PvBKp1K00sOYMrs3K');

        var elements = stripe.elements();
        var card = elements.create("card", {
            hidePostalCode: true
        });
        card.mount("#card-element");

        card.on('change', ({error}) => {
            let displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });


        var form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {token, error} = await stripe.createToken(card);

            if (error) {
                // Inform the customer that there was an error.
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(token);
            }
        });

        const stripeTokenHandler = (token) => {
            // Insert the token ID into the form so it gets submitted to the server
            const form = document.getElementById('payment-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>

<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>

    <script>
    paypal.Buttons({
        fundingSource: paypal.FUNDING.PAYPAL,
        style: {
            layout: 'horizontal',  // 'vertical' or 'horizontal'
            color: 'blue',          // 'gold', 'blue', 'silver', 'white', 'black'
            shape: 'rect',          // 'rect' or 'pill'
            label: 'checkout',      // 'paypal', 'checkout', 'pay', 'buynow'
            height: 45              // set height in pixels (default around 35-45px)
        },
        createOrder: function(data, actions) {
            return fetch('/paypal/order', {
                method: 'post',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    amount:<?php echo $total; ?>
                })
            }).then(res => res.json())
            .then(orderData => {
                return orderData.id; // Use the order ID from server
            });
        },
        onApprove: function(data, actions) {
            return fetch('/paypal/capture', {
                method: 'post',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    orderID: data.orderID
                })
            }).then(res => res.json())
            .then(details => {
                window.location.href = "<?php echo route('order_success'); ?>";
            });
        }
    }).render('#paypal-button-container');
    </script>




{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#checkout').click(function () {--}}
{{--                var formData = $('.cart').serialize();--}}
{{--                formData += "&_token=" + "{{ csrf_token() }}";--}}
{{--                var redirect = '{{ route('home') }}';--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route('checkout') }}',--}}
{{--                    type: 'POST',--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        toastr.options = {--}}
{{--                            preventDuplicates: true,--}}
{{--                            timeOut: 4000,--}}
{{--                            progressBar: true,--}}
{{--                        }--}}
{{--                        if (data.code === 200) {--}}
{{--                            toastr.success(data.message);--}}
{{--                            setTimeout(function () {--}}
{{--                                window.location.replace(redirect);--}}
{{--                            }, 4000);--}}
{{--                        } else {--}}
{{--                            toastr.error("Something went wrong.");--}}
{{--                        }--}}

{{--                    },--}}
{{--                    error: function (response) {--}}
{{--                        if (response.status === 422) {--}}
{{--                            if (--}}
{{--                                Object.keys(response.responseJSON).length > 0 &&--}}
{{--                                Object.keys(response.responseJSON.errors).length > 0--}}
{{--                            ) {--}}
{{--                                $.each(response.responseJSON.errors, function (key, value) {--}}
{{--                                    toastr.error(value);--}}
{{--                                });--}}
{{--                            }--}}
{{--                        } else {--}}
{{--                            toastr.error(response.responseJSON.message);--}}
{{--                        }--}}
{{--                        // toastr.error("Something went wrong.");--}}
{{--                        // handle error response from the server--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script>
        $(document).ready(function () {
            $('#removeItem').click(function () {
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
        $(document).ready(function () {
            $('#cartModal').click(function () {
                $.ajax({
                    url: '{{ route('getCartItems') }}',
                    type: 'GET',
                    success: function (data) {
                        if (data.code === 200) {
                            $.each(data.cartItems, function (k, cartItem) {
                                var image = "{{ asset('thumbnail') }}" + '/' + cartItem
                                    .paidcontent.thumbnail;
                                var html =
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
    <!-- End custom js for this page-->
    </body>

</html>
