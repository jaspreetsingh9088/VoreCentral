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
                    <div class="col-md-6">
                        <form class="card mb-3" method="POST"
                            action="{{ route('admin.employees.update', $employee) }}"
                            redirect="{{ url()->previous() }}">
                            @csrf
                            @method('put')
                            <div class="card-header">
                                <h5 class="mb-0">Edit Employee</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                                        value="{{ $employee->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option disabled selected>Select Role</option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}" @selected($employee->role_id == $item->id)>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="newemail">Email</label>
                                    <input type="email" class="form-control" name="email" id="newemail"
                                        placeholder="Enter email" autocomplete="off" value="{{ $employee->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter password" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password"
                                        placeholder="Enter password" autocomplete="off">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <span>Update</span>
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
