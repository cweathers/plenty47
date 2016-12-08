<!-- Modal -->
<div class="modal fade" id="profileDetailsModal" tabindex="-1" role="dialog" aria-labelledby="profileDetailsLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="fundraiser-profile-details-form">
	      <div class="modal-body">
	        <fieldset>
				<legend>Fundraising Group Info</legend>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>group name</label>
							<input type="text" name="groupName" class="form-control" value="{{$fundraiser->groupName}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>group category</label>
							<select name="category" class="form-control">
								<option value="">...</option>
								@foreach($categories as $cat)
								<option value="{{$cat->id}}" @if( $fundraiser->category == $cat->id) selected="selected" @endif() >{{$cat->category}}</option>
								@endforeach
							</select>									
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>phone</label>
							<input type="text" id="phone" name="phone" class="form-control" value="{{$fundraiser->phone}}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>address</label>
							<input type="text" name="address" class="form-control" value="{{$fundraiser->address}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>suite, office #, etc</label>
							<input type="text" name="address2" class="form-control" value="{{$fundraiser->address2}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>city</label>
							<input type="text" name="city" class="form-control" value="{{$fundraiser->city}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>state</label>
							<select name="state" class="form-control">
								<option value="">...</option>
								@include('staticPages.partials.fundraiserstateOptions')
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>zipcode</label>
							<input type="text" name="zipcode" class="form-control" value="{{$fundraiser->zipcode}}">
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<p><img src="{{asset('/uploads/'.$fundraiser->logo)}}" class="img-responsive currentLogo"></p>
				<legend>Upload/Change Your Logo</legend>
				<p>A square image works best!</p>
				<div id="fr-proflogolist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
				<br />
				
				<div id="fr-logoContainer">
				    <a id="fr-profpickLogo" href="javascript:;" class="btn btn-default">Select Logo</a> 
				    <a id="fr-profuploadLogo" href="javascript:;" class="btn btn-success">Upload Logo</a>
				</div>
			</fieldset>
			<fieldset>
				@if($fundraiser->profileImage)
				<p><img src="{{asset('/uploads/'.$fundraiser->profileImage)}}" class="img-responsive currentProfileImage"></p>
				@endif()
				<legend>Upload/Change Your Profile Image (Header Image)</legend>
				<p>A wide format image works best!</p>
				<div id="frProfileList">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
				<br />
				
				<div id="frProfileContainer">
				    <a id="frProfilePickLogo" href="javascript:;" class="btn btn-default">Select Profile Image</a> 
				    <a id="frProfileUploadLogo" href="javascript:;" class="btn btn-success">Upload Image</a>
				</div>
			</fieldset>
			<div class="pull-right">
				<input type="hidden" name="_token" value="{{ Session::get('_token') }}">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" id="merchantSaveDetails">Save changes</button>
			</div>
			<div class="clearfix"></div>
	      </div>
      </form>
    </div>
  </div>
</div>