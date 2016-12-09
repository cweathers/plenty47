@extends('app')

@section('content')

@include('vip.partials.profileHero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-4 col-lg-3">
			@include('vip.partials.sidebar')
		</div>
		<div class="col-md-8 col-lg-9">
			<div class="vip-padder">
				
				@if(Session::has('success'))
				<div class="alert alert-success">{{Session::get('success')}}</div>
				@endif()
				
				<fieldset>
					<legend>Change Your Avatar</legend>
					<p>A square image works best!</p>
					<div id="vip-logolist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
					<br />
					
					<div id="vip-logoContainer">
					    <a id="vip-pickLogo" href="javascript:;" class="btn btn-default">Select Avatar</a> 
					    <a id="vip-uploadLogo" href="javascript:;" class="btn btn-success">Upload Avatar</a>
					</div>
				</fieldset>
				<fieldset>
					<legend>Change Your Cover Image</legend>
					<p>We use cover images for our merchant profiles, similar to facebook and twitter. Please select a cover image.</p>
					<div id="vip-coverlist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
					<br />
					
					<div id="vip-coverContainer">
					    <a id="vip-pickCover" href="javascript:;" class="btn btn-default">Select Image</a> 
					    <a id="vip-uploadCover" href="javascript:;" class="btn btn-success">Upload Image</a>
					</div>
				</fieldset>
				<form id="vip-settings-form" method="POST" action="/my-account/settings">
					<fieldset>
						<legend>Address Settings</legend>
						<div class="row">
							<div class="col-md-6">
								<span class="fieldset-heading">Billing Address</span>
								<div class="form-group">
									<label>Address</label>
									<input type="text" name="address" class="form-control" value="{{$user->addresses[0]->address}}">
								</div>
								<div class="form-group">
									<label>Apt., Building #, etc...</label>
									<input type="text" name="address2" class="form-control" value="{{$user->addresses[0]->address2}}">
								</div>
								<div class="form-group">
									<label>City</label>
									<input type="text" name="city" class="form-control" value="{{$user->addresses[0]->city}}">
								</div>
								<div class="form-group">
									<label>State</label>
									<select name="state" class="form-control">
										<option value="">...</option>
										@include('vip.partials.billingStates')
									</select>
								</div>
								<div class="form-group">
									<label>Zipcode</label>
									<input type="text" name="zipcode" class="form-control" value="{{$user->addresses[0]->zipcode}}">
								</div>
								<input type="hidden" name="address_id" value="{{$user->addresses[0]->id}}">
	 						</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Subscription Status</legend>
						<div class="row">
							<div class="col-md-6">
								@if($user->subscription_ends_at)
								<div class="alert alert-info">Your vip membership has been scheduled for cancellation on {{date('F j, Y', strtotime($user->subscription_ends_at))}}, to renew your subscription, just log in after that date and you'll be prompted to renew. </div>
								@else()
								<div class="alert alert-success">Your vip membership is currently active! If you would like to cancel your VIP membership, <a class="alert-link" href="/cancel-vip-membership">click here.</a></div>
								@endif()
								
							</div>
							<div class="col-md-6">
								
							</div>
						</div>
					</fieldset>
					<input type="hidden" name="_token" value="{{Session::get('_token')}}">
					<button type="submit" id="saveVipSettings" class="btn btn-lg blue"><i class="fa fa-check"></i> Save Changes</button>
				</form>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>

@stop
