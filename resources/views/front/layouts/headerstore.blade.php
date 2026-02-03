<style>
    #webstore-navigation {
        text-align: center;
    }

    #webstore-navigation li {
        width: 200px;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        flex-wrap: wrap;
        border-radius: 8px;
        max-width: 1000px;
        margin: 20px auto;
    }

    .left-group,
    .right-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    input[type="text"],
    select,
    button {
        padding: 8px 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    button {
        cursor: pointer;
        background-color: #083008;
        color: white;
        border: none;
    }

    button:hover {
        background-color: #0056b3;
    }

    .store_main_sect {
        padding-top: 0px !important;
    }
</style>
<header id="header"  style="cursor:pointer;">

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-top">
            <div class="d-flex justify-content-between align-items-center">

                <div class="cart_button_sect mt-5 d-none d-sm-block">
                    <ul class="button_cart_menu">
                        <li class="nav-item">
                            <a href="{{route('myvault')}}" id="cartModalLeft"  class="nav-link">Purcahsed Content</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL('subscription/1')}}" class="nav-link">Subscriptions</a>
                        </li>
                    </ul>
                </div>

                <div class="cart_button_sect mt-5">
                    @include('front.layouts.navbar-top-webstore')
                </div>
            </div>
            </a>
        </div>
        <div class="navbar-bottom">
            <div class="">
                <div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                 </button>
                    <div class="navbar-collapse justify-content-center collapse"
                        id="navbarSupportedContent">
                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center" id="webstore-navigation">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('publicgallery.featured') }}">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forum') }}">Forums</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('publicstore')}}">Store</a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link" href="#">Misc</a>

                                <ul class="submenu">

                                    <li> <a class="" href="{{URL('aboutus')}}">About us</a></li>

                                    <li> <a class="" href="{{URL('contactus')}}">Contact us</a></li>

                                    <li> <a class="" href="#">Content produced and promoted </a></li>

                                    <li> <a class="" href="#">Creator Information and Monetasation</a></li>

                                    <li> <a class="" href="#">Help and Support</a></li>

                                    <li> <a class="" href="#">Information about different subjects</a></li>

                                    <li> <a class="" href="{{URL('news_archieve')}}">News archive</a></li>

                                    <li> <a class="" href="{{URL('ourstaff')}}">Our staff</a></li>

                                    <li> <a class="" href="{{route('privacypolicy')}}">Privacy Policy and Terms of service</a></li>

                                </ul>

                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>