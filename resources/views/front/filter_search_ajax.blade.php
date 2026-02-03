
@if(count($data) > 0)
    @foreach($data as $sr)
        <div class="sr_result_item_sect">
            <div class="row">
                <div class="col-sm-4 result_item-lft">
                    <h1>{{ $sr->title }}</h1>
                    <div class="item_photo">
                        <img src="{{ $sr->thumbnail }}" alt="thumb" class="img-fluid ">
                    </div>
                    <br>
                    @php
                        $islike = App\Models\Gallerylike::where('userid', Auth::id())->where('contentid', $sr->id)->count();
                        $isunlike = App\Models\Gallerydislike::where('userid', Auth::id())->where('contentid', $sr->id)->count();
                    @endphp
                    <a style="color: black;text-decoration: unset;" href="{{ route('contentdetail',$sr->id) }}" name="views" class="view_bt">View</a>
                    @if($islike == 0 && $isunlike == 0)
                        <a style="color: black;text-decoration: unset;" href="{{ route('contentlike',[$sr->id,'like']) }}" name="likes" class="view_bt">Likes</a>
                        <a style='color: white;text-decoration: unset; background: url("{{ url('public/assets/images/red_bg.webp') }}")' href="{{ route('contentlike',[$sr->id,'unlike']) }}" name="likes" class="view_bt">Unlikes</a>
                    @elseif($islike == 1)
                        <a style='color: white;text-decoration: unset; background: url("{{ url('public/assets/images/red_bg.webp') }}")' href="{{ route('contentlike',[$sr->id,'unlike']) }}" name="likes" class="view_bt">Unlikes</a>
                    @elseif($isunlike == 1)
                        <a style="color: black;text-decoration: unset;" href="{{ route('contentlike',[$sr->id,'like']) }}" name="likes" class="view_bt">Likes</a>
                    @endif
                </div>
                <div class="col-sm-4 result_item-center">
                    <div class="sr_bt_details">
                        <span class="create_date">Date : @php echo date('d.m.Y',strtotime($sr->created_at)) @endphp</span>
                    </div>
                    <div class="tags_area">
                        <b>Tags</b><br>
                        @if(isset($sr->tags))
                            @php
                                $tags = App\Models\Tag::whereIn('id',explode(',',$sr->tags))->get();
                            @endphp
                            @foreach($tags as $tag)
                                {{$tag->title}},
                            @endforeach
                        @endif
                    </div>
                    <div class="description_area description">
                        <b>description</b><br>
                        {{ $sr->description }}
                    </div>
                </div>
                <div class="col-sm-4 result_item-right">
                    <div class="item_photo creator_picture">
                        <img src="{{ $sr->user->profile_pic }}" alt="thumb" class="img-fluid ">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="row">
        <div class="col-sm-12 result_item-center">
            <div class="sr_bt_details">
                <span style="font-weight: bold;">Search Result</span>
            </div>
            <div class="description_area">
                <b>Sorry Content not found...</b><br>
            </div>
        </div>
    </div>
@endif
