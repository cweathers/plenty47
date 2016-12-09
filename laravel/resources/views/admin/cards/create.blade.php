@extends('admin')
@section('content')

<h1 class="visible-xs">{{$pageTitle}}</h1>
<hr class="visible-xs" />

@if(Session::has('success'))
<div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

<form id="create-cards-form" method="post" action="/admin/createCards">
	<div class="form-group">
		<label>How many cards do you want to create?</label>
		<input type="number" placeholder="100" class="form-control" name="qty">
	</div>
	<div class="form-group">
		<label>Do you want to associate these cards with a fundraising group. Note that the only benefit of this is for admin sorting, all cards can be purchased by any VIP.</label>
		<input type="text" placeholder="The Puppy Shelter" class="form-control" id="fundraiser_search">
		<input type="hidden" name="fundraiser_id" id="fundraiser_id" value="">
		<p class="help-block">Start typing a fundraising group name...</p>
	</div>
	<div class="form-group">
		<input type="hidden" name="_token" value="{{Session::get('_token')}}">
		<button type="submit" class="btn btn-success">create cards</button>
	</div>
</form>

@stop()