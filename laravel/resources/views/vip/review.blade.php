@extends('app')
@section('content')

<section class="content gray pad100 compTop hidden-xs">
	<div class="text-center rel">
		<div class="steps">
			<ul>
				<li>
					<a href="/vip-signup/account-info">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Account Setup</span>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Payment Info</span>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Choose Fundraiser</span>
					</a>
				</li>
				<li class="active">
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Overview</span>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Success</span>
					</a>
				</li>
			</ul>
		</div>
		<span class="step-line"></span>
	</div>
</section>

<section class="signup-container content white pad100">
	<div class="row">
		<div class="flex">
			<div class="col-sm-12 col-md-12 col-lg-3">
				<div class="signup-side">
					<span class="orange-title">VIP Member Sign Up</span>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9">
				<div class="signup-line">
					<fieldset>
						<legend>Review Account Details</legend>
						<div style="height:50px;"></div>
						<div class="row">
							<div class="col-md-6">
								<div class="review-section">
									<span class="rs-heading">Shipping Address:</span>
									@if(Session::has('billingSame'))
									<p>
										{{$user->firstName}} {{$user->lastName}}<br />
										{{$user->addresses[0]->address}} {{$user->addresses[0]->address2}}<br />
										{{$user->addresses[0]->city}}, {{$user->addresses[0]->state}} {{$user->addresses[0]->zipcode}}<br />
										{{$user->phone}}
									</p>
									@else()
									<p>
										{{$user->firstName}} {{$user->lastName}}<br />
										{{$user->addresses[1]->address}} {{$user->addresses[1]->address2}}<br />
										{{$user->addresses[1]->city}}, {{$user->addresses[1]->state}} {{$user->addresses[1]->zipcode}}<br />
										{{$user->phone}}
									</p>
									@endif()
								</div>
								<div class="review-section">
									<span class="rs-heading">Plenty4/7 Account Info:</span>
									<p>Email: {{$user->email}}<br />
									Password: *********<br />	
									</p>
								</div>
								<div class="review-section">
									<span class="rs-heading">Order Summary:</span>
									<p>P4/7 Card #: {{$masked_card}}</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="review-section">
									<span class="rs-heading">Payment Method:</span>
									<p>P4/7 Subscription via Credit Card</p>
								</div>
								<div class="review-section">
									<span class="rs-heading">Billing Address:</span>
									<p>
										{{$user->firstName}} {{$user->lastName}}<br />
										{{$user->addresses[0]->address}} {{$user->addresses[0]->address2}}<br />
										{{$user->addresses[0]->city}}, {{$user->addresses[0]->state}} {{$user->addresses[0]->zipcode}}<br />
										{{$user->phone}}
									</p>
								</div>
								<div class="review-section">
									<span class="rs-heading">Organization:</span>
									<p>
										{{$fundraiser->groupName}}
									</p>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</fieldset>
					<a href="/vip-signup/finalize" class="btn btn-lg btn-primary"><i class="fa fa-check"></i> Confirm and Submit</a>
				</div>
			</div>
		</div>
	</div>
</section>

@stop()