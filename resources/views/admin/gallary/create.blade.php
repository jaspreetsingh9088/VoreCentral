@extends('admin.layouts.app')
@php
    $title = 'Create Content';
@endphp
@section('title', $title)
@section('content')
<link rel="stylesheet" href="{{ url('public/assets/css/select2.css')}}">
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
                    <form action="{{ route('admin.galary.store') }}" enctype="multipart/form-data" class="card mb-3" method="POST"
                          redirect="{{ url()->previous() }}">
                        @csrf
                        <div class="card-header">
                            <h5 class="mb-0">Create Content</h5>
                        </div>
                        <div class="card-body col-md-10">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea cols="80" id="testedit" name="description" rows="10" data-sample="1" data-sample-short required>
                                    &lt;p&gt;The &lt;strong&gt;Basic&lt;/strong&gt; package is perfect for short text fields that require little formatting, such as:&lt;/p&gt;
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Add Content, Video, Audio, JPG, GIF and etc</label>
                                <input required type="file" accept="audio/*|video/*|image/*" name="image" class="form-control-file" >
                            </div>
                            <div class="form-group">
                                <label for="">Youtube or third party URL</label>
                                <input type="text" class="form-control" placeholder="Video Url" name="video_url">
                            </div>
                            <div class="form-group">
                                <label for="">Add Thumnail</label>
                                <input id="file-input" class="form-control" type="file" name="thumbnail" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="">Add Tags</label>
                                <select class="select2" class="form-control" name="tags[]" multiple="multiple"
                                    data-placeholder="Select..." data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <?php
                                        if(isset($TagData) && is_array($TagData) && count($TagData) > 0 ){
                                            foreach($TagData as $TagDataK => $TagDataV){
                                                ?>
                                                <option value="{{ $TagDataV['id'] }}">{{ $TagDataV['title'] }} </option>
                                                <?php
                                            }
                                        } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pick a type</label>
                                <select class="select2" class="form-control" name="type[]" id="type_id"
                                    data-placeholder="Pick a type" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option value="">Pick a type </option>
                                    <option value="Literature">Literature </option>
                                    <option value="Picture">Picture </option>
                                    <option value="Comic">Comic </option>
                                    <option value="Video">Video </option>
                                    <option value="Audio">Audio </option>
                                    <option value="Interactive">Interactive </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pick a category</label>
                                <select class="select2" class="form-control" name="category[]" id="category_id"
                                    data-placeholder="Select..." data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option value="Short">Short</option>
                                    <option value="story">story</option>
                                    <option value="chapter">chapter</option>
                                    <option value="other notification">other notification</option>
                                    <option value="3D art">3D art</option>
                                    <option value="Photograhy">Photograhy</option>
                                    <option value="Photomanip">Photomanip</option>
                                    <option value="visual update">visual update</option>
                                    <option value="Traditional art">Traditional art</option>
                                    <option value="Digital art">Digital art</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i><span>Create</span>
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
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="{{ asset('admin/js/formsubmit.js') }}"></script>
    <script>

        $('.select2').select2();
        $('#type_id').change(function() {
            console.log('123');
            $("#category_id").select2({
                data: [{
                    id: '',
                    text: ''
                }]
            });
            $("#category_id").select2({
                allowClear: true,
                ajax: {
                    url: "{{ url('/') }}" + "/get_project_cat ",
                    type: "POST",
                    dataType: 'json',
                    //delay: 300,
                    data: function(params) {
                        var query = {
                            "_token": "{{ csrf_token() }}",
                            type_id: $('#type_id').val(), // search term
                        };
                        return query;
                    },
                    processResults: function(response) {
                        return {
                            results: response,
                        };
                    },
                    //cache: true
                }
            });
        });

        ClassicEditor.create( document.querySelector( '#testedit' ) )
        .then( editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch( error => {
            console.error( error );
        });
    </script>
@endpush
