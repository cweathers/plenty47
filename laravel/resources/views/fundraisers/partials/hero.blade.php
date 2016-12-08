<section class="merchant-hero fund-min compTop" style="background: url( {{$profileImage}} ) no-repeat center top;background-size:cover;">
	<div class="clearfix"></div>
	<div class="frh-left">
		@if($fundraiser->logo)
		<img src="{{asset ('uploads/'.$fundraiser->logo)}}" class="fundraiser-logo currentLogo">
		@else()
		<img src="{{asset ('assets/img/default-logo.jpg')}}" class="fundraiser-logo currentLogo">
		@endif()
		
		<div id="fr-dets">
			@include('fundraisers.partials.dets')
		</div>
	</div>
	<span class="clearfix"></span>
	<div class="frh-right">
		<span class="frh-pitch">Support us with the purchase of a VIP Card!</span>
		<a href="/vip-signup?fundraiser={{$fundraiser->id}}" class="btn btn-lg green">sign up</a>
		<span class="clearfix"></span>
	</div>
</section>