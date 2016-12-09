@extends('admin')
@section('content')

<!-- Edit Admin Modal -->
<div class="modal fade" id="editVendorModal" tabindex="-1" role="dialog" aria-labelledby="editVendorModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editVendorModalLabel">Edit a Vendor</h4>
      </div>
      <form id="edit-vendor-form">
	      
      </form>
    </div>
  </div>
</div>

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />
<table class="display table table-striped table-rounded datatable" id="vendor-table">
	@include('admin/vendors/partials/vendorTable')
</table>
@stop()