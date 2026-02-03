@extends('admin.layouts.app')
@php
$title = 'Users';
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
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ $user->image }}" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>{{ $user->username }}</h4>
                                        <p class="text-secondary mb-1">Creator</p>
                                        <h5 class="mb-1">{{ $user->email }}</h5>
                                        @if ($user->status)
                                            <div class="text-success py-2 px-4 rounded my-2 fw-600 bg-light-green w-min mx-auto">
                                                Active
                                            </div>
                                        @else
                                            <div class="text-danger py-2 px-4 rounded my-2 fw-600 bg-light-red w-min mx-auto">
                                                Deactive
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Subgenres</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->subgenres }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Quick Summary</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->quicksummary }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Old Account</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->oldaccount }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Main Content</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->maincontent }}
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
