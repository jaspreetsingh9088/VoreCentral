<div id="snackbar"></div>
<footer>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div class="fs-14 font-weight-600">
                            <ul class="footer_menu">
                                <li>
                                    <a href="{{URL('contactus')}}">Contact us</a>
                                </li>

                                <li>
                                    <a href="{{URL('aboutus')}}">About us</a>
                                </li>

                                <li>
                                    <a href="{{URL('privacypolicy')}}">Privacy Policy</a>
                                </li>

                                <li>
                                    <a href="{{route('termsservice')}}">Terms of Service</a>
                                </li>
                            </ul>

                            © {{ date('Y') }}. All rights reserved.
                        </div>
                        <ul class="social-media mb-3">
                            {{-- <li>
                                <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                                    <img src="{{ url('public/assets/images/youtube.png') }}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="{{ env('APP_TWITTER_LINK', '#') }}">
                                    <img src="{{ url('public/assets/images/twitter.png') }}" alt="">
                                </a>
                            </li> --}}
                            <li></li>
                            <li>Alpha 1.6</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
