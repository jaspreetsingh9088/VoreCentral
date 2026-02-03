@php use Illuminate\Support\Facades\Auth; @endphp
@extends('front.layouts.app')
@php
    $title = 'Signup';
@endphp
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row aos-init aos-animate" data-aos="fade-up">
                <div class="col-sm-12">
                    <div class="ad_banner landscape">
                        <div data-banner-id="425470"></div>

                    </div>
                </div>

            </div>

            <div class="row">
                <form class="sign_up_form" action="{{ route('creatorpost') }}" class="card mb-3" method="POST"
                      redirect="{{ route('creator') }}">
                    @csrf
                    @if(Auth::user()->stripe_status === 0 && isset($stripe_link_expires_at))
                        <div class='d-flex align-items-center justify-content-center'>
                            <a href='{{ auth()->user()->stripe_account_link}}'>
                                <img src="{{ asset('connect-purple.webp') }}" class='img-thumbnail'
                                     alt='Connect With Stripe'/>
                            </a>
                        </div>
                        <p class="text-white">{{ $stripe_link_expires_at->diffForHumans(now()) }} this link will
                            Expires.</p>
                        @foreach($errors as $error)
                            <p class="text-danger">{{ $error }} </p>
                        @endforeach
                    @elseif(Auth::user()->stripe_status === 1)
                        <p class="text-white">Your account is active at stripe.</p>
                    @else
                        <p class="text-white">Your account is restricted at stripe.</p>
                    @endif
                    <div class="form-group">
                        <label for="">What type of content will you mainly be uploading?.</label>
                        <textarea class="form-control" id="" rows="3" name="content_type"
                                  required>{{$creator?->content_type}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Do you have any old content from another site to upload here? what is the name of
                            that account?</label>
                        <textarea class="form-control" id="" rows="3" name="old_account"
                                  required>{{$creator?->old_account}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">If you do not have any old content, describe what your first upload is likely to
                            be. Is it a video, a single artpiece,
                            or a chapter in some sort of future narative you are planning? If you’d like, give a quick
                            sumary of what its about</label>
                        <textarea class="form-control" id="" rows="3" name="content_description"
                                  required>{{$creator?->content_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">What subgenres are you interested in and what can we expect from you moving
                            forward?</label>
                        <textarea class="form-control" id="" rows="3" name="subgenres"
                                  required>{{$creator?->subgenres}}</textarea>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Agree to Terms and policies</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    <script src="{{ url('public/assets/js/formsubmit.js') }}"></script>
@endpush
