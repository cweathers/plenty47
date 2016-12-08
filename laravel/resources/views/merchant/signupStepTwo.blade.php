@extends('app')
@section('content')

<section class="content gray pad100 compTop">
	<div class="text-center rel">
		<div class="steps">
			<ul>
				<li>
					<a href="/merchant-signup?update=true">
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
			<div class="col-md-3">
				<div class="signup-side">
					<span class="orange-title">Merchant/Vendor Sign Up</span>
				</div>
			</div>
			<div class="col-md-9">
				<div class="signup-line">
					<form id="merchant-enhance-profile" method="POST" action="/merchant-finalize">
						<fieldset>
							<legend>Your P4/7 Merchant URL</legend>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>choose a unique url for your profile</label>
										<input type="text" name="slug" id="slug" class="form-control" value="{{$slug}}">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Upload Your Logo</legend>
							<p>A square image works best!</p>
							<div id="logolist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
							<br />
							
							<div id="logoContainer">
							    <a id="pickLogo" href="javascript:;" class="btn btn-default">Select Logo</a> 
							    <a id="uploadLogo" href="javascript:;" class="btn btn-success">Upload Logo</a>
							</div>
						</fieldset>
						<fieldset>
							<legend>Upload A Profile Cover Image</legend>
							<p>We use cover images for our merchant profiles, similar to facebook and twitter. Please select a cover image.</p>
							<div id="coverlist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
							<br />
							
							<div id="coverContainer">
							    <a id="pickCover" href="javascript:;" class="btn btn-default">Select Logo</a> 
							    <a id="uploadCover" href="javascript:;" class="btn btn-success">Upload Logo</a>
							</div>
						</fieldset>
						<fieldset>
							<legend>Add Your Hours of Operation</legend>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-striped table-bordered" id="hoursTable">
										<tr>
											<td>Label</td>
											<td>Hours (8am - 5pm, etc)</td>
											<td class="text-center">&nbsp;</td>
										</tr>
										<tr>
											<td>
												<input type="text" name="label[]" class="form-control" placeholder="mon-fri, sat, etc...">
											</td>
											<td>
												<input type="text" name="hours[]" class="form-control" placeholder="8am-5pm, till 7pm, etc...">
											</td>
											<td class="text-center">
												<a href="#" class="btn btn-danger remove-hours"><i class="fa fa-times"></i></a>
											</td>
										</tr>
									</table>
									<a href="#" class="btn btn-success add-hours"><i class="fa fa-plus"></i> add a row</a>
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Fun Facts About {{$vendor['companyName']}}</legend>
							<div class="row">
								<div class="col-md-12">
									<p>Add some fun facts about your company for people browsing your merchant profile.</p>
									<div class="form-group">
										<input type="text" name="funFacts[]" class="form-control">
									</div>
									<div class="form-group">
										<input type="text" name="funFacts[]" class="form-control">
									</div>
									<div class="form-group">
										<input type="text" name="funFacts[]" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset>
							<legend>Add Photos To Your Gallery</legend>
							<div class="row">
								<div class="col-md-12">
									<p>Upload some photos of your products, services, office building or anything you would like people browsing your merchant profile to see.</p>
									<div id="merchantPhotoList">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="container">
									    <a id="merchantPickPhoto" href="javascript:;" class="btn btn-default">Select Photos</a> 
									    <a id="merchantUploadPhotos" href="javascript:;" class="btn btn-success">Upload Photos</a>
									</div>
								</div>
							</div>
						</fieldset>
						
						<input type="hidden" name="vendor_id" value="{{$vendor['vendor_id']}}">
						<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
						<a href="/merchant-signup" class="btn btn-default">back</a> <button type="submit" name="submitForm" class="btn btn-lg blue pull-right">Continue</button>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@stop()