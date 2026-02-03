@extends('admin.layouts.app')
@php
    $title = 'Revenue & Analytics';
@endphp
@section('title', $title)
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Revenue & Analytics</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Revenue & Analytics</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Top Creators</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Sales</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($creators as $creator)
                                        <tr>
                                            <td>
                                                {{$creator->username}}
                                            </td>
                                            <td>{{$creator->email}}</td>
                                            <td>
                                                {{$creator->total_amount}}
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No record Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Revenue</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">{{$totalAmount}}</span>
                                        <span>Sales Over Time</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                    <span @class(["text-success" => $percentageGrowth > 0, "text-danger" => $percentageGrowth <= 0 ])>
                        <i class="fas fa-arrow-up"></i> {{$percentageGrowth}}%
                    </span>
                                        <span class="text-muted">Since last month</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Top Users</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Sales</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>
                                                {{$user->username}}
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                {{$user->total}}
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No record Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    @push('script')
        <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>

        <script>
            /* global Chart:false */

            $(function () {
                'use strict'

                var ticksStyle = {
                    fontColor: '#495057',
                    fontStyle: 'bold'
                }

                var mode = 'index'
                var intersect = true

                var $salesChart = $('#sales-chart')
                // eslint-disable-next-line no-unused-vars
                var salesChart = new Chart($salesChart, {
                    type: 'bar',
                    data: {
                        labels: @js($monthlyTotals->pluck('month')),
                        datasets: [
                            {
                                backgroundColor: '#007bff',
                                borderColor: '#007bff',
                                data: @js($monthlyTotals->pluck('total_amount'))
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,

                                    // Include a dollar sign in the ticks
                                    callback: function (value) {
                                        if (value >= 1000) {
                                            value /= 1000
                                            value += 'k'
                                        }

                                        return '$' + value
                                    }
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })

                // var $visitorsChart = $('#visitors-chart')
                // // eslint-disable-next-line no-unused-vars
                // var visitorsChart = new Chart($visitorsChart, {
                //     data: {
                //         labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                //         datasets: [{
                //             type: 'line',
                //             data: [100, 120, 170, 167, 180, 177, 160],
                //             backgroundColor: 'transparent',
                //             borderColor: '#007bff',
                //             pointBorderColor: '#007bff',
                //             pointBackgroundColor: '#007bff',
                //             fill: false
                //             // pointHoverBackgroundColor: '#007bff',
                //             // pointHoverBorderColor    : '#007bff'
                //         },
                //             {
                //                 type: 'line',
                //                 data: [60, 80, 70, 67, 80, 77, 100],
                //                 backgroundColor: 'tansparent',
                //                 borderColor: '#ced4da',
                //                 pointBorderColor: '#ced4da',
                //                 pointBackgroundColor: '#ced4da',
                //                 fill: false
                //                 // pointHoverBackgroundColor: '#ced4da',
                //                 // pointHoverBorderColor    : '#ced4da'
                //             }]
                //     },
                //     options: {
                //         maintainAspectRatio: false,
                //         tooltips: {
                //             mode: mode,
                //             intersect: intersect
                //         },
                //         hover: {
                //             mode: mode,
                //             intersect: intersect
                //         },
                //         legend: {
                //             display: false
                //         },
                //         scales: {
                //             yAxes: [{
                //                 // display: false,
                //                 gridLines: {
                //                     display: true,
                //                     lineWidth: '4px',
                //                     color: 'rgba(0, 0, 0, .2)',
                //                     zeroLineColor: 'transparent'
                //                 },
                //                 ticks: $.extend({
                //                     beginAtZero: true,
                //                     suggestedMax: 200
                //                 }, ticksStyle)
                //             }],
                //             xAxes: [{
                //                 display: true,
                //                 gridLines: {
                //                     display: false
                //                 },
                //                 ticks: ticksStyle
                //             }]
                //         }
                //     }
                // })
            })

            // lgtm [js/unused-local-variable]

        </script>

    @endpush

@endsection
