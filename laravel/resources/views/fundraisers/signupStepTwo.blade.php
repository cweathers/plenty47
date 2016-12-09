@extends('app')
@section('content')

<section class="content gray pad100 compTop">
	<div class="text-center rel">
		<div class="steps">
			<ul>
				<li>
					<a href="/fundraiser-signup?update=true">
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
					<span class="orange-title">Fundraising Group <br />Sign Up</span>
				</div>
			</div>
			<div class="col-md-9">
				<div class="signup-line">
					<form id="fundraiser-enhance-profile" method="POST" action="/fundraiser-finalize">
						<fieldset>
							<legend>Your P4/7 Fundraiser URL</legend>
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
							<div id="fr-logolist" class="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
							<br />
							
							<div id="fr-logoContainer">
							    <a id="fr-pickLogo" href="javascript:;" class="btn btn-default">Select Logo</a> 
							    <a id="fr-uploadLogo" href="javascript:;" class="btn btn-success">Upload Logo</a>
							</div>
						</fieldset>
						<fieldset>
							<legend>Upload A Profile Cover Image</legend>
							<p>We use cover images for our fundraiser profiles, similar to facebook and twitter. Please select a cover image.</p>
							<div id="fr-coverlist" class="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
							<br />
							
							<div id="fr-coverContainer">
							    <a id="fr-pickCover" href="javascript:;" class="btn btn-default">Select Image</a> 
							    <a id="fr-uploadCover" href="javascript:;" class="btn btn-success">Upload Image</a>
							</div>
						</fieldset>
						<fieldset>
							<legend>Fun Facts About {{$fundraiser['groupName']}}</legend>
							<div class="row">
								<div class="col-md-12">
									<p>Add some fun facts about your fundraising group for people browsing your profile.</p>
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
									<div id="frg-photolist" class="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="frg-container">
									    <a id="frg-pickphoto" href="javascript:;" class="btn btn-default">Select Photos</a> 
									    <a id="frg-uploadphoto" href="javascript:;" class="btn btn-success">Upload Photos</a>
									</div>
								</div>
								
							</div>
						</fieldset>
						
						<input type="hidden" name="fundraiser_id" value="{{$fundraiser['fundraiser_id']}}">
						<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
						<a href="/fundraiser-signup?update=true" class="btn btn-default">back</a> <button type="submit" name="submitForm" class="btn btn-lg blue pull-right">Continue</button>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@stop()