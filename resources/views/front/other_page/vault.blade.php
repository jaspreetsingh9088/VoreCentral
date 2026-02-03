@extends('front.other_page.layout.app')
@section('title', 'My Vault')
@section('content')
<section class="red_wrapper">
    <div class="container">
        <h1>MY VAULT</h1>
           
            @if(count($CreatorcontentData) > 0)
                @foreach($CreatorcontentData as $CreatorcontentDataK => $CreatorcontentDataV)
                    <div class="watch-clip-box">
                        <div class="row">
                            <div class="col-lg-2">
                                @php
                                    $data = $CreatorcontentDataV->paidcontent;
                                    $ext = pathinfo($data->content, PATHINFO_EXTENSION);
                                
                                @endphp
                                @if (!empty($data->video_url))
                                    <a href="{{ $data->video_url }}" class="popup-video"><img  style="width: 110px;height: 110px;" src="{{ $CreatorcontentDataV->paidcontent->thumbnail }}" class="clip-image" alt=""/></a>
    
                                @else
                                        @if ($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'webp')
                                            @php
                                                $url = $data->content;
                                                $lastSlashPos = strrpos($url, '/');
                                                $fileName = substr($url, $lastSlashPos + 1);
                                            @endphp
                                            <a href="{{ $data->content }}" class="popup-image"><img  style="width: 110px;height: 110px;" src="{{ $CreatorcontentDataV->paidcontent->thumbnail }}" class="clip-image" alt=""/></a>
                                        @elseif($ext == 'mp3' || $ext == 'wav')
                    
                                            <a href="{{ $data->content }}" class="popup-video"><img  style="width: 110px;height: 110px;" src="{{ $CreatorcontentDataV->paidcontent->thumbnail }}" class="clip-image" alt=""/></a>
                                        @elseif($ext == 'webm' || $ext == 'mp4')
                                            <a href="{{ $data->content }}" class="popup-video"><img  style="width: 110px;height: 110px;" src="{{ $CreatorcontentDataV->paidcontent->thumbnail }}" class="clip-image" alt=""/></a>
                                        @else
                                            <a href="{{ route('myvaultcontent',$data->id) }}" class="popup-ajax"><img  style="width: 110px;height: 110px;" src="{{ $CreatorcontentDataV->paidcontent->thumbnail }}" class="clip-image" alt=""/></a>
                                        @endif
                                @endif
                            </div>
                            <div class="col-lg-7">
                                <div class="watch-clip-content">
                                    <p class="font-weight-bold">{{ $CreatorcontentDataV->paidcontent->title }}</p>
                                    <p><a href="{{ URL('webstoredetail/'.$CreatorcontentDataV->paidcontent_id) }}">View Details</a></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="watch-clip-right float-right">
                                    <p>
                                        <a href="{{ route('vaultlike',$CreatorcontentDataV->paidcontent_id) }}"><img src="assets/images/like-icon.webp" alt=""></a>
                                        <a href="{{ route('vaultdislike',$CreatorcontentDataV->paidcontent_id) }}"><img src="assets/images/dislike-icon.webp" alt=""></a>
                                    </p>
                                   
                                    <p class="mt-4"><a href="{{URL('download-file', $CreatorcontentDataV->paidcontent->getRawOriginal('content'))}}">Download</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                @endforeach
            @else
                <h3 class="text-center">No records found.</h3>
            @endif
        <!-- watch list end-->
    </div>
</section>
@endsection

@push('script')
<link rel="stylesheet" href="{{ url('public/assets/vendors/magnific-popup/magnific-popup.css') }}">
<script src="{{ url('public/assets/vendors/magnific-popup/jquery.magnific-popup.js') }}"></script>
<script type="text/javascript">
    $('.popup-html').magnificPopup({
          type: 'inline',
          preloader: false,
          modal: false
        });
      $('.popup-image').magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          mainClass: 'mfp-with-zoom  mfp-img-mobile',
          image: {
            verticalFit: true
          }
          
        });

        $('.popup-video').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,

          fixedContentPos: false
        });
        $('.popup-ajax').magnificPopup({
          type: 'ajax',
          overflowY: 'scroll' // as we know that popup content is tall we set scroll overflow by default to avoid jump
        });

        
</script>

@endpush