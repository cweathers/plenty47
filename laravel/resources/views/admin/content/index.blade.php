@extends('admin')
@section('content')

	<h1>Social Network Settings</h1>
	<div class="alert alert-info">P4/7 Uses font awesome for social icons. You can use anything in the font-awesome library here. <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Click here to view the available icons.</a></div>
	<table class="table table-striped table-rounded table-bordered" id="settings-table">
		<tr>
			<th>Icon</th>
			<th>Link</th>
			<th>Action</th>
		</tr>
		@foreach($socialSettings as $ss)
		<?php $un = uniqid(); ?>
		<tr id="row-{{$un}}" data-type="existing" data-setting-id="{{$ss->id}}">
			<td><input type="text" id="icon-{{$un}}" class="form-control" value="{{$ss->icon}}"></td>
			<td><input type="text" id="link-{{$un}}" class="form-control" value="{{$ss->link}}"></td>
			<td>
				<a href="#" class="saveSocialSetting btn btn-success btn-sm" data-un="{{$un}}"><i class="fa fa-check"></i></a> <a href="#" class="deleteSocialSetting btn btn-sm btn-danger" data-un="{{$un}}"><i class="fa fa-times"></i></a>
			</td>
		</tr>
		@endforeach
	</table>
	<a href="#" class="addSocialSetting btn btn-primary" data-un="<?php echo uniqid(); ?>"><i class="fa fa-plus"></i> add social network</a>
	
	<hr />

	<h1>Content Page Administration</h1>
	<table class="table table-striped table-rounded table-bordered" id="content-table">
		<tr>
			<th>Page Name</th>
			<th>Preview</th>
			<th>Actions</th>
		</tr>
		<tr>
			<td>Home Page</td>
			<td><a href="/" target="_blank">preview</a></td>
			<td><a href="/manage-page/home" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i></a></td>
		</tr>
		<tr>
			<td>Vendors</td>
			<td><a href="/vendors" target="_blank">preview</a></td>
			<td><a href="/manage-page/vendors" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i></a></td>
		</tr>
		<tr>
			<td>Fundraisers</td>
			<td><a href="/fundraisers" target="_blank">preview</a></td>
			<td><a href="/manage-page/fundraisers" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i></a></td>
		</tr>
		<tr>
			<td>Trade Show Organizations</td>
			<td><a href="/trade-show-organizations" target="_blank">preview</a></td>
			<td><a href="/manage-page/trade-show-organizations" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i></a></td>
		</tr>
		<tr>
			<td>About Us</td>
			<td><a href="/about-us" target="_blank">preview</a></td>
			<td><a href="/manage-page/about-us" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i></a></td>
		</tr>
		<tr>
			<td>Terms</td>
			<td><a href="/terms" target="_blank">preview</a></td>
			<td><a href="/manage-page/terms" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i></a></td>
		</tr>
		<tr>
			<td>Legal</td>
			<td><a href="/legal" target="_blank">preview</a></td>
			<td><a href="/manage-page/legal" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i></a></td>
		</tr>
	</table>
@stop