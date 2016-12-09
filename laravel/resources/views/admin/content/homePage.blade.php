@extends('admin')
@section('content')

	@if(Session::has('success'))
	<div class="alert alert-success">{{Session::get('success')}}</div>
	@endif

	<form id="home-page-form" method="POST" enctype="multipart/form-data" action="/content/save-home-page/{{$content->slug}}">
		<fieldset>
			<legend>Home Page Modal Video</legend>
			<div class="form-group">
				<label>vimeo id only</label>
				<input type="text" name="vimeo_id" class="form-control" value="{{$content->vimeo_id}}">
			</div>
		</fieldset>
		<fieldset>
			<legend>Home Page Slide One</legend>
			<div class="form-group">
				@if($content->slide_1_bg_image)
				<img src="{{asset ('/contentUploads/'.$content->slide_1_bg_image)}}" class="prev-img img-responsive">
				@endif
				<label>Background Image</label>
				<input type="file" name="slide_1_bg_image">
			</div>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="slide_1_heading" class="form-control" value="{{$content->slide_1_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="slide_1_subheading" class="form-control" value="{{$content->slide_1_subheading}}">
			</div>
			<div class="form-group">
				<label>Text</label>
				<textarea name="slide_1_text" class="form-control">{{$content->slide_1_text}}</textarea>
			</div>
			<div class="form-group">
				<label>Buttons HTML</label>
				<textarea name="slide_1_btns" class="form-control">{{$content->slide_1_btns}}</textarea>
			</div>
		</fieldset>
		<fieldset>
			<legend>Home Page Slide Two</legend>
			<div class="form-group">
				@if($content->slide_2_bg_image)
				<img src="{{asset ('/contentUploads/'.$content->slide_2_bg_image)}}" class="prev-img img-responsive">
				@endif
				<label>Background Image</label>
				<input type="file" name="slide_2_bg_image">
			</div>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="slide_2_heading" class="form-control" value="{{$content->slide_2_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="slide_2_subheading" class="form-control" value="{{$content->slide_2_subheading}}">
			</div>
			<div class="form-group">
				<label>Text</label>
				<textarea name="slide_2_text" class="form-control">{{$content->slide_2_text}}</textarea>
			</div>
			<div class="form-group">
				<label>Buttons HTML</label>
				<textarea name="slide_2_btns" class="form-control">{{$content->slide_2_btns}}</textarea>
			</div>
		</fieldset>
		<fieldset>
			<legend>Home Page Slide Three</legend>
			<div class="form-group">
				@if($content->slide_3_bg_image)
				<img src="{{asset ('/contentUploads/'.$content->slide_3_bg_image)}}" class="prev-img img-responsive">
				@endif
				<label>Background Image</label>
				<input type="file" name="slide_3_bg_image">
			</div>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="slide_3_heading" class="form-control" value="{{$content->slide_3_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="slide_3_subheading" class="form-control" value="{{$content->slide_3_subheading}}">
			</div>
			<div class="form-group">
				<label>Text</label>
				<textarea name="slide_3_text" class="form-control">{{$content->slide_3_text}}</textarea>
			</div>
			<div class="form-group">
				<label>Buttons HTML</label>
				<textarea name="slide_3_btns" class="form-control">{{$content->slide_3_btns}}</textarea>
			</div>
		</fieldset>
		<fieldset>
			<legend>Merchant Section</legend>
			<div class="form-group">
				@if($content->merchant_icon)
				<img src="{{asset ('/contentUploads/'.$content->merchant_icon)}}" class="prev-img img-responsive">
				@endif
				<label>Icon</label>
				<input type="file" name="merchant_icon">
			</div>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="merchant_heading" class="form-control" value="{{$content->merchant_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="merchant_subheading" class="form-control" value="{{$content->merchant_subheading}}">
			</div>
			<div class="form-group">
				<label>Text</label>
				<textarea name="merchant_text" class="form-control">{{$content->merchant_text}}</textarea>
			</div>
			<div class="form-group">
				<label>Button Text</label>
				<input type="text" name="merchant_button_text" class="form-control" value="{{$content->merchant_button_text}}">
			</div>
		</fieldset>
		<fieldset>
			<legend>Fundraiser Section</legend>
			<div class="form-group">
				@if($content->fundraiser_icon)
				<img src="{{asset ('/contentUploads/'.$content->fundraiser_icon)}}" class="prev-img img-responsive">
				@endif
				<label>Icon</label>
				<input type="file" name="fundraiser_icon">
			</div>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="fundraiser_heading" class="form-control" value="{{$content->fundraiser_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="fundraiser_subheading" class="form-control" value="{{$content->fundraiser_subheading}}">
			</div>
			<div class="form-group">
				<label>Text</label>
				<textarea name="fundraiser_text" class="form-control">{{$content->fundraiser_text}}</textarea>
			</div>
			<div class="form-group">
				<label>Button Text</label>
				<input type="text" name="fundraiser_button_text" class="form-control" value="{{$content->fundraiser_button_text}}">
			</div>
		</fieldset>
		<fieldset>
			<legend>Trade Show Section</legend>
			<div class="form-group">
				@if($content->tradeshow_icon)
				<img src="{{asset ('/contentUploads/'.$content->tradeshow_icon)}}" class="prev-img img-responsive">
				@endif
				<label>Icon</label>
				<input type="file" name="tradeshow_icon">
			</div>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="tradeshow_heading" class="form-control" value="{{$content->tradeshow_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="tradeshow_subheading" class="form-control" value="{{$content->tradeshow_subheading}}">
			</div>
			<div class="form-group">
				<label>Text</label>
				<textarea name="tradeshow_text" class="form-control">{{$content->tradeshow_text}}</textarea>
			</div>
			<div class="form-group">
				<label>Button Text</label>
				<input type="text" name="tradeshow_button_text" class="form-control" value="{{$content->tradeshow_button_text}}">
			</div>
		</fieldset>
		<input type="hidden" name="_token" value="{{Session::get('_token')}}">
		<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> save changes</button>
	</form>
@stop