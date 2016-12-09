	<thead>
		<tr>
			<th>Card Number</th>
			<th>Fundraising Group</th>
			<th>Card Owner</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Card Number</th>
			<th>Fundraising Group</th>
			<th>Card Owner</th>
			<th>Actions</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach($cards as $card)
		<tr>
			<td>@if(isset($card->user->email)) <span style="color:red;"> @endif() {{$card->number}} @if(isset($card->user->email)) </span> @endif()</td>
			<td>@if(isset($card->fundraiser->groupName)) {{$card->fundraiser->groupName}} @else no group @endif()</td>
			<td>@if(isset($card->user->email)) {{$card->user->firstName.' '.$card->user->lastName}} @else() unused @endif()</td>
			<td>
				<a href="/admin/deleteCard/{{$card->id}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
			</td>
		</tr>
		@endforeach()
	</tbody>