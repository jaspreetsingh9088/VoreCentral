@extends('admin.layouts.app')
@php
$title = 'Roles';
@endphp
@section('title', $title)
@section('content')
    <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.roles.store') }}" class="modal-content" method="POST"
                table="RolesDatatableRefresh" modal="createRoleModal">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tag">Role Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Role">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
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
                    <button type="button" data-toggle="modal" data-target="#createRoleModal" class="btn btn-success mb-2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="fw-600">Create</span>
                    </button>
                </x-admin.common.role-check>
                <div class="row">
                    <div class="col-md-12">
                        <livewire:admin.role.roles-datatable>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="visibletabs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form class="modal-dialog modal-lg" role="document" id="visibletabsform" action="#" method="POST"
            table="RolesDatatableRefresh" modal="visibletabs"></form>
    </div>
    <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="#" method="POST" table="RolesDatatableRefresh" modal="editRoleModal" class="modal-dialog"
            role="document" id="editRoleModalbody"></form>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/js/formsubmit.js') }}"></script>
    <script>
        function editrole(e, id) {
            addLoader(e);
            $.ajax({
                url: "{{ url('admin/roles') }}/" + id + "/edit",
                type: 'get',
                success: function($response) {
                    $("#editRoleModalbody").attr('action', $response.data.url);
                    $("#editRoleModalbody").html($response.data.html);
                    $('#editRoleModal').modal('show');
                    removeLoader(e);
                },
                error: function($response) {
                    console.log($response.responseJSON.message);
                    removeLoader(e);
                }
            });
        }
    </script>
@endpush
