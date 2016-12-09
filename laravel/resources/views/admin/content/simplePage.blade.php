@extends('admin')
@section('content')

	@if(Session::has('success'))
	<div class="alert alert-success">{{Session::get('success')}}</div>
	@endif

	<form id="simple-page-form" method="POST" action="/manage-page/{{$content->slug}}">
		<fieldset>
			<legend>Edit Page: {{$content->heading}}</legend>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="heading" class="form-control" value="{{$content->heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="subheading" class="form-control" value="{{$content->subheading}}">
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea class="form-control tinymce" name="content">{!! $content->content !!}</textarea>
			</div>
		</fieldset>
		<input type="hidden" name="_token" value="{{Session::get('_token')}}">
		<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> save changes</button>
	</form>
@stop