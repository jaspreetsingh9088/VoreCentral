@extends('front.creatorvisitor.layout.app')
@section('title', 'Collection')
@section('bodyclass','green_theme creator_main_theme gallery_audio')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="top_gallery creator_search">
                        <div class="search_box">
                            <span class="text-danger">
                            <form action="{{ url()->current() }}" method="GET" style="margin-top: 2%;">
                                <div class="input-group">
                                    <input type="search" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                                    <button type="submit" class="btn btn-outline-primary ignore-submit">search</button>
                                    </div>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>        
            <?php
            if(isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0 ){
                foreach($Owncollaction as $OwncollactionK => $OwncollactionV){ ?>
                    <div class="col-md-12">
                        <h1> {{ $OwncollactionV['collection_name'] }} </h1>
                    </div>
                    <div class="row creator_box_main create_collect aos-init aos-animate" data-aos="fade-up">
                        <div class="col-sm-12" style="background:#fff; border: 3px solid;">
                            <div class="creatorvisitor-collection">
                                <div class="row flex-nowrap" style="overflow-x: scroll;">
                                    <?php
                                    if(isset($OwncollactionV['contentData']) && is_array($OwncollactionV['contentData']) && count($OwncollactionV['contentData']) > 0 ){
                                        foreach($OwncollactionV['contentData'] as $UsercontentDataKK => $UsercontentDataVV){ ?>
                                            <div class="col-lg-3 col-md-4 col-6" style="padding: 1.5rem;">
                                                <div class="creator-inn">
                                                    <a href="{{ URL('contentdetail/' . $UsercontentDataVV['id']) }}"> 
                                                        <img src="{{ $UsercontentDataVV['thumbnail'] }}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <?php 
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else{ ?>
                <div class="community_box">
                    <div class="card mb-2">
                        <h3 class="text-center">This creator has no collections currently!</h3>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
@endsection