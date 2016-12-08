@extends('admin')
@section('content')

<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addAdminModalLabel">Add an Administrator</h4>
      </div>
      <form id="add-admin-form">
	      <div class="modal-body">
		        <div class="form-group">
			        <label>Administrator's Email</label>
			        <input type="email" name="email" id="email" class="form-control">
		        </div>
		        <div class="form-group">
			        <label>Password</label>
			        <input type="password" id="password" name="password" class="form-control">
		        </div>
		        <div class="form-group">
			        <label>Confirm Password</label>
			        <input type="password" name="passwordConfirm" class="form-control">
		        </div>
		        <div class="form-group">
			        <label>Send Administrator Their Account Information</label>
			        <ul class="list-inline">
			        	<li><input type="radio" name="sendInfo" value="1"> yes, send them their email and password</li>
			        	<li><input type="radio" name="sendInfo" value="0" checked="checked"> no, I will send it later</li>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::get('_token') }}">
		        <input type="hidden" name="userType" value="admin">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary submitForm">Save</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Admin Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editAdminModalLabel">Edit an Administrator</h4>
      </div>
      <form id="edit-admin-form">
	      
      </form>
    </div>
  </div>
</div>

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />
<a href="#" class="btn btn-success" data-toggle="modal" data-target="#addAdminModal"><i class="fa fa-plus"></i> add admin</a>
<hr />
<table class="display table table-striped table-rounded datatable" id="admin-table">
	@include('admin/administrators/partials/adminTable')
</table>
@stop()