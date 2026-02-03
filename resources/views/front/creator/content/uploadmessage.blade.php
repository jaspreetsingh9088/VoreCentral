@extends('front.creator.layout.app')
@section('title', 'Creator Upload')
@section('bodyclass','bg_pattern green_theme')
@section('stylelink')
    <link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}" />
@endsection
@section('content')
    <style>
    @media  (min-width: 1200px) {
        .container{
            max-width:750px;
        }
    }
    footer{
        position: fixed;
        bottom: 0;
        width: 100%;
        background: #f1f1f1;
    }
    #message{
        margin-top: 5%;
        width: 100%;
    }
    </style>
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
