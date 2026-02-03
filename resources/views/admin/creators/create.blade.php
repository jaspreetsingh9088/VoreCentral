@extends('admin.layouts.app')
@php
    $title = 'Create Creators';
@endphp
@section('title', $title)
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.admindashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.creators.store') }}" enctype="multipart/form-data"
                            class="card mb-3" method="POST" redirect="{{ url()->previous() }}">
                        @csrf
                        <div class="card-header">
                            <h5 class="mb-0">{{$title}}</h5>
                        </div>
                        <div class="card-body col-md-10">
                            <div class="form-group">
                                <label for="name">Add Paypal account for Receiving payments</label>
                                <textarea name="paypal" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">What type of content will you mainly be uploading?.</label>
                                <textarea name="content_type" class="form-control" cols="30" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Do you have any old content from another site to upload here? what is the name of that account?</label>
                                <textarea name="old_account" class="form-control" cols="30" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">If you do not have any old content, describe what your first  upload is  likely to be. Is it  a video, a single artpiece,
                                    or a chapter in some sort of future narative you are planning? If you’d like, give a quick sumary of what its about</label>
                                <textarea name="content_description" class="form-control" cols="30" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">What subgenres are you interested in and what can we expect from you moving forward?</label>
                                <textarea name="subgenres" class="form-control" cols="30" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                <span>Create</span>
                            </button>
                            <a href="{{ url()->previous() }}" class="btn">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
        .create( document.querySelector( '#testedit' ) )
        .then( editor => {
        editor.ui.view.editable.element.style.height = '300px';
        } )
        .catch( error => {
            console.error( error );
        } );

    var displaySingleImagePreview = function(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#'+id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            if($('.file-upload-input')) {
                $('.file-upload-input').css('display', 'none');
            }
        }
    };
</script>
    <script src="{{ asset('admin/js/formsubmit.js') }}"></script>
@endpush
