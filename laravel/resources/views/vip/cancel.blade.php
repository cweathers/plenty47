@extends('app')

@section('content')

@include('vip.partials.profileHero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="cancel-box">
				<h1>Cancel Your VIP Membership</h1>
				<hr />
				<p>Are you sure you want to cancel your VIP membership? If you choose to cancel, your subscription will become inactive after your yearly subscription is up and your credit card will not be charged again.</p>
				<hr />
				<a href="/my-account/confirm-cancel" class="btn btn-danger btn-lg" onclick="return confirm('There\'s no going back! Are you sure?');"><i class="fa fa-exclamation-triangle"></i> Confirm Cancellation</a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>

@stop
