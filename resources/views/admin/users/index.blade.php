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
                    <div class="col-12">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users List</h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Sexual orientation</th>
                                            <th>Vore Role Preference</th>
                                            <th>Date of birth</th>
                                            <th>IP</th>
                                            <th>latitude</th>
                                            <th>latitude</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($user) && is_array($user) && count($user) > 0 ){ foreach($user as $userK => $userV){ ?>
                                            <tr>
                                                <td>{{$userV['username']}}</td>
                                                <td>{{$userV['email']}}</td>
                                                <td>{{$userV['gender']}}</td>
                                                <td>{{$userV['sexual_orientation']}}</td>
                                                <td>{{$userV['role_preference']}}</td>
                                                <td>{{$userV['dob']}}</td>
                                                <td>{{$userV['ip_address']}}</td>
                                                <td>{{$userV['latitude']}}</td>
                                                <td>{{$userV['longitude']}}</td>
                                                <td>
                                                    <a href="{{ URL::to('admin/users/status/'.$userV['id'].'/'.$userV['status']) }}" class="<?php echo ($userV['status']==1?'btn btn-success':'btn btn-danger'); ?> mb-2">
                                                    <span class="fw-600"><?php echo ($userV['status']==1?'Active':'In-active'); ?></span>
                                                    </a>
                                                    @if($userV['cid'] == null)
                                                        {{-- <a class="btn btn-sm btn-success" href="{{ route('admin.creators.create',[$userV['uid']]) }}">Make Creator</a> --}}
                                                        <a class="btn btn-sm btn-success" href="{{ route('admin.creators.make',[$userV['uid']]) }}">Make Creator</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        <?php }}else{ ?>
                                            <tr>
                                                <td colspan="6">No More Data Found</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
