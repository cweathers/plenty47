<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Categories;
use App\User;
use App\Vendor;
use App\VendorFact;
use App\VendorPhoto;
use App\VendorHour;
use App\VendorDeal;
use App\Market;
use App\VendorRecommendation;
use App\VendorBookmark;
use Session;
use Auth;
use Mail;
use Image;
use Carbon;

class MerchantController extends Controller
{
    
    /**
    * The Merchants Dashboard
    *
    * 
    */
    public function index()
    {
	    
	    //Grab all the deal categoies...
	    $data['categories'] = Categories::all();
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab all the markets
	    $data['markets'] = Market::all();
	    
	    //Grab the vendor info
	    
	    $vendor = Vendor::where('user_id', $user_id)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
		
		$vendor = Vendor::where('user_id', $user_id)->with(array('deals' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
	    
	    $vendor->load('facts', 'hours', 'market');

	    $data['vendor'] = $vendor[0];
	    
	    //Get the category name
	    $data['category'] = Categories::find($data['vendor']->category);
	    
	    if($data['vendor']->profileImage) {
		    $data['profileImage'] = asset('uploads/'.$data['vendor']->profileImage);
	    }else {
		    $data['profileImage'] = asset('assets/img/defaultProfile.png');
	    }
	    
	    return view('merchant.dashboard', $data);
	    
    }
    
    /**
    * The Merchant Signup Form
    *
    * 
    */
    public function signup()
    {
	    
	    //Check if we're returning here from a back button...
	    $data['formMethod'] = 'POST';
	    $data['formAction'] = '/merchant-signup';
	    if(Session::has('vendorSignup')) {
		    $data['prefill'] = Session::get('vendorSignup');
		    $data['formMethod'] = 'PUT';
		    $data['formAction'] = '/merchant-signup/'.$data['prefill']['user_id'].'/'.$data['prefill']['vendor_id'];
	    }
	    
	    //Give the page a meta title
	    $data['title'] = 'Merchant/Vendor Signup | Plenty4/7';
	    
	    //Grab all the deal categoies...
	    $data['categories'] = Categories::all();
	    
	    //Grab all the markets
	    $data['markets'] = Market::all();
	    
        return view('merchant.signup', $data);
    }
    
    /**
    * Process the Merchant Signup Form
    *
    * 
    */
    public function newMerchant(Request $request)
    {
	    
	    //First create a new user with the userType of "vendor"
	    $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userType' => $request->userType
        ]);
        
        //Log them in...
        Auth::login($user);
                
        //Now create a new Vendor...
        $vendor = Vendor::create([
	        'user_id' => $user->id,
	    	'companyName' => $request->companyName,
			'category' => $request->category,
			'phone' => $request->phone,
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode,
			'active' => 0,
			'market_id' => $request->market,
			'url' => $request->url
		]);
		
		$prefill = array(
			'email' => $user->email,
			'user_id' => $user->id,
			'vendor_id' => $vendor->id,
	    	'companyName' => $request->companyName,
			'category' => $request->category,
			'phone' => $request->phone,
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode,
			'market' => $request->market,
			'url' => $request->url
		);
		
		//Add the vendor array to the session in case they go back...
		Session::put('vendorSignup', $prefill);
	    
	    //Now send them along their way to the 2nd signup page...
	    
	    return redirect('/merchant-signup/enhance-profile');
        
    }
    
    /**
    * Process the Merchant Signup Form
    *
    * 
    */
    public function updateMerchantSignup(Request $request, $user_id, $vendor_id)
    {
        
        $user = User::find($user_id);

		$user->email = $request->email;
        $user->password = bcrypt($request->password);
		
		$user->save();
        
        //Now update the new Vendor...
        $vendor = Vendor::find($vendor_id);
        
        $vendor->companyName = $request->companyName;
		$vendor->category = $request->category;
		$vendor->phone = $request->phone;
		$vendor->address = $request->address;
		$vendor->address2 = $request->address2;
		$vendor->city = $request->city;
		$vendor->state = $request->state;
		$vendor->zipcode = $request->zipcode;
		
		$vendor->save();
		
		$prefill = array(
			'email' => $user->email,
			'user_id' => $user->id,
			'vendor_id' => $vendor->id,
	    	'companyName' => $request->companyName,
			'category' => $request->category,
			'phone' => $request->phone,
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode,
			'url' => $request->url
		);
		
		//Remove the old session vendor signup key...
		$request->session()->forget('vendorSignup');
		
		//Add the vendor array to the session in case they go back...
		Session::put('vendorSignup', $prefill);
	    
	    //Now send them along their way to the 2nd signup page...
	    
	    return redirect('/merchant-signup/enhance-profile');
        
    }
    
    public function signupStepTwo()
    {
	    
	    //Connect the session data to a variable for the vendor
	    $data['vendor'] = Session('vendorSignup');
	    
	    //Check if we can create a url slug from their company name
        $data['slug'] = $this->slugify($data['vendor']['companyName']);
        
        $checkSlug = Vendor::where('slug', $data['slug'])->first();
        
        if(!empty($checkSlug)) {
	        $data['slug'] = $data['slug'].'-'.uniqid();
        }
	    
	    //Give the page a meta title
	    $data['title'] = 'Merchant Profile Details | Plenty4/7';
	    
        return view('merchant.signupStepTwo', $data);
    }
    
    public function slugify($text)
	{ 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	
	  // trim
	  $text = trim($text, '-');
	
	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	
	  // lowercase
	  $text = strtolower($text);
	
	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);
	
	  if (empty($text))
	  {
	    return 'n-a';
	  }
	
	  return $text;
	}
	
	public function checkEmail(Request $request)
	{
		$email_exists = User::where('email', $request->email)->first();
		if ( empty($email_exists) ) { return 'true'; } else { return 'false'; }	
	}
	
	public function checkSlug(Request $request)
	{
		$slug_exists = Vendor::where('slug', $request->slug)->first();
		if ( empty($slug_exists) ) { return 'true'; } else { return 'false'; }	
	}
	
	public function merchantFinalize(Request $request) {
		
		//First update the slug...
        $vendor = Vendor::find($request->vendor_id);
		$vendor->slug = $request->slug;
		$vendor->logo = $request->logo;
		$vendor->profileImage = $request->profileImage;
		$vendor->save();
		
		//Now crop the photos...
		
		if($vendor->logo) {
			//Crop the logo to a 200x200
			$filename = $vendor->logo;
			$file = public_path().'/uploads/'.$vendor->logo;
			$path = $filename;
			$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
			$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
			
			//200x200
			$newImg = public_path().'/uploads/'.$vendor->logo;
			Image::make($file)->resize('200','200')->save($newImg);
		}
		
		if($vendor->profileImage) {
			//Crop the profile image to 2000x600
			$filename = $vendor->profileImage;
			$file = public_path().'/uploads/'.$vendor->profileImage;
			$path = $filename;
			$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
			$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
			
			//2000x600
			$newImg = public_path().'/uploads/'.$vendor->profileImage;
			Image::make($file)->resize('2000','600')->save($newImg);
		}
		
		
		//Now add the fun facts... 
		if(count($request->funFacts) > 0) {
			foreach($request->funFacts as $key => $value) {
			    $fact = VendorFact::create([
				    'vendor_id' => $request->vendor_id,
		            'fact' => $value
		        ]);
			}
		}
		
		//Now add the photos...
		if(count($request->photos) > 0) {
			foreach($request->photos as $key => $value) {
				
				//Crop the photo to 800x800
				$filename = $value;
				$file = public_path().'/uploads/'.$value;
				$path = $filename;
				$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
				$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
				
				//800x800
				$newImg = public_path().'/uploads/'.$value;
				Image::make($file)->resize('800','800')->save($newImg);
				
			    $fact = VendorPhoto::create([
				    'vendor_id' => $request->vendor_id,
		            'photo' => $value
		        ]);
			}
		}
		
		//Now add the hours...
		$count = count($request->hours);
		$i = 0;
		if($count > 0) {
			while($i <= $count - 1) {
				//First create a new user with the userType of "vendor"
			    VendorHour::create([
				    'vendor_id' => $request->vendor_id,
		            'label' => $request->label[$i],
		            'hours' => $request->hours[$i]
		        ]);
		        $i++;
			}
		}
		
		
		//Send an email to the new vendor...
		$data['title'] = 'Thank You for Signing Up!';
		$data['mainMsg'] = 'Thank you for completing the Vendor/Merchant signup on Plenty4/7. We take quality control very seriously, so your account is awaiting approval by a P4/7 admin. You can still log in and <a href="'.url('/merchant-dashboard').'">view your merchant dashboard</a>, but your public facing profile must be approved. Usually this happens within a few hours of signing up.';
		$data['actionButton'] = true;
		$data['actionButtonLink'] = url('/merchant-dashboard');
		$data['actionButtonLabel'] = 'My Merchant Profile';
		
		Mail::send('email.transactional', $data, function ($message) {
			
			//Grab the user object...
			$user_id = Auth::id();
			$user = User::find($user_id);

		    $message->from('no-reply@plenty47.com', 'Plenty4/7');
			$message->to($user->email);
			$message->subject('P4/7 Merchant Signup Confirmation');
		});
		
		//Send an email to the admins...
		$data['title'] = 'Merchant Pending Approval';
		$data['mainMsg'] = 'Please log into the P4/7 administration area and approve the new pending merchants.';
		$data['actionButton'] = false;
		
		Mail::send('email.transactional', $data, function ($message) {
			
			//Grab the user object...
			$user_id = Auth::id();
			$user = User::find($user_id);
			
		    $message->from('no-reply@plenty47.com', 'Plenty4/7');
			$message->to(config('app.adminEmail'));
			$message->subject('P4/7 Merchant Signup Pending Approval');
		});
		
		return redirect('/merchant-dashboard/');
		
	}
	
	/**
    * The Merchants Dashboard
    */
    public function viewMerchant($slug)
    {
	    
	    //Grab the vendor
	    $data['vendor'] = Vendor::where('slug', $slug)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
		
		$data['vendor'] = Vendor::where('slug', $slug)->with(array('deals' => function($query)
		{
			$query->where('expirationDate', '=', NULL);
			$query->orWhere('expirationDate', '>=', date('Y-m-d H:i:s'));
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
	    
	    $data['vendor']->load('facts', 'hours');
	    
	    $data['vendor'] = $data['vendor'][0];
	    
	    $data['vendor']['recs'] = VendorRecommendation::where('vendor_id', $data['vendor']->id)->get();
	    
	    //Check if we're going for a specific deal...
	    if(isset($_GET['deal'])) {
		    $id = $_GET['deal'];
		    $data['specificDeal'] = VendorDeal::find($id);
	    }
	    
	    //Check if a vip that is viewing this, has bookmarked or recommended it...
	    if(Auth::check()) {
		    $tempUser = Auth::user();
		    
		     //Set the vip state...
		    if($tempUser->userType == 'vip') {
			    
			    $user = Auth::user();
			    
			    $data['vipRec'] = 0;
			    $data['vipBook'] = 0;
			    
			    //grab the vip recommendations for this vendor...
			    if(count(vendorRecommendation::where('user_id', $tempUser->id)->where('vendor_id', $data['vendor']->id)->get()) > 0) {
				    $data['vipRec'] = 1;
			    }
			    
			    //grab the vip bookmarks for this vendor...
			    if(count(vendorBookmark::where('user_id', $tempUser->id)->where('vendor_id', $data['vendor']->id)->get()) > 0) {
				    $data['vipBook'] = 1;
			    }
			    
			     //Grab recommendations...
		        $data['userRecs'] = VendorRecommendation::where('user_id', $user->id)->get();
		        //Grab bookmarks...
		        $data['userBookmarks'] = VendorBookmark::where('user_id', $user->id)->get();
			    
		    } 
	    
	    }
	    
	    //Get the category name
	    $data['category'] = Categories::find($data['vendor']->category);
	    
	    if($data['vendor']->profileImage) {
		    $data['profileImage'] = asset('uploads/'.$data['vendor']->profileImage);
	    }else {
		    $data['profileImage'] = asset('assets/img/defaultProfile.png');
	    }
	    
	    //Set a flag for looping through the array
	    $data['flag'] = 0;
	    
	    //Get 4 random deals for the "you may also like" section..
	    if(count($data['vendor']->deals) > 0) {
		    $ids = array();
		    foreach($data['vendor']->deals as $d) {
			    array_push($ids, $d->id);
		    }  
	    }
	    
	    //Get 4 deals from vendors in the same market_id
	    
	    //Set the market id
	    $market = $data['vendor']->market_id;
	    
	    //Get all vendors in this market...
	    $vendors = array();
	    $allVendors = Vendor::where('market_id', $market)->get();
	    foreach($allVendors as $v) {
		    array_push($vendors, $v->id);
	    }
	    
	    //Grab the deals...
	    $data['moreDeals'] = VendorDeal::where('expirationDate', '>=', date('Y-m-d H:i:s'))->orWhere('expirationDate', '=', NULL)->whereNotIn('id', $ids)->whereIn('vendor_id', $vendors)->take(4)->get();
	    
	    //Load the vendors...
	    $data['moreDeals']->load('vendor');
	    
	    
	    //The vendor must be activated by an admin before they appear on the frontend...
	    if($data['vendor']->active == 1) {
	    	return view('merchant.profile', $data);
	    }else {
		    return view('merchant.notActivated');
	    }
	    
    }
    
    /**
    * Ajax Functions for the merchant dashboard
    */
    
    public function saveFact(Request $request) {
	    $id = $request->factId;
	    $fact = VendorFact::find($id);
	    $fact->fact = $request->fact;
	    $fact->save();
	    return 'fact saved';
    }
    
    public function deleteFact(Request $request) {
	    $id = $request->factId;
	    VendorFact::destroy($id);
	    return 'fact deleted';
    }
    
    public function newFact(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vendor info
	    $vendor = Vendor::where('user_id', $user_id)->get();

	    VendorFact::create([
		    'vendor_id' => $vendor[0]->id,
            'fact' => $request->fact
        ]);
	    return 'fact created';
    }
    
    public function newPhoto(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vendor info
	    $vendor = Vendor::where('user_id', $user_id)->get();
	    
	    $vendor->load('photos');

	    VendorPhoto::create([
		    'vendor_id' => $vendor[0]->id,
            'photo' => $request->photo
        ]);
	    
	    //Crop the photo to 800x800
		$filename = $request->photo;
		$file = public_path().'/uploads/'.$filename;
		$path = $filename;
		$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		
		//800x800
		$newImg = public_path().'/uploads/'.$filename;
		Image::make($file)->resize('800','800')->save($newImg);
		
		//Grab the vendor again...
	    $vendor = Vendor::where('user_id', $user_id)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
	    
	    $vendor->load('facts', 'hours');
		
		$data['vendor'] = $vendor[0];
		
		//Grab an updated view for the photos
		return view('merchant.partials.photos', $data);
	    
    }
    
    public function deletePhoto(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    $id = $request->id;
	    VendorPhoto::destroy($id);
		
		//Grab the vendor again...
	    $vendor = Vendor::where('user_id', $user_id)->get();
	    
	    $vendor->load('photos');
		
		$data['vendor'] = $vendor[0];
		
		//Grab an updated view for the photos
		return view('merchant.partials.photos', $data);
	    
    }
    
    public function changeLogo(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vendor info
	    $vendor = Vendor::where('user_id', $user_id)->get();
	    
	    $vendor[0]->logo = $request->logo;
	    $vendor[0]->save();

	    
	    //Crop the logo to 200x200
		$filename = $request->logo;
		$file = public_path().'/uploads/'.$filename;
		$path = $filename;
		$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		
		//800x800
		$newImg = public_path().'/uploads/'.$filename;
		Image::make($file)->resize('200','200')->save($newImg);
		
		return 'logo updated!';
	    
    }
    
    public function updateProfile(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vendor info
	    $vendor = Vendor::where('user_id', $user_id)->get();
	    
	    $vendor[0]->companyName = $request->companyName;
		$vendor[0]->category = $request->category;
		$vendor[0]->phone = $request->phone;
		$vendor[0]->address = $request->address;
		$vendor[0]->address2 = $request->address2;
		$vendor[0]->city = $request->city;
		$vendor[0]->state = $request->state;
		$vendor[0]->zipcode = $request->zipcode;
		$vendor[0]->market_id = $request->market;
		$vendor[0]->url = $request->url;
		
		$vendor[0]->save();

		//Delete all facts for vendor 
	    VendorHour::where('vendor_id', $vendor[0]->id)->delete();
	    
	    //Now add the hours...
		$count = count($request->hours);
		$i = 0;
		if($count > 0) {
			while($i <= $count - 1) {
				//First create a new user with the userType of "vendor"
			    VendorHour::create([
				    'vendor_id' => $vendor[0]->id,
		            'label' => $request->label[$i],
		            'hours' => $request->hours[$i]
		        ]);
		        $i++;
			}
		}
		
	    //Grab all the deal categoies...
	    $data['categories'] = Categories::all();
	    
	    //Grab the vendor info
	    
	    $vendor = Vendor::where('user_id', $user_id)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
	    
	    $vendor->load('facts', 'hours');

	    $data['vendor'] = $vendor[0];
	    
	    //Get the category name
	    $data['category'] = Categories::find($data['vendor']->category);
	    
	    if($data['vendor']->profileImage) {
		    $data['profileImage'] = asset('uploads/'.$data['vendor']->profileImage);
	    }else {
		    $data['profileImage'] = asset('assets/img/defaultProfile.png');
	    }
	    
	    return (String) view('merchant.partials.mhSidebar', $data);
	    
    }
    
    public function changeProfileImage(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vendor info
	    $vendor = Vendor::where('user_id', $user_id)->get();
	    
	    $vendor[0]->profileImage = $request->profileImage;
	    $vendor[0]->save();

	    
	    //Crop the logo to 2000x600
		$filename = $request->profileImage;
		$file = public_path().'/uploads/'.$filename;
		$path = $filename;
		$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		
		//800x800
		$newImg = public_path().'/uploads/'.$filename;
		Image::make($file)->resize('2000','600')->save($newImg);
		
		return 'profile Image Updated!';
	    
    }
    
    public function addNewDeal(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vendor info
	    $vendor = Vendor::where('user_id', $user_id)->get();
	    
	    //Figure out if expiration date is null
	    if($request->expirationDate) {
		    $expDate = date('Y-m-d H:i:s', strtotime($request->expirationDate));
	    }else {
		    $expDate = NULL;
	    }

	    VendorDeal::create([
		    'vendor_id' => $vendor[0]->id,
            'title' => $request->title,
            'tagline' => $request->tagline,
            'description' => $request->description,
            'finePrint' => $request->finePrint,
            'redemptionInstructions' => $request->redemptionInstructions,
            'largeImage' => $request->largeImage,
            'squareImage' => $request->squareImage,
            'expirationDate' => $expDate,
            'featuredDeal' => 0,
        ]);
	    
	    //Crop the large Image to 2000 x 600
		$filename = $request->largeImage;
		$file = public_path().'/uploads/'.$filename;
		$path = $filename;
		$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		
		//800x800
		$newImg = public_path().'/uploads/'.$filename;
		Image::make($file)->resize('2000','600')->save($newImg);
		
		//Crop the square Image to 800 x 800
		$filename = $request->squareImage;
		$file = public_path().'/uploads/'.$filename;
		$path = $filename;
		$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		
		//800x800
		$newImg = public_path().'/uploads/'.$filename;
		Image::make($file)->resize('800','800')->save($newImg);
		
		//Grab the vendor again...
	    $vendor = Vendor::where('user_id', $user_id)->with(array('deals' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
		
		$data['vendor'] = $vendor[0];
		
		//Grab an updated view for the photos
		return view('merchant.partials.dealList', $data);
	    
    }
    
    public function deleteDeal(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    $id = $request->id;
	    VendorDeal::destroy($id);
		
		//Grab the vendor again...
	    $vendor = Vendor::where('user_id', $user_id)->with(array('deals' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
		
		$data['vendor'] = $vendor[0];
		
		//Grab an updated view for the photos
		return view('merchant.partials.dealList', $data);
	    
    }
    
    public function editDeal(Request $request) {
	    
	    //Get the vendor deal
	    $id = $request->id;
	    $data['deal'] = VendorDeal::find($id);
		
		//Grab an updated view for the photos
		return view('merchant.partials.editDealForm', $data);
	    
    }
    
    public function saveDealChanges(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vendor info
	    $vendor = Vendor::where('user_id', $user_id)->get();
	    
	    //Figure out if expiration date is null
	    if($request->expirationDate) {
		    $expDate = date('Y-m-d H:i:s', strtotime($request->expirationDate));
	    }else {
		    $expDate = NULL;
	    }
	    
	    //Grab the vendor deal...
	    $vendorDeal = VendorDeal::find($request->id);
	    
	    $oldLargeImage = $vendorDeal->largeImage;
	    $oldSquareImage = $vendorDeal->squareImage;
	    
	    $vendorDeal->title = $request->title;
	    $vendorDeal->tagline = $request->tagline;
	    $vendorDeal->description = $request->description;
	    $vendorDeal->finePrint = $request->finePrint;
	    $vendorDeal->redemptionInstructions = $request->redemptionInstructions;
	    $vendorDeal->largeImage = $request->largeImage;
	    $vendorDeal->squareImage = $request->squareImage;
	    $vendorDeal->expirationDate = $expDate;
	    
	    $vendorDeal->save();
	    
	    if($request->largeImage !== $oldLargeImage) {
		    //Crop the large Image to 2000 x 600
			$filename = $request->largeImage;
			$file = public_path().'/uploads/'.$filename;
			$path = $filename;
			$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
			$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
			
			//800x800
			$newImg = public_path().'/uploads/'.$filename;
			Image::make($file)->resize('2000','600')->save($newImg);
			
		}
		
		if($request->squareImage !== $oldSquareImage) {
			//Crop the square Image to 800 x 800
			$filename = $request->squareImage;
			$file = public_path().'/uploads/'.$filename;
			$path = $filename;
			$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
			$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
			
			//800x800
			$newImg = public_path().'/uploads/'.$filename;
			Image::make($file)->resize('800','800')->save($newImg);
		}
		
		//Grab the vendor again...
	    $vendor = Vendor::where('user_id', $user_id)->with(array('deals' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
		
		$data['vendor'] = $vendor[0];
		
		//Grab an updated view for the photos
		return view('merchant.partials.dealList', $data);
	    
    }
    
}
