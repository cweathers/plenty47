<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Session;
use App\SocialSettings;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        
        $data['socialSettings'] = SocialSettings::all();
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'userType' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'userType' => $data['userType']
        ]);
    }
    
    protected function authenticated()
    {
	    
	    $user = Auth::user();

        
	    if($user->userType == 'vip') {
		    
		    //Check if the user is subscribed or not...
		    if (!$user->subscribed()) {
			    
			    Session::put('suspended', true);
			    
			    return redirect('/my-account/suspended');
			    
			}else {
				return redirect('/my-account');
			}
		    
        }elseif($user->userType == 'vendor') {
	        return redirect('/merchant-dashboard');
        }elseif($user->userType == 'fundraiser') {
	        return redirect('/fundraiser-dashboard'); 
        }elseif($user->userType == 'admin') {
	        return redirect('/admin');
        }

        return redirect('/');
        
        
    }
}
