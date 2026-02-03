@extends('admin.layouts.app')
@php
$title = 'Purchased Content';
@endphp
@section('title', $title)
@section('content')
    <style>
        #myTable_length{
            margin-left : 10px; margin-top : 5px;
        }
        .dataTables_filter{
            margin-right : 10px; margin-top : 5px;
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Purchased Content</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Content Name</th>
                                            <th>Amount</th>
                                            <th>Qty</th>
                                            <th>Purchased Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchasedcontent as $pc)
                                            <tr>
                                                <td>
                                                    @php
                                                        $cart = App\Models\Cart::where('id',$pc->cart_id)->with('user')->first();
                                                    @endphp
                                                    @if(!is_null($cart->user))
                                                        {{ $cart->user->username }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!is_null($pc->paidcontent))
                                                        {{ $pc->paidcontent->title }}
                                                    @endif
                                                </td>
                                                <td>{{ $pc->price }}</td>
                                                <td>{{ $pc->quantity }}</td>
                                                {{-- <td>{{ $pc->view }}</td> --}}
                                                <td>{{ date('d-m-Y', strtotime($pc->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        });
    </script>
@endpush
