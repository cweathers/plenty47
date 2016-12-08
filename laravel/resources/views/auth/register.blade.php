
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
	    <input type="hidden" name="userType" value="vendor">
        <button type="submit">Register</button>
    </div>
</form>