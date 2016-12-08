@extends('admin')
@section('content')

<!-- Edit Fundraiser Modal -->
<div class="modal fade" id="editFundraiserModal" tabindex="-1" role="dialog" aria-labelledby="editFundraiserModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editFundraiserModalLabel">Edit a Fundraising Group</h4>
      </div>
      <form id="edit-fundraiser-form" method="POST" action="/admin/saveFundraiserChanges">
	      
      </form>
    </div>
  </div>
</div>

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />

@if(Session::has('success'))
<div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

<table class="display table table-striped table-rounded datatable" id="fundraiser-table">
	@include('admin/fundraisers/partials/fundraisersTable')
</table>
@stop()