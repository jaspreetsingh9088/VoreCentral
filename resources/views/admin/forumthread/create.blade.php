@extends('admin.layouts.app')
@php
    $title = 'Forum Thread';
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
                    <form action="{{ route('admin.forumthread.store') }}" enctype="multipart/form-data"
                            class="card mb-3" method="POST" redirect="{{ url()->previous() }}">
                        @csrf
                        <div class="card-header">
                            <h5 class="mb-0">Create Forum Thread</h5>
                        </div>
                        <div class="card-body col-md-10">
                            <div class="form-group">
                                <select name="cid" class="form-control" required>
                                    <option value="">Selecte Forum Category</option>
                                    @foreach($forumcat as $row)
                                        <option value="{{$row->id}}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Topic</label>
                                <input type="text" class="form-control" name="topic" id="topic" placeholder="Enter topic" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Comment</label>
                                <textarea cols="80" name="comment" class="form-control" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Add Media</label>
                                <input type="file" name="media" class="form-control-file">
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
