	<thead>
		<tr>
			<th>Thumbnail</th>
			<th>Title</th>
			<th>Tagline</th>
			<th>Created On</th>
			<th>Flash Deal</th>
			<th>Featured</th>
			<th>Vendor</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Thumbnail</th>
			<th>Title</th>
			<th>Tagline</th>
			<th>Created On</th>
			<th>Flash Deal</th>
			<th>Featured</th>
			<th>Vendor</th>
			<th>Actions</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach($deals as $deal)
		<tr>
			<td>
				@if($deal->squareImage)
				<img class="vendor-thumb" src="{{asset ('uploads/'.$deal->squareImage)}}">
				@else()
				<img class="vendor-thumb" src="{{asset ('assets/img/default-logo.jpg')}}">
				@endif()
			</td>
			<td>{{$deal->title}}</td>
			<td>{{$deal->tagline}}</td>
			<td>{{date('F j, Y', strtotime($deal->created_at))}}</td>
			<td>@if($deal->expirationDate) Yes @else() No @endif()</td>
			<td>
				@if($deal->featuredDeal == 1)
				<i class="fa fa-circle green"></i>
				@else()
				<i class="fa fa-circle red"></i>
				@endif()
			</td>
			<td>{{$deal->vendor->companyName}}</td>
			<td>
				<a href="/merchant/{{$deal->vendor->slug}}?deal={{$deal->id}}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-search"></i></a> <a href="#" class="btn btn-primary btn-sm admin-editDeal" data-id="{{$deal->id}}"><i class="fa fa-gear"></i></a> <a href="#" class="btn btn-danger btn-sm admin-deleteDeal" data-id="{{$deal->id}}"><i class="fa fa-times"></i></a>
			</td>
		</tr>
		@endforeach()
	</tbody>