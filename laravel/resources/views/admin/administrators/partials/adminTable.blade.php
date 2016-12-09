	<thead>
		<tr>
			<th>Email</th>
			<th>Created On</th>
			<th>Super Admin</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Email</th>
			<th>Created On</th>
			<th>Super Admin</th>
			<th>Actions</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach($admins as $admin)
		<tr>
			<td>{{$admin->email}}</td>
			<td>{{date('F j Y', strtotime($admin->created_at))}}</td>
			<td>
				@if($admin->super_admin === 1)
				<i class="fa fa-circle green"></i>
				@else()
				<i class="fa fa-circle red"></i>
				@endif()
			</td>
			<td>
				<a href="#" class="btn btn-primary btn-sm editAdmin" data-id="{{$admin->id}}"><i class="fa fa-gear"></i></a> @if($admin->super_admin != 1) <a href="#" class="btn btn-danger btn-sm deleteAdmin" data-id="{{$admin->id}}"><i class="fa fa-times"></i></a> @endif()
			</td>
		</tr>
		@endforeach()
	</tbody>