@extends('app')
@section('content')

		@include('staticPages.partials.homeVideoModal')
	    
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