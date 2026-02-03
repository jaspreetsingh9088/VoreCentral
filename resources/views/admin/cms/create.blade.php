@extends('admin.layouts.app')
@php
$title = 'Content Management System';
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
                        <form  action="{{ route('admin.cms.store') }}" class="card mb-3" method="POST"  redirect="{{ url()->previous() }}">
                            @csrf
                            <div class="card-header">
                                <h5 class="mb-0">Create CMS</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                   <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="name"> Title</label>
                                        <input type="text" class="form-control" name="title" id="name"
                                        placeholder="Title" >
                                        </div>
                                          <div class="form-group">
                                        <label for="name"> Alias</label>
                                        <input type="text" class="form-control" name="alias" id="alias"
                                        placeholder="Alias" >
                                        </div>
                                        
                                         <div class="form-group">
                                        <label for="name">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" id="name"
                                        placeholder="Meta Title" >
                                        </div>
                                        
                                      
                                
                                   </div>
                                   
                                   <div class="col-md-6">
                                         <div class="form-group">
                                        <label for="name">Meta Description</label>
                                        <input type="text" class="form-control" name="meta_description" id="name"
                                        placeholder="Meta Description"  >
                                        </div>
                                        
                                        <div class="form-group">
                                        <label for="name">Meta Tag</label>
                                        <input type="text" class="form-control" name="meta_tag" id="name"
                                        placeholder="Meta Tag">
                                        </div>
                                        
                                        <div class="form-group" style="margin-top: 48px;text-align:right;">
                                       
                                        <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        <span>Create</span>
                                        </button>
                                        <a href="{{ url()->previous() }}" class="btn">Cancel</a>
                                        </div>
                                   
                                   </div>
                                   
                                   
                                 
                                   
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
@endpush
