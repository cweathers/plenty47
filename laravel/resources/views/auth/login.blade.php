@extends('noSocialApp')

@section('content')

<section class="content white compTop">
	
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="sm-box">
					
					@if (count($errors) > 0)
					<div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
					</div>
				    @endif
					
					<form method="POST" action="/auth/login">
					    {!! csrf_field() !!}
					
					    <div class="form-group">
					        <label>Email</label>
					        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
					    </div>
					
					    <div class="form-group">
					        <label>Password</label>
					        <input type="password" name="password" id="password" class="form-control">
					    </div>
					
					    <div class="form-grouop">
					        <input type="checkbox" name="remember"> Remember Me
					    </div>
						
						<hr />
					    <div>
					        <button type="submit" class="btn btn-primary"><i class="fa fa-lock"></i> Login</button>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@stop