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
                        <form  action="{{route('admin.cms.update', $userData->id)}}" class="card mb-3" method="post" redirect="{{ url()->previous() }}">
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
                                        placeholder="Title" value="{{$userData->title}}">
                                        </div>
                                        
                                         <div class="form-group">
                                        <label for="name">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" id="name"
                                        placeholder="Meta Title" value="{{$userData->meta_title}}">
                                        </div>
                                        
                                      
                                
                                   </div>
                                   
                                   <div class="col-md-6">
                                         <div class="form-group">
                                        <label for="name">Meta Description</label>
                                        <input type="text" class="form-control" name="meta_description" id="name"
                                        placeholder="Meta Description"  value="{{$userData->meta_description}}">
                                        </div>
                                        
                                        <div class="form-group">
                                        <label for="name">Meta Tag</label>
                                        <input type="text" class="form-control" name="meta_tag" id="name"
                                        placeholder="Meta Tag" value="{{$userData->meta_tag}}">
                                        </div>
                                        
                                        <div class="form-group" style="margin-top: 48px;text-align:right;">
                                       
                                        <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        <span>Update</span>
                                        </button>
                                        <a href="{{ url()->previous() }}" class="btn">Cancel</a>
                                        </div>
                                   
                                   </div>
                                   
                                   
                                 
                                   @method('PUT')
                                </div>
                               
                 
                            </div>
                            
                        </form>
                    </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                     {{$userData->title}} Page List
                    <a href="{{ URL::to('admin/section/addsection/'. $userData->id) }}" class="btn btn-success mb-2">
                    
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span class="fw-600">Add New Section</span>
                    </a>
                    
                </div></div>        
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">Content List</h3>
        <div class="card-tools">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" wire:model="search">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                   
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
               @foreach ($sectionData as $section)
                    <tr>
                        <td>{{$section->name}}</td>
                        <td>
                            <a href="{{ URL::to('admin/section/' . $section->id) }}" class="btn btn-primary">
                                <i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</a>
                           
                        </td>
                    </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
                <div class="float-right">
                  
                </div>
            </div>
        </div>
    </div>
</div>

                    </div>
                </div>
                
                
            </div>
        </section>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/js/formsubmit.js') }}"></script>
@endpush
