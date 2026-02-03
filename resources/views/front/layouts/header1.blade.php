<header id="header">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="navbar-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        {{-- <a class="navbar-brand" href="{{ route('home') }}">HOME</a> --}}
                        @if(Auth::check())
                            <h3 style="color: #fff;"><strong>Welcome {{ Auth::user()->username }}</strong></h3>
                        @endif
                    </div>
                    @include('front.layouts.navbar-top')
                </div>
              </div>
              <div class="navbar-bottom">
                <div class="">

                  <div>
                    <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span></button>
                     <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                        <li>
                          <button class="navbar-close"><img src="{{ url('public/assets/images/close.png') }}" alt=""></button>
                        </li>
                        <li class="nav-item active"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('publicgallery.featured') }}">Featured</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('publicgallery.featured') }}">Gallery</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('collection') }}">Collections</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('media',['media']) }}">Media</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('community') }}">Community</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('favoriteartwork') }}">Groups Favorites</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('journal') }}">Journal</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Misc</a>
              <ul class="submenu">
               <li> <a class="" href="{{ URL('aboutus') }}">About us</a></li>
              <li> <a class="" href="{{ URL('contactus') }}">Contact us</a></li>
              <li> <a class="" href="{{route('contentpromoted')}}">Content produced and promoted </a></li>
              <li> <a class="" href="{{ route('creator.information.monetisation') }}">Creator Information and Monetasation</a></li>
              <li> <a class="" href="{{ route('helpandsupport') }}">Help and Support</a></li>
              <li> <a class="" href="{{ route('information.different.subject') }}">Information about different subjects</a></li>
              <li> <a class="" href="{{URL('news_archieve')}}">News archive</a></li>
              <li> <a class="" href="{{URL('ourstaff')}}">Our staff</a></li>
              <li>
                <a class="" href="{{ route('privacypolicy') }}">Privacy Policy</a>
            </li>
            <li>
                <a class="" href="{{route('termsservice')}}">Terms and Service</a>
            </li>
              </ul>
</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </header>
