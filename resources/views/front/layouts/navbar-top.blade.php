{{-- <script src="{{url('assets/js/slidetoggle.js.map')}}"></script> --}}
<style>
    .notifications-list {
        transition: height .25s ease;
        overflow: hidden;
        width: 300px !important;
    }
    .notifications-list:not(.active) {
        display: none;
    }
    
    .notification-icon {
        position: relative;
    }
    .notification-icon span {
        position: absolute;
        right: 0;
        top: -10px;
        width: 18px;
        height: 18px;
        background-color: #fe0b0f;
        color: #fff;
        text-align: center;
        font-size: 12px;
        border-radius: 100%;
        z-index: 2;
    }
    .profile-container {
      position: relative;
      display: inline-block;
    }

    .profile-trigger {
      display: flex;
      align-items: center;
      gap: 8px;
      background-image: url('/public/assets/images/right-buttons.jpg');

      padding: 10px;
      border-radius: 8px;
      color: white;
      cursor: pointer;
    }
    #logout a{
        background-image: url('/public/assets/images/homepage-intro.jpg') !important; 
        border-radius: 8px;
        margin-right:10px;

    }

    #message{
        background-image: url('/public/assets/images/envelope.png') !important;  
        border-radius: 8px;
        width: 50px;
        height: 50px;
        margin-right:10px;


    }
    #upload{
        background-image: url('/public/assets/images/upload.png') !important; 
        margin-right: 10px;
        border-radius: 8px;
        width: 50px;
        height: 50px;
    }
    .profile-trigger img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
    }
    .dropdown {
      position: absolute;
      top: 100%;
      right: 0;
      background: url('/public/assets/images/homepage-intro.jpg') !important; 
      background-size: cover;
      padding: 20px;
      min-width: 280px;
      max-width: 90vw;  
      border-radius: 12px;
      display: none;
      min-width: 280px;
      overflow-wrap: break-word;
      margin-top:5px;
      color: white;
      z-index: 1000;
    }

    .dropdown .top-section {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 15px;
    }

    .dropdown .avatar {
      width: 50px;
      height: 50px;
      background: white;
      clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .dropdown .avatar img {
      width: 50px;
      height: 50px;
    }

    .dropdown .user-info {
      display: flex;
      flex-direction: column;
    }

    .dropdown .user-info a {
      color: white;
      text-decoration: none;
    }

    .dropdown .user-info a:hover {
      text-decoration: underline;
    }

    .dropdown .menu-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px 20px;
    }

    .dropdown .menu-grid a {
      color: white;
      text-decoration: none;
    }

    .dropdown .menu-grid a:hover {
      text-decoration: underline;
    }
    .upload-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    color: black;
    min-width: 160px;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    display: none;
    flex-direction: column;
    z-index: 999;
    }

    .upload-dropdown a {
        padding: 10px 15px;
        text-decoration: none;
        color: black;
        display: block;
    }

    .upload-dropdown a:hover {
        background-color: #f0f0f0;
    }

    .profile-menu{
        background: none !important;
    }
</style>
<ul class="navbar-top-right-menu">
    @if(Auth::check())
        @if(Route::current()->getName() == 'forum')

        @endif
    @endif
    <?php
    if (Auth::check()) { ?>
        <li class="nav-item" style="position: relative;">
            <a href="javascript:void(0);" class="nav-link" id="upload" onclick="toggleUploadDropdown()"></a>
            <div id="uploadDropdown" class="upload-dropdown">
                @php if(Auth::user()->creator==1){ @endphp
                <a href="{{ route('creator.content.upload')}}">Gallery Upload</a>
                <a href="{{ route('webStoremonetizeupload')}}">Webstore Upload</a>
                <a href="{{ route('creator.dlc.upload')}}">DLC Upload</a>
                @php } @endphp
                <a href="{{ route('dashboard') }}">My Page</a>
            </div>
        </li>
        
        <li >
            <a href="{{ route('pm')}}" class="nav-link" id="message"></a>
        </li>
        <li style="margin-right:10px;">
            {{-- <a href="javascript:;" style="background:none !important;" class="notification-icon">
                <img src="{{ url('public/assets/images/notification.png') }}" alt="">
            </a> --}}
            <livewire:notification-dropdown>
        </li>


        <li>
            <div class="profile-container">
                <div class="profile-trigger" onclick="toggleDropdown()">
                    <img src="{{ Auth::user()->profile_pic }}">
                    <span>{{ Auth::user()->username }} </span>
                </div>
                    @php
                    $dashboard_link='';
                    if(Auth::user()->creator==1){
                    $id=Auth::user()->id;
                    $dashboard_link=$id."/creatordashboard";
                    } else{
                    $id=Auth::user()->id;
                    $dashboard_link=$id."/dashboard";
                    }
                    @endphp
                <div class="dropdown" id="dropdownMenu">
                    <div class="top-section">
                        <div class="avatar">
                        @php
                        $formattedProfileRank = Str::slug($profile_rank, '-');
                        @endphp
                        <img src="{{ asset('/achievement/profile/' . $formattedProfileRank . '.png') }}" >
                        </div>
                        <div class="user-info">
                            <a href="/{{ $dashboard_link }}" style="background: none !important;">{{ Auth::user()->username }}</a>
                            <a href="{{ route('achievement.index')}}" style="background: none !important;">Profile Rank:{{ $profile_rank}}</a>
                        </div>
                    </div>
                    <div class="menu-grid">
                        <a href="/<?php echo $dashboard_link; ?>" class="profile-menu" style="background: none !important;">View Profile</a>
                        <a href="{{URL('subscription/1')}}" class="profile-menu" style="background: none !important;">Subscriptions</a>
                        <a href="{{ route('pm')}}" class="profile-menu" style="background: none !important;">View DMs</a>
                        <a href="{{route('myvault')}}" class="profile-menu" style="background: none !important;">Purchased Content</a>
                        <a href="{{ route('generalSetting')}}" class="profile-menu" style="background: none !important;">Settings</a>
                        <a href="{{ route('publicstore')}}" class="profile-menu" style="background: none !important;">Premium membership</a>
                        @php if(Auth::user()->creator==1){ @endphp
                        <a href="{{ route('creator.content.upload')}}" class="profile-menu" style="background: none !important;">Gallery Upload</a>
                        <a href="{{ route('creator.dlc.upload')}}" class="profile-menu" style="background: none !important;">DLC Upload</a>
                        @php } @endphp
                        @php if(Auth::user()->creator==1){ @endphp
                        <a href="{{ route('webStoremonetizeupload')}}" style="background: none !important;">Store Upload</a>

                        @php } else{ @endphp
                        <a href="{{ route('creator')}}" style="background: none !important;">Become Creator</a>
                        @php } @endphp
                        <a href="{{URL('/logout')}}" class="profile-menu" style="background: none !important;">Sign out</a>
                    </div>
                </div>
            </div>

        </li>                 

        <?php
    }else{ ?>
        <li class="nav-item mr-2">
            <a href="{{URL('/signup')}}" class="nav-link">Register</a>
        </li>
        <li class="nav-item">
            <a href="{{URL('/login')}}" class="nav-link">Login</a>
        </li>
        <?php
    } ?>
</ul>

<script>
    $(".notifications-list").hide();
    $(".notification-icon").click(function() {
        $(".notifications-list").toggle();
    });

    $('#close').click(function(){
        $('.notifications-list').slideToggle();
    });
</script>
<script> 
  function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
  }

  document.addEventListener('click', function(e) {
    const profile = document.querySelector('.profile-container');
    if (!profile.contains(e.target)) {
      document.getElementById('dropdownMenu').style.display = 'none';
    }
  });

  function toggleUploadDropdown() {
    const dropdown = document.getElementById('uploadDropdown');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
}

document.addEventListener('click', function(e) {
    const uploadBtn = document.getElementById('upload');
    const dropdown = document.getElementById('uploadDropdown');
    if (!uploadBtn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
    }
});

</script>
