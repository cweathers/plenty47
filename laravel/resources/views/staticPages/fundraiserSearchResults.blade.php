@extends('app')
@section('content')
	    
	    <!-- HP Search -->
	    <section class="hp-search compTop" style="background:url({{ asset ('assets/img/search-bg.png') }}) no-repeat center top;background-size: cover;">
		    <span class="search-heading">Search Fundraisers</span>
		    <span class="search-text">Search below to find plenty4/7 fundraisers. You can leave the search blank to list all fundraisers.</span>
		    
		    <div class="search-wrap">
			    <div class="row">
				    <div class="col-md-6 col-md-offset-3">
					    <form id="search-fundraiser-form" method="GET" action="/search-fundraisers">
						    <div class="input-group">
							  <span class="input-group-addon" id="basic-addon1"><img src="{{ asset ('assets/img/icons/search.png') }}" alt="search" width="25" height="25"></span>
							  <input type="text" class="form-control" name="fundraiser" placeholder="Search Fundraisers..." aria-describedby="basic-addon1">
							</div>
					    </form>
				    </div>
			    </div>
		    </div>
	    </section>
	    <!-- End HP Search -->
	    
	    <section class="fundraiser-listings">
		    @if(count($searchResults) > 0)
				    
		    @foreach($searchResults as $res)
		    <div class="col-sm-12 col-md-6 col-lg-3">
			    <div class="ind-listing">
				    <div class="ind-img-box">
					    <a href="/fundraiser/{{$res->slug}}">
						    @if($res->profileImage)
							    <img src="{{asset('/uploads/'.$res->profileImage)}}" alt="{{$res->groupName}}">
						    @else
							    <img src="{{asset('/assets/img/defaultProfile.png')}}" alt="{{$res->groupName}}">
						    @endif()
					    </a>
					    <div class="desc">
						    <span class="ind-name">{{$res->groupName}}</span>
					    </div>
					    <div class="fundraiser-more">
						    <div class="row">
							    <div class="col-md-3">
								    @if($res->logo)
									<img src="{{asset ('uploads/'.$res->logo)}}" class="fundraiser-logo currentLogo img-responsive">
									@else()
									<img src="{{asset ('assets/img/default-logo.jpg')}}" class="fundraiser-logo img-responsive">
									@endif()
							    </div>
							    <div class="col-md-9">
								    <div class="fr-more-left">
									    <p><strong>About Us</strong><br />
									    @if($res->aboutUs)
									    {{ str_limit($res->aboutUs, 140) }}
									    @else()
									    We are a plenty4/7 verified fundraising group.
									    @endif()
									    </p>
								    </div>
							    </div>
						    </div>
					    </div>
				    </div>
				    <div class="clearfix"></div>
				    <a href="/fundraiser/{{$res->slug}}" class="btn btn-lg blue btn-block fr-more-btn">view profile</a>
			    </div>
		    </div>
		    @endforeach()
		    
		    
		    <div class="clearfix"></div>
		    <div class="pages">
			    {!! $searchResults->render() !!}
		    </div>
		    
		    @else()
		    <div class="col-md-12">
			    <div class="alert alert-info">Sorry, there are no fundraisers to show.</div>
			    <div style="height:50px;"></div>
			    <div class="clearfix"></div>
		    </div>
		    @endif()
		    
	    </section>
	   
		

@stop()