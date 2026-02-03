@extends('front.layouts.app')
@php
    $title = 'Signup';
@endphp
@section('title', $title)
@section('style')
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}" />
@endsection
@section('content')
    <style>
        .form-group label {
            color: white !important;
        }

        .form-control {
            width: 100% !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="container">
            <div class="row aos-init aos-animate" data-aos="fade-up">
                <div class="col-sm-12">

                    <div class="ad_banner landscape">
                      <div data-banner-id="425470"></div>
                    </div>

                </div>
            </div>
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
            @if (Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
            <form class="sign_up_form w-100" action="{{ route('signup') }}" method="POST" id="sign_up_form"
                redirecturl="{{ route('login') }}">
                <div id="sign_up_form-errors"></div>
                <div class="row">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Username*</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                aria-describedby="" placeholder="username">
                        </div>
                        <div class="form-group">
                            <label for="">Password*</label>
                            <input type="password" name="password" class="form-control" id="" aria-describedby=""
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address*</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gender*</label>
                            <select class="form-select form-control" name="gender" aria-label="Default select example">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="do not specify">Don't specify</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sexual Orientation*</label>
                            <select name="sexual_orientation" class="form-select form-control"
                                aria-label="Default select example">
                                <option value="">Select Sexual orientation</option>
                                <option value="Interested in men">Interested in men</option>
                                <option value="Interested in women">Interested in women</option>
                                <option value="Interested in other">Interested in other</option>
                                <option value="Interested in all">Interested in all</option>
                                <option value="do not specify">Don't specify</option>
                            </select>
                            @error('sexual_orientation')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{env("G_RECAPTCHA_KEY")}}"></div>
                            <br />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Vore Role Preference*</label>
                            <select name="role_preference" class="form-select form-control"
                                aria-label="Default select example">
                                <option value="">Select Vore Role Preference</option>
                                <option value="pred">Pred</option>
                                <option value="prey">Prey</option>
                                <option value="switch">Switch</option>
                                <option value="observer">Observer</option>
                                <option value="do not specify">Don't specify</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password*</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label for="tag" class="mt-3">Tags: Pick some tags that you are interested in*</label>
                            <select class="form-control select2" id="tag" name="tags[]" multiple="multiple"
                                data-placeholder="Select..." data-dropdown-css-class="select2-purple" style="width: 100%;">
                                <option value="">Select Tag</option>
                                @foreach ($Tagdata as $key => $tag)
                                    <option value="{{ $key }}">{{ $tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="antitag" class="mt-3">Antitags: Pick some antitags that you do not want to see*</label>
                            <select class="form-control select2" id="antitag" name="antitags[]" multiple="multiple"
                                data-placeholder="Select..." data-dropdown-css-class="select2-purple"
                                style="width: 100%;">
                                <option value="">Select Antitag</option>
                                @foreach ($Tagdata as $key => $tag)
                                    <option value="{{ $key }}">{{ $tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group pt-2">
                            <label for="">Date Of Birth*</label>
                            <input type="date" class="form-control" id="dob" aria-describedby="" name="dob">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Registration Code</label>
                            <input type="text" class="form-control" id="registration_code" aria-describedby="" name="registration_code" placeholder="Enter code here">
                        </div> --}}
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">I am over the age of 18 and agree to the terms and conditions</label>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Become Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    <script>
        $('#sign_up_form').submit(function(e) {
            e.preventDefault();
            var frm = $("#sign_up_form");
            var data = new FormData(this);
            var redirecturl = $(this).attr("redirecturl");
            $('#sign_up_form-errors').empty();
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: data,
                dataType:'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.result=="error"){
                        $('#sign_up_form-errors').html('<strong class="text-danger">'+response.error_message+'</strong>');
                    }else{
                        window.location.replace(redirecturl);
                    }

                },
                error: function(data) {
                    console.log(data.responseJSON);
                    var errors = data.responseJSON;
                    errorsHtml = '<strong class="text-danger">';
                    $.each(errors.errors, function(k, v) {
                        errorsHtml += v + ', ';
                    });
                    errorsHtml += '</strong>';
                    $('#sign_up_form-errors').html(errorsHtml);
                }
            });
        });

        $(document).ready(function() {
            $('.select2').select2(); // Initialize select2 on both elements

            var tagOptions = $('#tag option').clone(); // Clone the tag options
            var antitagOptions = $('#antitag option').clone(); // Clone the antitag options

            var isProgrammaticChange = false; // Flag to track programmatic change

            $('#tag').on('change', function() {
                if (!isProgrammaticChange) {
                    isProgrammaticChange = true; // Set the flag

                    var selectedTags = $(this).val(); // Get the selected tags as an array

                    // Clear the antitag select2 element
                    $('#antitag').empty();

                    // Remove the selected tags from the tagOptions
                    var filteredOptions = tagOptions.filter(function() {
                        return !selectedTags.includes($(this).val());
                    });

                    // Append the filtered options to the antitag select2 element
                    $('#antitag').append(filteredOptions);

                    // Set the previously selected antitags (if any)
                    var selectedAntitags = $('#antitag').val();
                    $('#antitag').val(selectedAntitags).trigger('change');

                    isProgrammaticChange = false; // Reset the flag
                }
            });

            $('#antitag').on('change', function() {
                if (!isProgrammaticChange) {
                    isProgrammaticChange = true; // Set the flag

                    var selectedAntitags = $(this).val(); // Get the selected antitags as an array

                    // Clear the tag select2 element
                    $('#tag').empty();

                    // Remove the selected antitags from the antitagOptions
                    var filteredOptions = antitagOptions.filter(function() {
                        return !selectedAntitags.includes($(this).val());
                    });

                    // Append the filtered options to the tag select2 element
                    $('#tag').append(filteredOptions);

                    // Set the previously selected tags (if any)
                    var selectedTags = $('#tag').val();
                    $('#tag').val(selectedTags).trigger('change');

                    isProgrammaticChange = false; // Reset the flag
                }
            });
        });
    </script>
@endpush
