	<thead>
		<tr>
			<th>Thumbnail</th>
			<th>Company Name</th>
			<th>Signup Date</th>
			<th>Activated</th>
			<th>Deals</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Thumbnail</th>
			<th>Company Name</th>
			<th>Signup Date</th>
			<th>Activated</th>
			<th>Deals</th>
			<th>Actions</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach($vendors as $vendor)
		<tr>
			<td>
				@if($vendor->logo)
				<img class="vendor-thumb" src="{{asset ('uploads/'.$vendor->logo)}}">
				@else()
				<img class="vendor-thumb" src="{{asset ('assets/img/default-logo.jpg')}}">
				@endif()
			</td>
			<td>{{$vendor->companyName}}</td>
			<td>{{date('F j, Y', strtotime($vendor->created_at))}}</td>
			<td>
				@if($vendor->active == 1)
				<a href="#" class="setVendorStatus" data-id="{{$vendor->id}}" data-status="0"><i class="fa fa-circle green"></i></a>
				@else()
				<a href="#" class="setVendorStatus" data-id="{{$vendor->id}}" data-status="1"><i class="fa fa-circle red"></i></a>
				@endif()	
			</td>
			<td><a href="/admin/deals?vendor_id={{$vendor->id}}" class="btn btn-primary btn-sm">view deals</a></td>
			<td>
				<a href="/merchant/{{$vendor->slug}}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-search"></i></a> <a href="#" class="btn btn-primary btn-sm editVendor" data-id="{{$vendor->id}}"><i class="fa fa-gear"></i></a> <a href="#" class="btn btn-danger btn-sm deleteVendor" data-id="{{$vendor->id}}"><i class="fa fa-times"></i></a>
			</td>
		</tr>
		@endforeach()
	</tbody>