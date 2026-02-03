@extends('front.creator.uploadpage-layout.app')
@section('title', 'Creator Upload')
@section('bodyclass','green_theme')
@section('style')
.popup-background{
    z-index:9999;
}
@endsection
@section('content')
<style>
.list-item {
  position: relative;
  display: inline-block; /* or flex depending on your layout */
}

.list-item img {
  display: block;
  width: 100px; /* Set image size as needed */
  height: auto;
}

.close-btn-collection {
  position: absolute;
  top: 0px;
  right: 0px;
  background: #fff;
  border-radius: 50%;
  padding: 2px 6px;
  font-weight: bold;
  color: red;
  cursor: pointer;
  font-size: 16px;
  line-height: 1;
}
.close-btn-featured {
  position: absolute;
  top: 0px;
  right: 0px;
  background: #fff;
  border-radius: 50%;
  padding: 2px 6px;
  font-weight: bold;
  color: red;
  cursor: pointer;
  font-size: 16px;
  line-height: 1;
}
.profile-upload {
    position: fixed;
    top: 50%;
    right: 10%;
    transform: translate(-50%, -50%);
    z-index: 9999;
}

.open_popup {
    background-color: #fff;
    color: #000;
    padding: 14px;
    font-size: 16px;
    text-transform: uppercase;
    position: relative;
    z-index: 0;
    position: absolute;
    right: 30px;
    bottom: 36px;
    border-radius: 50px;
    border: 1px solid #222;
}
.main-featured-item-label{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px 20px;
    border-radius: 8px;
}
.custom-custom-background-label{
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px 20px;
    border-radius: 8px;
}
</style>
    <div class="">
        <div class="main-panel">
            <!-- partial -->
            <div class="content-wrapper">
                <div class="container">
                    <div class="row manage_feature">
                        <div class="col-sm-6">
                            <div class="feature_item_section position-relative text-center">

                                @if (isset($SingleFeaturedcontentData) && is_array($SingleFeaturedcontentData) && count($SingleFeaturedcontentData) > 0)
                                <div class="image-container" style="position: relative; display: inline-block;">
                                    <img src="{{ $SingleFeaturedcontentData[0]['thumbnail'] }}" alt="thumb" class="img-fluid" style="width: 100%;">

                                    <!-- Centered Overlay Text -->
                                    <div class="main-featured-item-label">
                                        Main Featured Item
                                    </div>
                                </div>
                                @else
                                <img src="{{ url('public/assets/images/default-image.jpg') }}" alt="thumb" class="img-fluid">
                                <div class="main-featured-item-label">
                                    Main Featured Item
                                </div>
                                @endif

                                @if (isset($SingleFeaturedcontentData) && is_array($SingleFeaturedcontentData) && count($SingleFeaturedcontentData) > 0)
                                <a href="{{ route('removesinglefeaturedcontents') }}" class="close_bt">
                                    <svg style="width:40px;height:40px" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M19,3H16.3H7.7H5A2,2 0 0,0 3,5V7.7V16.4V19A2,2 0 0,0 5,21H7.7H16.4H19A2,2 0 0,0 21,19V16.3V7.7V5A2,2 0 0,0 19,3M15.6,17L12,13.4L8.4,17L7,15.6L10.6,12L7,8.4L8.4,7L12,10.6L15.6,7L17,8.4L13.4,12L17,15.6L15.6,17Z">
                                        </path>
                                    </svg>
                                </a>
                                @endif

                                <div class="uploadbtn info-btn4">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </div>

                            </div>
                        </div>

                        @php
                        $customebg = Auth::user()->themebg;
                        @endphp
                        <div class="col-sm-6">
                            <div class="feature_item_section position-relative text-center">

                                <div class="image-container" style="position: relative; display: inline-block;">
                                    <img src="<?php echo $customebg; ?>" alt="thumb" class="img-fluid" style="width: 100%;">

                                    <div class="custom-custom-background-label">
                                        Custom Channel Background
                                    </div>
                                </div>

                                <div class="image-upload">
                                    <label class="open_popup">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="profile-upload">
                            <div class="profile-inner">
                                <div class="profile-box-upload">
                                    <div class="upload-file-container">
                                        <div class="close-icon">X</div>
                                        <form class="sign_up_form" action="{{ route('updatethemebg') }}" enctype='multipart/form-data'
                                            class="card mb-3" method="POST" redirect="{{ url()->current() }}">
                                            @csrf
                                            <input type="file" name="themebg" accept="image/*" />
                                            <input type="submit" value="upload">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class="row aos-init aos-animate manage_feature" data-aos="fade-up">
                        <div class="col-sm-12">
                            <div class="manage_area ">
                                <h2>Own Collections</h2>
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error_message') }}
                                    </div>
                                @endif
                                <div class="manage_gallery_sect manage_feature_collect">
                                    <ul>
                                        @if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0)
                                            @foreach ($Owncollaction as $OwncollactionK => $OwncollactionV)
                                                <li class="list-item">
                                                    <a href="{{ URL('contentdetail/' . $OwncollactionV['content_id']) }}" target="_blank" class="">
                                                        <img src="{{ $OwncollactionV['image'] }}" alt="thumb2" class="img-fluid ">
                                                        {{ $OwncollactionV['id'] }}
                                                    </a>
                                                    <a href="{{ URL('delete-collection/' . $OwncollactionV['id']) }}"><span class="close-btn-collection">&times;</span></a>
                                                </li>
                                            @endforeach
                                        @else
                                            <h3 class="text-center">You do not have any content yet. Please add to view here</h3>
                                        @endif
                                    </ul>
                                    <div class="upload_delete info-btn">
                                        Create new
                                        <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                                            </svg></span>
                                        <span class="small_font">New collection</span>
                                    </div>
                                </div>
                            </div>
                            <div class="manage_area ">
                                <h2>Featured Content</h2>
                                <div class="manage_gallery_sect back_b">
                                    <ul>
                                        @if (isset($FeaturedcontentData) && is_array($FeaturedcontentData) && count($FeaturedcontentData) > 0)
                                            @foreach ($FeaturedcontentData as $FeaturedcontentDataK => $FeaturedcontentDataV)
                                                <li class="list-item">
                                                    <a href="{{ URL('contentdetail/' . $FeaturedcontentDataV['id']) }}" target="_blank" class="">
                                                        <img src="{{ $FeaturedcontentDataV['thumbnail'] }}" alt="thumb" class="img-fluid ">
                                                    </a>
                                                    <a href="{{ URL('delete-feature-content/' . $FeaturedcontentDataV['id']) }}"><span class="close-btn-featured">&times;</span></a>
                                                </li>
                                            @endforeach
                                        @else
                                            <h3 class="text-center">You do not have any content yet. Please add to view here</h3>
                                        @endif
                                    </ul>
                                    <div class="upload_delete info-btn1">
                                        Add
                                        <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                                            </svg></span>
                                        An Item
                                    </div>
                                </div>
                            </div>
                            <div class="manage_area ">
                                <h2>Featured Collections</h2>
                                <div class="manage_gallery_sect manage_feature_collect">
                                    <ul>
                                        @if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0)
                                            @foreach ($Owncollaction as $OwncollactionK => $OwncollactionV)
                                                @if ($OwncollactionV['featured'])
                                                    <li class="list-item"><a href="{{ URL('contentdetail/' . $OwncollactionV['id']) }}"
                                                            target="_blank" class=""><img
                                                                src="{{ $OwncollactionV['image'] }}" alt="thumb"
                                                                class="img-fluid "></a>
                                                                <a href="{{ URL('delete-feature-collection/' . $OwncollactionV['id']) }}"><span class="close-btn-featured">&times;</span></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @else
                                            <h3 class="text-center">You do not have any content yet. Please add to view here</h3>
                                        @endif
                                    </ul>
                                    <div class="upload_delete info-btn2">
                                        Add
                                        <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                                            </svg></span>
                                        <span class="small_font">A collection</span>
                                    </div>
                                </div>
                            </div>
                            <div class="manage_area ">
                                <h2>Favoritemade Collections from other creators</h2>
                                <div class="manage_gallery_sect back_b">
                                    <ul>
                                        @if (isset($Favouritecollection) && is_array($Favouritecollection) && count($Favouritecollection) > 0)
                                            @foreach ($Favouritecollection as $FavouritecollectionK => $FavouritecollectionV)
                                                <li class="list-item"><a href="{{ URL('contentdetail/' . $FavouritecollectionV['id']) }}"
                                                        target="_blank" class=""><img
                                                            src="{{ $FavouritecollectionV['image'] }}" alt="thumb"
                                                            class="img-fluid "></a>
                                                 <a href="{{ URL('delete-fav-collections/' .  $FavouritecollectionV['id']) }}"><span class="close-btn-featured">&times;</span></a>
                                                </li>
                                            @endforeach
                                        @else
                                            <h3 class="text-center">You do not have any content yet. Please add to view here</h3>
                                        @endif
                                    </ul>
                                    <div class="upload_delete info-btn3">
                                        Create new
                                        <span class="plus"><svg style="width:50px;height:50px" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                                            </svg></span>
                                        <span class="small_font">New collection</span>
                                    </div>
                                </div>

                            </div>

                            <div class="manage_area ">
                                <h2>Featured Channels</h2>
                                <div class="manage_gallery_sect back_b">
                                    <ul>
                                        <?php
                                        if(isset($UserData) && is_array($UserData) && count($UserData) > 0 ){
                                            foreach($UserData as $UserDataK => $UserDataV){
                                                ?>
                                                <li class="list-item"><a href="" target="_blank" class=""><img src="{{$UserDataV['profile_pic']}}" alt="thumb" class="img-fluid "></a>
                                                <a href="{{ URL('delete-feature-channels/' .  $UserDataV['id']) }}"><span class="close-btn-featured">&times;</span></a>

                                            </li>
                                                <?php
                                            }
                                        }else{?>
                                            <h3 class="text-center">You do not have any featured channels yet. Please add to view here</h3>
                                        <?php }?>
                                    </ul>
                                    <div class="upload_delete info-btn5">
                                        Create new
                                        <span class="plus">
                                            <svg style="width:50px;height:50px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                                            </svg>
                                        </span>
                                        <span class="small_font">New collection</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="popup-background" id="popup-background">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set">
                    <form class="sign_up_form" action="{{ route('createowncollaction') }}" class="card mb-3"
                        method="POST" enctype="multipart/form-data" style="width:100%;">
                        @csrf
                        <span class="close-icon close-iconn">X</span>
                        <div class="row mb-3" style="overflow: scroll;">
                            @if (isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0)
                                @foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV)
                                    <div class="col-lg-3 mb-3" style="height:170px;" >
                                        <input id="test{{ $UsercontentDataV['id'] }}" type="checkbox" class="check-select" name="images[]" value="{{ $UsercontentDataV['id'] }}"  onclick="selectimage(this)"/>
                                        <img for="test{{ $UsercontentDataV['id'] }}" onclick="selectCheckbox({{ $UsercontentDataV['id'] }})" src="{{ $UsercontentDataV['thumbnail'] }}" onclick="selectimage(this)"  class="img-fluid" style="height:150px;" />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="bottom-box">
                            <input type="text" name="collection_name" style="width: 64%;float: left;" placeholder="Collection Name" />
                            <a href="#" class="close-btn close-iconn"><i class="fa fa-times" aria-hidden="true">Cancel</i></a>
                            <button type="submit" class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-background" id="popup-background1">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set">
                    <form class="sign_up_form" action="{{ route('featuredcontents') }}" class="card mb-3"
                        method="POST" enctype="multipart/form-data" style="width:100%;">
                        @csrf
                        <span class="close-icon close-iconn">X</span>
                        <div class="row mb-3" style="overflow: scroll;">
                            @if (isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0)
                                @foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV)
                                    <div class="col-lg-3 mb-3" style="height:170px;" >
                                        <input id="test{{ $UsercontentDataV['id'] }}" type="checkbox" class="check-select" name="images[]" value="{{ $UsercontentDataV['id'] }}"  onclick="selectimage(this)"/>
                                        <img for="test{{ $UsercontentDataV['id'] }}" src="{{ $UsercontentDataV['thumbnail'] }}" class="img-fluid" style="height:150px;" onclick="selectimage(this)" />
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="bottom-box">
                            <a href="#" class="close-btn close-iconn"><i class="fa fa-times" aria-hidden="true"></i>Cancel</a>
                            <button type="submit" class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-background" id="popup-background2">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set">
                    <form class="sign_up_form" action="{{ route('featuredcollection') }}" class="card mb-3" method="POST" enctype="multipart/form-data" style="width:100%;">
                        @csrf
                        <span class="close-icon close-iconn">X</span>
                        <div class="row mb-3" style="overflow: scroll;">
                            @if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0)
                                @foreach ($Owncollaction as $OwncollactionK => $OwncollactionV)
                                    @if ($OwncollactionV['featured'] > 0)
                                        @continue
                                    @endif
                                    <div class="col-lg-3 mb-3" style="height:170px;">
                                        <input type="checkbox" class="check-select" name="images[]" value="{{ $OwncollactionV['id'] }}" onclick="selectimage(this)" />
                                        <img src="{{ $OwncollactionV['image'] }}" class="img-fluid" style="height:150px;"   onclick="selectimage(this)"/>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="bottom-box">
                            <a href="#" class="close-btn close-iconn"><i class="fa fa-times" aria-hidden="true"></i>Cancel</a>
                            <button type="submit" class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-background" id="popup-background3">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set">
                    <form class="sign_up_form" action="{{ route('favroitecollection') }}" class="card mb-3"
                        method="POST" enctype="multipart/form-data" style="width:100%;">
                        @csrf
                        <span class="close-icon close-iconn">X</span>
                        <div class="row mb-3" style="overflow: scroll;">
                            @if (isset($FavouritecontentData) && is_array($FavouritecontentData) && count($FavouritecontentData) > 0)
                                @foreach ($FavouritecontentData as $FavouritecontentDataK => $FavouritecontentDataV)
                                    <div class="col-lg-3 mb-3" style="height:170px;">
                                        <input type="checkbox" class="check-select" name="images[]" value="{{ $FavouritecontentDataV['id'] }}" onclick="selectimage(this)" />
                                        <img src="{{ $FavouritecontentDataV['thumbnail'] }}" class="img-fluid" style="height:150px;" onclick="selectimage(this)" />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="bottom-box">
                            <a href="#" class="close-btn close-iconn"><i class="fa fa-times" aria-hidden="true"></i>Cancel</a>
                            <button type="submit" class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-background" id="popup-background4">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set">
                    <form class="sign_up_form" action="{{ route('singlefeaturedcontents') }}" class="card mb-3"
                        method="POST" enctype="multipart/form-data" style="width:100%;">
                        @csrf
                        <span class="close-icon close-iconn">X</span>
                        <div class="row mb-3" style="overflow: scroll;">
                            @if (isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0)
                                @foreach ($UsercontentData as $UsercontentDataK => $UsercontentDataV)
                                    <div class="col-lg-3 mb-3" style="height:170px;">
                                        <input id="test{{ $UsercontentDataV['id'] }}" type="checkbox" class="check-select" name="images[]" value="{{ $UsercontentDataV['id'] }}" onclick="selectimage(this)" />
                                        <img for="test{{ $UsercontentDataV['id'] }}" src="{{ $UsercontentDataV['thumbnail'] }}" class="img-fluid" style="height:150px;" onclick="selectimage(this)" />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="bottom-box">
                            <a href="#" class="close-btn close-iconn"><i class="fa fa-times" aria-hidden="true"></i>Cancel</a>
                            <button type="submit" class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-background" id="popup-background5" style="z-index: 99;">
        <div class="popup-background-outter">
            <div class="popup-background-center">
                <div class="popup-set">
                    <form class="sign_up_form" action="{{ route('setfeaturedchannel') }}" class="card mb-3" method="POST"   enctype="multipart/form-data" style="width:100%;">
                        @csrf
                        <span class="close-icon close-iconn">X</span>
                        <div class="row mb-3" style="overflow: scroll;">
                            <?php
                            if(isset($AllUserData) && is_array($AllUserData) && count($AllUserData) > 0 ){
                                foreach($AllUserData as $AllUserDataK => $AllUserDataV){
                                    ?>
                                    <div class="col-lg-3 relative-box" style="height:170px;">
                                        <input  type="checkbox" class="check-select" name="images[]" value="{{ $AllUserDataV['id'] }}" onclick="selectimage(this)" />
                                        <img for="test{{ $AllUserDataV['id'] }}" src="{{ $AllUserDataV['profile_pic'] }}" class="img-fluid" style="height:150px;"  onclick="selectimage(this)"/>
                                    </div><?php
                                }
                            } ?>
                        </div>
                        <div class="bottom-box">
                            <a href="#" class="close-btn close-iconn"><i class="fa fa-times" aria-hidden="true"></i>Cancel</a>
                            <button type="submit" class="tick-btn"><i class="fa fa-check" aria-hidden="true"></i>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    function selectimage(row)
    {
        var firstInput = row.getElementsByTagName('input')[0];
        firstInput.checked = !firstInput.checked;
    }

    function selectCheckbox(id)
    {
        var firstInput = document.getElementById('test'+id);
        firstInput.checked = !firstInput.checked;
    }
@endpush
