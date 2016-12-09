@extends('app')
@section('content')

		@include('staticPages.partials.homeVideoModal')

		@include('staticPages.partials.slider')
		
		<!-- Homepage Tri Section -->
	    <section class="nopad white">
			<div class="col-md-4">
				<div class="row">
					<div class="tc">
						<span class="tc-small">{{$content->merchant_heading}}</span>
						<span class="tc-lg">{{$content->merchant_subheading}}</span>
						<span class="tc-text">{{$content->merchant_text}}</span>
						<img src="{{ asset ('/contentUploads/'.$content->merchant_icon) }}" alt="merchants" class="pull-right" width="60" height="60">
						<a href="/vendors" class="btn orange">{{$content->merchant_button_text}}</a>
						<span class="clearfix"></span>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="tc gray">
						<span class="tc-small">{{$content->fundraiser_heading}}</span>
						<span class="tc-lg">{{$content->fundraiser_subheading}}</span>
						<span class="tc-text">{{$content->fundraiser_text}}</span>
						<img src="{{ asset ('/contentUploads/'.$content->fundraiser_icon) }}" alt="merchants" class="pull-right" width="60" height="60">
						<a href="/fundraisers" class="btn orange">{{$content->fundraiser_button_text}}</a>
						<span class="clearfix"></span>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="tc">
						<span class="tc-small">{{$content->tradeshow_heading}}</span>
						<span class="tc-lg">{{$content->tradeshow_subheading}}</span>
						<span class="tc-text">{{$content->tradeshow_text}}</span>
						<img src="{{ asset ('/contentUploads/'.$content->tradeshow_icon) }}" alt="merchants" class="pull-right" width="60" height="60">
						<a href="/trade-show-organizations" class="btn orange">{{$content->tradeshow_button_text}}</a>
						<span class="clearfix"></span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
	    </section>
	    <!-- End Homepage Tri Section -->
	    
	    @include('staticPages.partials.searchSection')
	   
		<!-- Listings -->
	    <section class="listings">
		    <div class="row">
			    <div class="col-md-4">
				    @include('staticPages.partials.listingFilters')
			    </div>
			    <div class="col-md-8">
				    <div class="listings">
					    <div class="row">
						    <div id="listings-loader">
							    @include('staticPages.partials.listings')
						    </div>
					    </div>
				    </div>
				</div>
		    </div>
		    
	    </section>
	    <!-- End Listings -->

@stop()