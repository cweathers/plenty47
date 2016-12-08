<section class="merchant-hero fund-min compTop"  id="vipCover" style="background: url( {{$profileImage}} ) no-repeat center top;background-size:cover;">
	<div class="clearfix"></div>
	<div class="frh-left">
		<a href="/my-account">
			@if($vip->avatar)
			<img src="{{asset ('uploads/'.$vip->avatar)}}" id="vipAvatar" class="fundraiser-logo currentLogo">
			@else()
			<img src="{{asset ('assets/img/default-logo.jpg')}}" id="vipAvatar" class="fundraiser-logo currentLogo">
			@endif()
		</a>
		
		<div id="fr-dets">
			<span class="frh-name">{{$user->firstName}} {{$user->lastName}}</span>
			<span class="frh-cat">Benefitting {{$vip->fundraiser->groupName}}</span>
		</div>
	</div>
	<span class="clearfix"></span>
	<a href="/my-account/settings" class="btn blue changeCover"><i class="fa fa-gear"></i> change cover</a>
	<span class="clearfix"></span>
</section>