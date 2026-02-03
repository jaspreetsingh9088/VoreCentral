@extends('admin.layouts.app')
@php
$title = 'Creators';
@endphp
@section('title', $title)
@section('content')
<style>
    td p{
        text-overflow: ellipsis;
        overflow: hidden;
        display: -webkit-box !important;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
    }
</style>
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


                       <div class="card">
    <div class="card-header">
        <h3 class="card-title">Creators List</h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" id="myTable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Payapl A/c Info</th>
                    <th>Content Type</th>
                    <th>Old A/c Name</th>
                    <th>Old content summary</th>
                    <th>Subgenres </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($Creator) && is_array($Creator) && count($Creator) > 0 ){ foreach($Creator as $CreatorK => $CreatorV){ ?>
                    <tr>
                        <td>{{$CreatorV['userid']['username']}}</td>
                        <td><p>{{$CreatorV['paypal']}}</p></td>
                        <td><p>{{$CreatorV['content_type']}}</p></td>
                        <td><p>{{$CreatorV['old_account']}}</p></td>
                        <td><p>{{$CreatorV['content_description']}}</p></td>
                        <td><p>{{$CreatorV['subgenres']}}</p></td>
                        <td>
                            <a href="{{ URL::to('admin/creators/status/'.$CreatorV['id'].'/'.$CreatorV['status']) }}" class="<?php echo ($CreatorV['status']==2?'btn btn-warning':($CreatorV['status']==1?'btn btn-success':'btn btn-danger')); ?> mb-2">
                            <span class="fw-600"><?php echo ($CreatorV['status']==2?'Approve': ($CreatorV['status']==1?'Active':'In-active')); ?></span>
                            </a>
                        </td>


                    </tr>
                    <?php }}else{ ?>
                    <tr>
                        <td colspan="6">No Data Found</td>
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

@push('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    <script>
        function changestatus(status) {
           alert(status);

           if(confirm("Are you sure to change status ?"))
           {
               window.location.replace("<?php echo URL('admin/creators') ?>");
           }
        }
    </script>
@endpush


