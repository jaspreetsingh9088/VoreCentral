
<!DOCTYPE html>

<html lang="en">

<head>

    <title>DLC Content</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style-1.css')}}">

   <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
   <script src="{{ url('public/assets/js/jquery-3.6.0.min.js') }}"></script>
</head>

<body class="{{ $themes ? $themes : 'red_theme ' }}" style="font-family:{{ $font }}">

    @include('front.layouts.header')
    @include('front.layouts.subscription_submenu')

        <!-- secondary header-->

        <div class="secondary_header">

            <div class="container">

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                    <div class="container">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="navbar-collapse collapse justify-content-start" id="navbar10">

                            <ul class="navbar-nav nav-fill w-100">

                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('dlc.type',['featured']) }}">Featured</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dlc.type',['latest']) }}">Latest</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dlc.type',['Literature']) }}">Literature</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dlc.type',['Picture']) }}">Pictures</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dlc.type',['Comic']) }}">Comics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dlc.type',['Video']) }}">videos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dlc.type',['Game']) }}">Games</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dlc.type',['Audio']) }}">Audio</a>
                                </li>

                            </ul>

                        </div>

                    </div>

                </nav>

            </div>

        </div>



<!-- main content start -->

<section class="dlc-wrapper">
    <div class="container-fluid">
         <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="dlc_middle-sctn">
                    <div class="disclamer-sctn">
                         <p>DISCLAIMER: Most of the files available below have NOT been Verified and may be harmful to your computer. Only download from trusted users.</p>
                     </div>

                     <div class="ad-spac">
                        <div class="ad_banner landscape">
                            <div data-banner-id="425470"></div>
                        </div>

                    </div>

                     <div class="dlc-table-data" style="padding-left: 10px !important; padding : 10px;">
                         <table class="w-100">
                             <thead>
                                <tr>
                                    <td>Type</td>
                                    <td></td>
                                    <td>Name(Order by Uploaded, Size, Uploaded by, Like, Dislike)</td>
                                    <td>Like</td>
                                    <td>Dislike</td>
                                </tr>
                             </thead>
                                <tbody>
                                    @foreach($DlccontentsData as $dd)
                                        @php
                                            $totallike = App\Models\Likedlc::where('dlcid', $dd->id)->count();
                                            $totaldislike = App\Models\Dislikedlc::where('dlcid', $dd->id)->count();
                                            $negative_content = false;
                                            if(!is_null($generalsetting) && $generalsetting->show_comments == 1){
                                                if($totaldislike > $totallike){
                                                    $negative_content = true;
                                                }
                                            }
                                        @endphp
                                        <tr>
                                            @if($negative_content == true)
                                                <td colspan="5">
                                                    <p class="m-0" style="color: black;">This content is hidden because it has negative like/dislike ratio. To view this, manage your settings from General option page</p>
                                                </td>
                                            @else
                                                <td>
                                                    <p class="m-0"><a style="color : black; text-decoration: unset;" href="#">{{ $dd->filetype }}</a></p>
                                                </td>
                                                <td></td>
                                                <td style="color: black;">
                                                    <table>
                                                        <tr>
                                                            <td class="file-img">
                                                                <a style="color : black; text-decoration: unset; text-overflow: ellipsis;overflow: hidden;display: -webkit-box !important;-webkit-line-clamp: 2;-webkit-box-orient: vertical;white-space: normal;"
                                                                href="{{route('downloaddlcFile', ['file' => $dd->content])}}">
                                                                    {{ $dd->title }}
                                                                </a>
                                                                <p>
                                                                    <a style="color : black; text-decoration: unset;font-size: 20px;" href="{{URL('likedlc/'.$dd->id)}}">
                                                                        @php
                                                                            $islike = false;
                                                                            if(Auth::check()){
                                                                                $islike = App\Models\Likedlc::where('dlcid', $dd->id)->where('userid',Auth::id())->count();
                                                                            }
                                                                        @endphp
                                                                        @if($islike > 0)
                                                                            <i class="fa fa-heart text-black" aria-hidden="true"></i>
                                                                        @else
                                                                            <i class="fa fa-heart-o text-black" aria-hidden="true"></i>
                                                                        @endif
                                                                        {{-- <img src="assets/images/like-icon.webp" alt=""> --}}
                                                                    </a>
                                                                    <a style="color : black; text-decoration: unset;font-size: 20px;" href="{{URL('dislikedlc/'.$dd->id)}}">
                                                                        {{-- <img src="assets/images/dislike-icon.webp" alt=""> --}}
                                                                        @php
                                                                            $isdislike = false;
                                                                            if(Auth::check()){
                                                                                $isdislike = App\Models\Dislikedlc::where('dlcid', $dd->id)->where('userid',Auth::id())->count();
                                                                            }
                                                                        @endphp
                                                                        @if($isdislike > 0)
                                                                            <i class="fa fa-thumbs-down text-black" aria-hidden="true"></i>
                                                                        @else
                                                                            <i class='fa fa-thumbs-o-down text-black' aria-hidden="true"></i>
                                                                        @endif
                                                                    </a>
                                                                </p>
                                                            </td>
                                                            <td>{{ date('d-m-Y',strtotime($dd->created_at))}}</td>
                                                            <td>
                                                                @php
                                                                    $filesize = File::size(public_path('dlccontent/'.$dd->content));
                                                                @endphp
                                                                {{$filesize}}
                                                            </td>
                                                            <td>
                                                                @if(!is_null($dd->user))
                                                                    {{ $dd->user->username }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="color: black;">
                                                    <div align="center">
                                                        @php
                                                            $likecount = App\Models\Likedlc::where('dlcid', $dd->id)->count();
                                                        @endphp
                                                        {{ $likecount }}<br>Likes
                                                    </div>
                                                </td>
                                                <td style="color: black;">
                                                    <div align="center">
                                                        @php
                                                            $dislikecount = App\Models\Dislikedlc::where('dlcid', $dd->id)->count();
                                                        @endphp
                                                        {{ $dislikecount }}<br>Dislikes
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    {{--<?php
                                    if(isset($DlccontentsData) && is_array($DlccontentsData) && count($DlccontentsData) > 0 ){
                                        foreach($DlccontentsData as $DlccontentsDataK => $DlccontentsDataV){
                                            ?>
                                            <tr>
                                                <td>
                                                    <p class="m-0"><a style="color : black; text-decoration: unset;" href="#">{{ $DlccontentsDataV['filetype']}}</a></p>
                                                </td>
                                                <td></td>
                                                <td style="color: black;">
                                                    <table>
                                                        <tr>
                                                            <td class="file-img">
                                                                <a style="color : black; text-decoration: unset; text-overflow: ellipsis;overflow: hidden;display: -webkit-box !important;-webkit-line-clamp: 2;-webkit-box-orient: vertical;white-space: normal;" href="{{route('downloaddlcFile', ['file' => $DlccontentsDataV['content']])}}">
                                                                    {{ $DlccontentsDataV['title']}}
                                                                </a>
                                                                <p>
                                                                    <a style="color : black; text-decoration: unset;" href="{{URL('likedlc/'.$DlccontentsDataV['id'])}}">
                                                                        <img src="assets/images/like-icon.webp" alt="">
                                                                    </a>
                                                                    <a style="color : black; text-decoration: unset;" href="{{URL('dislikedlc/'.$DlccontentsDataV['id'])}}">
                                                                        <img src="assets/images/dislike-icon.webp" alt="">
                                                                    </a>
                                                                </p>
                                                            </td>
                                                            <td>{{ date('d-m-Y',strtotime($DlccontentsDataV['created_at']))}}</td>
                                                            <td>{{ $DlccontentsDataV['filesize']}}</td>
                                                            <td>{{ $DlccontentsDataV['username']}}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="color: black;">
                                                    <div align="center">
                                                        {{ $DlccontentsDataV['likecount']}}<br>Likes
                                                    </div>
                                                </td>
                                                <td style="color: black;">
                                                    <div align="center">
                                                        {{ $DlccontentsDataV['dislikecount']}}<br>Dislikes
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } ?>--}}
                             </tbody>
                         </table>
                         <div class="pagination_subforums mt-5" style="display: flex; justify-content: center;">
                            {{ $DlccontentsData->links('vendor.pagination.dlc-pagination') }}
                          </div>
                     </div>
                 </div>
            </div>

            <div class="col-lg-2">
                <div class="dlc-right">
                    <div class="ad-spac">
                        <div class="ad_banner vertical">
                            <div data-banner-id="425472"></div>
                        </div>
                    </div>
                </div>
            </div>


         </div>

    </div>

</section>

<footer>

   <div class="footer-bottom">

      <div class="container">

         <div class="row">

            <div class="col-sm-12">

               <div class="d-sm-flex justify-content-between align-items-center">

                  <div class="fs-14 font-weight-600">

                     <ul class="footer_menu">

                        <li>
                            <a href="{{ URL('contactus') }}">Contact us</a>
                        </li>

                        <li>
                            <a href="{{ URL('aboutus') }}">About us</a>
                        </li>

                        <li>
                            <a href="{{ route('privacypolicy') }}">Privacy Policy</a>
                        </li>

                        <li>
                            <a href="{{route('termsservice')}}">Terms of Service</a>
                        </li>

                     </ul>

                     © {{ date('Y') }}.  All rights reserved.

                  </div>

                   <ul class="social-media mb-3">
                       <li>
                           <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                               <i class="mdi mdi-youtube"></i>
                               <span class="sr-only">{{ env('APP_NAME')  }} Youtube</span>
                           </a>
                       </li>
                       <li>
                           <a href="{{ env('APP_TWITTER_LINK', '#') }}">
                               <i class="mdi mdi-twitter"></i>
                               <span class="sr-only">{{ env('APP_NAME')  }} Twitter</span>
                           </a>
                       </li>
                   </ul>

               </div>

            </div>

         </div>

      </div>

   </div>

</footer>

</body>

</html>

