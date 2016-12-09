		  <div class="modal-body">
		        <fieldset>
					<legend>Merchant/Vendor Info</legend>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>company name</label>
								<input type="text" name="companyName" class="form-control" value="{{$vendor->companyName}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>business category</label>
								<select name="category" class="form-control">
									<option value="">...</option>
									@foreach($categories as $cat)
									<option value="{{$cat->id}}" @if( $vendor->category == $cat->id) selected="selected" @endif() >{{$cat->category}}</option>
									@endforeach
								</select>									
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>phone</label>
								<input type="text" id="phone" name="phone" class="form-control" value="{{$vendor->phone}}">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>address</label>
								<input type="text" name="address" class="form-control" value="{{$vendor->address}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>suite, office #, etc</label>
								<input type="text" name="address2" class="form-control" value="{{$vendor->address2}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>city</label>
								<input type="text" name="city" class="form-control" value="{{$vendor->city}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>state</label>
								<select name="state" class="form-control">
									<option value="">...</option>
									@include('staticPages.partials.merchantstateOptions')
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>zipcode</label>
								<input type="text" name="zipcode" class="form-control" value="{{$vendor->zipcode}}">
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<p><img src="{{asset('/uploads/'.$vendor->logo)}}" class="img-responsive currentLogo"></p>
					<legend>Upload/Change Your Logo</legend>
					<p>A square image works best!</p>
					<div id="proflogolist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
					<br />
					
					<div id="logoContainer">
					    <a id="profpickLogo" href="javascript:;" class="btn btn-default">Select Logo</a> 
					    <a id="profuploadLogo" href="javascript:;" class="btn btn-success">Upload Logo</a>
					</div>
				</fieldset>
				<fieldset>
					<legend>Hours of Operation</legend>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped table-bordered" id="hoursTable">
								<tr>
									<td>Label</td>
									<td>Hours (8am - 5pm, etc)</td>
									<td class="text-center">&nbsp;</td>
								</tr>
								@foreach($vendor->hours as $hour)
								<tr>
									<td>
										<input type="text" name="label[]" class="form-control" placeholder="mon-fri, sat, etc..." value="{{$hour->label}}">
									</td>
									<td>
										<input type="text" name="hours[]" class="form-control" placeholder="8am-5pm, till 7pm, etc..." value="{{$hour->hours}}">
									</td>
									<td class="text-center">
										<a href="#" class="btn btn-danger remove-hours"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								@endforeach()
							</table>
							<a href="#" class="btn btn-success add-hours"><i class="fa fa-plus"></i> add a row</a>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Edit Fun Facts</legend>
					<table class="table table-striped table-bordered" id="factTable" data-vendor-id="{{$vendor->id}}">
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
				</fieldset>
				<fieldset>
					<legend>Add a Video to the profile</legend>
					<div class="form-group">
						<label>Vimeo video ID</label>
						<input type="text" name="vimeo_id" class="form-control" value="{{$vendor->vimeo_id}}">
					</div>
				</fieldset>
		        <input type="hidden" name="user_id" id="vendor_id" value="{{$vendor->id}}">
		        <input type="hidden" name="_token" value="{{ Session::get('_token') }}">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary submitForm" id="saveVendorEdits">Save</button>
	      </div>