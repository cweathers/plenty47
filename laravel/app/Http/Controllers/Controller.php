<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use View;
use App\Vip;
use App\Fundraiser;
use App\Vendor;
use App\VendorRecommendation;
use App\VendorBookmark;
use App\SocialSettings;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct() {
        
        if(Auth::check()) {
	        $user = Auth::user();
	        
	        if($user->userType == 'vip') {
		        $userDets = Vip::where('user_id', $user->id)->firstOrFail();
		        //Grab recommendations...
		        $userRecs = VendorRecommendation::where('user_id', $user->id)->get();
		        //Grab bookmarks...
		        $userBookmarks = VendorBookmark::where('user_id', $user->id)->get();
		        
		        View::share ( 'userRecs', $userRecs );
		        
		        View::share ( 'userBookmarks', $userBookmarks );
		        
	        }elseif($user->userType == 'fundraiser') {
		        $userDets = Fundraiser::where('user_id', $user->id)->firstOrFail();
	        }elseif($user->userType == 'vendor') {
		        $userDets = Vendor::where('user_id', $user->id)->firstOrFail();
	        }elseif($user->userType == 'admin') {
		        $userDets = array();
	        }
	        
			View::share ( 'user', $user );
			View::share ( 'userDets', $userDets );
			
        }
        
        //Grab global settings...
        $socialSettings = SocialSettings::all();
        View::share('socialSettings', $socialSettings);

    }
    
}
