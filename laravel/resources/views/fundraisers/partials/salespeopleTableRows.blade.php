@foreach($fundraiser->salespeople as $person)
<tr>
	<td>{{$person->firstName.' '.$person->lastName}}</td>
	<td>{{date('F j Y', strtotime($person->created_at))}}</td>
	<td><a href="/fundraiser/delete-salesperson/{{$person->id}}" class="delete-salesperson btn btn-sm btn-danger" data-id="{{$person->id}}" onclick="return confirm('are you sure you want to delete this salesperson?');"><i class="fa fa-times"></i></a></td>
</tr>
@endforeach()