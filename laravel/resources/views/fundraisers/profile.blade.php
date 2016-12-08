@extends('app')

@section('content')


@if($fundraiser->active == 0)

<section class="compTop content pad100 white">
	<div class="alert alert-info">We take quality control VERY seriously. All of our fundraisers go through an activation process to ensure quality and genuine profile details. This fundraising group is not yet verified, please check back often.</div>
</section>

@else()

@include('fundraisers.partials.hero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-4 col-lg-3">
			<div class="profile-sb">
				<div class="psb-sect">
					<span class="psb-left">Invite Supporters</span>
					<span class="psb-right text-left">
						<p class="padBoth">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sem arcu, interdum id hendrerit in, egestas a lacus.</p>
						@if(count($fundraiser->salespeople) > 0)
						<form id="generate-link-form">
							<div class="form-group">
								<select name="salespeople" id="salespeople" class="form-control">
									<option value="">choose salesperson...</option>
									@foreach($fundraiser->salespeople as $person)
									<option value="{{$person->id}}">{{$person->firstName.' '.$person->lastName}}</option>
									@endforeach()
								</select>
								<input type="hidden" id="salespersonFRID" value="{{$fundraiser->id}}">
							</div>
						</form>
						@else()
						<div class="alert alert-info">
							We have not added any salespeople yet.
						</div>
						@endif()
					</span>
					<span class="clearfix"></span>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-lg-9">
			<div class="dealDets">
				
				<div class="deal-section">
					<span class="ds-heading">About Us</span>
					<span class="ds-line"></span>
					{{$fundraiser->aboutUs}}
				</div>
				
				<div class="deal-section">
					<span class="ds-heading">Raising Funds For</span>
					<span class="ds-line"></span>
					{{$fundraiser->ourCause}}
				</div>
				
				@if($fundraiser->videoLink)
				<div class="deal-section">
					<span class="ds-heading">Video</span>
					<span class="ds-line"></span>
					<div id="currentVideo">
						@include('fundraisers.partials.video')
					</div>
				</div>
				@endif()
				
				@if(count($fundraiser->facts) > 0)
				<div class="deal-section">
					<span class="ds-heading">Fun Facts About {{$fundraiser->groupName}}</span>
					<ul class="fact-list">
						@foreach($fundraiser->facts as $fact)
						<li>{{$fact->fact}}</li>
						@endforeach()
					</ul>
				</div>
				@endif()
				
				@if(count($fundraiser->photos) > 0)
				<div class="deal-section">
					
					<span class="ds-heading">Photos</span>
					<span class="ds-line"></span>
					<ul class="merchant-photos">
						@foreach($fundraiser->photos as $photo)
						<li>
							<a class="fancybox" rel="group" href="{{asset ('/uploads/'.$photo->photo)}}"><img src="{{asset ('/uploads/'.$photo->photo)}}" alt=""></a>
						</li>
						@endforeach()
					</ul>
				</div>
				@endif()
				
			</div>
		</div>
	</div>
</section>

<section class="vendorCta gray">
	<span>Support us With the Purchase of a VIP Card</span> <a href="/vip-signup?fundraiser={{$fundraiser->id}}" class="">sign up</a>
</section>

@endif()

@stop
