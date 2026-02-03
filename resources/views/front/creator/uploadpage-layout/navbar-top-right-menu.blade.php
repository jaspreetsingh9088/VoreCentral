{{-- <script src="{{url('assets/js/slidetoggle.js.map')}}"></script> --}}
<style>
    .notifications-list {
        transition: height .25s ease;
        overflow: hidden;
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
</style>
<ul class="navbar-top-right-menu">
    <li class="nav-item mr-2">
        <a href="{{ url('creatorcontentupload') }}" class="nav-link dropdown-toggle">Upload</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('creatorupload') }}" class="nav-link">Creator Studio</a>
        &nbsp;&nbsp;
    </li>
    <?php
    if (Auth::check()) { ?>
        <li class="nav-item">
            <a href="{{URL('/logout')}}" class="nav-link">Logout</a>
        </li>
        <li>
            {{-- <a href="javascript:;" style="background:none !important;" class="notification-icon">
                <img src="{{ url('public/assets/images/notification.png') }}" alt="">
            </a> --}}
            <livewire:notification-dropdown>
        </li>
        <?php
    }else{ ?>
        <li class="nav-item">
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
