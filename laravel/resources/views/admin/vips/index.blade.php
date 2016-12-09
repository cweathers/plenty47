@extends('admin')
@section('content')

<!-- Edit Admin Modal -->
<div class="modal fade" id="editVipModal" tabindex="-1" role="dialog" aria-labelledby="editVipModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editVipModalLabel">VIP Details</h4>
      </div>
      <form id="edit-vip-form">
	      
      </form>
    </div>
  </div>
</div>

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />
<table class="display table table-striped table-rounded datatable" id="vip-table">
	@include('admin.vips.partials.vipTable')
</table>
@stop()