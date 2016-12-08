					@if(count($vendor->deals) > 0)
					<table id="vendor-deals" class="table table-bordered table-striped table-rounded">
						<tr>
							<td>Thumbnail</td>
							<td>Deal Title &amp; Tagline</td>
							<td>Created On</td>
							<td>Expiration Date</td>
							<td class="text-center">Actions</td>
						</tr>
						@foreach($vendor->deals as $deal)
						<tr>
							<td><img src="{{asset('uploads/'.$deal->squareImage)}}" class="deal-thumbnail"></td>
							<td>{{$deal->title}} {{$deal->tagline}}</td>
							<td>{{date('F j, Y', strtotime($deal->created_at))}}</td>
							<td>@if($deal->expirationDate !== NULL) {{date('m/d/Y', strtotime($deal->expirationDate))}} @endif</td>
							<td class="text-center"><a href="#" class="editDeal btn btn-primary" data-deal-id="{{$deal->id}}"><i class="fa fa-gear"></i></a> <a href="#" class="deleteDeal btn btn-danger" data-deal-id="{{$deal->id}}"><i class="fa fa-times"></i></a></td>
						</tr>
						@endforeach
					</table>
					<a href="#" class="btn btn-success newDeal" data-toggle="modal" data-target="#newDealModal"><i class="fa fa-plus"></i> Create New Deal</a>
					@else()
					<div class="alert alert-info">
						You have not added any deals yet. If you'd like to <strong><a href="#" class="alert-link newDeal" data-toggle="modal" data-target="#newDealModal">add a deal, click here.</a></strong>
					</div>
					@endif()