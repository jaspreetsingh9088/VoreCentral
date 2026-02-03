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
    @php
        $currenturl = request()->segment(2);
        $userid = request()->segment(1);
        if($userid == 'featuredgallery'){
            $userid = request()->segment(2);
        }elseif($userid == 'media'){
            $userid = request()->segment(2);
        }elseif($userid == 'gallery'){
            $userid = request()->segment(3);
        }
    @endphp
        <li class="nav-item">
            <a href="{{ route('sendMsgtoUser',[$userid]) }}" class="nav-link dropdown-toggle">Message</a>
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
