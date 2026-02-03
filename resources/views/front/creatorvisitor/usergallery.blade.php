@extends('front.homepage.layout.app')
@section('title', 'Content Promoted Produced')
@section('content')
    <div class="secondary_header" style="display: none;">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse justify-content-start" id="navbar10">
                        <ul class="navbar-nav nav-fill w-100">
                            <li class="nav-item"><a class="nav-link" href="#">Mixed</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Free Content</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Store Items</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Official Statements and other Misc</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">Media Subtotals</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- main content start -->
    <section class="dlc-wrapper">
        <div class="container-fluid">
            {{-- <div class="row ">
                    <div class="col-lg-2"> </div>
                    <div class="col-lg-8">
                        <div class="search_box_forums mb-5">
                            <div class="d-flex search_box justify-content-end">
                            <span class="text-danger">
                                <div class="input-group">
                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                            </div>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div> --}}
            <div class="row mt-5">

                <div class="col-lg-2 mt-5">
                    <div class="subs-left">
                        <div class="subs-ad-top mb-4">
                            <div class="ad_banner vertical">
                                <div data-banner-id="425472"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="subs-center">
                        <div class="row">
                            @if (count($data) > 0)

                                @foreach ($data as $index => $filteredData)
                                    @php $user = App\Models\User::select(
                                            'username',
                                            'profile_pic',
                                            'id',
                                            'creator',
                                        )
                                            ->where('id', $filteredData['userid'])
                                            ->first();

                                    @endphp
                                    <div class="col-md-3">
                                        <div class="subs-boxx">
                                            <a href="{{ URL('contentdetail/' . $filteredData['id']) }}">
                                                <img src="{{ $filteredData['thumbnail'] }}" class="w-100" alt="" />
                                            </a>
                                            <a href="{{ URL('contentdetail/' . $filteredData['id']) }}">
                                                <h5 class="m-0">{{ $filteredData['title'] }}</h5>
                                            </a>
                                            <div class="clearfix subs-content">
                                                <div class="float-left">
                                                    <a href="{{ URL($user->id . '/dashboard') }}"><span
                                                            style="cursor: pointer;" class="username"
                                                            data-link="">{{ $user->username }}</span></a>
                                                </div>
                                                <div class="float-right">
                                                    <a href="{{ URL('contentdetail/' . $filteredData['id']) }}"><span>{{ \Carbon\Carbon::parse($filteredData['created_at'])->format('d-m-Y') }}</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <h3 class="text-center" style="color: black;">No Content Found</h3>
                                </div>
                            @endif
                        </div><!-- row ends-->
                        <div class="pagination_subforums text-center mb-5">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <style>
        footer {
            position: fixed;
            bottom: 0px;
            width: 100%;
        }
    </style>
@endsection
@push('script')
    <script>
        $('.username').click(function() {
            var link = $(this).data('link');
            window.location = link;
        })
    </script>
@endpush
