@extends('app')

@section('content')

@include('merchant.partials.editProfileDetails')

@include('merchant.partials.dashboardHero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-4 col-lg-3">
			<div class="profile-sb">
				<div class="psb-sect">
					<span class="psb-left">current offers</span>
					<span class="psb-right">
						<img src="{{asset ('assets/img/icons/tag-orange.png')}}" width="24" height="24">
						<span>{{count($vendor->deals)}}</span>
					</span>
					<span class="clearfix"></span>
				</div>
				<div class="psb-sect">
					<span class="psb-left">recommendations</span>
					<span class="psb-right">
						<img src="{{asset ('assets/img/icons/heart-orange.png')}}" width="24" height="24">
						<span>{{$vendor->recommendations}}</span>
					</span>
					<span class="clearfix"></span>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-lg-9">
			<div class="dealDets">
				<div class="deal-section">
					<span class="ds-heading">Manage Deals</span>
					<span class="ds-line"></span>
					
					@include('merchant.partials.newDealModal')
					
					@include('merchant.partials.editDealModal')
					
					<div id="deal-loader">
					@include('merchant.partials.dealList')
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
						@foreach($vendor->facts as $fact)
						<tr id="fact-row-{{$fact->id}}">
							<td><input type="text" id="fact-text-{{$fact->id}}" class="form-control" value="{{$fact->fact}}"></td>
							<td class="text-center"><a href="#" class="merchant-saveFact btn btn-success" data-id="{{$fact->id}}"><i class="fa fa-check"></i></a> <a href="#" class="merchant-removeFact btn btn-danger" data-id="{{$fact->id}}"><i class="fa fa-times"></i></a>
						</tr>
						@endforeach()
					</table>
					<a href="#" class="merchant-addFact btn btn-success"><i class="fa fa-plus"></i> add fact</a>
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
									<p>Upload some photos of your products, services, office building or anything you would like people browsing your merchant profile to see.</p>
									<div id="merchantPhotoList">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="container">
									    <a id="merchantPickPhotos" href="javascript:;" class="btn btn-default">Select Photos</a> 
									    <a id="merchantUploadPhotos" href="javascript:;" class="btn btn-success">Upload Photos</a>
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
						@include('merchant.partials.photos')
					</ul>
				</div>
				
			</div>
		</div>
	</div>
</section>

@stop
