@extends('front.layouts.app')
@php
$title = 'DLC Upload';
@endphp
@section('title', $title)
@section('content')
    <section class="dlc-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <form class="sign_up_form col-lg-8" action="{{ route('uploaddlccontent') }}" class="card mb-3" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div style="margin: 100px 0px;">
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif
                        <div class="upload-content-wrapper">
                            <div class="upload-content-section">
                                <input type="text" class="form-control" placeholder="Title" name="title" required>
                            </div>
                            <div class="upload-content-item mb-5 mt-5">
                                <div class="outter-white">
                                    <div class="image-upload">
                                        <label for="file-input">
                                            Add Content, Video, Audio, JPG, GIF and etc
                                        </label>
                                        <input id="file-input" type="file" name="content" accept="audio/*|video/*|image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="upload-content-tags">
                                <label for="exampleInputEmail1">Pick a type</label>
                                <select class="select2" class="form-control" name="type" id="type_id"
                                    data-placeholder="Pick a type" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option value="">Pick a type </option>
                                    <option value="Literature">Literature </option>
                                    <option value="Picture">Picture </option>
                                    <option value="Comic">Comic </option>
                                    <option value="Video">Video </option>
                                    <option value="Audio">Audio </option>
                                    <option value="Game">Game </option>
                                    <option value="Interactive">Interactive </option>
                                </select>
                            </div>

                            <div class="accept-terms privacy_box my-5">
                                <div class="src_checks">
                                    <div class="form-group">
                                        <input type="checkbox" id="default130" checked="">
                                        <label for="default130">Accept terms of condition?</label>
                                    </div>
                                </div>
                            </div>
                            <!-- recapta box-->
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{env("G_RECAPTCHA_KEY")}}"></div>
                                <br />
                            </div>
                            <!-- upload button -->
                            <div class="upload-button-wrap">
                                <button class="upload-add-tag" type="submit">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-1">
                </div>
            </div>
        </div>
    </section>

@endsection
@push('script')
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    <script>
        $('.select2').select2();
        $(document).ready(function() {
            $('.cover-upload').hide();
            $('.profile-upload').hide();

            $(".user-profile-picture a").click(function() {
                $('.profile-upload').show();
            });

            $(".add-banner-image").click(function() {
                $('.cover-upload').show();
            });

            $(".close-icon").click(function() {
                $(this).parent().parent().parent().parent().hide();
            });
            $(".follow-unfollow").click(function() {
                $(this).text(function(i, text) {
                    return text === "Follow" ? "Unfollow" : "Follow";
                })
            });

        });
    </script>
@endpush
