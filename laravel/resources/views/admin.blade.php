<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ Session::get('_token') }}" />
    
    <title>Plenty4/7 Administration</title>

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
    
    <div class="admin-sb">
	    <div class="asb-logo">
		    <a href="/admin"><img src="{{asset ('assets/img/logo.png')}}" alt="Plenty4/7 Admin"></a>
	    </div>
	    <ul class="asb-menu">
		    <li><a href="/admin/administrators" class="@if($currentPage && $currentPage === 'admins') active @endif()">Administrators</a></li>
		    <li><a href="/admin/deals" class="@if($currentPage && $currentPage === 'deals') active @endif()">Deals</a></li>
		    <li><a href="/admin/vendors" class="@if($currentPage && $currentPage === 'vendors') active @endif()">Vendors</a></li>
		    <li><a href="/admin/fundraisers" class="@if($currentPage && $currentPage === 'fundraisers') active @endif()">Fundraising Groups</a></li>
		    <li><a href="/admin/vips" class="@if($currentPage && $currentPage === 'vips') active @endif()">VIP Members</a></li>
		    <li><a href="/admin/cards" class="@if($currentPage && $currentPage === 'cards') active @endif()">Card Numbers</a></li>
		    <li><a href="/admin/content-management" class="@if($currentPage && $currentPage === 'content') active @endif()">Content Management</a></li>
	    </ul>
    </div>
    <div class="admin-content">
		<div class="admin-header">
			<a href="#" class="toggleAdminSb"><i class="fa fa-bars"></i></a>
			<h1 class="hidden-xs">{{$pageTitle}}</h1>
			<a href="/auth/logout" class="adminLogout"><i class="fa fa-unlock-alt"></i></a>
			<span class="clearfix"></span>
		</div>
		<div class="admin-content-padder">
	    	@yield('content')
		</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <input type="hidden" name="siteUrl" id="siteUrl" value="{{ $app->make('url')->to('/') }}/">
    <script src="{{asset ('assets/js/min/app.min.js') }}"></script>
    @yield('footer')
  </body>
</html>