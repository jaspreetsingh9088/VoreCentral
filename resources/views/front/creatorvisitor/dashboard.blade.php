@extends('front.creatorvisitor.layout.app')
@section('title', 'Dashboard')
@section('bodyclass','green_theme creator_main_theme gallery_audio')
@section('content')
@php
$customebg = $myData[0]['themebg'];
$style = '';
$custom_bg = '';
if($customebg != null){
    $style = 'background: url('.$customebg.') 0% 0% / cover repeat !important;';
    $customebg = ".add-custom-bg{background:url({$customebg}) repeat; background-size:cover;}";
} else {
    $customebg = "var(--body-bg)";
}
if(isset($generalsetting)){
    $custom_theme = $generalsetting->creator_pages_custom_theme;
    if($custom_theme != 1){
        $style = '';
    }
}
@endphp
@if($style)
<style>
    body {
        {{ $style }}
    }
</style>
@endif
	<div class="creatordashboard">
		<div class="main-panel">
			<div class="content-wrapper">
				<div class="container">
					<div class="row creator_upload aos-init aos-animate" data-aos="fade-up">
						<div class="col-xl-8  grid-margin">
							<div class="featured_section featured_photo">
								<div class="card-title mt-4">
									Featured Upload
								</div>
								<div class="row mt-4">
									<div class="col-sm-12 grid-margin">
										<div class="position-relative">
											<div class="rotate-img featured_img">
												@if (isset($SingleFeaturedcontentData) && is_array($SingleFeaturedcontentData) && count($SingleFeaturedcontentData) > 0)
													<img src="{{ $SingleFeaturedcontentData[0]['thumbnail'] }}" alt="thumb" class="img-fluid">
												@else
													<img src="{{ url('public/assets/images/news_banner2.webp') }}" alt="thumb" class="img-fluid">
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4">
							<div class="right_creator">
								<!-- <h2>Profile Information about creator etc</h2> -->
								<!--<div class="buttons-container"><button type="button" class="red_theme_bt" style="position:relative; margin-right:5px;">Subscribe</button></div>-->

                                @if(Auth::id() != $id)
                                    @if($isFollowing)
                                        <a href="{{ route('unfollow',[$id]) }}" class="red_theme_bt" style="position:relative; right:0px; top:-10px;">UNFOLLOW</a>
                                    @else
                                        <a href="{{ route('follow',[$id]) }}" class="red_theme_bt" style="position:relative; right:0px; top:-10px;">FOLLOW</a>
                                    @endif
                                @endif

								<ul class="profile-listing-creator">
									@php
										if(!is_null($generalsetting)){
											if($generalsetting->general_privacy != null){
												$general_privacy = json_decode($generalsetting->general_privacy);
											}else{
												$general_privacy = null;
											}
										}else{
											$general_privacy = null;
										}

									@endphp
									  <li><a href="#">Number of followers: {{$AllFollower}} </a></li>
									<li><a href="#">Profile rank : {{ $userinfo['profile_rank'] }}</a></li>
									<li><a href="#">Profile Type : {{ $userinfo['profile_type'] }}</a></li>
									<li><a href="#">Administration Status : {{ ($myData[0]['moderator']==1)?'Moderator':'None' }}</a></li>
									<li><a href="#">Number of uploads : {{ $userinfo['upload_count'] }}</a></li>
									<li><a href="#">Number of threads started : {{ $userinfo['thread_count'] }}</a></li>
									<li><a href="#">Number of comments : {{ $userinfo['total_comment'] }} </a></li>
									<li><a href="#">Has been a member for : {{ $userinfo['hasbeenmember'] }} Days</a></li>
									<li><a href="#">Gender : {{ucwords($myData[0]['gender'])}}</a></li>
									@if($general_privacy != null && in_array('show_vorerole_preference',$general_privacy))
										<li><a href="#">Pred/prey/Switch/Observer/None <span style="float:right;">{{ ucwords($myData[0]['role_preference']) }}</span></a></li>
									@endif
									@if($general_privacy != null && in_array('show_orientation',$general_privacy))
										<li>
											<a href="#">Sexual orientation
												<span style="float:right;">{{ ucwords($myData[0]['sexual_orientation']) }}</span>
											</a>
										</li>
									@endif
								</ul>
							</div>
						</div>
					</div>
					<div class="row creator_upload aos-init" data-aos="fade-up">
						<div class="col-xl-8  grid-margin">
							<div class="recent_photo recent_upload">
								<?php
								if(isset($RecentUsercontent) && is_array($RecentUsercontent) && count($RecentUsercontent) > 0 ){
									foreach($RecentUsercontent as $RecentUsercontentK => $RecentUsercontentV){ ?>
										<div class="featured_section">
											<div class="card-title">
												Recent Upload
											</div>
											<div class="row">
												<div class="col-sm-12 grid-margin">
													<div class="position-relative">
														<div class="rotate-img featured_img">
															<img src="{{ $RecentUsercontentV['thumbnail'] }}" alt="thumb" class="img-fluid">
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
								} ?>
							</div>							
									<?php
									if(isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0 ){
										?>
										<div class="recent_photo">
											<div class="featured_section">
												<div class="card-title">
													Featured collection
												</div><?php
										foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){ ?>
											<div class="row creator_box_main create_collect aos-init aos-animate" data-aos="fade-up">
												<div class="col-sm-12">
													<div class="creator_box">
														<div class="row flex-nowrap" style="overflow-x: scroll;">
															<?php
															if(isset($UsercontentDataV) && is_array($UsercontentDataV) && count($UsercontentDataV) > 0 ){
																foreach($UsercontentDataV as $UsercontentDataKK => $UsercontentDataVV){
																	?>
																	<div class="col-lg-3 col-md-4 col-6">
																		<div class="creator-inn">
																			<a href="{{ URL('contentdetail/' . $UsercontentDataVV['id']) }}">
																				<img src="{{ $UsercontentDataVV['thumbnail'] }}" alt="">
																			</a>
																		</div>
																	</div>
																	<?php
																}
															} ?>
														</div>
													</div>
												</div>
											</div>
											<?php
										}

										?>
											</div>
										</div>
										<?php
									}
								?>
						</div>
						<div class="col-xl-3">
							<div class="ad_banner vertical">
								<div data-banner-id="425472"></div>
							</div>
						</div>
					</div>

					<div class="row aos-init" data-aos="fade-up">
						<div class="col-sm-12">
							<div class="ad_banner landscape">
								<div data-banner-id="425470"></div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
