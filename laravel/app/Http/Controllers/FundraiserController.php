<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\FundraisingCategories;
use App\Fundraiser;
use App\FundraiserPhoto;
use App\FundraiserFact;
use Session;
use Auth;
use Mail;
use Image;
use Carbon;
use Redirect;
use App\Salesperson;

class FundraiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Grab all the deal categoies...
	    $data['categories'] = FundraisingCategories::all();
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    
	    $fundraiser = Fundraiser::where('user_id', $user_id)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
	    
	    $fundraiser->load('facts', 'salespeople');

	    $data['fundraiser'] = $fundraiser[0];
	    
	    //Get the category name
	    $data['category'] = FundraisingCategories::find($data['fundraiser']->category);
	    
	    if($data['fundraiser']->profileImage) {
		    $data['profileImage'] = asset('uploads/'.$data['fundraiser']->profileImage);
	    }else {
		    $data['profileImage'] = asset('assets/img/defaultProfile.png');
	    }
	    
	    return view('fundraisers.dashboard', $data);

	}
    
    /**
    * The Fundraiser Signup Form
    *
    * 
    */
    public function signup()
    {
	    
	    //Check if we're returning here from a back button...
	    $data['formMethod'] = 'POST';
	    $data['formAction'] = '/fundraiser-signup';
	    if(Session::has('fundraiserSignup')) {
		    $data['prefill'] = Session::get('fundraiserSignup');
		    $data['formMethod'] = 'PUT';
		    $data['formAction'] = '/fundraiser-signup/'.$data['prefill']['user_id'].'/'.$data['prefill']['fundraiser_id'];
	    }
	    
	    //Give the page a meta title
	    $data['title'] = 'Fundraising Group Signup | Plenty4/7';
	    
	    //Grab all the deal categoies...
	    $data['categories'] = FundraisingCategories::all();
	    
        return view('fundraisers.signup', $data);
    }
    
    /**
    * Process the Merchant Signup Form
    *
    * 
    */
    public function newFundraiser(Request $request)
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
        $fundraiser = Fundraiser::create([
	        'user_id' => $user->id,
	    	'groupName' => $request->groupName,
			'category' => $request->category,
			'phone' => $request->phone,
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode,
			'active' => 0
		]);
		
		$prefill = array(
			'email' => $user->email,
			'user_id' => $user->id,
			'fundraiser_id' => $fundraiser->id,
	    	'groupName' => $request->groupName,
			'category' => $request->category,
			'phone' => $request->phone,
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode
		);
		
		//Add the vendor array to the session in case they go back...
		Session::put('fundraiserSignup', $prefill);
	    
	    //Now send them along their way to the 2nd signup page...
	    
	    return redirect('/fundraiser-signup/enhance-profile');
        
    }
    
    /**
    * Process the Merchant Signup Form
    *
    * 
    */
    public function updateFundraiserSignup(Request $request, $user_id, $fundraiser_id)
    {
	    
	    //First update the user...
        
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
			'fundraiser_id' => $fundraiser_id->id,
	    	'groupName' => $request->groupName,
			'category' => $request->category,
			'phone' => $request->phone,
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode
		);
		
		//Remove the old session vendor signup key...
		$request->session()->forget('fundraiserSignup');
		
		//Add the vendor array to the session in case they go back...
		Session::put('fundraiserSignup', $prefill);
	    
	    //Now send them along their way to the 2nd signup page...
	    
	    return redirect('/fundraiser-signup/enhance-profile');
        
    }
    
    public function signupStepTwo()
    {
	    
	    //Connect the session data to a variable for the vendor
	    $data['fundraiser'] = Session('fundraiserSignup');
	    
	    //Check if we can create a url slug from their company name
        $data['slug'] = $this->slugify($data['fundraiser']['groupName']);
        
        $checkSlug = Fundraiser::where('slug', $data['slug'])->first();
        
        if(!empty($checkSlug)) {
	        $data['slug'] = $data['slug'].'-'.uniqid();
        }
	    
	    //Give the page a meta title
	    $data['title'] = 'Fundraising Group Profile Details | Plenty4/7';
	    
        return view('fundraisers.signupStepTwo', $data);
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
	
	public function checkSlug(Request $request)
	{
		$slug_exists = Fundraiser::where('slug', $request->slug)->first();
		if ( empty($slug_exists) ) { return 'true'; } else { return 'false'; }	
	}
	
	public function fundraiserFinalize(Request $request) {
		
		//First update the slug...
        $fundraiser = Fundraiser::find($request->fundraiser_id);
		$fundraiser->slug = $request->slug;
		$fundraiser->logo = $request->logo;
		$fundraiser->profileImage = $request->profileImage;
		$fundraiser->save();
		
		//Now crop the photos...
		
		if($fundraiser->logo) {
			//Crop the logo to a 200x200
			$filename = $fundraiser->logo;
			$file = public_path().'/uploads/'.$fundraiser->logo;
			$path = $filename;
			$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
			$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
			
			//200x200
			$newImg = public_path().'/uploads/'.$fundraiser->logo;
			Image::make($file)->resize('200','200')->save($newImg);
		}
		
		if($fundraiser->profileImage) {
			//Crop the profile image to 2000x600
			$filename = $fundraiser->profileImage;
			$file = public_path().'/uploads/'.$fundraiser->profileImage;
			$path = $filename;
			$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
			$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
			
			//2000x600
			$newImg = public_path().'/uploads/'.$fundraiser->profileImage;
			Image::make($file)->resize('2000','600')->save($newImg);
		}
		
		
		//Now add the fun facts... 
		if(count($request->funFacts) > 0) {
			foreach($request->funFacts as $key => $value) {
			    $fact = FundraiserFact::create([
				    'fundraiser_id' => $request->fundraiser_id,
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
				
			    $fact = FundraiserPhoto::create([
				    'fundraiser_id' => $request->fundraiser_id,
		            'photo' => $value
		        ]);
			}
		}
		
		
		//Send an email to the new vendor...
		$data['title'] = 'Thank You for Signing Up!';
		$data['mainMsg'] = 'Thank you for completing the Fundraising Group signup on Plenty4/7. We take quality control very seriously, so your account is awaiting approval by a P4/7 admin. You can still log in and <a href="'.url('/fundraiser-dashboard').'">view your fundraising dashboard</a>, but your public facing profile must be approved. Usually this happens within a few hours of signing up.';
		$data['actionButton'] = true;
		$data['actionButtonLink'] = url('/fundraiser-dashboard');
		$data['actionButtonLabel'] = 'My Fundraising Profile';
		
		Mail::send('email.transactional', $data, function ($message) {
			
			//Grab the user object...
			$user_id = Auth::id();
			$user = User::find($user_id);

		    $message->from('no-reply@plenty47.com', 'Plenty4/7');
			$message->to($user->email);
			$message->subject('P4/7 Fundraiser Signup Confirmation');
		});
		
		//Send an email to the admins...
		$data['title'] = 'Fundraising Group Pending Approval';
		$data['mainMsg'] = 'Please log into the P4/7 administration area and approve the new pending fundraising groups.';
		$data['actionButton'] = false;
		
		Mail::send('email.transactional', $data, function ($message) {
			
			//Grab the user object...
			$user_id = Auth::id();
			$user = User::find($user_id);
			
		    $message->from('no-reply@plenty47.com', 'Plenty4/7');
			$message->to(config('app.adminEmail'));
			$message->subject('P4/7 Fundraiser Signup Pending Approval');
		});
		
		return redirect('/fundraiser-dashboard/');
		
	}
	
	public function newPhoto(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser->load('photos');

	    FundraiserPhoto::create([
		    'fundraiser_id' => $fundraiser[0]->id,
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
	    $fundraiser = Fundraiser::where('user_id', $user_id)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
	    
	    $fundraiser->load('facts');
		
		$data['fundraiser'] = $fundraiser[0];
		
		//Grab an updated view for the photos
		return view('fundraisers.partials.photos', $data);
	    
    }
    
    /**
    * Ajax Functions for the fundraiser dashboard
    */
    
    public function saveFact(Request $request) {
	    $id = $request->factId;
	    $fact = FundraiserFact::find($id);
	    $fact->fact = $request->fact;
	    $fact->save();
	    return 'fact saved';
    }
    
    public function deleteFact(Request $request) {
	    $id = $request->factId;
	    FundraiserFact::destroy($id);
	    return 'fact deleted';
    }
    
    public function newFact(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();

	    FundraiserFact::create([
		    'fundraiser_id' => $fundraiser[0]->id,
            'fact' => $request->fact
        ]);
	    return 'fact created';
    }
        
    public function deletePhoto(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    $id = $request->id;
	    FundraiserPhoto::destroy($id);
		
		//Grab the vendor again...
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser->load('photos');
		
		$data['fundraiser'] = $fundraiser[0];
		
		//Grab an updated view for the photos
		return view('fundraisers.partials.photos', $data);
	    
    }
    
    public function changeLogo(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser[0]->logo = $request->logo;
	    $fundraiser[0]->save();

	    
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
    
    public function changeProfileImage(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser[0]->profileImage = $request->profileImage;
	    $fundraiser[0]->save();

	    
	    //Crop the logo to 2000x600
		$filename = $request->profileImage;
		$file = public_path().'/uploads/'.$filename;
		$path = $filename;
		$ext = '.'.pathinfo($path, PATHINFO_EXTENSION);
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		
		//800x800
		$newImg = public_path().'/uploads/'.$filename;
		Image::make($file)->resize('2000','600')->save($newImg);
		
		return 'profile Image updated!';
	    
    }
    
    public function updateProfile(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser[0]->groupName = $request->groupName;
		$fundraiser[0]->category = $request->category;
		$fundraiser[0]->phone = $request->phone;
		$fundraiser[0]->address = $request->address;
		$fundraiser[0]->address2 = $request->address2;
		$fundraiser[0]->city = $request->city;
		$fundraiser[0]->state = $request->state;
		$fundraiser[0]->zipcode = $request->zipcode;
		
		$fundraiser[0]->save();
				
	    //Grab all the fundraiser categoies...
	    $data['categories'] = FundraisingCategories::all();
	    
	    //Grab the fundraiser info
	    
	    $fundraiser = Fundraiser::where('user_id', $user_id)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
	    
	    $fundraiser->load('facts');

	    $data['fundraiser'] = $fundraiser[0];
	    
	    //Get the category name
	    $data['category'] = FundraisingCategories::find($data['fundraiser']->category);
	    
	    if($data['fundraiser']->profileImage) {
		    $data['profileImage'] = asset('uploads/'.$data['fundraiser']->profileImage);
	    }else {
		    $data['profileImage'] = asset('assets/img/defaultProfile.png');
	    }
	    
	    return view('fundraisers.partials.dets', $data)->render();
	    
    }
    
    public function updateAboutUs(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser[0]->aboutUs = $request->aboutUs;
		
		$fundraiser[0]->save();
				
	   return 'about us saved!';
	    
    }
    
    public function updateOurCause(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser[0]->ourCause = $request->ourCause;
		
		$fundraiser[0]->save();
				
	   return 'our cause saved!';
	    
    }
    
    public function updateVideoLink(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $fundraiser[0]->videoLink = $request->videoLink;
		
		$fundraiser[0]->save();
				
		//Grab the updated info
	    $fundraiser = Fundraiser::where('user_id', $user_id)->get();
	    
	    $data['fundraiser'] = $fundraiser[0];
	    
	    return view('fundraisers.partials.video', $data)->render();
	    
	    
    }
    
    /**
     * View this fundraiser
     */
    public function viewFundraiser($slug)
    {
	    
	    //Grab the fundraiser info
	    
	    $fundraiser = Fundraiser::where('slug', $slug)->with(array('photos' => function($query)
		{
		    $query->orderBy('created_at', 'desc');
		
		}))->get();
		
		if(count($fundraiser) > 0) {
	    
		    $fundraiser->load('facts', 'salespeople');
	
		    $data['fundraiser'] = $fundraiser[0];
		    
		    //Get the category name
		    $data['category'] = FundraisingCategories::find($data['fundraiser']->category);
		    
		    if($data['fundraiser']->profileImage) {
			    $data['profileImage'] = asset('uploads/'.$data['fundraiser']->profileImage);
		    }else {
			    $data['profileImage'] = asset('assets/img/defaultProfile.png');
		    }
		    
		    return view('fundraisers.profile', $data);
		    
		}else {
			
			//No fundraisers were found for that slug!
			abort(404);
			
		}

	}
	
	public function addSalesPerson(Request $request)
	{
		
		//Now create a salesperson...
        Salesperson::create([
	        'fundraiser_id' => $request->fundraiser_id,
	        'firstName' => $request->firstName,
	        'lastName' => $request->lastName
		]);
		
		Session::flash('successPerson', 'You have added a new salesperson!');
		
		return redirect('/fundraiser-dashboard');
		
	}
	
	public function deleteSalesPerson($id)
	{
		
		//Now create a salesperson...
        Salesperson::destroy($id);
		
		Session::flash('successPerson', 'You have successfully deleted a salesperson!');
		
		return redirect('/fundraiser-dashboard');
		
	}
	
	public function search() {
	    
	    if(isset($_GET['fundraiser'])) {
	    
		    $searchTerm = $_GET['fundraiser'];
		    
		    $q = $searchTerm;
	
		    $searchTerms = explode(' ', $q);
		
		    $query = Fundraiser::query();
		
		    foreach($searchTerms as $term)
		    {
		        $query->where('groupName', 'LIKE', '%'. $term .'%');
		    }
		
		    $data['searchResults'] = $query->paginate(12);
		    
		    
		    
		}else {
			$data['searchResults'] = Fundraiser::paginate(12);
		}
		
		$data['title'] = 'Fundraiser Search Results | P4/7';
		
		//Load the search results view...
		return view('staticPages.fundraiserSearchResults', $data);

	    
    }


}
