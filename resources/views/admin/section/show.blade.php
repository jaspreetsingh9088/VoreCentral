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
                        <form action="{{route('admin.section.update', $sectionData->id)}}" class="card mb-3" method="POST"
                            redirect="{{ url()->previous() }}">
                            @csrf
                            <div class="card-header">
                                <h5 class="mb-0">Create Section</h5>
                            </div>
                            <div class="card-body">
                                
                                   
                                        <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Name" value="{{$sectionData->name}}">
                                        </div>
                                        
                                     
                                        
                                         
                                       <div class="form-group">
                                       <label for="title" class="awesome">Text</label>
                                       <textarea cols="80" id="testedit2" name="text" rows="10" data-sample="1" data-sample-short>{{$sectionData->text}}</textarea>
                                        </div>
           
            
                                        <div class="form-group" style="margin-top: 48px;text-align:right;">
                                       
                                        <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        <span>Update</span>
                                        </button>
                                        <a href="{{ url()->previous() }}" class="btn">Cancel</a>
                                        </div>
                                   
                             @method('PUT')
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
        .create( document.querySelector( '#testedit2' ) )
        .then( editor => {
        editor.ui.view.editable.element.style.height = '300px';
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

@endpush
