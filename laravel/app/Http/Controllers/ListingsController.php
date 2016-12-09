<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Mail;
use Image;
use Carbon;
use Redirect;
use App\CardNumber;
use App\User;
use App\Address;
use App\Vip;
use App\Fundraiser;
use App\VendorRecommendation;
use App\VendorBookmark;
use App\Vendor;
use App\VendorDeal;
use App\Market;
use App\Categories;

class ListingsController extends Controller
{
    
    //Ajax filtering on the listings...
    public function filter(Request $request)
    {
	    
	    $market_id = $request->market;
	    $category_id = $request->category;
	    
	    $query = Vendor::query();

		if ($market_id != 'all') {
		    $query = $query->where('market_id', '=', $market_id);
		}
		
		if ($category_id != 'all') {
		    $query = $query->where('category', '=', $category_id);
		}
		
		// Get the results
		$vendors = $query->get();
		
		
		$data['deals'] = array();
		
		if(count($vendors) > 0) {
			
			$temp = array();
			
			foreach($vendors as $vendor) {
				array_push($temp, $vendor->id);
			}
			
			//Grab all the deals that have NO exp. date, or the exp. date is in the future (as to not show expired flash deals)
		    $today = date('Y-m-d H:i:s');
		    
		    $data['deals'] = VendorDeal::whereIn('vendor_id', $temp)->orderByRaw("RAND()")->where('expirationDate', null)->orWhere('expirationDate', '>=', $today)->with('vendor')->paginate(env('DEAL_NUMBER', 12));
			
			
		}
		
		return view('staticPages.partials.listings', $data)->render();
	    
    }
    
    public function search(Request $request) {
	    
	    $searchTerm = $request->searchTerm;
	   
	    $today = date('Y-m-d H:i:s');
	    
	    $q = $searchTerm;

	    $searchTerms = explode(' ', $q);
	
	    $query = VendorDeal::query();
	
	    foreach($searchTerms as $term)
	    {
	        $query->where('tagline', 'LIKE', '%'. $term .'%');
	    }
	
	    $data['searchResults'] = $query->where('expirationDate', null)->orWhere('expirationDate', '>=', $today)->with('vendor')->get();
	    
	    //Load the search results view...
	    return view('staticPages.partials.searchResults', $data)->render();

	    
    } 
    
    
}
