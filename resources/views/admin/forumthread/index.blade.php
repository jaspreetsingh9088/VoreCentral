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
                <x-admin.common.role-check :type="'add'">
                    <a href="{{ route('admin.forumthread.create') }}" class="btn btn-success mb-2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="fw-600">Create</span>
                    </a>
                </x-admin.common.role-check>
                <div class="row">
                    <div class="col-md-12">
                        <livewire:admin.forumthread-datatable>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
