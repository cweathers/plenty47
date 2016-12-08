<div id="login-overlay" class="custom-overlay"></div>
<div class="login-box">
	<div class="login-upper">
		<img class="login-logo" src="{{asset ('assets/img/orange-logo.png')}}" alt"login" width="149" height="53">
		<span class="login-heading">log in</span>
		<form id="login-form" method="POST" action="/auth/login">
			<div class="form-group">
				<input type="email" name="email" id="loginemail" class="form-control" placeholder="email...">
			</div>
			<div class="form-group">
				<input type="password" name="password" id="loginpassword" class="form-control" placeholder="password...">
			</div>
			<p><a href="/password/email" class="black">forgot password</a></p>
			<input type="hidden" name="_token" value="{{Session::get('_token')}}">
			<button type="submit" class="btn btn-lg orange">login</button>
		</form>
	</div>
	<div class="login-lower">
		<div class="ll-pad">
			<span>don't have an account?</span>
			<a href="/vip-signup" class="btn-outline btn">become a vip member</a>
		</div>
	</div>
</div>