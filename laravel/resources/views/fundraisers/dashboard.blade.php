@extends('app')

@section('content')

@include('fundraisers.partials.editProfileDetails')

@include('fundraisers.partials.dashboardHero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-12">
			<div class="dealDets">
				
				<div class="deal-section">
					
					<!-- Modal -->
					<div class="modal fade" id="addSalesPersonModal" tabindex="-1" role="dialog" aria-labelledby="addSalesPersonLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="addSalesPersonLabel">Add a Salesperson</h4>
					      </div>
					      <div class="modal-body">
					        <div class="row">
						        <form id="add-salesperson-form" method="POST" action="/fundraiser/add-salesperson">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" name="firstName" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" name="lastName" class="form-control">
										</div>
									</div>
									<div class="col-md-12">
										<hr />
										<input type="hidden" name="_token" value="{{Session::get('_token')}}">
										<input type="hidden" name="fundraiser_id" value="{{$fundraiser->id}}">
										<button type="submit" class="btn btn-lg blue">Save Salesperson</button>
									</div>
						        </form>
							</div>
					      </div>
					    </div>
					  </div>
					</div>
					
					<span class="ds-heading">Manage Salespeople</span>
					<span class="ds-line"></span>
					
					@if(Session::has('successPerson'))
					<div class="alert alert-success">{{Session::get('successPerson')}}</div>
					@endif()
					
					@if(count($fundraiser->salespeople) > 0)
					@include('fundraisers.partials.salespeopleTable')
					<a href="#" data-toggle="modal" data-target="#addSalesPersonModal" class="btn btn-success"><i class="fa fa-plus"></i> add salesperson</a>
					@else()
					<div class="alert alert-info">
						You have not added any salespeople yet. Do you want to <a href="#" data-toggle="modal" data-target="#addSalesPersonModal" class="alert-link">add one now?</a>
					</div>
					@endif()
				</div>
				
				<div class="clearfix"></div>
				
				<div class="deal-section">
					<span class="ds-heading">Edit Your "About Us" Text</span>
					<span class="ds-line"></span>
					<textarea id="aboutUsText" class="form-control exHeight">{{$fundraiser->aboutUs}}</textarea>
					<a href="#" class="fr-saveAboutUs btn btn-success"><i class="fa fa-check"></i> save</a>
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">Edit Your "Raising Funds For" Text</span>
					<span class="ds-line"></span>
					<textarea id="ourCauseText" class="form-control exHeight">{{$fundraiser->ourCause}}</textarea>
					<a href="#" class="fr-saveOurCause btn btn-success"><i class="fa fa-check"></i> save</a>
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">Add/Change Profile Video</span>
					<span class="ds-line"></span>
					
					<div id="currentVideo">
						@include('fundraisers.partials.video')
					</div>
					
					<p>We use vimeo for video hosting! Please paste your vimeo video id below.</p>
					<div class="input-group" style="max-width:500px;">
					  <span class="input-group-addon">http://vimeo.com/</span>
					  <input type="text" class="form-control" id="videoLink">
					  <span class="input-group-btn">
				        <button class="btn btn-success" id="fr-saveVideoLink" type="button"><i class="fa fa-check"></i> save</button>
				      </span>
					</div>
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">Edit Fun Facts</span>
					<span class="ds-line"></span>
					<table class="table table-striped table-bordered" id="factTable">
						<tr>
							<td>Fact</td>
							<td class="text-center">Actions</td>
						</tr>
						@foreach($fundraiser->facts as $fact)
						<tr id="fact-row-{{$fact->id}}">
							<td><input type="text" id="fact-text-{{$fact->id}}" class="form-control" value="{{$fact->fact}}"></td>
							<td class="text-center"><a href="#" class="fundraiser-saveFact btn btn-success" data-id="{{$fact->id}}"><i class="fa fa-check"></i></a> <a href="#" class="fundraiser-removeFact btn btn-danger" data-id="{{$fact->id}}"><i class="fa fa-times"></i></a>
						</tr>
						@endforeach()
					</table>
					<a href="#" class="fundraiser-addFact btn btn-success"><i class="fa fa-plus"></i> add fact</a>
				</div>
				
				<div class="deal-section">
					
					<!-- Modal -->
					<div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-labelledby="addPhotoModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="addPhotoModalLabel">Upload Photos</h4>
					      </div>
					      <div class="modal-body">
					        <div class="row">
								<div class="col-md-12">
									<p>Upload some photos of anything you would like people browsing your fundraising profile to see.</p>
									<div id="fundraiserPhotoList" class="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="container">
									    <a id="fundraiserPickPhotos" href="javascript:;" class="btn btn-default">Select Photos</a> 
									    <a id="fundraiserUploadPhotos" href="javascript:;" class="btn btn-success">Upload Photos</a>
									</div>
								</div>
							</div>
					      </div>
					    </div>
					  </div>
					</div>
					
					<span class="ds-heading">Manage Photos</span>
					<span class="ds-line"></span>
					<ul class="merchant-photos">
						@include('fundraisers.partials.photos')
					</ul>
				</div>
				
				<div class="clearfix"></div>
				
				
				
			</div>
		</div>
	</div>
</section>

<section class="vendorCta gray">
	<span>Support us With the Purchase of a VIP Card</span> <a href="/vip-signup?fundraiser={{$fundraiser->id}}" class="">sign up</a>
</section>

@stop
