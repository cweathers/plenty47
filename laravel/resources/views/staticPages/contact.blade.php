@extends('app')
@section('content')
<div class="page-template compTop">
	<section class="pt-header">
		<h1>Contact Us</h1>
		<h2>Please fill out the form below to contact us</h2>
	</section>
	<section class="pt-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<div class="contact-box">
						
						@if(Session::has('success'))
						<div class="alert alert-success">{{Session::get('success')}}</div>
						@endif()
						
						<form id="contact-form" method="post" action="/contact">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Name</label>
										<input type="text" name="name" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" name="phone" id="phone" class="form-control">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Request Type</label>
										<select name="requestType" class="form-control">
											<option value="General Request" selected="selected">General Request</option>
											<option value="Becoming a VIP" >Becoming a VIP</option>
											<option value="Becoming a Merchant" >Becoming a Merchant</option>
											<option value="Becoming a Fundraising Group" >Becoming a Fundraising Group</option>
											<option value="VIP Account Support" >VIP Account Support</option>
											<option value="Merchant/Vendor Support" >Merchant/Vendor Support</option>
											<option value="Fundraising Group Support" >Fundraising Group Support</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Your Message</label>
										<textarea name="message" class="form-control"></textarea>
									</div>
									<hr />
									<div class="form-group">
										<input type="hidden" name="_token" value="{{Session::get('_token')}}">
										<button type="submit" class="btn btn-lg blue">submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop()