@extends('app')
@section('content')

<section class="signup-container content white pad100">
	<div class="row">
		<div class="flex">
			<div class="col-sm-12 col-md-12 col-lg-3">
				@if(isset($_GET['error']))
				<div class="alert alert-error">Sorry, there was a problem with the card you used, or the card the system assigned to you. Please start over below or contact support to continue.</div>
				@endif()
				<div class="signup-side">
					<span class="orange-title">VIP Member Sign Up</span>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9">
				<div class="signup-line">
					
					<form id="check-card-form" method="POST" action="/vip-signup/process-card?card=existing">
						
						<p><img src="{{asset ('assets/img/p47-card.png')}}" class="vip-card"></p>
						<fieldset>
							<legend>I have a VIP Card</legend>
							<p>Type card number here to register your VIP account.</p>
							<div class="form-group">
								<input type="text" name="card_number" id="card_number" class="form-control" placeholder="5555-5555-5555-5555">
							</div>
							<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
							<button type="submit" name="submitForm" class="btn btn-lg blue">Continue</button>
						</fieldset>
						<div class="clearfix"></div>
					</form>
					
					<form id="vip-signup" method="POST" action="/vip-signup/process-card?card=new">
						<fieldset class="fieldset-nobot">
							<legend>I need a VIP Card</legend>
							<p>Click here to sign up, pay for your card, and get some sweet VIP deals!</p>
							<div class="form-group">
							</div>
							@if(isset($_GET['fundraiser']))
							<input type="hidden" name="fundraiser_id" value="{{$_GET['fundraiser']}}">
							@endif()
							<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
							<button type="submit" name="submitForm" class="btn btn-lg blue">Continue</button>
						</fieldset>
						<div class="clearfix"></div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</section>

@stop()
