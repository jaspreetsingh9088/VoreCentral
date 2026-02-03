@extends('admin.layouts.app')
@php
    $title = 'Advertisement';
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
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.admindashboard') }}">Dashboard</a></li>
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
                    <form action="{{ route('admin.advertisement.store') }}" class="card mb-3"
                        method="POST" redirect="{{ url()->previous() }}">
                        @csrf
                        <div class="card-header">
                            <h5 class="mb-0">Create Advertisement</h5>
                        </div>
                        <div class="card-body col-md-6">
                           
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                            </div>

                           

                            <div class="col-lg-12 connectedSortable">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Status</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-label-group">
                                            <select class="form-control" id="type" class="form-control" name="status"
                                                placeholder="Status" required="">
                                                <option value="1"
                                                    {{ old('status') == "1" ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ old('status') == "0" ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @if($errors->has('status'))
                                                <span
                                                    class="text-danger">{{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div>
                                <div class="form-group col-md-12">
                                    <label>Horizontal Advertisement  (Dimensions 728*90):</label>
                                    <!--<input type="file" name="image1" id="image1" class="form-control" >-->
                                    <textarea class="form-control" name="content1" id="content1" rows="10"></textarea>
                                </div>
                                </div>
                                <div>
                                <div class="form-group col-md-12">
                                    <label>Vertical Advertisement (Dimensions 160*600):</label>
                                    <!--<input type="file" name="image2" id="image2" class="form-control" >-->
                                    <textarea class="form-control" name="content2" id="content2" rows="10"></textarea>
                                </div>
                                </div>
                            

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
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
    <script src="{{ asset('admin/js/formsubmit.js') }}"></script>
@endpush
