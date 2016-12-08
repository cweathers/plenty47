@extends('noSocialApp')

@section('content')

<section class="content white compTop">
	
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="sm-box">

					<form method="POST" action="/password/reset">
					    {!! csrf_field() !!}
					    <input type="hidden" name="token" value="{{ $token }}">
					
					    @if (count($errors) > 0)
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
					    @endif
					
					    <div class="form-group">
					        <label>Email</label>
					        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
					    </div>
					
					    <div class="form-group">
					        <label>Password</label>
					        <input type="password" name="password" class="form-control">
					    </div>
					
					    <div class="form-group">
					        <label>Confirm Password</label>
					        <input type="password" name="password_confirmation" class="form-control">
					    </div>
					
					    <div class="form-group">
					        <button type="submit" class="btn btn-primary">Reset Password</button>
					    </div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</section>

@stop()