
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
		<link  rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css" />
		<!-- inject:css -->
		<link rel="stylesheet" href="{{ url('public/assets/css/style.css')}}">
		<!-- endinject -->
		<link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" href="{{ url('public/assets/lightbox/simple-lightbox.css?v2.8.0')}}" />
  	</head>
  	<body class="store_theme">
      	<div class="container">
      		<div class="main-panel">
        		<!-- partial:partials/_navbar.html -->
        		<header id="header">
					<nav class="navbar navbar-expand-lg navbar-light">
						<div class="navbar-top">
							<div class="d-flex justify-content-end align-items-center">
								<div class="cart_button_sect mt-5">
									<ul class="button_cart_menu">
										<li class="nav-item">
											<a href="#" class="nav-link">Cart</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">Checkout</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="navbar-bottom"  >
							<div class="">
								<div>
									<button class="navbar-toggler" type="button" data-target="#navbarSupportedContent"
									aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>
									<div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent" >
										<ul class="navbar-nav d-lg-flex justify-content-between align-items-center" >
											<li>
												<button class="navbar-close"><img src="{{ url('public/assets/images/close.png') }}" alt=""> </button>
											</li>
											<li class="nav-item active">
												<a class="nav-link" href="#">Newest First</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#"><input type="text" name="search" class="form-control"></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">Browse Creators</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">Upload</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">random</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</nav>
        		</header>
				<div class="content-wrapper">
					<div class="product_details_background">
						<div class="preview col-md-8">
							<div class="preview-pic">
								<div class="tab-pane active" id="pic-1">
									<img alt="" src="{{ $data->content }}">
								</div>
							</div>
							<div class="product_button">
								<style> .checked { color: orange; } </style>
								<input type="hidden" class="content_id" value="{{ $data->id }}">
								<div class="rating-star">
									<div class="media forum-item mb-2">
										<a href="{{ route('creatorvisitorwebstore',[$data->user->id]) }}" class="community_img mr-3">
											<img src="{{ $data->user->profile_pic }}" alt="thumb" class="img-fluid  rounded-circle">
										</a>
										<div class="media-body">
											<h6>
												<a href="{{ route('creatorvisitorwebstore',[$data->user->id]) }}" class="text-body">{{ $data->user->username }}</a>
											</h6>
										</div>
										<a href="#" class="text-secondary font-weight-bold"> </a>
									</div>
									@if(!is_null($rating))
										@for($i = 1; $i <= $rating->rating; $i++)
											<span class="fa fa-star fa-2x checked" id="rating-star-icon" data-index="{{$i}}"></span>
										@endfor
										@for($i = $rating->rating+1; $i <= 5; $i++)
											<span class="fa fa-star fa-2x" id="rating-star-icon" data-index="{{$i}}"></span>
										@endfor
									@else
										@for($i = 1; $i < 6; $i++)
											<span class="fa fa-star fa-2x" id="rating-star-icon" data-index="{{$i}}"></span>
										@endfor
									@endif

								</div>
								<div class="product_right">
									@if(Auth::check() && Auth::id() != $data->user->id)
										@if($isFollowing)
											<a style="text-decoration: unset;" href="{{ route('unfollow',[$data->user_id]) }}" class="subscrib_bt">Subscribed</a>
										@else
											<a style="text-decoration: unset;" href="{{ route('follow',[$data->user_id]) }}" class="subscrib_bt">Subscribe</a>
										@endif
										<button name="rating" class="buy_bt" @if(Auth::id()) id="content_buy" @else id="buy_bt_notlogin" @endif>Buy Now</button>
									@endif
								</div>
							</div>
							<div class="details">
								<div class="rating">
									@if(!is_null($average_rating))
										@for($i = 1; $i <= $average_rating; $i++)
											<span class="fa fa-star fa-2x checked"></span>
										@endfor
										@for($i = $average_rating+1; $i <= 5; $i++)
											<span class="fa fa-star fa-2x"></span>
										@endfor
									@endif
									<br><br>
									<span class="review-no">{{$total_review}} reviews</span><br><br>
								</div>
								<p style="color: black" class="product-description">{{ $data->description }}</p>

							</div>
							<div class="details p-2" style="margin : 10px 0 30px;">
								<h3 class="product-title w-50 float-left" style="color: black">{{ $data->title ?? 'Not Available' }}</h3>
								<h4 style="color: black" class="price">Current Price: <span>${{ $data->price }}</span></h4>
							</div>
							<div class="user_input">
								<span class="add_comment">Add a Review</span>
								<form   class="" action="{{ route('addgallerycomment') }}" class="card mb-3" method="POST"  redirect="{{ url()->current(); }}" >
									@csrf
									<input type="text" name="comment" class="form-control" id="" aria-describedby="" placeholder="">
									<input type="hidden" name="contentid" value="{{$CreatorcontentDataV['id']}}">
									<input type="submit" value="Submit Reviewl" class="btn btn-primary" style="float: right;margin-top: 10px;border-radius: 0px;">
								</form>
							</div>
						</div>
					</div>
				</div>
      		</div>
    	</div>
		@include('front.layouts.footer')
		<script src="{{ url('public/assets/js/common.js') }}"></script>
		<script src="{{ url('public/assets/js/formsubmit.js') }}"></script>
		<script src="{{ url('public/assets/lightbox/simple-lightbox.js?v2.8.0')}}"></script>
		<script>
			(function() {
				var $gallery = new SimpleLightbox('.gallery a', {});
			})();
		</script>
  	</body>
</html>
