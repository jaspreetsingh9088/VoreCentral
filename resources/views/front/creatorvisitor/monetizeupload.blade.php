
<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description"
            content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
    <title></title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
    <!-- plugin css for this page -->
    <link  rel="stylesheet" href="{{ url('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}" />




    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css')}}">
    <!-- endinject -->
  </head>

  <body class="store_theme studio_theme" style="font-family:{{ $font }}">

      <div class="container">


      <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
        <header id="header" class="studio_hd">
          <h1 class="">Webstore Studio</h1>

            @if(Session::has('successful_message'))
                <div class="alert alert-success">
                {{ Session::get('successful_message') }}
                </div>
                @endif
        </header>

        <!-- partial -->
    <form  class="sign_up_form" action="{{ route('uploadmonetize') }}" class="card mb-3" method="POST"   enctype="multipart/form-data" style="width:100%;">
    @csrf
        <div class="content-wrapper">
          <div class="product_details_background">

        <div class="top_file">
        <button class="file-upload-btn1" type="button">Upload</button>
        <input class="file-upload-input"  name="content" type="file" onchange="readURL(this);">
        </div>

												<div class="file-upload">

<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )"></button>


  <div class="file-upload-content">

    <img class="file-upload-image" src="{{ asset("assets/images/519704.webp")}}" alt="your image">
	 <div class="image-title-wrap">

    </div>

  </div>
</div>

<div class="upload_details_content">
<div class="row">
 <div class="col-sm-6 p-0">
  <div class="price_details">
      <h1><img alt="" src="{{ asset("assets/images/set_price.webp")}}"></h1>
  <textarea class="form-control textarea" name="price" id="exampleFormControlTextarea5" style="height: 284px;width: 400px;margin: auto;" rows="3" placeholder="price"></textarea>

  </div>
 </div>

<div class="col-sm-6 p-0 thumbnail_details">
 <div class="add_thumbnail">

<div class="upload-btn-wrapper">
  <button class="btn">Add thumbnail</button>
  <input type="file" name="thumbnail" />
</div>


 </div>
</div>
</div>
<div class="row">
<div class="col-sm-6 p-0">
<div class="cont_details pt-5 pr-5 pl-5">

<input type="text" name="title" class="form-control" placeholder="Enter Name" required>
<textarea class="form-control textarea" id="exampleFormControlTextarea5" rows="3" name="description" placeholder="Description" required></textarea>
<textarea class="textarea1" id="exampleFormControlTextarea5" rows="3" placeholder="Tags" name="tags" required></textarea>

</div>
</div>
<div class="col-sm-6 p-0 upload_btn_details">
<div class="file-upload-btn-area">
<button class="file-upload-btn" type="submit">Upload</button>
</div>

</div>
</div>

</div>
</form>


		  </div>
        </div>

        <!-- main-panel ends -->
        <!-- container-scroller ends -->

        <!-- partial:partials/_footer.html -->
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
                              <a href="{{ env('APP_YOU_TUBE_LINK', '#')  }}">
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

        <!-- partial -->
      </div>
    </div>
    <!-- inject:js -->
    <script src="{{ url('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('public/assets/vendors/aos/dist/aos.js/aos.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ asset("assets/js/demo.js")}}"></script>
    <script src="{{ asset("assets/js/jquery.easeScroll.js")}}"></script>
	<script>
function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
		$('.image-upload-wrap').addClass('image-dropping');
	});
	$('.image-upload-wrap').bind('dragleave', function () {
		$('.image-upload-wrap').removeClass('image-dropping');
});
</script>




    <!-- End custom js for this page-->
  </body>
</html>
