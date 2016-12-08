		@if(count($deals) > 0)
			    
	    @foreach($deals as $deal)
	    <div class="col-sm-12 col-md-6 col-lg-4">
		    <div class="ind-listing">
			    @if($deal->expirationDate !== NULL)
			    <div class="flash-deal">
				    <span>Flash Deal</span>
				    <?php
					$exp = new Carbon($deal->expirationDate);
					$exp = $exp->diffForHumans();
					?>
					Ends {{$exp}}
			    </div>
			    @endif()
			    <div class="ind-img-box">
				    <a href="/merchant/{{$deal->vendor->slug}}?deal={{$deal->id}}"><img src="{{ asset ('/uploads/'.$deal->squareImage) }}" alt="{{$deal->vendor->companyName}}"></a>
				    <div class="desc">
					    <span class="ind-name">{{$deal->vendor->companyName}}</span>
					    <span class="ind-city">{{$deal->vendor->city}}, {{$deal->vendor->state}}</span>
				    </div>
			    </div>
			    <a href="/merchant/{{$deal->vendor->slug}}?deal={{$deal->id}}" class="desc-link">
				    <span class="deal-tag">{{$deal->title}}</span>
					<span class="deal-subline">{{$deal->tagline}}</span>
			    </a>
			    <ul class="deal-list">
				    <li>
				    	<a target="_blank" href="http://maps.google.com/?q={{$deal->vendor->address}} {{$deal->vendor->address2}} {{$deal->vendor->city}}, {{$deal->vendor->state}} {{$deal->vendor->zipcode}}">
							<span>directions</span>
							<img src="{{ asset ('assets/img/icons/map-pin.png') }}" alt="directions" width="16" height="21">    
				    	</a>
				    </li>
				    @if(isset($user) && $user->userType == 'vip')
				    <li>
				    
				    	@if(!empty($userRecs))
			    		<?php $state = 0; ?>
						<?php $set_flag = 1; ?>
						@foreach($userRecs as $rec)
						@if($rec->vendor_id == $deal->vendor->id)
						<?php $state = 1; ?>
						<?php $set_flag = 0; ?>
						@endif()
						@endforeach()
						
						@if($set_flag == 1)
						<?php $state = 0 ; ?>
						@endif()
							
						@else()
						<?php $state = 0; ?>
						@endif()
				    
				    	<a href="#" class="recMerchant-frontend" data-vendor-id="{{$deal->vendor->id}}" data-user-id="{{$user->id}}" data-state="{{$state}}">
							<span>recommend it</span>
							@if(!empty($userRecs))
								<?php $set_flag = 1; ?>
								@foreach($userRecs as $recommendation)
								@if($recommendation->vendor_id == $deal->vendor->id)
								<i class="fa fa-check green-check"></i>
								<img src="{{ asset ('assets/img/icons/heart.png') }}" alt="recommend it" width="25" height="21" style="display:none;">
								<?php $set_flag = 0; ?>
								@endif()
								@endforeach()
								
								@if($set_flag == 1)
								<img src="{{ asset ('assets/img/icons/heart.png') }}" alt="recommend it" width="25" height="21">
								@endif()
								
							@else()
							<img src="{{ asset ('assets/img/icons/heart.png') }}" alt="recommend it" width="25" height="21">
							@endif()
							  
				    	</a>
				    </li>
				    <li>
				    	
				    	@if(!empty($userBookmarks))
			    		<?php $state = 0; ?>
						<?php $set_flag = 1; ?>
						@foreach($userBookmarks as $bookmark)
						@if($bookmark->vendor_id == $deal->vendor->id)
						<?php $state = 1; ?>
						<?php $set_flag = 0; ?>
						@endif()
						@endforeach()
						
						@if($set_flag == 1)
						<?php $state = 0 ; ?>
						@endif()
							
						@else()
						<?php $state = 0; ?>
						@endif()
				    
				    	<a href="#" class="bookmarkMerchant-frontend" data-vendor-id="{{$deal->vendor->id}}" data-user-id="{{$user->id}}" data-state="{{$state}}">
							<span>bookmark</span>
							@if(!empty($userBookmarks))
								<?php $set_flag = 1; ?>
								@foreach($userBookmarks as $bookmark)
								@if($bookmark->vendor_id == $deal->vendor->id)
								<i class="fa fa-check green-check"></i>
								<img src="{{ asset ('assets/img/icons/bookmark.png') }}" alt="bookmark" width="21" height="21" style="display:none;"> 
								<?php $set_flag = 0; ?>
								@endif()
								@endforeach()
								
								@if($set_flag == 1)
								<img src="{{ asset ('assets/img/icons/bookmark.png') }}" alt="bookmark" width="21" height="21"> 
								@endif()
								
							@else()
							<img src="{{ asset ('assets/img/icons/bookmark.png') }}" alt="bookmark" width="21" height="21"> 
							@endif()
							  
				    	</a>
				    </li>
				    @endif()
			    </ul>
			    <div class="clearfix"></div>
		    </div>
	    </div>
	    @endforeach()
	    
	    
	    <div class="clearfix"></div>
	    <div class="pages">
		    {!! $deals->render() !!}
	    
		    <!-- Pagination 
		    <div class="col-md-12">
			    <div class="pages">
				    <a href="#" class="page-prev"><img src="{{ asset ('assets/img/icons/arrow-left.png') }}" width="30" height="17"></a>
				    <nav>
					  <ul class="pagination">
					    <li><a href="#">1</a></li>
					    <li><a href="#">2</a></li>
					    <li><a href="#">3</a></li>
					    <li class="hidden-xs"><a href="#">4</a></li>
					    <li class="hidden-xs"><a href="#">5</a></li>
					  </ul>
					</nav>
				    <a href="#" class="page-next"><img src="{{ asset ('assets/img/icons/arrow-right.png') }}" width="30" height="17"></a>
				    <span class="clearfix"></span>
			    </div>
		    </div>
		    -->
	    </div>
	    
	    @else()
	    <div class="col-md-12">
		    <div class="alert alert-info">Sorry, there are no deals to show.</div>
	    </div>
	    @endif()