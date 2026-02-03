<a href="javascript:;" style="background:none !important;" class="notification-icon" id="notification-status">
    @if ($unread==0)
    @php $display="style=display:block";@endphp
    @else 
    @php $display="style=display:none";@endphp

    @endif
    <img src="{{ url('public/assets/images/notification_1.png') }}" {{ $display }} alt="" id="zerounread" width="40px;" height="40px;"  >

        @if ($unread>=1)
    @php $display="style=display:block";@endphp
    @else 
    @php $display="style=display:none";@endphp

    @endif
    
    @if ($unread >= 1)
        <img src="{{ url('public/assets/images/notification.png') }}" alt=""  {{ $display }} id="hasreads" width="40px;" height="40px;"  >
        <span class="notification-count">{{ $unread }}</span>
  
    @endif
</a>
<div class="notifications-list" style="display: none;">
    <div class="all-notifications__headert">
        <div class="all-notifications__left">Notification <span>{{$unread}}</span></div>
        <a href="javascript:void(0)" id="close" class="close__btn">x</a>
    </div>
    <div class="overflow-notifications">
        <ul>
            @if(count($notification) > 0)
                @foreach($notification as $row)
                    <li>
                        @if($row->type == 'usercontent')
                            @if($row->notification_type == 'like' || $row->notification_type == 'dislike')
                                @php $page_link = route('contentdetail',[$row->content_id]); @endphp
                            @elseif($row->notification_type == 'comment')
                                @php $page_link = route('contentdetail',[$row->content_id.'#comment'.$row->sender->username]); @endphp
                            @else
                                @php $page_link = 'javascript:;'; @endphp
                            @endif
                        @elseif($row->type == 'userpage')
                            @if($row->notification_type == 'follow')
                                @php $page_link = $row->sender->dashboard_link;  @endphp
                            @elseif($row->notification_type == 'comment reacts user page')
                                @php $page_link = url('profilepost#profilepost'.$row->content_id) @endphp
                            @elseif($row->notification_type == 'comment userpage')
                                @php $page_link = url('profilepost#profilepost'.$row->content_id) @endphp
                            @else
                                @php $page_link = 'javascript:;';  @endphp
                            @endif
                        @elseif($row->type == 'DLC')
                            @if($row->notification_type == 'DLC creators follow')
                                @php $page_link = url('dlc#dlccontent'.$row->content_id) @endphp
                            @elseif($row->notification_type == 'DLC reacts')
                                @php $page_link = url('dlc#dlccontent'.$row->content_id) @endphp
                            @elseif($row->notification_type == 'DLC download')
                                @php $page_link = url('dlc#dlccontent'.$row->content_id) @endphp
                            @else
                                @php $page_link = 'javascript:;';  @endphp
                            @endif
                        @elseif($row->type == 'forums')
                            @if($row->notification_type == 'quotes message')
                                @php
                                    $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                    $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$threadcomment->parent_id);
                                @endphp
                            @elseif($row->notification_type == 'thread like')
                                @php
                                    $threadlike = App\Models\Threadcommentlike::where('id',$row->content_id)->first();
                                    $threadcomment = App\Models\Threadcomment::where('id',$threadlike->comment_id)->first();
                                    $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$threadlike->comment_id);
                                @endphp
                            @elseif($row->notification_type == 'post thread started')
                                @php
                                    $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                    $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$threadcomment->threadid);
                                @endphp
                            @elseif($row->notification_type == 'posted thread')
                                @php
                                    $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                    $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$row->content_id);
                                @endphp
                            @elseif($row->notification_type == 'mentions')
                                @php
                                    $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                    $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$row->content_id);
                                @endphp
                            @elseif($row->notification_type == 'post thread I follow')
                                @php
                                    $threadcomment = App\Models\Threadcomment::where('id',$row->content_id)->first();
                                    $page_link = url('threaddetail/'.$threadcomment->threadid.'/1#threadcomment'.$row->content_id);
                                @endphp
                            @else
                                @php $page_link = 'javascript:;';  @endphp
                            @endif
                        @elseif($row->type == 'subscription')
                            @if($row->notification_type == 'Subscribe upload webstore')
                                @php $page_link = route('buyablecontent',$row->content_id) @endphp
                            @elseif($row->notification_type == 'Subscription upload')
                                @php $page_link = route('contentdetail',$row->content_id) @endphp
                            @else
                                @php $page_link = 'javascript:;';  @endphp
                            @endif
                        @elseif($row->type == 'storecontent')
                            @if($row->notification_type == 'like' || $row->notification_type == 'dislike')
                                @php $page_link = route('buyablecontent',[$row->content_id]); @endphp
                            @else
                                @php $page_link = 'javascript:;'; @endphp
                            @endif
                        @else
                            @php $page_link = 'javascript:;';  @endphp
                        @endif
                        <a href="{{ $page_link }}">
                            <div class="notification-show-box">
                                <div class="profile-image">
                                    @if($row->sender)
                                        <img src="{{ $row->sender->profile_pic }}">
                                    @endif
                                </div>
                                <div class="notification-side-text">
                                    {{$row->message}}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="all-notifications__bottom">
        <a href="{{ route('notification.index') }}" class="view-all">View all notification</a>
    </div>
</div>
<script>
    const notificationImageUrl = "{{ url('public/assets/images/notification.png') }}";

  document.getElementById('notification-status').addEventListener('click', function() {
     fetch("{{ route('notifications.update') }}", {
      method: "GET",
      headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Content-Type": "application/json"
      },
    })
    .then(response => response.json())
    .then(data => {
        document.querySelectorAll('.notification-count').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.all-notifications__left').forEach(el => el.style.display = 'none');
document.getElementById("zerounread").style.display = "block";
document.getElementById("hasreads").style.display = "none";


    })
    .catch(error => console.error("Upload request failed:", error));
  });
</script>