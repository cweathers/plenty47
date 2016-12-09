@extends('admin')
@section('content')

	@if(Session::has('success'))
	<div class="alert alert-success">{{Session::get('success')}}</div>
	@endif

	<form id="simple-page-form" method="POST" enctype="multipart/form-data" action="/content/save-advanced-page/{{$content->slug}}">
		<fieldset>
			<legend>Top Section / Hero</legend>
			<div class="form-group">
				@if($content->top_section_image)
				<img src="{{asset ('/contentUploads/'.$content->top_section_image)}}" class="prev-img img-responsive">
				@endif
				<label>Image</label>
				<input type="file" name="top_section_image">
			</div>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="top_section_heading" class="form-control" value="{{$content->top_section_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="top_section_subheading" class="form-control" value="{{$content->top_section_subheading}}">
			</div>
			<div class="form-group">
				<label>Text</label>
				<textarea name="top_section_text" class="form-control">{{$content->top_section_text}}</textarea>
			</div>
			<div class="form-group">
				<label>Button Text</label>
				<input type="text" name="top_section_button_text" class="form-control" value="{{$content->top_section_button_text}}">
			</div>
			<div class="form-group">
				<label>Button Link</label>
				<input type="text" name="top_section_button_link" class="form-control" value="{{$content->top_section_button_link}}">
			</div>
			<div class="form-group">
				<label>How it Works Button Text</label>
				<input type="text" name="top_section_button_text_2" class="form-control" value="{{$content->top_section_button_text_2}}">
			</div>
			<div class="form-group">
				<label>How it Works Vimeo ID</label>
				<input type="text" name="top_section_button_link_2" class="form-control" value="{{$content->top_section_button_link_2}}">
			</div>
		</fieldset>
		<fieldset>
			<legend>Blue Section</legend>
			<div class="form-group">
				<label>CTA Text</label>
				<input type="text" name="blue_section_heading" class="form-control" value="{{$content->blue_section_heading}}">
			</div>
		</fieldset>
		<fieldset>
			<legend>Quad Section: Left</legend>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="qs_left_heading" class="form-control" value="{{$content->qs_left_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="qs_left_subheading" class="form-control" value="{{$content->qs_left_subheading}}">
			</div>
			<div class="form-group">
				@if($content->qs_left_icon)
				<img src="{{asset ('/contentUploads/'.$content->qs_left_icon)}}" class="prev-img img-responsive">
				@endif
				<label>Icon</label>
				<input type="file" name="qs_left_icon">
			</div>
			<div class="form-group">
				@if($content->qs_left_image)
				<img src="{{asset ('/contentUploads/'.$content->qs_left_image)}}" class="prev-img img-responsive">
				@endif
				<label>Image</label>
				<input type="file" name="qs_left_image">
			</div>
		</fieldset>
		<fieldset>
			<legend>Quad Section: Left Middle</legend>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="qs_leftMiddle_heading" class="form-control" value="{{$content->qs_leftMiddle_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="qs_leftMiddle_subheading" class="form-control" value="{{$content->qs_leftMiddle_subheading}}">
			</div>
			<div class="form-group">
				@if($content->qs_leftMiddle_icon)
				<img src="{{asset ('/contentUploads/'.$content->qs_leftMiddle_icon)}}" class="prev-img img-responsive">
				@endif
				<label>Icon</label>
				<input type="file" name="qs_leftMiddle_icon">
			</div>
			<div class="form-group">
				@if($content->qs_leftMiddle_image)
				<img src="{{asset ('/contentUploads/'.$content->qs_leftMiddle_image)}}" class="prev-img img-responsive">
				@endif
				<label>Image</label>
				<input type="file" name="qs_leftMiddle_image">
			</div>
		</fieldset>
		<fieldset>
			<legend>Quad Section: Right Middle</legend>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="qs_rightMiddle_heading" class="form-control" value="{{$content->qs_rightMiddle_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="qs_rightMiddle_subheading" class="form-control" value="{{$content->qs_rightMiddle_subheading}}">
			</div>
			<div class="form-group">
				@if($content->qs_rightMiddle_icon)
				<img src="{{asset ('/contentUploads/'.$content->qs_rightMiddle_icon)}}" class="prev-img img-responsive">
				@endif
				<label>Icon</label>
				<input type="file" name="qs_rightMiddle_icon">
			</div>
			<div class="form-group">
				@if($content->qs_rightMiddle_image)
				<img src="{{asset ('/contentUploads/'.$content->qs_rightMiddle_image)}}" class="prev-img img-responsive">
				@endif
				<label>Image</label>
				<input type="file" name="qs_rightMiddle_image">
			</div>
		</fieldset>
		<fieldset>
			<legend>Quad Section: Right</legend>
			<div class="form-group">
				<label>Heading</label>
				<input type="text" name="qs_right_heading" class="form-control" value="{{$content->qs_right_heading}}">
			</div>
			<div class="form-group">
				<label>Sub Heading</label>
				<input type="text" name="qs_right_subheading" class="form-control" value="{{$content->qs_right_subheading}}">
			</div>
			<div class="form-group">
				@if($content->qs_right_icon)
				<img src="{{asset ('/contentUploads/'.$content->qs_right_icon)}}" class="prev-img img-responsive">
				@endif
				<label>Icon</label>
				<input type="file" name="qs_right_icon">
			</div>
			<div class="form-group">
				@if($content->qs_right_image)
				<img src="{{asset ('/contentUploads/'.$content->qs_right_image)}}" class="prev-img img-responsive">
				@endif
				<label>Image</label>
				<input type="file" name="qs_right_image">
			</div>
		</fieldset>
		<fieldset>
			<legend>Section : Below Quad Section</legend>
			<div class="form-group">
				<label>Do you want to show this section.</label>
				<select name="extra_section_active" class="form-control">
					<option value="1" @if(isset($content->extra_section_active) && $content->extra_section_active == 1) selected="selected" @endif() >yes</option>
					<option value="0" @if(isset($content->extra_section_active) && $content->extra_section_active == 0) selected="selected" @endif() >no</option>
				</select>
			</div>
			<div class="form-group">
				<label>Section BG Color</label>
				<select name="extra_section_bg_color" class="form-control">
					<option value="gray" @if(isset($content->extra_section_bg_color) && $content->extra_section_bg_color == 'gray') selected="selected" @endif() >gray</option>
					<option value="white" @if(isset($content->extra_section_bg_color) && $content->extra_section_bg_color == 'white') selected="selected" @endif() >white</option>
				</select>
			</div>
			<div class="form-group">
				<label>Left Content</label>
				<textarea name="extra_section_left" class="form-control">{{$content->extra_section_left}}</textarea>
			</div>
			<div class="form-group">
				<label>Right Content</label>
				<textarea name="extra_section_right" class="form-control">{{$content->extra_section_right}}</textarea>
			</div>
		</fieldset>
		<fieldset>
			<legend>Section : List Items</legend>
			<div class="form-group">
				<label>Do you want to show this section.</label>
				<select name="bottom_section_active" class="form-control">
					<option value="1" @if(isset($content->bottom_section_active) && $content->bottom_section_active == 1) selected="selected" @endif() >yes</option>
					<option value="0" @if(isset($content->bottom_section_active) && $content->bottom_section_active == 0) selected="selected" @endif() >no</option>
				</select>
			</div>
			<div class="form-group">
				<label>Section BG Color</label>
				<select name="bottom_section_bg_color" class="form-control">
					<option value="gray" @if(isset($content->bottom_section_bg_color) && $content->bottom_section_bg_color == 'gray') selected="selected" @endif() >gray</option>
					<option value="white" @if(isset($content->bottom_section_bg_color) && $content->bottom_section_bg_color == 'white') selected="selected" @endif() >white</option>
				</select>
			</div>
			<div class="form-group">
				@if($content->bottom_section_left_image)
				<img src="{{asset ('/contentUploads/'.$content->bottom_section_left_image)}}" class="prev-img img-responsive">
				@endif
				<label>Left Image</label>
				<input type="file" name="bottom_section_left_image">
			</div>
			<div class="form-group">
				<label>Left Content</label>
				<textarea name="bottom_section_left" class="form-control">{{$content->bottom_section_left}}</textarea>
			</div>
			<div class="form-group">
				<label>Right Side List Items</label>
				<table class="table table-striped table-bordered table-rounded" id="list-table">
					<tr>
						<td>Show Number?</td>
						<td>Content</td>
						<td>Actions</td>
					</tr>
					@foreach($lists as $list)
					<?php $un = uniqid(); ?>
					<tr id="row-{{$un}}" data-type="existing" data-id="{{$list->id}}">
						<td>
							<input type="checkbox" value="1" name="show_number" id="show-number-{{$un}}" data-un="{{$un}}" @if($list->show_number == 1) checked="checked" @endif() >
						</td>
						<td><textarea name="content" id="content-{{$un}}" data-un="{{$un}}" class="form-control">{{$list->content}}</textarea></td>
						<td><a href="#" class="removeListItem btn btn-danger btn-sm" data-un="{{$un}}" data-id="{{$list->id}}"><i class="fa fa-times"></i></a> <a href="#" class="saveListItem btn btn-success btn-sm" data-un="{{$un}}" data-id="{{$list->id}}" data-advanced-page-id="{{$list->advanced_page_id}}"><i class="fa fa-check"></i></a></td>
					</tr>
					@endforeach()
				</table>
				<hr />
				<a hred="#" class="addListItem btn btn-success" data-un="{{uniqid()}}" data-advanced-page-id="{{$content->id}}"><i class="fa fa-plus"></i> add list item</a>
			</div>
		</fieldset>
		<fieldset>
			<legend>Section : Below List Section</legend>
			<div class="form-group">
				<label>Do you want to show this section.</label>
				<select name="bottom_bg_section_active" class="form-control">
					<option value="1" @if(isset($content->extra_section_active) && $content->bottom_bg_section_active == 1) selected="selected" @endif() >yes</option>
					<option value="0" @if(isset($content->extra_section_active) && $content->bottom_bg_section_active == 0) selected="selected" @endif() >no</option>
				</select>
			</div>
			<div class="form-group">
				@if($content->bottom_bg_section_image)
				<img src="{{asset ('/contentUploads/'.$content->bottom_bg_section_image)}}" class="prev-img img-responsive">
				@endif
				<label>Section Background Image</label>
				<input type="file" name="bottom_bg_section_image">
			</div>
			<div class="form-group">
				<label>Left Content</label>
				<textarea name="bottom_bg_section_left" class="form-control">{{$content->bottom_bg_section_left}}</textarea>
			</div>
			<div class="form-group">
				<label>Right Content</label>
				<textarea name="bottom_bg_section_right" class="form-control">{{$content->bottom_bg_section_right}}</textarea>
			</div>
		</fieldset>
		<fieldset>
			<legend>Last Section</legend>
			<div class="form-group">
				<label>Do you want to show this section.</label>
				<select name="last_section_active" class="form-control">
					<option value="1" @if(isset($content->last_section_active) && $content->last_section_active == 1) selected="selected" @endif() >yes</option>
					<option value="0" @if(isset($content->last_section_active) && $content->last_section_active == 0) selected="selected" @endif() >no</option>
				</select>
			</div>
			<div class="form-group">
				<label>Left Content</label>
				<textarea name="last_section_left" class="form-control">{{$content->last_section_left}}</textarea>
			</div>
			<div class="form-group">
				<label>Right Content</label>
				<textarea name="last_section_right" class="form-control">{{$content->last_section_right}}</textarea>
			</div>
		</fieldset>
		<input type="hidden" name="_token" value="{{Session::get('_token')}}">
		<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> save changes</button>
	</form>
@stop