			<div class="modal-body">
		        <div class="form-group">
			        <label>Administrator's Email</label>
			        <input type="email" name="email" id="email" class="form-control" value="{{$admin->email}}">
		        </div>
		        <div class="form-group">
			        <label>Change Password? (leave blank to keep the same)</label>
			        <input type="password" id="password" name="password" class="form-control">
		        </div>
		        <div class="form-group">
			        <label>Send Administrator Their Updated Account Information</label>
			        <ul class="list-inline">
			        	<li><input type="radio" name="sendInfo" value="1"> yes, send them their email and password</li>
			        	<li><input type="radio" name="sendInfo" value="0" checked="checked"> no, I will send it later</li>
		        </div>
		        <input type="hidden" name="user_id" value="{{$admin->id}}">
		        <input type="hidden" name="_token" value="{{ Session::get('_token') }}">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary submitForm">Save</button>
	      </div>