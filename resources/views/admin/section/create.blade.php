@extends('admin.layouts.app')
@php
$title = 'Section Management';
@endphp
@section('title', $title)
@section('content')
<style>
<link rel="stylesheet" href="{{ asset('admin/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
<link rel="stylesheet" href="{{ asset('admin/ckeditor/samples/css/samples.css') }}">
</style>
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
                        <form action="{{ route('admin.section.store') }}" class="card mb-3" method="POST"
                            redirect="{{ url()->previous() }}">
                            @csrf
                            <div class="card-header">
                                <h5 class="mb-0">Create Section</h5>
                            </div>
                            <div class="card-body">


                                        <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Name">
                                        </div>




                                       <div class="form-group">
                                       <label for="title" class="awesome">Text</label>
                                       <textarea cols="80" id="testedit" name="text" rows="10" data-sample="1"
                                            data-sample-short>
                                            &lt;p&gt;The &lt;strong&gt;Basic&lt;/strong&gt; package is perfect for short text fields that require little formatting, such as:&lt;/p&gt;
                                        </textarea>
                                        </div>


                                        <div class="form-group" style="margin-top: 48px;text-align:right;">
                                       <input type="hidden" name="cid" value="{{$id}}" />
                                        <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        <span>Create</span>
                                        </button>
                                        <a href="{{ url()->previous() }}" class="btn">Cancel</a>
                                        </div>


                            </div>

                        </form>
                    </div>
                </div>


                </div>
        </section>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/js/formsubmit.js') }}"></script>
    <!--<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>-->
    <!--<script src="{{ asset('admin/samples/js/sample.js') }}" ></script>-->
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
</script>

@endpush
