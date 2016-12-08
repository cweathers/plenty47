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
				<li class="active">
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
				<li>
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
					
					<form id="vip-payment-form" method="POST" action="/vip-signup/process-payment-info">
						
						<fieldset>
							<legend>Payment Info</legend>
							<div class="row">
								
								<div class="col-md-12">
									@if($prefill['card_status'] == 'existing')
									<div class="alert alert-info">You are covered for 1 year from today on your Plenty4/7 subscription, however to finalize you're account in the system, we must have a credit card on file to renew your account 1 year from today. You can cancel at any time before {{date('F j, Y', strtotime(date('Y-m-d').' + 1 year'))}}. If you do not cancel, you will be charged ${{$cost}} on {{date('F j, Y', strtotime(date('Y-m-d').' + 1 year'))}}</div>
									@else()
									<div class="alert alert-info">
										You will be charged ${{$cost}} / year starting today. Your next subscription renewal will occur on {{date('F j, Y', strtotime(date('Y-m-d').' + 1 year'))}}, you can cancel your subscription at any point before then.</div>
									@endif()
									
									<div class="payment-errors"></div>
									
								</div>
								
								<div class="col-md-9">
									<div class="form-group">
										<label>Card Number</label>
										<input type="text" name="cc_number" id="card_number" data-stripe="number" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>CVC</label>
										<input type="text" data-stripe="cvc" id="cc_cvc" name="cc_cvc" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Exp. Month</label>
										<select data-stripe="exp-month" id="cc_exp_month" class="form-control" name="cc_exp_month">
											<option value="">...</option>
											<option value="01">Jan (01)</option>
											<option value="02">Feb (02)</option>
											<option value="03">Mar (03)</option>
											<option value="04">Apr (04)</option>
											<option value="05">May (05)</option>
											<option value="06">Jun (06)</option>
											<option value="07">Jul (07)</option>
											<option value="08">Aug (08)</option>
											<option value="09">Sep (09)</option>
											<option value="10">Oct (10)</option>
											<option value="11">Nov (11)</option>
											<option value="12">Dec (12)</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Exp. Year</label>
										<?php 
										$current = date('Y');
										$max = $current+10;	
										?>
										<select data-stripe="exp-year" id="cc_exp_year" class="form-control" name="cc_exp_year">
											<option value="">...</option>
											@while($current <= $max)
											<option value="{{$current}}">{{$current}}</option>
											{{$current++}}
											@endwhile()
										</select>
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Billing Address</legend>
							<input type="checkbox" name="billingSame" id="billingSame" value="1" checked="checked"> Same as Shipping
							<div class="shipping-address">
							<hr />
								<div class="row">
									<div class="col-md-12">
									<div class="form-group">
										<label>address</label>
										<input type="text" name="address" class="form-control">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>apt., suite, etc...</label>
										<input type="text" name="address2" class="form-control">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>city</label>
										<input type="text" name="city" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>state</label>
										<select name="state" class="form-control">
											<option value="">...</option>
											@include('staticPages.partials.stateOptions')
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>zipcode</label>
										<input type="text" name="zipcode" id="zipcode" class="form-control">
									</div>
								</div>
								<input type="hidden" name="label" value="Shipping Address">
							</div>
						</fieldset>
						<input type="hidden" name="pk" id="pk" value="{{$stripe['key']}}">
						<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
						<button type="submit" name="submitForm" id="submitPaymentForm" class="btn btn-lg blue">Continue</button>
						<div class="clearfix"></div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</section>

@stop()

@section('footer')
<script src="https://js.stripe.com/v2/"></script>
<script>
	$(document).ready(function() {

		//Stripe token...
		var pk = $('#pk').val();
		Stripe.setPublishableKey(pk);
		
	});
	
	//Validate vendor/merchant signup form...
	$("#vip-payment-form").validate({
	    errorClass:'error',
	    validClass:'success',
	    errorElement:'span',
	  onkeyup: false,
	  rules: {
	    cc_number: { required: true },
	    cc_cvc: { required: true },
	    cc_exp_month: { required: true },
	    cc_exp_year: { required: true },
	  },
	  submitHandler: function(form) {
		  
		  	function stripeResponseHandler(status, response) {
			  var $form = $('#vip-payment-form');
			
			  if (response.error) {
			    // Show the errors on the form
			    $('.payment-errors').html(response.error.message);
			    $('#submit-payment-form').removeClass('disabled');
			  } else {
			    // response contains id and card, which contains additional card details
			    var token = response.id;
			    // Insert the token into the form so it gets submitted to the server
			    $('#vip-payment-form').append('<input type="hidden" name="stripeToken" value="'+token+'" />');
			    
			    //Clear all the inputs so that we don't send the cc info along...
			    $('#card_number, #cc_cvc, #cc_exp_month, #cc_exp_year').val('');
			    
			    // and submit
			    $form.get(0).submit();
			  }
			};
	
		    // Disable the submit button to prevent repeated clicks
		    $('#submit-payment-form').addClass('disabled');
		
		    Stripe.card.createToken(form, stripeResponseHandler);
			
	  },
	});

</script>
@stop