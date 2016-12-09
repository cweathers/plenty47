<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="csrf-token" content="{{ Session::get('_token') }}" />-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="assets/img/icons/favicon.png" type="image/x-icon" />
    <title>@if(isset($title)) {{ $title }} @else Plenty4/7 @endif</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
   <!-- MailMunch for http://www.plenty47.com/ -->
   <!-- Paste this code right before the </head> tag on every page of your site. -->
   <script src="//a.mailmunch.co/app/v1/site.js" id="mailmunch-script" data-mailmunch-site-id="208914" async="async"></script>
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
						    <ul class="social">
						    	@if(isset($title))
							    @foreach($socialSettings as $soc)
							    <li><a href="{{$soc->link}}" target="_blank"><i class="fa {{$soc->icon}}"></i></a></li>
							    @endforeach()
							    @endif()
						    </ul>
					    </div>
				   </div>
				   <div class="col-md-3">
					   <div class="ft-pad">
						   <form id="search-fundraiser-form" method="GET" action="/search-fundraisers">
							   <div class="input-group">
								  <input type="text" id="fundraiserSearch" name="fundraiser" class="form-control" placeholder="Fundraiser Lookup..." aria-describedby="sizing-addon2">
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
			   <span class="fb-right"><a href="http://weathersmedia.com">Weathers Media Group</a></span>
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

<!-- GOOGLE ANALYTICS TRACKING CODE (DEVELOPMENT) -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-11534566-11', 'auto');
  ga('send', 'pageview');

</script>
<!-- END GooGLE ANALyTICS DEVElOpMENT CodE -->

<!-- GOOGLE ANALYTICS TRACKING CODE (PRODUCTION)
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-11534566-12', 'auto');
  ga('send', 'pageview');

</script>
-->
  </body>
</html>
