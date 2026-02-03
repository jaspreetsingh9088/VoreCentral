@extends('admin.layouts.app')
@php
$title = 'Content Management';
@endphp
@section('title', $title)
@section('content')

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
                <a href="{{ route('admin.cms.create') }}" class="btn btn-success mb-2">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span class="fw-600">Create</span>
                </a>
                <div class="row">
                    <div class="col-md-12">
                       <div class="card">
    <div class="card-header">
        <h3 class="card-title">Content List</h3>
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
                    <th>#</th>
                    <th>Name</th>
                    <th>Sections</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
            @foreach ($userData as $userK => $userV)
             <?php $sec = implode(",",array_column($userV['sections'],'name')); ?>
            <tr>
            <td>{{$userK+1}}</td>        
            <td>{{$userV['title']}}</td>
            <td><?php echo $sec; ?></td>
            <td>
            <a href="{{ URL::to('admin/cms/' . $userV['id']) }}" class="btn btn-primary">
            <i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</a>
            
            </td>
            </tr>
            @endforeach
                   
               
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
                <div class="float-right">
                  
                </div>
            </div>
        </div>
    </div>
</div>

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
                url: "{{ url('admin/subscription') }}/" + id + "/edit",
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
