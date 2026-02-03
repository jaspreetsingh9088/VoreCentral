@extends('admin.layouts.app')
@php
$title = 'All Thread';
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Forum Thread</h3>
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
                                            <th>Topic</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($forumthread as $item)
                                            <tr>
                                                <td>{{ $item->topic }}</td>
                                                <td>
                                                    <a href="{{ route('admin.forumthread.edit',[$item->id]) }}" type="button" class="btn btn-sm btn-success">Edit</a>
                                                    {{-- <a href="{{ route('admin.forumthread.show',[$item->id]) }}" type="button" class="btn btn-sm btn-primary">view</a> --}}
                                                    <a href="{{ route('admin.forumthread.delete',[$item->id]) }}" type="button" class="btn btn-sm btn-danger">Delete</a>
                                                    @if($item->thread_lock == 0)
                                                        <a href="{{ route('admin.forumthread.updatestatus',[$item->id,'1']) }}" type="button" class="btn btn-sm btn-danger">Lock</a>
                                                    @elseif($item->thread_lock == 1)
                                                        <a href="{{ route('admin.forumthread.updatestatus',[$item->id,'0']) }}" type="button" class="btn btn-sm btn-success">Unlock</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No More Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-right">
                                            {{ $forumthread->links() }}
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endpush
