<div class="option_theme secondary_header mt-5">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
            <div class="container">
                <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" data-target="#navbar10">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-start" id="navbar10">
                    <ul class="navbar-nav nav-fill w-100">
                        <li class="nav-item"><a class="nav-link" href="{{ route('generalSetting')}}">General</a></li>
                        <li class="nav-item"><a class="nav-link" href={{ route('search.sorting') }}>Sorting and search settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tagOption')}}">Tag settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('notificationOption')}}">Notifications and Privacy</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('technicalOption')}}">Technical settings etc</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('themeOption')}}">Theme Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('achievement.index')}}">Achievement</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('socialOption')}}">Social</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
