@extends('admin.layouts.app')
@php
    $title = 'Employees';
@endphp
@section('title', $title)
@push('links')
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}">
    <style>
        .select2-container .select2-selection--single{
            height: auto !important;
        }
    </style>
@endpush
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
                        <form action="{{ route('admin.employees.store') }}" class="card mb-3" method="POST"
                              redirect="{{ url()->previous() }}">
                            @csrf
                            <div class="card-header">
                                <h5 class="mb-0">Create Employee</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option disabled selected>Select Role</option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                @if (auth()->user()->admin_id == null)
                                                    {{ '(' . $item->admin->name . ')' }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @livewire('admin.employee.moderator-email-box-employee-admin-livewire')
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Enter password" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           id="password"
                                           placeholder="Enter password" autocomplete="off">
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
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
@endpush
