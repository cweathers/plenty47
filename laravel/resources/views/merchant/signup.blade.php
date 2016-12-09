@extends('app')
@section('content')

<section class="content gray pad100 compTop hidden-xs">
	<div class="text-center rel">
		<div class="steps">
			<ul>
				<li class="active">
					<a href="#">
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
						<span class="step-name">Profile Details</span>
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
					<span class="orange-title">Merchant/Vendor Sign Up</span>
					<br />
					<p>You have reached the Plenty4/7 new vendor/merchant signup page.</p> 

					<p>Plenty4/7 is absolutely committed to providing new and returning customers for your business via our 100% free marketing program.</p> <p>This page allows you to create/apply for a free merchant profile. Upon acceptance into the program, you will be notified within 1-2 business days of acceptance in order to access your deal management dashboard.</p> <p>We are so excited to partner with you!</p>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9">
				<div class="signup-line">
					
					<form id="merchant-signup" method="POST" action="{{$formAction}}">
						<fieldset>
							<legend>Owner/Manager Info</legend>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>email</label>
										<input type="email" id="email" name="email" class="form-control" @if(isset($prefill)) value="{{$prefill['email']}}" @endif()>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>choose a password</label>
										<input type="password" name="password" class="form-control" id="password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>confirm password</label>
										<input type="password" name="passwordConf" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Merchant/Vendor Info</legend>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>company name</label>
										<input type="text" name="companyName" class="form-control" @if(isset($prefill)) value="{{$prefill['companyName']}}" @endif()>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>company website</label>
										<input type="text" name="url" class="form-control" @if(isset($prefill)) value="{{$prefill['url']}}" @endif()>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>business category</label>
										<select name="category" class="form-control">
											<option value="">...</option>
											@foreach($categories as $cat)
											<option value="{{$cat->id}}" @if(isset($prefill) && $prefill['category'] == $cat->id) selected="selected" @endif() >{{$cat->category}}</option>
											@endforeach
										</select>									
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>choose a market</label>
										<select name="market" class="form-control">
											<option value="">...</option>
											@foreach($markets as $m)
											<option value="{{$m->id}}" @if(isset($prefill) && $prefill['market'] == $m->id) selected="selected" @endif() >{{$m->market}}</option>
											@endforeach
										</select>									
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>phone</label>
										<input type="text" id="phone" name="phone" class="form-control" @if(isset($prefill)) value="{{$prefill['phone']}}" @endif()>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>address</label>
										<input type="text" name="address" class="form-control" @if(isset($prefill)) value="{{$prefill['address']}}" @endif()>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>suite, office #, etc</label>
										<input type="text" name="address2" class="form-control" @if(isset($prefill)) value="{{$prefill['address2']}}" @endif()>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>city</label>
										<input type="text" name="city" class="form-control" @if(isset($prefill)) value="{{$prefill['city']}}" @endif()>
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
										<input type="text" name="zipcode" class="form-control" @if(isset($prefill)) value="{{$prefill['zipcode']}}" @endif()>
									</div>
								</div>
							</div>
						</fieldset>
						
						@if(isset($prefill))
						<input type="hidden" name="_method" value="PUT">
						@endif
						<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
						<input type="hidden" name="userType" value="vendor">
						<button type="submit" name="submitForm" class="btn btn-lg blue pull-right">Continue</button>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@stop()
