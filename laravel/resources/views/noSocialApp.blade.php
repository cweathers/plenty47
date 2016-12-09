<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ Session::get('_token') }}" />
    
    <title>@if(isset($title)) {{ $title }} @else Plenty4/7 @endif</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!-- Wrapper -->
    <div class="wrapper">
	    
	    @include('staticPages/partials/loginModal')
	    
	    @include('staticPages/partials/mainMenu')
	    
	    <!-- Header -->
	    <header>
		    <a href="#" class="menu-link">
			    <span class="menu-icon">
				    <span class="top"></span>
				    <span class="mid"></span>
				    <span class="bot"></span>
			    </span>
			    <span class="menu-text hidden-xs">menu</span>
		    </a>
		    <a href="/" class="logo"><img src="{{asset ('assets/img/logo.png') }}" width="126" height="40"></a>
		    <ul class="menu-right hidden-xs">
			    <li><a href="/search-deals" class="search-site"><img src="{{asset ('assets/img/icons/search.png') }}" alt="search site" width="23" height="23"></a></li>
			    @if(isset($user))
			    	@if($user->userType == 'vip')
			    	
			    	<li>
			    		<a href="/my-account" class="header-avatar">
				    		@if($userDets->avatar)
				    		<img src="{{asset ('uploads/'.$userDets->avatar)}}" alt="{{$user->firstName.' '.$user->lastName}}">
				    		@else()
				    		<img src="{{asset ('assets/img/default-logo.jpg')}}" alt="{{$user->firstName.' '.$user->lastName}}">
				    		@endif()
			    		</a>
			    	</li>
			    	
			    	@elseif($user->userType == 'vendor')
			    	
			    	<li>
			    		<a href="/merchant-dashboard" class="header-avatar">
				    		@if($userDets->logo)
				    		<img src="{{asset ('uploads/'.$userDets->logo)}}" alt="">
				    		@else()
				    		<img src="{{asset ('assets/img/default-logo.jpg')}}" alt="">
				    		@endif()
			    		</a>
			    	</li>
			    	
			    	@elseif($user->userType == 'fundraiser')
			    	
			    	<li>
			    		<a href="/fundraiser-dashboard" class="header-avatar">
				    		@if($userDets->logo)
				    		<img src="{{asset ('uploads/'.$userDets->logo)}}" alt="">
				    		@else()
				    		<img src="{{asset ('assets/img/default-logo.jpg')}}" alt="">
				    		@endif()
			    		</a>
			    	</li>
			    	
			    	@endif()
			    @else()
			    <li><a href="#" class="login-btn loginModal">log in</a></li>
			    <li><a href="/vip-signup" class="join-btn">join now</a></li>
			    @endif()
		    </ul>
		    <span class="clearfix"></span>
	    </header>
	    <!-- End Header -->
	    
	    @yield('content')
	    
	    <!-- Footer -->
	    <footer>
		   <div class="footer-top">
			   <div class="row">
				   <div class="col-md-6">
					    <div class="ft-left">
						    <ul class="ft-menu">
							    <li><a href="/about-us">ABOUT</a></li>
								<li><a href="/search-deals">DEALS</a></li>
								<li><a href="/terms">TERMS</a></li>
								<li><a href="/legal">LEGAL STUFF</a></li>
								<li><a href="/vip-signup">JOIN US</a></li>
								<li><a href="/contact">CONTACT</a></li>
						    </ul>
					    </div>
				   </div>
				   <div class="col-md-3">
					   <div class="ft-pad">
						   <form id="search-fundraiser-form" method="GET" action="/search-fundraisers">
							   <div class="input-group">
								  <input type="text" id="fundraiserSearch" name="fundraiser" class="form-control" placeholder="Fundraiser..." aria-describedby="sizing-addon2">
								  <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-search"></i></span>
								</div>
						   </form>
					   </div>
				   </div>
				   <div class="col-md-3">
					   <div class="ft-pad">
					   		<img src="{{asset ('assets/img/logo-gray.png') }}" alt="plenty4/7" class="img-responsive">
					   </div>
				   </div>
			   </div>
		   </div> 
		   <div class="footer-bottom">
			   <span class="fb-left">&copy; plenty4/7 <?php echo date('Y'); ?></span>
			   <span class="fb-right"><a href="http://liftcreations.com">a LIFT creation</a></span>
			   <span class="clearfix"></span>
		   </div>
	    </footer>
	    <!-- End Footer -->
	    
    </div>
    <!-- End Wrapper -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <input type="hidden" name="siteUrl" id="siteUrl" value="{{ $app->make('url')->to('/') }}/">
    @yield('loadScripts')
    <script src="{{asset ('assets/js/min/app.min.js') }}"></script>
    @yield('footer')
  </body>
</html>