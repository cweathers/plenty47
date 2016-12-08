@extends('admin')
@section('content')

<!-- Edit Admin Modal -->
<div class="modal fade" id="editDealModal" tabindex="-1" role="dialog" aria-labelledby="editDealModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editDealModalLabel">Edit a Deal</h4>
      </div>
      <form id="edit-deal-form" method="POST" action="/admin/saveDealChanges">
	      
      </form>
    </div>
  </div>
</div>

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />

@if(Session::has('success'))
<div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

<table class="display table table-striped table-rounded datatable" id="deals-table">
	@include('admin/deals/partials/dealsTable')
</table>
@stop()