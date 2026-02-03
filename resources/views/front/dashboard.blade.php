@extends('front.layouts.app')
@php
    $title = 'My Dashboard';
@endphp
@section('title', $title)
@section('content')
    @include('front.layouts.profileview')
    <section class="user-about-sctn user-pg">
        <div class="container">
            <div class="row">
                @include('front.layouts.usersidepanel')
                <div class="col-lg-8 pl-0">
                    <div class="user-section1 auto-height" style="height:auto ; padding:30px;">
                        <div class="middle-part-padding dashboard-mobile">
                            @if (isset($ActivityData) && is_array($ActivityData) && count($ActivityData) > 0)
                                @foreach ($ActivityData as $ActivityDataK => $ActivityDataV)
                                    <div class="row mb-3" style="border: 2px solid #000;padding: 10px;">
                                        <div class="col-lg-2 col-md-2 col-4">
                                            <a href="{{ URL('dashboard/' . $ActivityDataV['refrenceid']) }}">
                                                <img src="{{ $ActivityDataV['profile_pic'] }}" alt="user_profile_image" class="img-fluid img-rounded">
                                            </a>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-8 comments-setting text-white">
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
    <!-- partial:partials/_footer.html -->
    <div class="cover-upload">
        <div class="cover-inner">
            <div class="cover-box-upload">
                <div class="upload-file-container">
                    <div class="close-icon">X</div>
                    <form class="sign_up_form" enctype='multipart/form-data' class="card mb-3">
                        @csrf

                        <img class="thum-file-image" src="" alt="cover image" style="width: 270px; margin-bottom: 10px; display: none;">
                        <input type="file" name="cover_pic" accept="image/*" onchange="readURL(this);" style="color: #000;"/>
                        <input type="submit" value="upload">
                    </form>
                    <div id="response_message" style="display:none;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="removeBannerModal" tabindex="-1"role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="hedding">Remove Banner</h2>
                </div>
                <div class="modal-body">
                    <h5>Are You Sure You Want To Remove This Banner?</h5>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('remove-picture', ['type' => 'banner']) }}" class="btn btn-primary">Remove</a>
                    <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal" style="color: #fff;">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="removeProfileImageModal" tabindex="-1"role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="hedding">Remove Profile Picture</h2>
                </div>
                <div class="modal-body">
                    <h5>Are You Sure You Want To Remove This Profile Picture?</h5>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('remove-picture', ['type' => 'profile_picture']) }}" class="btn btn-primary">Remove</a>
                    <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal" style="color: #fff;">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.thum-file-image').attr('src', e.target.result);
                    $('.thum-file-image').show();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        // Cover image upload
        $('.sign_up_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('updatecoverpic') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#response_message').html('<p style="color:#28A74B;">'+data.message+'</p>');
                    $('#response_message').show();
                    location.reload();
                },
                error:function(resp){
                    var errors = resp.responseJSON;
                    if(errors){
                        errorsHtml = '<strong class="text-danger">';
                        var sep = "";
                        $.each(errors.errors, function(k, v) {
                            errorsHtml += sep+v;
                            sep = ", ";
                        });
                        errorsHtml += '</strong>';
                        $('#response_message').html(errorsHtml);
                    }else{
                        $('#response_message').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    }

                    if(resp.status == 413){
                        $('#response_message').html('<strong class="text-danger">File upload failed. Maximum file size should be 10 MB.</strong>');
                    }
                    $('#response_message').show();
                }
            });
        });
    </script>

@endpush
