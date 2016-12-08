						<li>
							<a href="#" data-toggle="modal" data-target="#addPhotoModal"><img src="{{asset ('/assets/img/addPhoto.jpg')}}"></a>
						</li>
						@foreach($vendor->photos as $photo)
						<li>
							<a class="merchant-deletePhoto btn btn-danger" data-id="{{ $photo->id }}"><i class="fa fa-times"></i></a>
							<a class="fancybox" rel="group" href="{{asset ('/uploads/'.$photo->photo)}}"><img src="{{asset ('/uploads/'.$photo->photo)}}" alt=""></a>
						</li>
						@endforeach()
						