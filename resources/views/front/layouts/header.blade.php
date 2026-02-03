<style>
.navbar-nav {
  display: flex;
  width: 100%;
  padding: 0;
  margin: 0;
}

.navbar-nav>li {
  flex: 1;
  text-align: center;
}

.navbar-nav .nav-link {
  display: block;
  padding: 10px 0;
}
</style>

  <header id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="navbar-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-none d-sm-block">
                        {{-- <a class="navbar-brand" href="{{route('home')}}">Home</a> --}}
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
                        <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" data-toggle="collapse" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse  collapse"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                @php
                                    use Illuminate\Support\Str;
                                    $userid = request()->segment(1);
                                @endphp
                                @if (Str::endsWith(request()->path(), 'dashboard'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('publicgallery.pictures',['all','featured']) }}">Gallery</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('publicgallery.pictures',['all','featured']) }}">Gallery</a>
                                </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('forum')}}">Forums</a>
                                </li>
                            <!--     <li class="nav-item">
                                    <a class="nav-link" href="{{URL('subscription/1')}}">Subscriptions</a>
                                </li> -->
             <!--                    @if (Auth::check())
                                    <li class="nav-item">
                                        @if(Auth::user()->creator == 0)
                                            <a class="nav-link" href="{{ route('dashboard')}}">My Page</a>
                                        @elseif(Auth::user()->creator == 1)
                                            <a class="nav-link" href="{{URL('/creatordashboard')}}">My Page</a>
                                        @endif
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dashboard') }}">My Page</a>
                                    </li>
                                @endif -->
                             <!--    <li class="nav-item">
                                    <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('publicstore')}}">Store</a>
                                </li>
                            <!--     <li class="nav-item">
                                    <a class="nav-link" href="{{route('generalSetting')}}">Options</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Misc</a>
                                    <ul class="submenu">
                                    <li><a class="" href="{{URL('dlc')}}">DLC</a></li>
                                    <li>
                                        <a class="" href="{{route('generalSetting')}}">Options</a>
                                        </li>
                                        <li><a class="" href="{{URL('news_archieve')}}">News archive</a></li>

                                   <!--      <li><a class="" href="{{ URL('aboutus') }}">About us</a></li>
                                        <li><a class="" href="{{ URL('contactus') }}">Contact us</a></li> -->
                                        <li>
                                            <a class="" href="{{ route('content.promoted.produced') }}">Content produced and promoted</a>
                                        </li>
                                      <!--   <li>
                                            <a class="" href="{{ route('creator.information.monetisation') }}">Creator Information and Monetisation</a>
                                        </li> -->
                                      <!--   <li><a class="" href="{{ route('helpandsupport') }}">Help and Support</a></li>
                                        <li>
                                            <a class="" href="{{ route('information.different.subject') }}">Information about different subjects</a>
                                        </li> -->
                                        <li><a class="" href="{{ route('onlineuser') }}">Online Users</a></li>
                                        <li><a class="" href="{{ route('myvault') }}">Purchased Content</a></li>
                                        <li><a class="" href="{{ URL('publicgallery/pictures/latest') }}">Inner Gallery</a></li>
                                     <!--    <li><a class="" href="{{URL('ourstaff')}}">Our staff</a></li>
                                        <li>
                                            <a class="" href="{{ route('privacypolicy') }}">Privacy Policy</a>
                                        </li>
                                        <li>
                                            <a class="" href="{{route('termsservice')}}">Terms and Service</a>
                                        </li> -->
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
