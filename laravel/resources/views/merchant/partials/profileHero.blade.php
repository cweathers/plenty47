<section class="merchant-hero compTop" style="background: url( @if(count($vendor->deals) > 0) {{ asset ('/uploads/'.$vendor->deals[0]->largeImage) }} @else() {{$profileImage}} @endif() ) no-repeat center top;background-size:cover;">
	<div class="mh-sidebar">
		@if($vendor->logo)
		<img src="{{asset ('uploads/'.$vendor->logo)}}" class="vendor-logo">
		@else()
		<img src="{{asset ('assets/img/default-logo.jpg')}}" class="vendor-logo">
		@endif()
		<span class="mh-name">{{$vendor->companyName}}</span>
		<ul class="mh-list">
			<li><strong>{{$category->category}}</strong></li>
			@if(count($vendor->hours) > 0)
			<li>
			<strong>HOURS:</strong><br />
			@foreach($vendor->hours as $hour)
			{{$hour->label}}, {{$hour->hours}}<br />
			@endforeach()
			</li>
			@endif()
			<li><strong>PHONE:</strong> {{$vendor->phone}}</li>
			<li>
			<strong>LOCATION: </strong><br />
			{{$vendor->address}} {{$vendor->address2}}<br />
			{{$vendor->city}}, {{$vendor->state}} {{$vendor->zipcode}}
			</li>
			@if($vendor->url)
			<li><strong>WEBSITE:</strong><br /><a href="{{$vendor->url}}" target="_blank">{{$vendor->url}}</a></li>
			@endif()
			<li>
				<a href="http://maps.google.com/?q={{$vendor->address}} {{$vendor->address2}} {{$vendor->city}}, {{$vendor->state}} {{$vendor->zipcode}}" class="mh-directions text-center" target="_blank"><img src="{{asset ('assets/img/icons/orange-pin.png')}}" width="16" height="21"><span>directions</span></a>
			</li>
		</ul>
	</div>
	<div class="clearfix"></div>
	<div class="mh-bot">
		<div class="mhb-left">
			@if(isset($specificDeal))
				<span class="current-top">current deal</span>
				<span class="current-price">{{$specificDeal->title}}</span>
				<span class="current-tag">{{$specificDeal->tagline}}</span>
			@else()
				@if(count($vendor->deals) > 0)
				<span class="current-top">current deal</span>
				<span class="current-price">{{$vendor->deals[0]->title}}</span>
				<span class="current-tag">{{$vendor->deals[0]->tagline}}</span>
				@endif()
			@endif()
			@if(isset($user) && $user->userType == 'vip')
			<div class="hidden-lg lg-btns">
				<a href="#" class="btn blue btn-spacer bookmarkMerchant" data-state="{{$vipRec}}" data-vendor-id="{{$vendor->id}}" data-user-id="{{$user->id}}">Bookmark <img class="bm-img" src="{{asset ('assets/img/icons/bookmark-white.png')}}" width="15" height="15"></a> <a href="#" class="btn blue recMerchant" data-state="{{$vipRec}}" data-vendor-id="{{$vendor->id}}" data-user-id="{{$user->id}}">Reccommend <img class="bm-img" src="{{asset ('assets/img/icons/recommend-white.png')}}" width="15" height="15"></a>
			</div>
			@endif()
		</div>
		
		@if(isset($user) && $user->userType == 'vip')
		<div class="mh-rel">
			<div class="mhb-right visible-lg">
				
				@if($vipRec == 0)
				
				<a href="#" class="btn blue btn-spacer bookmarkMerchant" data-state="{{$vipRec}}" data-vendor-id="{{$vendor->id}}" data-user-id="{{$user->id}}">Bookmark <img class="bkImg" src="{{asset ('assets/img/icons/bookmark-white.png')}}" width="15" height="15"></a> <a href="#" class="btn blue recMerchant" data-state="{{$vipRec}}" data-vendor-id="{{$vendor->id}}" data-user-id="{{$user->id}}">Reccommend <img class="recImg" src="{{asset ('assets/img/icons/recommend-white.png')}}" width="15" height="15"></a>
				
				@else()
				
				<a href="#" class="btn blue btn-spacer bookmarkMerchant active" data-state="{{$vipRec}}" data-vendor-id="{{$vendor->id}}" data-user-id="{{$user->id}}">Bookmark <i class="fa fa-check"></i></a> <a href="#" class="btn blue recMerchant active" data-state="{{$vipRec}}" data-vendor-id="{{$vendor->id}}" data-user-id="{{$user->id}}">Reccommend <i class="fa fa-check"></i></a>
				
				@endif()
			</div>
		</div>
		@endif()
	</div>
</section>