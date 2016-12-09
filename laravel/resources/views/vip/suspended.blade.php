@extends('app')

@section('content')

@include('vip.partials.profileHero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="cancel-box">
				<h1>Reactivate Your VIP Membership</h1>
				<hr />
				<p>You have landed here because your vip membership is inactive or cancelled. We'll need to get you paid up again so that you can enjoy all the P4/7 benefits! It will only take a second, just fill out the credit card form below and we'll have you deal surfing in 30 seconds.</p>
				<hr />
				<div class="alert alert-info">VIP Memberships currently cost ${{$cost}}. Your membership, pending payment, would be activated today and expire on {{date('F j, Y', strtotime(date('Y-m-d').' + 1 year'))}}.</div>
				<hr />
				<form id="vip-payment-form" method="POST" action="/my-account/renew-membership">
						
					<fieldset>
						<legend>Payment Info</legend>
						<div class="row">
							
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
					<input type="hidden" name="pk" id="pk" value="{{$stripe['key']}}">
					<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
					<button type="submit" name="submitForm" id="submitPaymentForm" class="btn btn-lg blue">Renew My Membership!</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>

@stop

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
