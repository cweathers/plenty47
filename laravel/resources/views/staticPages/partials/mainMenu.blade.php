		<!-- Menu -->
	    <div class="menu-overlay">
		    <nav class="main-menu" id="main-nav">
			    <div class="mn-close">
				    <a href="#" class="close-menu"><img src="{{ asset('assets/img/icons/nav/menu-close.png') }}" alt="close menu" width="18" height="18"></a>
				    <ul class="mn-right visible-xs">
					    <li><a href="/search-deals" class="search-mobile"><img src="{{ asset('assets/img/icons/search.png') }}" alt="search site" width="18" height="18"></a></li>
				    </ul>
				    <span class="clearfix"></span>
			    </div>
			    <ul class="mn-bar">
				    <li><a href="/"><img src="{{asset ('assets/img/icons/nav/home.png') }}" alt="home" width="23" height="23"> home</a></li>
				    <li><a href="/vip-signup"><img src="{{asset ('assets/img/icons/nav/join.png') }}" alt="join" width="23" height="23"> become a vip (join)</a></li>
				    <li><a href="/search-deals"><img src="{{asset ('assets/img/icons/nav/deals.png') }}" alt="find deals" width="23" height="23"> find deals</a></li>
			    </ul>
			    <ul class="mn-bar">
				    <li><a href="/fundraisers"><img src="{{asset ('assets/img/icons/nav/fundraising.png') }}" alt="fundraising" width="23" height="23"> fundraising groups</a></li>
				    <li><a href="/vendors"><img src="{{asset ('assets/img/icons/nav/merchants.png') }}" alt="merchants" width="23" height="23"> merchants/vendors</a></li>
				    <li><a href="/trade-show-organizations"><img src="{{asset ('assets/img/icons/nav/tradeshows.png') }}" alt="tradeshows" width="23" height="23"> tradeshows</a></li>
			    </ul>
			    <ul class="mn-bar">
				    <li><a href="/contact"><img src="{{asset ('assets/img/icons/nav/contact.png') }}" alt="contact" width="23" height="23"> contact us</a></li>
				    <li><a href="/terms"><img src="{{asset ('assets/img/icons/nav/terms.png') }}" alt="terms" width="23" height="23"> terms</a></li>
			    </ul>
			    @if(isset($user))
				    @if($user->userType == 'vip')
				    <ul class="mn-bar last">
					    <li><a href="/my-account"><img src="{{asset ('assets/img/icons/nav/profile.png') }}" alt="profile" width="23" height="23"> my account</a></li>
					    <li><a href="/my-account"><img src="{{asset ('assets/img/icons/nav/bookmarks.png') }}" alt="bookmarks" width="23" height="23"> bookmarks</a></li>
					    <li><a href="/my-account/recommendations"><img src="{{asset ('assets/img/icons/nav/recommendations.png') }}" alt="recommendations" width="23" height="23"> recommendations</a></li>
				    </ul>
				    <div class="mn-user">
					    <span class="mnu-left">
					    	<a href="/auth/logout" class="logout-link">log out</a>
					    	<span class="mnu-name">{{$user->firstName.' '.$user->lastName}}</span>
					    </span>
					    <a href="/my-account" class="mnu-avatar">
						    @if($userDets->avatar)
				    		<img src="{{asset ('uploads/'.$userDets->avatar)}}" alt="{{$user->firstName.' '.$user->lastName}}">
				    		@else()
				    		<img src="{{asset ('assets/img/default-logo.jpg')}}" alt="{{$user->firstName.' '.$user->lastName}}">
				    		@endif()
					    </a>
					    <span class="clearfix"></span>
				    </div>
				    @elseif($user->userType == 'vendor')
				    <ul class="mn-bar last">
					    <li><a href="/merchant-dashboard"><img src="{{asset ('assets/img/icons/nav/profile.png') }}" alt="profile" width="23" height="23"> merchant dashboard</a></li>
				    </ul>
				    <div class="mn-user">
					    <span class="mnu-left">
					    	<a href="/auth/logout" class="logout-link">log out</a>
					    	<span class="mnu-name">{{$userDets->companyName}}</span>
					    </span>
					    <a href="/merchant-dashboard" class="mnu-avatar">
						   @if($userDets->logo)
							<img src="{{asset ('uploads/'.$userDets->logo)}}" alt="{{$userDets->companyName}}">
							@else()
							<img src="{{asset ('assets/img/default-logo.jpg')}}" alt="{{$userDets->companyName}}">
							@endif()
					    </a>
					    <span class="clearfix"></span>
				    </div>
				    @endif()
				@else()
				<ul class="mn-bar">
				    <li><a href="/auth/login"><img src="{{asset ('assets/img/icons/nav/profile.png') }}" alt="contact" width="23" height="23"> log in</a></li>
			    </ul>
				@endif()
		    </nav>
	    </div>
	    <!-- End Menu -->