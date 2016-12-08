@extends('app')

@section('content')

@include('merchant.partials.profileHero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-4 col-lg-3">
			<div class="profile-sb">
				<div class="psb-sect">
					<span class="psb-left">current offers</span>
					<span class="psb-right">
						<img src="{{asset ('assets/img/icons/tag-orange.png')}}" width="24" height="24">
						<span>{{count($vendor->deals)}}</span>
					</span>
					<span class="clearfix"></span>
				</div>
				<div class="psb-sect">
					<span class="psb-left">recommendations</span>
					<span class="psb-right">
						<img src="{{asset ('assets/img/icons/heart-orange.png')}}" width="24" height="24">
						<span>{{count($vendor->recs)}}</span>
					</span>
					<span class="clearfix"></span>
				</div>
				<div class="psb-sect">
					<span class="psb-left">share this vendor</span>
					<span class="psb-right">
						<img src="{{asset ('assets/img/icons/share-icon.png')}}" width="14" height="24">
					</span>
					<span class="clearfix"></span>
					<ul class="psb-icons">
						<li><a href="https://plus.google.com/share?url={{url()}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="https://twitter.com/home?status=check%20out%20this%20deal%3A%20{{url()}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{url()}}&title=Awesome%20deals%20from%20P4/7&summary=&source=" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-lg-9">
			<div class="dealDets">
				@if(isset($specificDeal))
					<div class="deal-section">
					<span class="ds-heading">description</span>
					<span class="ds-line"></span>
					{{$specificDeal->description}}
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">fine print</span>
					<span class="ds-line"></span>
					{{$specificDeal->finePrint}}
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">redeem now</span>
					<span class="ds-line"></span>
				</div>
				
					@if(Auth::check() && (isset($user) && $user->userType == 'vip'))
					<div class="redeemDeal">
						<span class="rd-name">{{$specificDeal->title}} {{$specificDeal->tagline}}</span>
						<hr />
						{{$specificDeal->redemptionInstructions}}
						<hr />
						<ul class="list-inline">
							<li>
								@if($vendor->logo)
								<img src="{{asset ('uploads/'.$vendor->logo)}}" class="vendor-logo">
								@else()
								<img src="{{asset ('assets/img/default-logo.jpg')}}" class="vendor-logo">
								@endif()
							</li>
							<li>
								<img src="{{asset ('assets/img/p47-card.png')}}" alt="redeem this deal">
							</li>
						</ul>
					</div>
					@else()
					<div class="profile-not-li">
						<p><strong>You must be logged in to redeem VIP Deals</strong><br />
					    <a href="#" class="loginModal btn blue">log in</a></p>
					    <span class="spacer"></span>
					    <p><strong>Not a VIP Member?</strong><br />
					    <a href="/vip-signup" class="btn orange-outline">sign up now</a></p>
					</div>
					@endif()

				@else()
				@if(count($vendor->deals) > 0)
			
				<div class="deal-section">
					<span class="ds-heading">description</span>
					<span class="ds-line"></span>
					{{$vendor->deals[0]->description}}
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">fine print</span>
					<span class="ds-line"></span>
					{{$vendor->deals[0]->finePrint}}
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">redeem now</span>
					<span class="ds-line"></span>
				</div>
				
					@if($user->userType == 'vip')
					<div class="redeemDeal">
						<span class="rd-name">{{$vendor->deals[0]->title}} {{$vendor->deals[0]->tagline}}</span>
						<hr />
						{{$vendor->deals[0]->redemptionInstructions}}
						<hr />
						<ul class="list-inline">
							<li>
								@if($vendor->logo)
								<img src="{{asset ('uploads/'.$vendor->logo)}}" class="vendor-logo">
								@else()
								<img src="{{asset ('assets/img/default-logo.jpg')}}" class="vendor-logo">
								@endif()
							</li>
							<li>
								<img src="{{asset ('assets/img/p47-card.png')}}" alt="redeem this deal">
							</li>
						</ul>
					</div>
					@else()
					<div class="profile-not-li">
						<p><strong>You must be logged in to redeem VIP Deals</strong><br />
					    <a href="#" class="loginModal btn blue">log in</a></p>
					    <span class="spacer"></span>
					    <p><strong>Not a VIP Member?</strong><br />
					    <a href="/vip-signup" class="btn orange-outline">sign up now</a></p>
					</div>
					@endif()
				
				@else()
				
				<div class="deal-section">
					<div class="alert alert-info">This merchant does not have any deals at this time!</div>
				</div>
				
				@endif()
				
				@endif()
				
				<div class="deal-section">
					<span class="ds-heading">Fun Facts About {{$vendor->companyName}}</span>
					<span class="ds-line"></span>
					<ul class="fact-list">
						@foreach($vendor->facts as $fact)
						<li>{{$fact->fact}}</li>
						@endforeach()
					</ul>
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">Photos</span>
					<span class="ds-line"></span>
					<ul class="merchant-photos">
						@foreach($vendor->photos as $photo)
						<li>
							<a class="fancybox" rel="group" href="{{asset ('/uploads/'.$photo->photo)}}"><img src="{{asset ('/uploads/'.$photo->photo)}}" alt=""></a>
						</li>
						@endforeach()
					</ul>
				</div>
				
				@if($vendor->vimeo_id)
				<div class="clearfix"></div>
				<div class="deal-section">
					<span class="ds-heading">Video</span>
					<span class="ds-line"></span>
					<div id="currentVideo">
						<div class='embed-container'>
							<iframe src='https://player.vimeo.com/video/{{$vendor->vimeo_id}}' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
					</div>
				</div>
				@endif()
				
			</div>
		</div>
	</div>
</section>

<section class="vendorCta gray">
	<span>Not Yet a Member. Get Your VIP Card Now!</span> <a href="/vip-signup" class="">sign up</a>
</section>

<section class="relevant-listings">
	
	@if(count($vendor->deals) >= 2)
	
	<div class="text-center">
		<span class="alsoLike">More Deals From {{$vendor->companyName}}</span>
	</div>
	
		@foreach($vendor->deals as $deal)
		@if($flag !== 0)
	    <div class="row">
		    <div class="col-sm-12 col-md-6 col-lg-3">
			    <div class="ind-listing">
				    @if($deal->expirationDate !== NULL)
				    <div class="flash-deal">
					    <span>Flash Deal</span>
					    <?php
						$exp = new Carbon($deal->expirationDate);
						$exp = $exp->diffForHumans();
						?>
						{{$exp}}
				    </div>
				    @endif()
				    <div class="ind-img-box">
					    <a href="/merchant/{{$vendor->slug}}?deal={{$deal->id}}"><img src="{{ asset ('/uploads/'.$deal->squareImage) }}" alt="{{$vendor->companyName}}"></a>
					    <div class="desc">
						    <span class="ind-name">{{$vendor->companyName}}</span>
						    <span class="ind-city">{{$vendor->city}}, {{$vendor->state}}</span>
					    </div>
				    </div>
				    <a href="/merchant/{{$vendor->slug}}?deal={{$deal->id}}" class="desc-link">
					    <span class="deal-tag">{{$deal->title}}</span>
						<span class="deal-subline">{{$deal->tagline}}</span>
				    </a>
				    <ul class="deal-list">
					    <li>
					    	<a href="http://maps.google.com/?q={{$vendor->address}} {{$vendor->address2}} {{$vendor->city}}, {{$vendor->state}} {{$vendor->zipcode}}">
								<span>directions</span>
								<img src="{{ asset ('assets/img/icons/map-pin.png') }}" alt="directions" width="16" height="21">    
					    	</a>
					    </li>
					    <li>
					    	<a href="#">
								<span>recommend it</span>
								<img src="{{ asset ('assets/img/icons/heart.png') }}" alt="recommend it" width="25" height="21">    
					    	</a>
					    </li>
					    <li>
					    	<a href="#">
								<span>bookmark</span>
								<img src="{{ asset ('assets/img/icons/bookmark.png') }}" alt="bookmark" width="21" height="21">    
					    	</a>
					    </li>
				    </ul>
				    <div class="clearfix"></div>
			    </div>
		    </div>
		    @endif()
		    <?php $flag = 1; ?>
		    @endforeach()
		
		@else()
		
			<div class="text-center">
				<span class="alsoLike">You May Also Like</span>
			</div>
			@if(count($moreDeals) <= 0)
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="alert alert-info">
						We'll be adding more deals to the system soon!
					</div>
				</div>
			</div>
			@else()
			<div class="row">
			@foreach($moreDeals as $deal)
			@if((!isset($specificDeal) || (isset($specificDeal) && $specificDeal->id !== $deal->id)) && $deal->vendor->market_id == $vendor->market_id)
				<div class="col-sm-12 col-md-6 col-lg-3">
				    <div class="ind-listing">
					    @if($deal->expirationDate !== NULL)
					    <div class="flash-deal">
						    <span>Flash Deal</span>
						    <?php
							$exp = new Carbon($deal->expirationDate);
							$exp = $exp->diffForHumans();
							?>
							{{$exp}}
					    </div>
					    @endif()
					    <div class="ind-img-box">
						    <a href="/merchant/{{$deal->vendor->slug}}?deal={{$deal->id}}"><img src="{{ asset ('/uploads/'.$deal->squareImage) }}" alt="{{$deal->vendor->companyName}}"></a>
						    <div class="desc">
							    <span class="ind-name">{{$deal->vendor->companyName}}</span>
							    <span class="ind-city">{{$deal->vendor->city}}, {{$deal->vendor->state}}</span>
						    </div>
					    </div>
					    <a href="/merchant/{{$deal->vendor->slug}}?deal={{$deal->id}}" class="desc-link">
						    <span class="deal-tag">{{$deal->title}}</span>
							<span class="deal-subline">{{$deal->tagline}}</span>
					    </a>
					    <ul class="deal-list">
						    <li>
						    	<a target="_blank" href="http://maps.google.com/?q={{$deal->vendor->address}} {{$deal->vendor->address2}} {{$deal->vendor->city}}, {{$deal->vendor->state}} {{$deal->vendor->zipcode}}">
									<span>directions</span>
									<img src="{{ asset ('assets/img/icons/map-pin.png') }}" alt="directions" width="16" height="21">    
						    	</a>
						    </li>
						    @if(isset($user) && $user->userType == 'vip')
						    <li>
						    
						    	@if(!empty($userRecs))
					    		<?php $state = 0; ?>
								<?php $set_flag = 1; ?>
								@foreach($userRecs as $rec)
								@if($rec->vendor_id == $deal->vendor->id)
								<?php $state = 1; ?>
								<?php $set_flag = 0; ?>
								@endif()
								@endforeach()
								
								@if($set_flag == 1)
								<?php $state = 0 ; ?>
								@endif()
									
								@else()
								<?php $state = 0; ?>
								@endif()
						    
						    	<a href="#" class="recMerchant-frontend" data-vendor-id="{{$deal->vendor->id}}" data-user-id="{{$user->id}}" data-state="{{$state}}">
									<span>recommend it</span>
									@if(!empty($userRecs))
										<?php $set_flag = 1; ?>
										@foreach($userRecs as $recommendation)
										@if($recommendation->vendor_id == $deal->vendor->id)
										<i class="fa fa-check green-check"></i>
										<img src="{{ asset ('assets/img/icons/heart.png') }}" alt="recommend it" width="25" height="21" style="display:none;">
										<?php $set_flag = 0; ?>
										@endif()
										@endforeach()
										
										@if($set_flag == 1)
										<img src="{{ asset ('assets/img/icons/heart.png') }}" alt="recommend it" width="25" height="21">
										@endif()
										
									@else()
									<img src="{{ asset ('assets/img/icons/heart.png') }}" alt="recommend it" width="25" height="21">
									@endif()
									  
						    	</a>
						    </li>
						    <li>
						    	
						    	@if(!empty($userBookmarks))
					    		<?php $state = 0; ?>
								<?php $set_flag = 1; ?>
								@foreach($userBookmarks as $bookmark)
								@if($bookmark->vendor_id == $deal->vendor->id)
								<?php $state = 1; ?>
								<?php $set_flag = 0; ?>
								@endif()
								@endforeach()
								
								@if($set_flag == 1)
								<?php $state = 0 ; ?>
								@endif()
									
								@else()
								<?php $state = 0; ?>
								@endif()
						    
						    	<a href="#" class="bookmarkMerchant-frontend" data-vendor-id="{{$deal->vendor->id}}" data-user-id="{{$user->id}}" data-state="{{$state}}">
									<span>bookmark</span>
									@if(!empty($userBookmarks))
										<?php $set_flag = 1; ?>
										@foreach($userBookmarks as $bookmark)
										@if($bookmark->vendor_id == $deal->vendor->id)
										<i class="fa fa-check green-check"></i>
										<img src="{{ asset ('assets/img/icons/bookmark.png') }}" alt="bookmark" width="21" height="21" style="display:none;"> 
										<?php $set_flag = 0; ?>
										@endif()
										@endforeach()
										
										@if($set_flag == 1)
										<img src="{{ asset ('assets/img/icons/bookmark.png') }}" alt="bookmark" width="21" height="21"> 
										@endif()
										
									@else()
									<img src="{{ asset ('assets/img/icons/bookmark.png') }}" alt="bookmark" width="21" height="21"> 
									@endif()
									  
						    	</a>
						    </li>
						    @endif()
					    </ul>
					    <div class="clearfix"></div>
				    </div>
			    </div>
			@endif()
			@endforeach()
			</div>
			@endif()
		
		@endif()
		
		<div class="clearfix"></div>
</section>

@stop
