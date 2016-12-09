@extends('admin')
@section('content')

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />

@if(Session::has('success'))
<div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

	<a href="/admin/createCards" class="btn btn-success"><i class="fa fa-plus"></i> create new cards</a>
	<span class="clearfix"></span>
	
	<hr />
	
	<table class="display table table-striped table-rounded datatable" id="cards-table">
		@include('admin/cards/partials/cardsTable')
	</table>
@stop()