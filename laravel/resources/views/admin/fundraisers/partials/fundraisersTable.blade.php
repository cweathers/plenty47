	<thead>
		<tr>
			<th>Thumbnail</th>
			<th>Group Name</th>
			<th>Joined On</th>
			<th>Activated</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Thumbnail</th>
			<th>Group Name</th>
			<th>Joined On</th>
			<th>Activated</th>
			<th>Actions</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach($fundraisers as $f)
		<tr>
			<td>
				@if($f->logo)
				<img class="vendor-thumb" src="{{asset ('uploads/'.$f->logo)}}">
				@else()
				<img class="vendor-thumb" src="{{asset ('assets/img/default-logo.jpg')}}">
				@endif()
			</td>
			<td>{{$f->groupName}}</td>
			<td>{{date('F j, Y', strtotime($f->created_at))}}</td>
			<td>
				@if($f->active == 0)
				<a href="/admin/fundraiserStatus/{{$f->id}}/1"><i class="fa fa-circle red"></i></a>
				@else()
				<a href="/admin/fundraiserStatus/{{$f->id}}/0"><i class="fa fa-circle green"></i></a>
				@endif()
			</td>
			<td>
				<a href="/fundraiser/{{$f->slug}}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-search"></i></a> <a href="#" class="btn btn-primary btn-sm admin-editFundraiser" data-id="{{$f->id}}"><i class="fa fa-gear"></i></a> <a href="#" class="btn btn-danger btn-sm admin-deleteFundraiser" data-id="{{$f->id}}"><i class="fa fa-times"></i></a>
			</td>
		</tr>
		@endforeach()
	</tbody>