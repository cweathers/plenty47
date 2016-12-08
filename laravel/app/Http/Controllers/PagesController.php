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
use App\SimplePage;
use App\AdvancedPage;
use App\AdvancedContentList;
use App\HomePageContent;

class PagesController extends Controller
{
    
    /**
    * Home page
    */
    public function index()
    {
	    
	    if(Auth::check()) {
		    
		    $user = Auth::user();
		    
		    if($user->userType == 'vip') {
		    
			    //Grab recommendations...
		        $data['userRecs'] = VendorRecommendation::where('user_id', $user->id)->get();
		        //Grab bookmarks...
		        $data['userBookmarks'] = VendorBookmark::where('user_id', $user->id)->get();
		        
		    }
	    }
	    
	    //Grab all the deals that have NO exp. date, or the exp. date is in the future (as to not show expired flash deals)
	    $today = date('Y-m-d H:i:s');
	    
	    $data['deals'] = VendorDeal::where('expirationDate', null)->orWhere('expirationDate', '>=', $today)->orderByRaw("RAND()")->with('vendor')->paginate(env('DEAL_NUMBER', 12));
	    
	    //Get all categories
	    $data['categories'] = Categories::all();
	    
	    //Get all Markets
	    $data['markets'] = Market::all();
	    
	    //grab the content
	    $data['content'] = HomePageContent::find(1);
	    
	    //Set the page title...
	    $data['title'] = 'Plenty4/7';
	    
	    //load the view...
        return view('staticPages.home', $data);
    }
    
     /**
    * Search page
    */
    public function searchDeals()
    {
	    
	    //Grab all the deals that have NO exp. date, or the exp. date is in the future (as to not show expired flash deals)
	    $today = date('Y-m-d H:i:s');
	    
	    $data['deals'] = VendorDeal::where('expirationDate', null)->orWhere('expirationDate', '>=', $today)->orderByRaw("RAND()")->with('vendor')->paginate(env('DEAL_NUMBER', 12));
	    
	    //Get all categories
	    $data['categories'] = Categories::all();
	    
	    //Get all Markets
	    $data['markets'] = Market::all();
	    
	    //Set the page title...
	    $data['title'] = 'Plenty4/7';
	    
	    //load the view...
        return view('staticPages.searchDeals', $data);
    }

    
    /**
    * Vendors page
    */
    public function vendors()
    {
	    
	    $data['content'] = AdvancedPage::where('slug', 'vendors')->first();
	    $data['lists'] = AdvancedContentList::where('advanced_page_id', $data['content']->id)->get();
	    
	    $data['title'] = 'Become a Vendor | Plenty4/7';
        return view('staticPages.advancedPage', $data);
    }
    
    /**
    * Fundraisers page
    */
    public function fundraisers()
    {
	    
	    $data['content'] = AdvancedPage::where('slug', 'fundraisers')->first();
	    $data['lists'] = AdvancedContentList::where('advanced_page_id', $data['content']->id)->get();
	    
	    $data['title'] = 'Become a Fundraising Partner | Plenty4/7';
        return view('staticPages.advancedPage', $data);
    }
    
    /**
    * Tradeshows page
    */
    public function tradeShows()
    {
	    
	    $data['content'] = AdvancedPage::where('slug', 'trade-show-organizations')->first();
	    $data['lists'] = AdvancedContentList::where('advanced_page_id', $data['content']->id)->get();
	    
	    $data['title'] = 'Trade Show Organizations | Plenty4/7';
        return view('staticPages.advancedPage', $data);
    }
    
    /**
    * Contact page
    */
    public function contact()
    {
	    $data['title'] = 'Contact Us | Plenty4/7';
        return view('staticPages.contact', $data);
    }
    
    /**
    * Submit Contact page
    */
    public function submitContact(Request $request)
    {
	   //Send an email to the new vendor...
		$data['title'] = 'Contact Form Submission';
		$data['mainMsg'] = '<p><strong>Name:</strong> '.$request->name.'<br /><strong>Email:</strong> '.$request->email.'<br /><strong>Phone: </strong>'.$request->phone.'<br /><strong>Request Type: </strong> '.$request->requestType.'</p><p><strong>Message: </strong><br />'.$request->message.'</p>';
		$data['actionButton'] = false;
		
		Mail::send('email.transactional', $data, function ($message) use ($request) {
			
			//Grab the user object...

		    $message->from($request->email, $request->name);
			$message->to(env('ADMIN_EMAIL', 'info@plenty47.com'));
			$message->subject('P4/7 Contact Form Submission');
		});
		
		Session::flash('success', 'We have received your email and will be back with you shortly!');
		
		return redirect('/contact');
		
    }
    
    /**
    * About Us page
    */
    public function aboutUs()
    {
	    $data['content'] = SimplePage::where('slug', 'about-us')->first();
	    
	    $data['title'] = 'About Us | Plenty4/7';
        return view('staticPages.simplePage', $data);
    }
    
    /**
    * About Us page
    */
    public function terms()
    {
	    
	    $data['content'] = SimplePage::where('slug', 'terms')->first();
	    
	    $data['title'] = 'Terms | Plenty4/7';
        return view('staticPages.simplePage', $data);
    }
    
    /**
    * About Us page
    */
    public function legal()
    {
	    
	    $data['content'] = SimplePage::where('slug', 'legal')->first();
	    
	    $data['title'] = 'Legal | Plenty4/7';
        return view('staticPages.simplePage', $data);
    }
    
}
