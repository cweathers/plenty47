	<thead>
		<tr>
			<th>Thumbnail</th>
			<th>Name</th>
			<th>Signup Date</th>
			<th>Salesperson</th>
			<th>Email</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Thumbnail</th>
			<th>Name</th>
			<th>Signup Date</th>
			<th>Salesperson</th>
			<th>Email</th>
			<th>Actions</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach($vips as $vip)
		<tr>
			<td>
				@if($vip->avatar)
				<img class="vendor-thumb" src="{{asset ('uploads/'.$vip->avatar)}}">
				@else()
				<img class="vendor-thumb" src="{{asset ('assets/img/default-logo.jpg')}}">
				@endif()
			</td>
			<td>{{$vip->user->firstName.' '.$vip->user->lastName}}</td>
			<td>{{date('F j, Y', strtotime($vip->created_at))}}</td>
			<td>@if(isset($vip->salesperson->firstName)) {{$vip->salesperson->firstName}} {{$vip->salesperson->lastName}} @else N/A @endif()</td>
			<td>{{$vip->user->email}}</td>
			<td>
				<a href="#" class="btn btn-primary btn-sm editVip" data-id="{{$vip->id}}"><i class="fa fa-gear"></i></a> <a href="#" class="btn btn-danger btn-sm deleteVip" data-id="{{$vip->id}}" onclick="return confirm('Are you sure you want to delete this vip?');"><i class="fa fa-times"></i></a>
			</td>
		</tr>
		@endforeach()
	</tbody>