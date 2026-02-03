@extends('front.profilevisitor.layout.app')
@php
    $title = 'My Dashboard';
@endphp
@section('title', $title)
@section('content')

<section class="user-about-sctn user-pg">
    <div class="container">
        <div class="row">
           @include('front.profilevisitor.layout.visitorusersidepanel')
             <div class="col-lg-8 pl-0">
                <div class="user-section1 auto-height" style="height:auto ; padding:30px;">
                    <div class="middle-part-padding dashboard-66">
                        @if (isset($ActivityData) && is_array($ActivityData) && count($ActivityData) > 0)
                            @foreach ($ActivityData as $ActivityDataK => $ActivityDataV)
                                <div class="row mb-3" style="border: 2px solid #000;padding: 10px;">
                                    <div class="col-lg-2 col-md-2 col-3">
                                        <a href="{{ URL('dashboard/' . $ActivityDataV['refrenceid']) }}">
                                            <img src="{{ $ActivityDataV['profile_pic'] }}" alt="user_profile_image"
                                                class="img-fluid img-rounded">
                                        </a>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-9 comments-setting text-white">
                                        <p>{{ $ActivityDataV['content'] }}</p>
                                        @php
                                            $formattedDate = date("d-m-Y h:i:s", strtotime($ActivityDataV['created_at']));
                                        @endphp
                                        <small><i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span class="ml-1 text-white">{{ $formattedDate }}</span></small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p style="color: #fff;">No Activity Found </p>
                        @endif
                    </div>
                </div>

             </div>

        </div>

    </div>

</section>
@endsection
@push('script')
    <script src="{{ url('public/assets/js/common.js') }}"></script>
    <script src="{{ url('public/assets/js/formsubmit.js') }}"></script>

    <script>
        $( document ).ready(function() {
            $('.cover-upload').hide();
            $('.profile-upload').hide();

            $(".user-profile-picture img").click(function(){
                $('.profile-upload').show();
            });

            $(".add-banner-image").click(function(){
                $('.cover-upload').show();
            });

            $(".close-icon").click(function(){
                $(this).parent().parent().parent().parent().hide();
            });
            $(".follow-unfollow").click(function () {
                $(this).text(function(i, text){
                    return text === "Follow" ? "Unfollow" : "Follow";
                })
            });
        });
    </script>
@endpush
