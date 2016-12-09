@extends('app')
@section('content')
<div class="page-template compTop">
	<section class="pt-header">
		<h1>{{$content->heading}}</h1>
		@if($content->subheading)
		<h2>{{$content->subheading}}</h2>
		@endif()
	</section>
	<section class="pt-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					{!! $content->content !!}
				</div>
			</div>
		</div>
	</section>
@stop()