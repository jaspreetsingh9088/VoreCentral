@extends('front.layouts.app')
@php
    $title = 'Dashboard';
@endphp
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <div class="container">

            <div class="row aos-init aos-animate" data-aos="fade-up">
                <div class="col-sm-12">

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="login_page">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger">
                                {{ Session::get('error_message') }}
                            </div>
                        @endif

                        <form class="sign_up_form" action="{{ route('loginpost') }}" class="card mb-3" method="POST">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="">Email*</label>
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    required="required">
                            </div> --}}
                            <div class="form-group">
                                <label for="">Username*</label>
                                <input type="text" class="form-control" name="username" placeholder="Username"
                                    required="required">
                            </div>

                            <div class="form-group">
                                <label for="">Password*</label>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required="required">

                            </div>

                            @env('production')
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{env("G_RECAPTCHA_KEY")}}"></div>
                                <br />
                            </div>
                            @endenv

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>


                       
                        <div class="ad_banner landscape">
                        <div data-banner-id="425470"></div>
                        </div>
                       


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
