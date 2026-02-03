<header id="header" class="equal-menus">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="navbar-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                    {{-- <a class="navbar-brand" href="#">FORUMS</a> --}}
                        @if(Auth::check())
                            <h3 style="color: #fff;"><strong>Welcome {{ Auth::user()->username }}</strong></h3>
                        @endif
                    </div>

                    <ul class="navbar-top-right-menu">
                        <?php
                            if (Auth::check()) {
                        ?>
                        <li class="nav-item">
                            <a href="{{URL('/logout')}}" class="nav-link">Logout</a>
                        </li>
                        <?php }else{ ?>
                        <li class="nav-item">
                            <a href="{{URL('/signup')}}" class="nav-link">Register</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL('/login')}}" class="nav-link">Login</a>
                        </li>
                        <?php } ?>
                    </ul>

                </div>
              </div>
              <div class="navbar-bottom">
                <div class="">

                  <div>
                    <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                   <div class="navbar-collapse collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mx-auto nav-justify text-center w-100">
                        <li>
                          <button class="navbar-close">
                          <img src="{{ url('public/assets/images/close.png') }}" alt="">
                          </button>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('publicgallery.featured') }}">gallery</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('forum')}}">Forums</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ URL('subscription/1') }}">MY ARTISTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">MY PAGE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mytopics') }}">MY TOPICS</a>
                        </li>
                      </ul>
                    </div>
                  </div>


                </div>
              </div>
            </nav>
          </div>
        </header>
