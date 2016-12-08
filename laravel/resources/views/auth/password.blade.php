@extends('noSocialApp')

@section('content')

<section class="content white compTop">
	
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="sm-box">

					<form method="POST" action="/password/email">
					    {!! csrf_field() !!}
					
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
					        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
					    </div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	
</section>

@stop()