		<a href="#" class="merchant-editDetails" data-toggle="modal" data-target="#profileDetailsModal"><i class="fa fa-gear fa-2x"></i></a>
		@if($vendor->logo)
		<img src="{{asset ('uploads/'.$vendor->logo)}}" class="vendor-logo currentLogo">
		@else()
		<img src="{{asset ('assets/img/default-logo.jpg')}}" class="vendor-logo currentLogo">
		@endif()
		<span class="mh-name">{{$vendor->companyName}}</span>
		<ul class="mh-list">
			<li><strong>{{$category->category}}</strong></li>
			@if(count($vendor->hours) > 0)
			<li>
			<strong>HOURS:</strong><br />
			@foreach($vendor->hours as $hour)
			{{$hour->label}}, {{$hour->hours}}<br />
			@endforeach()
			</li>
			@endif()
			<li><strong>PHONE:</strong> {{$vendor->phone}}</li>
			<li>
			<strong>LOCATION: </strong><br />
			{{$vendor->address}} {{$vendor->address2}}<br />
			{{$vendor->city}}, {{$vendor->state}} {{$vendor->zipcode}}
			</li>
			@if($vendor->url)
			<li><strong>WEBSITE:</strong><br /><a href="{{$vendor->url}}" target="_blank">{{$vendor->url}}</a></li>
			@endif()
			<li>
				<a href="http://maps.google.com/?q={{$vendor->address}} {{$vendor->address2}} {{$vendor->city}}, {{$vendor->state}} {{$vendor->zipcode}}" class="mh-directions text-center" target="_blank"><img src="{{asset ('assets/img/icons/orange-pin.png')}}" width="16" height="21"><span>directions</span></a>
			</li>
		</ul>