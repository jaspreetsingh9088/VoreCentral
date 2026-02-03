@extends('admin.layouts.app')
@php
    $title = 'News Archive';
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
                    <form action="{{ route('admin.newsarchive.store') }}" enctype="multipart/form-data"
                            class="card mb-3" method="POST" redirect="{{ url()->previous() }}">
                        @csrf
                        <div class="card-header">
                            <h5 class="mb-0">Create News Archive</h5>
                        </div>
                        <div class="card-body col-md-10">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label>
                                {{-- <textarea name="description" class="form-control" cols="30" rows="10" required></textarea> --}}
                                <textarea cols="80" id="testedit" name="description" rows="10" data-sample="1" data-sample-short required>
                                    &lt;p&gt;The &lt;strong&gt;Basic&lt;/strong&gt; package is perfect for short text fields that require little formatting, such as:&lt;/p&gt;
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input required type="file" accept="image/*" name="image" class="form-control-file" onchange="displaySingleImagePreview(this, 'image')">
                                <img src="" id="image" style="max-width: 50%; max-height: 50%; width: auto; height: auto;" class="mt-2">
                            </div>
                        </div>
                        <div class="card-footer">
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
