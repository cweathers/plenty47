<!-- Modal -->
<div class="modal fade" id="profileDetailsModal" tabindex="-1" role="dialog" aria-labelledby="profileDetailsLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="merchant-profile-details-form">
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
					<div class="col-md-6">
						<div class="form-group">
							<label>market</label>
							<select name="market" class="form-control">
								<option value="">...</option>
								@foreach($markets as $market)
								<option value="{{$market['id']}}" @if($vendor->market['market'] == $market['market']) selected="selected" @endif() >{{$market['market']}}</option>
								@endforeach()
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>company URL</label>
							<input type="text" name="url" class="form-control" value="{{$vendor->url}}">
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				
				@if($vendor->logo == true)<p><img src="{{asset('/uploads/'.$vendor->logo)}}" class="img-responsive currentLogo"></p>@endif()
				<legend>Upload/Change Your Logo</legend>
				<p>A square image works best!</p>
				<div id="proflogolist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
				<br />
				
				<div id="logoContainer">
				    <a id="profpickLogo" href="javascript:;" class="btn btn-default">Select Logo</a> 
				    <a id="profuploadLogo" href="javascript:;" class="btn btn-success">Upload</a>
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
