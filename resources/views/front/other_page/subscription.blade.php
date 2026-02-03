@extends('front.other_page.layout.app')
@section('title', 'Subscription')
@section('style')
   <style>
        .new-div{
           margin:0px 13px;
           width:165px;
           display: inline-block;
        }
        .content-title{
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: normal;
        }
   </style>
@endsection
@section('content')
<section class="dlc-wrapper">
    <div class="container-fluid">
         <div class="row">

            <div class="col-lg-2">
                <div class="ad_banner vertical">
                    <div data-banner-id="425472"></div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="subs-center">
                    <?php
                    $no_of_records_per_page = 20 ;
                    $offset = ($pageno-1) * $no_of_records_per_page;
                    $total_rows = $Usercontentdatacount ;
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $counter = 0 ;
                    if(isset($UsercontentData) && count($UsercontentData) > 0 ){
                        foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){
                            if($counter==0){
                                echo '<div class="row">';
                            }
                            if($counter%5==0){
                                echo '</div><div class="row">';
                            }
                            ?>
                            <div class="new-div">
                                <a href="{{URL('contentdetail/'.$UsercontentDataV['id'])}}">
                                    <div class="subs-boxx">
                                        <img src="{{$UsercontentDataV['thumbnail']}}" class="w-100" alt=""/>
                                        <h5 class="m-0 content-title">{{ucwords($UsercontentDataV['title'])}}</h5>
                                        <div class="clearfix subs-content">
                                            <div class="float-left">
                                                <span>{{$UsercontentDataV->user->username}}</span>
                                            </div>
                                            <div class="float-right">
                                                <span>{{ date('d M Y',strtotime($UsercontentDataV['created_at']))}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            if(count($UsercontentData)==$UsercontentDataK+1){ echo '</div>';}
                            $counter++ ;
                        }
                    }else{
                        ?>
                        <h3 class="text-center">No records found.</h3>
                        <?php
                    }
                    ?>
                    @if(count($UsercontentData) > 0 )
                        <div class="pagination_subforums mt-5">
                            <ul class="list-none float-left">
                                <li><?php echo "Page ".$pageno." of ".$total_pages ?></li>
                                <li><a  style="color:#222;" href="{{URL('subscription/1')}}">First</a></li>
                                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                    <a style="color:#222;" href="<?php if($pageno <= 1){ echo '#'; } else { echo URL('subscription/'.$pageno-1); } ?>">Prev</a>
                                </li>
                                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                    <a style="color:#222;" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo URL('subscription/'.$pageno+1); } ?>">Next</a>
                                </li>
                                <li><a style="color:#222;" href="{{URL('subscription/'.$total_pages)}}">Last</a></li>
                            </ul>
                        </div>
                    @endif
                        <br>
                        <br>

                    <div class="ad_banner landscape">
                        <div data-banner-id="425470"></div>

                    </div>

                </div>
            </div>

            <div class="col-lg-2">
                <div class="ad_banner vertical">
                    <div data-banner-id="425472"></div>
                </div>
            </div>

         </div>
    </div>
</section>
@endsection
