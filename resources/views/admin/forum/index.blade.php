@extends('admin.layouts.app')
@php
$title = 'Forum Category';
@endphp
@section('title', $title)
@section('content')
    <?php //dd($forumheadingData); ?>
    <div class="modal fade" id="createTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.forumcategory.store') }}" class="modal-content" method="POST"
                table="TagsDatatableRefresh" modal="createTagModal">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                 <div class="modal-body">
                    <div class="form-group">
                        <label for="tag">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                </div>

                 <div class="modal-body">
                    <div class="form-group">
                        <label for="tag">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Description">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tag">Select Parent Heading</label>
                        <select class="form-control" name="hid">
                            <?php if(isset($forumheadingData) && is_array($forumheadingData) && count($forumheadingData) > 0){
                                  foreach($forumheadingData as $forumheadingDataK =>$forumheadingDataV){
                            ?>
                            <option value="{{$forumheadingDataV['id']}}"> {{$forumheadingDataV['name']}} </option>
                            <?php }} ?>
                        </select>
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
                        <livewire:admin.forumcategories-datatable>
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
        var confirmDelete = function(section, url) {
            swal.fire({
                title: "Are you sure?",
                text: "You want to delete this " + section,
                icon: "error",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        };
    </script>
    <script>
        window.addEventListener('edit-role-modal-show', event => {
            $('#editTagModal').modal("show");
        });

        function edittag(e, id) {
            addLoader(e);
            $.ajax({
                url: "{{ url('admin/forumcategory') }}/" + id + "/edit",
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
