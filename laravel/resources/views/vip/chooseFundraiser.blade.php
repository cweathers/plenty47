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
				<li class="active">
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
					
					<div id="fundraiser-error" class="alert alert-danger">You must select a fundraising organization to support!</div>
					
					<form id="vip-fundraiser-form" method="POST" action="/vip-signup/choose-fundraiser">
						
						<fieldset>
							<legend>Choose an Organization</legend>
							<p>Select a charity organization below that you would like to benefit. <br />(a portion of the proceeds from your membership will help a great cause!)</p>
							
							@if(isset($fundraiser))
							<ul class="fundraiser-list">
								<li>
									@if($fundraiser->aboutUs)
									<div class="fundraiser-bubble"><i class="fa fa-caret-down"></i>{{str_limit($fundraiser->aboutUs, 140)}}<div class="text-center"><a class="fbrm" href="/fundraiser/{{$fundraiser->slug}}">read more</a></div></div>
									<a href="#" class="fundraiser-info"><i class="fa fa-exclamation-circle"></i></a>
									@endif()
									<span class="fl-name">{{$fundraiser->groupName}}</span>
									<a href="#" class="select-fundraiser active disabled" data-id="{{$fundraiser->id}}"><i class="fa fa-check-square"></i></a>
								</li>
							</ul>
							@else()
							<ul class="fundraiser-list">
								@foreach($fundraisers as $f)
								<li>
									@if($f->aboutUs)
									<div class="fundraiser-bubble"><i class="fa fa-caret-down"></i>{{str_limit($f->aboutUs, 140)}}<div class="text-center"><a class="fbrm" href="/fundraiser/{{$f->slug}}">read more</a></div></div>
									<a href="#" class="fundraiser-info"><i class="fa fa-exclamation-circle"></i></a>
									@endif()
									<span class="fl-name">{{$f->groupName}}</span>
									<a href="#" class="select-fundraiser" data-id="{{$f->id}}"><i class="fa fa-square"></i></a>
								</li>
								@endforeach()
							</ul>
							@endif()
							
						</fieldset>
						
						
					
						<input type="hidden" name="fundraiser_id" id="fundraiser_id" value="@if(isset($fundraiser)){{$fundraiser->id}}@endif()">
						<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
						<button type="submit" name="submitForm" id="submitFundraiserForm" class="btn btn-lg blue">Continue</button>
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