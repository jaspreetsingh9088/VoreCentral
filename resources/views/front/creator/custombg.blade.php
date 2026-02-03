@extends('front.creator.uploadpage-layout.app')
@section('title', 'Custome Background')
@section('bodyclass','green_theme')
@php
    // $customebg = Auth::user()->themebg;
    // if($customebg != null){
    //     $style = 'background: url('.$customebg.') 0% 0% / cover repeat !important;';
    // }
@endphp
@section('style')
    .profile-upload{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
    .add-custom-bg{
        {{-- background:url({{$customebg}}) repeat; background-size:cover ; --}}
    }
@endsection
@section('content')
    {{-- <div class=""> --}}
        <div class="main-panel">
	        <div class="content-wrapper">
                <div class="container">
                    <div class="add-custom-sctn">
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="add-custom-bg">
                                    <h2>Add Custom<br>Background</h2>
                                    <div class="image-upload">
                                        <label class="open_popup">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="add-custom-right">
                                    <div class="ad_banner vertical">
                                        <div data-banner-id="425472"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
		        </div>
            </div>
        </div>
    {{-- </div> --}}
    <div class="profile-upload">
        <div class="profile-inner">
            <div class="profile-box-upload">
                <div class="upload-file-container">
                    <div class="close-icon">X</div>
                    <form class="sign_up_form" action="{{ route('updatethemebg') }}" enctype='multipart/form-data'
                        class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                        @csrf
                        <input type="file" name="themebg" accept="image/*" />
                        <input type="submit" value="upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
