@extends('front.homepage.layout.app')
@section('title', 'Contact Us')
@section('content')
<section class="viewhistory-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="news_archieve_wrapper mt-0 our_staff_wrapper">

                    <div class="news_adsquare contact_ad">
                        <div class="ad_banner landscape">
                            <div data-banner-id="425470"></div>
                        </div>
                    </div>

                    <div class="contact_msg_box">
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger">
                                {{ Session::get('error_message') }}
                            </div>
                        @endif
                        <form action="{{ route('contactus-mail') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Your Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Write a subject:</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label>Write a message to our team:</label>
                                <textarea class="form-control" id="message" name="message"></textarea>
                            </div>
                            <button type="submit" class="contact_btn">Send</button>
                        </form>
                    </div>
                    <div class="our_staff_inner">
                        <span class="d-none">page : contactus</span>
                        <span class="d-none">content start</span>
                        <h5>Our Staff</h5>
                        <table class="">
                            <tr>
                                <td>SuperAdmin (link to userpage) </td>
                                <td>(optional business E-mail)</td>
                            </tr>
                            <tr>
                                <td>Admin (link to userpage) </td>
                                <td>(optional business E-mail)</td>
                            </tr>
                            <tr>
                                <td>Admin (link to userpage) </td>
                                <td>(optional business E-mail)</td>
                            </tr>
                            <tr>
                                <td>Admin (link to userpage) </td>
                                <td>(optional business E-mail)</td>
                            </tr>
                        </table>
                        <span class="d-none">content end</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-1">
            </div>
        </div>
    </div>
</section>
@endsection
