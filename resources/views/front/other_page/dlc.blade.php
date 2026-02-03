@extends('front.other_page.layout.app')
@section('title', 'DLC Content')
@section('content')
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
                                    @if(count($DlccontentsData) > 0)
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
                                            <tr id="dlccontent{{$dd->id}}">
                                                @if($negative_content == true)
                                                    <td colspan="5">
                                                        <p class="m-0" style="color: black;">This content is hidden because it has negative like/dislike ratio. To view this, manage your settings from General option page</p>
                                                    </td>
                                                @else
                                                    @if (file_exists(public_path('dlccontent/'.$dd->content)))
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
                                                            {{ $totallike }}<br>Likes
                                                        </div>
                                                    </td>
                                                    <td style="color: black;">
                                                        <div align="center">
                                                            {{ $totaldislike }}<br>Dislikes
                                                        </div>
                                                    </td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr style="width: 100%;">
                                            <td style="color: black;" align="center" colspan="5">No records found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination_subforums mt-5" style="display: flex; justify-content: center;">
                                {{ $DlccontentsData->links() }}
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
@endsection
