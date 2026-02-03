<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Admin</title>
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/fontawesome-free/css/all.min.css') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Vore Fetish</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                   
                    @env('production')
                        @if($show_captcha)
                            <div class="mb-3">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{env("G_RECAPTCHA_KEY")}}"></div>
                                    @error('g-recaptcha-response')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                            </div>
                        @endif
                    @endenv
                    <button type="submit" class="btn btn-block btn-primary">Sign in</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
</body>

</html>
