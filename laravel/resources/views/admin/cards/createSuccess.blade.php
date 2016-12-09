@extends('admin')
@section('content')

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />

<div class="alert alert-success">
	The cards have been successfully created.
</div>

<a href="{{asset ('/exports/'.Session::get('latestDownload'))}}" class="btn btn-success" style="margin-bottom:40px;"><i class="fa fa-cloud-download"></i> Download CSV</a>

<table class="table table-striped table-bordered">
	<tr>
		<td><strong>Card Number</strong></td>
		<td><strong>Fundraiser</strong></td>
	</tr>
	@foreach($cards as $card)
	<tr>
		<td>{{$card->number}}</td>
		<td>
			@if($card->fundraiser_id != NULL)
			{{$card->fundraiser->groupName}}
			@endif()
		</td>
	</tr>
	@endforeach()
</table>

@stop()