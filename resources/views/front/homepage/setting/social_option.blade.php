@extends('front.homepage.setting.layout.app')
@section('title', 'Social Option')
@section('content')
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}
        <section class="viewhistory-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="view_history-outer p-0 m-0">
                            <div class="news_archieve_wrapper">
                                <div class="social_wrapper">
                                    <div class="social_top"  style="margin-bottom: 10px;">
                                        <div class="row align-items-end">
                                            <div class="col-lg-6">
                                                <h2 class="m-0"><span class="social_heading">Following</span></h2>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="social_src_box">
                                                    <span class="m-0">Send friend request</span>
                                                    <div class="dropdown">
                                                        <input type="text" placeholder="Search user here" class="" id="search" >
                                                    </div>
                                                </div>
                                                <div class="social_src_box" >                                                    
                                                    <div class="row userlist"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="social_bottom_odd">
                                        @if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
                                            @foreach ($AllFollowing as $AllFollowingK => $AllFollowingV)
                                                <div class="social_user">
                                                    <img src="{{$AllFollowingV['profile_pic']}}" alt="y@z.com"/>
                                                    <a  href="{{ route('unfollow',['id' => $AllFollowingV['id']]) }}" class="remove_friend" onclick="return confirm('Do you want to unfollow ?')">&times;</a>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 class="text-center" style="color: black;">You don't follow anyone's</h3>
                                        @endif
                                    </div>
                                </div>
                                <div class="social_wrapper">
                                    <div class="social_top"  style="margin-bottom: 10px;">
                                        <div class="row align-items-end">
                                            <div class="col-lg-6">
                                                <h2 class="m-0"><span class="social_heading">Followers</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="social_bottom_odd">
                                        @if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
                                            @foreach($AllFollower as $AllFollowerK => $AllFollowerV)
                                                <div class="social_user">
                                                    <img src="{{$AllFollowerV['profile_pic']}}" alt=""/>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 class="text-center" style="color: black;">You don't have any followers</h3>
                                        @endif
                                    </div>
                                </div><!--social wrapper end -->
                                <div class="social_wrapper">
                                    <div class="social_top" style="margin-bottom:10px;">
                                        <div class="row align-items-end">
                                            <div class="col-lg-6">
                                                <h2 class="m-0"><span class="social_heading">Blocked Users</span></h2>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="social_src_box">
                                                    <span class="m-0">Add yet another day</span>
                                                    <div class="dropdown">
                                                        <input type="text" class="" id="block_search" >                                                        
                                                    </div>
                                                </div>
                                                <div class="social_src_box" >
                                                    <div class="row blockuserlist"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="social_bottom_even">
                                        @if(count($blockuser) > 0)
                                            @foreach($blockuser as $bu)
                                                <div class="social_user">
                                                    <img src="{{ $bu->user->profile_pic }}" alt="{{ $bu->user->username }}"/>
                                                    <a data-id="{{ $bu->user->id }}" class="unblock-btn remove_friend text-danger" data-reload="yes">&times;</a>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 class="text-center" style="color: black;">You have not blocked any user</h3>
                                        @endif
                                    </div>
                                </div><!--social wrapper end -->
                                <div class="social_wrapper">
                                    <div class="social_top"  style="margin-bottom: 10px;">
                                        <div class="row align-items-end">
                                            <div class="col-lg-6">
                                                <h2 class="m-0"><span class="social_heading">Users blocked you</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="social_bottom_odd">
                                        @if(count($blockyou) > 0)
                                            @foreach($blockyou as $by)
                                                <div class="social_user">
                                                    <img src="{{ $by->byuser->profile_pic }}" alt="{{ $by->byuser->username }}"/>                                                    
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 class="text-center" style="color: black;">No one has blocked you</h3>
                                        @endif
                                    </div>
                                </div><!--social wrapper end -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </section>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        // var path = "https://employeyarena.com/vore1/public/searchuser";
        var path = "{{ url('searchuser') }}";
        var blocksearchpath = "{{ url('search-block-user')}}";
        
        function search(request){
            $.ajax({
                url: path,
                type: 'GET',
                dataType: 'JSON',
                data: {
                    search: request
                },
                success: function( data ) {
                    $('.userlist').html(data.data);
                }
            });
        }

        $( "#search" ).autocomplete({
            source: function( request, availableTags ) {
                search(request.term);
            },
        });

        $(document).on('click','.follow-btn',function(){
            var id = $(this).data('id');
            $(this).addClass('disabled');
            var url = "{{ url('follow/') }}";
            $.ajax({
                url: url+'/'+id,
                type: 'GET',
                success: function( data ) {
                    var search_val = $('.ui-autocomplete-input').val();
                    search(search_val);
                }
            });
        })

        $(document).on('click','.unfollow-btn',function(){
            var id = $(this).data('id');
            $(this).addClass('disabled');
            var url = "{{ url('unfollow/') }}";
            $.ajax({
                url: url+'/'+id,
                type: 'GET',
                success: function( data ) {
                    var search_val = $('.ui-autocomplete-input').val();
                    search(search_val);
                }
            });
        })

        $(document).on('click','.unfollow-btn',function(){
            var id = $(this).data('id');
        })

        $(document).on('click','.block-btn',function(){
            var id = $(this).data('id');
            $(this).addClass('disabled');
            var url = "{{ url('block-user/') }}";
            $.ajax({
                url: url+'/'+id,
                type: 'GET',
                success: function( data ) {
                    var search_val = $('#block_search').val();
                    blockusersearch(search_val);
                }
            });
        })

        $(document).on('click','.unblock-btn',function(){
            var id = $(this).data('id');
            var reload = $(this).data('reload');
            $(this).addClass('disabled');
            var url = "{{ url('unblock-user/') }}";
            $.ajax({
                url: url+'/'+id,
                type: 'GET',
                success: function( data ) {                    
                    var search_val = $('#block_search').val();
                    if(search_val != ''){
                        blockusersearch(search_val);
                    }else{
                        if(reload == 'yes'){
                            location.reload();
                        }
                    }
                }
            });
        })

        function blockusersearch(request){
            $.ajax({
                url: blocksearchpath,
                type: 'GET',
                dataType: "JSON",
                data: {
                    search: request
                },
                success: function( data ) {
                    $('.blockuserlist').html(data.data);
                }
            });
        }

        $( "#block_search" ).autocomplete({
            source: function( request, response ) {
                blockusersearch(request.term)
            },
        });

        function Unfollow(id){
            var confrm = confirm('Are you sure to unfollow ?');
            if(confrm){
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "html",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        $('#social_src_box').html(data);
                    }
                });
            }else{
                return false;
            }
        }
    </script>
@endpush