@extends('admin.layouts.app')
@php
$title = 'Tags';
@endphp
@section('title', $title)
@section('content')
    <div class="modal fade" id="createTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.tags.store') }}" class="modal-content" method="POST"
                table="TagsDatatableRefresh" modal="createTagModal">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tag">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Title">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
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
                <button type="button" data-toggle="modal" data-target="#createTagModal" class="btn btn-success mb-2">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span class="fw-600">Create</span>
                </button>
                <div class="row">
                    <div class="col-md-12">
                        <livewire:admin.tags-datatable>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <form action="#" method="POST" table="TagsDatatableRefresh" modal="editTagModal" class="modal-dialog"
                role="document" id="editTagModalbody"></form>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/js/formsubmit.js') }}"></script>
    <script>
        window.addEventListener('edit-role-modal-show', event => {
            $('#editTagModal').modal("show");
        });

        function edittag(e, id) {
            addLoader(e);
            $.ajax({
                url: "{{ url('admin/tags') }}/" + id + "/edit",
                type: 'get',
                success: function($response) {
                    $("#editTagModalbody").attr('action', $response.data.url);
                    $("#editTagModalbody").html($response.data.html);
                    $('#editTagModal').modal('show');
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
