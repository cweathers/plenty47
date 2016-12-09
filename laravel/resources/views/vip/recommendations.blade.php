@extends('app')

@section('content')

@include('vip.partials.profileHero')

<section class="content white profileDets">
	<div class="row">
		<div class="col-md-4 col-lg-3">
			@include('vip.partials.sidebar')
		</div>
		<div class="col-md-8 col-lg-9">
			<div class="vip-padder">
				<div class="listings profile">
				    <div class="row">
					    @if(count($recommendedVendors) > 0)
						    @foreach($recommendedVendors as $rec)
						    <div class="col-sm-12 col-md-6 col-lg-4">
							    <div class="ind-listing">
								    <div class="ind-img-box">
									    <a href="/merchant/{{$rec->slug}}">
										    <?php
											if($rec->profileImage) {
												$profileImage = asset('/uploads/'.$rec->profileImage);
											}else {
												$profileImage = asset('/assets/img/defaultProfile.png');
											}
											
											?>
										    <img src="{{ $profileImage }}" alt="$rec->companyName">
										</a>
									    <div class="desc">
										    <span class="ind-name">{{$rec->companyName}}</span>
										    <span class="ind-city">{{$rec->market->market}}</span>
									    </div>
								    </div>
								    @if(count($rec->deals) > 0)
								    <a href="/merchant/{{$rec->slug}}" class="desc-link">
									    <span class="deal-tag">{{$rec->deals[0]->title}}</span>
										<span class="deal-subline">{{$rec->deals[0]->tagline}}</span>
								    </a>
								    @endif()
								    <div class="clearfix"></div>
							    </div>
						    </div>
						    @endforeach()
						@else()
						<div class="alert alert-info">You have not recommended any vendors yet!</div>
						@endif()
				    </div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>

@stop
