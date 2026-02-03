@extends('front.homepage.layout.app')
@php
    $title = 'User Upload';
@endphp
@section('title', $title)
@section('style')
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}" />
    <style>
    footer{
        position: fixed;
        bottom: 0;
        width: 100%;
        background: #f1f1f1;
    }
    #message{
        margin-top: 5%;
        width: 100% !important;
    }
    </style>
@endsection
@section('content')

    <section class="dlc-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <div id="message"> 
                In order to avoid Spam Uploads, you must become a contributor in order to upload! In order to become a contributor, simply like five items, comment on five items, or make five forum posts 
               </div>
                <div class="col-lg-1">
                </div>
            </div>

        </div>
    </section>


@endsection
   