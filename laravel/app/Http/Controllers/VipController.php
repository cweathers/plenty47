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

class VipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
	
	
    public function signup()
    { 
	    
	    if(isset($_GET['fundraiser'])) {
		    
		    $salesperson = '';
		    if(isset($_GET['salesperson'])) {
			    $salesperson = '&salesperson='.$_GET['salesperson'];
		    }
		    
		    //They are coming from a fundraiser so lets just start the signup
			return redirect('/vip-signup/process-card?fundraiser='.$_GET['fundraiser'].$salesperson);  
			  
		}else {
			
			//Give the page a meta title
		    $data['title'] = 'VIP Signup | Plenty4/7';
		    
	        return view('vip.signup', $data);	
		}
    }
    
    /**
     * Validate the card
     *
     */
    public function validateCard(Request $request)
    {
        $card_exists = CardNumber::where('number', $request->card_number)->first();
		if ( empty($card_exists) ) { return 'false'; } else { return 'true'; }	
    }
    
    /**
     * Start the new user...
     *
     */
    public function processCard(Request $request)
    {
	    
	    //Check if they have a fundraiser id to pass along...
	    if(isset($request->fundraiser_id)) {
		    //Save it to the session
		    Session::put('fundraiser_id', $request->fundraiser_id);
	    }
	    
        if(!isset($_GET)) {
	        return redirect('/vip-signup');
        }else {
	        
	        //Check if its a fundraising group...
	        if(isset($_GET['fundraiser'])) {
		        
		        //Save it to the session
				Session::put('fundraiser_id', $_GET['fundraiser']);
				
				if(isset($_GET['salesperson'])) {
					//Save it to the session
					Session::put('salesperson_id', $_GET['salesperson']);
				}
		        
		        //They want a card assigned to this fundraiser. Grab an existing fundraiser assigned card and mark it as used...
		        $card = CardNumber::take(1)->where('user_id', NULL)->where('fundraiser_id', $_GET['fundraiser'])->get();
		        
		        if(count($card) == 0) {
			        return view('vip.nocards');
		        }else {
			        Session::put('card_id', $card[0]->id);
			        //mark the card taken
			        $card[0]->user_id = 0;
			        $card[0]->save();
			        return redirect('/vip-signup/account-info?card=new');
		        }

	        }else {
		        
		        //Its not a fundraising group so now check for new or existing cards...
		        if($_GET['card'] == 'new') {
		        
			        //They want a new card. Grab an existing card and mark it as used...
			        $card = CardNumber::take(1)->where('user_id', NULL)->get();
			        
			        if(count($card) == 0) {
				        return view('vip.nocards');
			        }else {
				        Session::put('card_id', $card[0]->id);
				        $card[0]->user_id = 0;
						$card[0]->save();
				        return redirect('/vip-signup/account-info?card=new');
			        }
			        
		        }elseif($_GET['card'] == 'existing') {
			        
			        //They must have a physical card from a fundraiser or something!
			        $card = $request->card_number;
			        $card = CardNumber::where('number', $card)->get();
			        
			        if(count($card) == 0) {
				        return view('vip.nocards');
			        }else {
				        Session::put('card_id', $card[0]->id);
				        
				        $card[0]->user_id = 0;
						$card[0]->save();
				        
				        //save fundraiser in case...
				        if($card[0]->fundraiser_id) {
					        //Save it to the session
							Session::put('fundraiser_id', $card[0]->fundraiser_id);
				        }
				        
				        return redirect('/vip-signup/account-info?card=existing');
			        }
			        
		        }else {
			        //If nothing else triggered a response, that can't be good!
			        return abort(404);
		        }
	        }
        }
    }
    
    /**
     * Start the new user...
     *
     */
    public function accountInfo()
    {
		if(!Session::has('card_id')) {
			
			//We have to have a card id to engage this step...	
			return redirect('/vip-signup?error=nocard');
		
		}else {
			
			//Assing the card_id in the session to a variable
			$data['card_id'] = Session::get('card_id');
			
			//Is the card new or existing
			$data['card_status'] = $_GET['card'];
			
			//Check if we're returning here from a back button...
		    $data['formMethod'] = 'POST';
		    $data['formAction'] = '/vip-signup/account-info';
		    $data['formId'] = 'vip-account-signup';
		    if(Session::has('vipSignup')) {
			    $data['prefill'] = Session::get('vipSignup');
			    $data['formMethod'] = 'PUT';
			    $data['formAction'] = '/vip-signup/account-info/'.$data['prefill']['user_id'].'/'.$data['prefill']['vip_id'].'/'.$data['prefill']['address_id'];
			    $data['formId'] = 'vip-account-signup-update';
		    }
		    
		    return view('vip.accountInfo', $data);
			
		}
	}
	
	/**
     * Check if the email exists
     *
     */
    public function checkEmail(Request $request)
    {
        $email_exists = User::where('email', $request->email)->first();
		if ( empty($email_exists) ) { return 'true'; } else { return 'false'; }
    }
    
    public function checkEmailUpdate(Request $request)
    {
	    
	    //First check if its the same email...
	    if(Session::has('vipSignup')) {
		    $vipSignup = Session::get('vipSignup');
		    if($vipSignup['email'] == $request->email) {
			    return 'true';
		    }
	    }
	    
        $email_exists = User::where('email', $request->email)->first();
		if ( empty($email_exists) ) { return 'true'; } else { return 'false'; }
    }
    
    /**
     * Save the new user...
     *
     */
     public function saveVip(Request $request)
     {
	     //First create a new user with the userType of "vendor"
	    $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userType' => $request->userType,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName
        ]);
        
        //Log them in...
        Auth::login($user);
        
        
        $salesperson_id = '';
		if(Session::has('salesperson_id')) {
			 $salesperson_id = Session::get('salesperson_id');
		}
		
		$fundraiser_idFinal = '';
		if(Session::has('fundraiser_id')) {
			 $fundraiser_idFinal = Session::get('fundraiser_id');
		}
                
        //Now create a new Vendor...
        $vip = Vip::create([
	        'user_id' => $user->id,
	        'card_number_id' => $request->card_id,
	        'phone' => $request->phone,
		    'active' => 0,
		    'salesperson_id' => $salesperson_id,
		    'fundraiser_id' => $fundraiser_idFinal
		]);
		
		//Add an address to the user...
		$address = Address::create([
			'label' => 'Primary Billing Address',
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode,
			'type' => 'billing',
			'active' => 1,
			'user_id' => $user->id
			
		]);
		
		$prefill = array(
			'email' => $user->email,
			'firstName' => $user->firstName,
			'lastName' => $user->lastName,
			'card_number_id' => $request->card_id,
			'user_id' => $user->id,
			'vip_id' => $vip->id,
			'phone' => $request->phone,
			'address' => $address->address,
			'address2' => $address->address2,
			'city' => $address->city,
			'state' => $address->state,
			'zipcode' => $address->zipcode,
			'address_id' => $address->id,
			'card_status' => $request->card_status
		);
		
		//Add the vendor array to the session in case they go back...
		Session::put('vipSignup', $prefill);
	    
	    //Now send them along their way to the 2nd signup page...
	    
	    return redirect('/vip-signup/payment-info');
     }
     
     /**
     * Save the new user...
     *
     */
     public function updateVip(Request $request, $user_id, $vip_id, $address_id)
     {
	    //Grab the user
	    $user = User::find($user_id);
	     
	    $user->email = $request->email;
	    $user->password = bcrypt($request->password);
	    
	    $user->save();
        
		//Grab the VIP
		$vip = Vip::find($vip_id);
		
		$vip->phone = $request->phone;
		
		$vip->save();
		
		//Delete the address...
		Address::destroy($address_id);
		
		//Add an address to the user...
		$address = Address::create([
			'label' => 'Primary Billing Address',
			'address' => $request->address,
			'address2' => $request->address2,
			'city' => $request->city,
			'state' => $request->state,
			'zipcode' => $request->zipcode,
			'type' => 'billing',
			'active' => 1,
			'user_id' => $user->id
			
		]);
		
		$temp = Session::get('vipSignup');
		
		$card_number_id = $temp['card_number_id'];
		$user_id = $user_id;
		$vip_id = $temp['vip_id'];
		$address_id = $temp['address_id'];
		$card_status = $temp['card_status'];
		
		$prefill = array(
			'email' => $user->email,
			'firstName' => $request->firstName,
			'lastName' => $request->lastName,
			'card_number_id' => $card_number_id,
			'user_id' => $user_id,
			'vip_id' => $vip_id,
			'address_id' => $address_id,
			'phone' => $request->phone,
			'address' => $address->address,
			'address2' => $address->address2,
			'city' => $address->city,
			'state' => $address->state,
			'zipcode' => $address->zipcode,
			'card_status' => $card_status
		);
		
		//Add the vendor array to the session in case they go back...
		Session::put('vipSignup', $prefill);
	    
	    //Now send them along their way to the 2nd signup page...
	    
	    return redirect('/vip-signup/payment-info');
     }
     
     /**
     * Take their payment info...
     *
     */
     public function paymentInfo(Request $request)
     {	    
	    
	    //Grab the cost of the sub
	    $data['cost'] = env('VIP_COST');
	    
	    //Get stripe config items
	    $data['stripe'] = config('services.stripe');
	   
	   	//Give the page a meta title
		$data['title'] = 'VIP Signup | Plenty4/7';
	     
	    $data['prefill'] = Session::get('vipSignup');
	     
	 	return view('vip.paymentInfo', $data);
	 	
	 }
	 
	  /**
     * Now they need to select a fundraiser...
     *
     */
     public function processPaymentInfo(Request $request)
     {	
	     
	    //Is billing the same?
	    if($request->billingSame !== 1) {
		    
		    Session::put('billingSame', 1);
		    
		    $user = Auth::user();
		    
		    $address = Address::create([
				'label' => 'Primary Shipping Address',
				'address' => $request->address,
				'address2' => $request->address2,
				'city' => $request->city,
				'state' => $request->state,
				'zipcode' => $request->zipcode,
				'type' => 'shipping',
				'active' => 1,
				'user_id' => $user->id
				
			]);
	    }    
	    
	    //Push the stripe token to the vipSignup array in the session...
	    $vipSignup = Session::get('vipSignup');
	    $vipSignup['stripeToken'] = $request->stripeToken;
	    Session::put('vipSignup', $vipSignup);
	    
	    return redirect('/vip-signup/choose-fundraiser');
	 	
	 }
	 
	 public function chooseFundraiser()
	 {
		 //Give the page a meta title
		$data['title'] = 'VIP Signup | Plenty4/7';
	     
	    $data['prefill'] = Session::get('vipSignup');
	    
	    
	    if(Session::has('fundraiser_id')) {
		    //Grab the saved fundraiser
		    $data['fundraiser'] = Fundraiser::find(Session::get('fundraiser_id'));
		    
	    }else {
	    	//Grab 4 random fundraisers...
			$data['fundraisers'] = Fundraiser::take(env('SHOW_FUNDRAISERS'))->orderByRaw("RAND()")->get();
		}
	    
	 	return view('vip.chooseFundraiser', $data);
	 }
	 
	  /**
     * Save the chosen fundraiser...
     *
     */
     public function saveChosenFundraiser(Request $request)
     {	    
	    
	    //Push the stripe token to the vipSignup array in the session...
	    $vipSignup = Session::get('vipSignup');
	    $vipSignup['fundraiser_id'] = $request->fundraiser_id;
	    Session::put('vipSignup', $vipSignup);
	    
	    return redirect('/vip-signup/review');
	 	
	 }
	 
	 public function signupReview()
	 {
		 //Give the page a meta title
		$data['title'] = 'VIP Signup | Plenty4/7';
	     
	    $data['user'] = Auth::user();
	    
	    $data['user']->load('addresses');
	    
	    $data['vip'] = Vip::find($data['user']->id);
	    
	    //Grab a masked card...
	    $data['vipSignup'] = Session::get('vipSignup');
	    $card = CardNumber::find($data['vipSignup']['card_number_id']);
	    $expCard = explode("-", $card->number);
	    $data['masked_card'] = '****-****-****-'.$expCard[3];
	    
	    //Grab their supported fundraiser...
	    $data['fundraiser'] = Fundraiser::find($data['vipSignup']['fundraiser_id']);
	    
	   	    
	 	return view('vip.review', $data);
	 }
	 
	 public function signupFinalize()
	 {
		 //Grab the user...
		 $user = Auth::user();
		 
		 //Grab the vip...
		 $vip = Vip::where('user_id', $user->id)->get();
		 $vip = $vip[0];
		 
		 //Grab the vip signup session variable
		 $vipSignup = Session::get('vipSignup');
		 
		 //Save the fundraiser id...
		 $vip->fundraiser_id = $vipSignup['fundraiser_id'];
		 
		 //Grab the users card...
		 $card = CardNumber::find($vipSignup['card_number_id']);
		 $card->fundraiser_id = $vipSignup['fundraiser_id'];
		 $card->user_id = $user->id;
		 $card->save();
		 
		 //Grab the saved fundraiser...
		 $fundraiser = Fundraiser::find($vipSignup['fundraiser_id']);
		 
		 //Save Stripe subscription...
		 
		 //What type of sub are they?
		 if($vipSignup['card_status'] == 'existing') {
			 $stripePlan = 'existingvip';
		 }else {
			 $stripePlan = 'newvip';
		 }
		 
		 //Create sub
		 $user->subscription($stripePlan)->create($vipSignup['stripeToken'], [
		    'email' => $user->email, 'description' => 'P4/7 VIP Signup'
		 ]);
		 
		 //Send an email to the new vip...
		$data['title'] = 'Thank You for Signing Up!';
		$data['mainMsg'] = '<p>Thank you for your Plenty4/7 VIP Membership purchase. You may start using your membership immediately. You will receive your card in the mail soon. Please take your physical card to any location that you have purchased a deal from for verification purposes.</p>';
		$data['actionButton'] = false;
		
		Mail::send('email.transactional', $data, function ($message) use ($user) {
			
			//Grab the user object...

		    $message->from('no-reply@plenty47.com', 'Plenty4/7');
			$message->to($user->email);
			$message->subject('P4/7 VIP Signup Confirmation');
		});
		
		//Send an email to the admins...
		$data['title'] = 'A New VIP Has Signed Up';
		$data['mainMsg'] = 'A new vip has signed up. They are benefiting the charity: '.$fundraiser->groupName.'. Make sure that you take any actions necessary to notify / compensate them for the VIP purchase!';
		$data['actionButton'] = true;
		$data['actionButtonLink'] = url('/admin');
		$data['actionButtonLabel'] = 'Admin Dashboard';
		
		Mail::send('email.transactional', $data, function ($message) {
			
		    $message->from('no-reply@plenty47.com', 'Plenty4/7');
			$message->to(config('app.adminEmail'));
			$message->subject('P4/7 VIP Signup Notification');
		});

		 
		return redirect('/vip-signup/success');
		 
		 
	 }
	 
	function signupSuccess()
	{
		 
		//Give the page a meta title
		$data['title'] = 'VIP Signup Success | Plenty4/7';

		return view('vip.signupSuccess', $data);
	}
	
	//Save Recommendations....
	function saveRecommendation(Request $request)
	{
		if($request->state == 0) {
			//create a new one...
			VendorRecommendation::create([
	            'user_id' => $request->userId,
	            'vendor_id' => $request->vendorId
	        ]);
		}else {
			//Delete this one...
			VendorRecommendation::where('user_id', $request->userId)->where('vendor_id', $request->vendorId)->delete();
		}
		
		return 'done!';
	}
	
	//Save Recommendations....
	function saveBookmark(Request $request)
	{
		if($request->state == 0) {
			//create a new one...
			VendorBookmark::create([
	            'user_id' => $request->userId,
	            'vendor_id' => $request->vendorId
	        ]);
		}else {
			//Delete this one...
			VendorBookmark::where('user_id', $request->userId)->where('vendor_id', $request->vendorId)->delete();
		}
		
		return 'done!';
	}
	
	//VIP Account Dashboard
	function myAccount() 
	{
		
		if(Session::has('vipSuspended')) {
			return redirect('/my-account/suspended');
		}
		
		$data['activePage'] = 'dashboard';
		
		$data['user'] = Auth::user();
		
		if($data['user']->userType == 'vip') {
			
			//Grab the vip...
			$data['vip'] = Vip::where('user_id', $data['user']->id)->firstOrFail();
			
			//Load its fundraiser
			$data['vip']['fundraiser'] = Fundraiser::find($data['vip']->fundraiser_id);
			
			//determine what profile image to use...
			if($data['vip']->profileImage) {
				$data['profileImage'] = asset('/uploads/'.$data['vip']->profileImage);
			}else {
				$data['profileImage'] = asset('/assets/img/default-profile-image.jpg');
			}
			
			//Grab their recommendations and bookmarks...
			$data['vip']['recommendations'] = VendorRecommendation::where('user_id', $data['user']->id)->get();
			$data['vip']['bookmarks'] = VendorBookmark::where('user_id', $data['user']->id)->get();
			
			//Grab all the vendors for the recommendations...
			$data['recommendedVendors'] = array();
			foreach($data['vip']['recommendations'] as $rec) {
				$vendor = Vendor::where('id', $rec->vendor_id)->with('deals', 'market')->get();
				if(count($vendor) > 0) {
					array_push($data['recommendedVendors'], $vendor[0]);	
				}
			}
			
			//Grab all the vendors for the bookmarks...
			$data['bookmarkedVendors'] = array();
			foreach($data['vip']['bookmarks'] as $rec) {
				$vendor = Vendor::where('id', $rec->vendor_id)->with('deals', 'market')->get();
				if(count($vendor) > 0) {
					array_push($data['bookmarkedVendors'], $vendor[0]);	
				}
			}

			
			//Give the page a meta title
		    $data['title'] = 'My VIP Dashboard | Plenty4/7';
		    
	        return view('vip.profile', $data);
			
			
		}else {
			return abort(401);
		}
	}
	
	//VIP Account Dashboard
	function myAccountSettings() 
	{
		
		if(Session::has('vipSuspended')) {
			return redirect('/my-account/suspended');
		}
		
		$data['user'] = Auth::user();
		
		$data['user']->load('addresses');
		
		if($data['user']->userType == 'vip') {
			
			//Grab the vip...
			$data['vip'] = Vip::where('user_id', $data['user']->id)->firstOrFail();
			
			//Load its fundraiser
			$data['vip']['fundraiser'] = Fundraiser::find($data['vip']->fundraiser_id);
			
			//determine what profile image to use...
			if($data['vip']->profileImage) {
				$data['profileImage'] = asset('/uploads/'.$data['vip']->profileImage);
			}else {
				$data['profileImage'] = asset('/assets/img/default-profile-image.jpg');
			}
			
			//Grab their recommendations and bookmarks...
			$data['vip']['recommendations'] = VendorRecommendation::where('user_id', $data['user']->id)->get();
			$data['vip']['bookmarks'] = VendorBookmark::where('user_id', $data['user']->id)->get();
			
			//Give the page a meta title
		    $data['title'] = 'My VIP Dashboard | Plenty4/7';
		    
		    $data['activePage'] = 'settings';
		    
	        return view('vip.settings', $data);
			
			
		}else {
			return abort(401);
		}
	}
	
	public function changeAvatar(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Grab the vip info
	    $vip = Vip::where('user_id', $user_id)->get();
	    
	    $vip[0]->avatar = $request->avatar;
	    $vip[0]->save();

	    
	    //Crop the logo to 200x200
		$filename = $request->avatar;
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
	    $vip = Vip::where('user_id', $user_id)->get();
	    
	    $vip[0]->profileImage = $request->profileImage;
	    $vip[0]->save();

	    
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
    
    public function saveMyAccountSettings(Request $request) {
	    
	    //Get the user...
	    $user = Auth::user();
	    
	    //save the billing address...
	    $address = Address::find($request->address_id);
	    $address['address'] = $request->address;
	    $address['address2'] = $request->address2;
	    $address['city'] = $request->city;
	    $address['state'] = $request->state;
	    $address['zipcode'] = $request->zipcode;
	    
	    $address->save();
	    
	    Session::flash('success', 'You have successfully updated your account settings!');
	    
	    return redirect('/my-account/settings');
	    
    }
    
    //VIP Account Dashboard
	function myAccountRecommendations() 
	{
		
		if(Session::has('vipSuspended')) {
			return redirect('/my-account/suspended');
		}
		
		$data['user'] = Auth::user();
		
		$data['activePage'] = 'recs';
		
		if($data['user']->userType == 'vip') {
			
			//Grab the vip...
			$data['vip'] = Vip::where('user_id', $data['user']->id)->firstOrFail();
			
			//Load its fundraiser
			$data['vip']['fundraiser'] = Fundraiser::find($data['vip']->fundraiser_id);
			
			//determine what profile image to use...
			if($data['vip']->profileImage) {
				$data['profileImage'] = asset('/uploads/'.$data['vip']->profileImage);
			}else {
				$data['profileImage'] = asset('/assets/img/default-profile-image.jpg');
			}
			
			//Grab their recommendations and bookmarks...
			$data['vip']['recommendations'] = VendorRecommendation::where('user_id', $data['user']->id)->get();
			$data['vip']['bookmarks'] = VendorBookmark::where('user_id', $data['user']->id)->get();
			
			//Grab all the vendors for the recommendations...
			$data['recommendedVendors'] = array();
			foreach($data['vip']['recommendations'] as $rec) {
				$vendor = Vendor::where('id', $rec->vendor_id)->with('deals', 'market')->get();
				if(count($vendor) > 0) {
					array_push($data['recommendedVendors'], $vendor[0]);	
				}
			}
			
			//Grab all the vendors for the bookmarks...
			$data['bookmarkedVendors'] = array();
			foreach($data['vip']['bookmarks'] as $rec) {
				$vendor = Vendor::where('id', $rec->vendor_id)->with('deals', 'market')->get();
				if(count($vendor) > 0) {
					array_push($data['bookmarkedVendors'], $vendor[0]);	
				}
			}

			
			//Give the page a meta title
		    $data['title'] = 'My VIP Dashboard | Plenty4/7';
		    
	        return view('vip.recommendations', $data);
			
			
		}else {
			return abort(401);
		}
	}
	
	public function myAccountSuspended()
	{
		$data['user'] = Auth::user();
		
		
		if($data['user']->userType == 'vip') {
			
			//Grab the vip...
			$data['vip'] = Vip::where('user_id', $data['user']->id)->firstOrFail();
			
			//Load its fundraiser
			$data['vip']['fundraiser'] = Fundraiser::find($data['vip']->fundraiser_id);
			
			//determine what profile image to use...
			if($data['vip']->profileImage) {
				$data['profileImage'] = asset('/uploads/'.$data['vip']->profileImage);
			}else {
				$data['profileImage'] = asset('/assets/img/default-profile-image.jpg');
			}
			
			//Grab the cost of the sub
		    $data['cost'] = env('VIP_COST');
		    
		    //Get stripe config items
		    $data['stripe'] = config('services.stripe');


			
			//Give the page a meta title
		    $data['title'] = 'VIP Account Suspended | Plenty4/7';
		    
	        return view('vip.suspended', $data);
			
			
		}else {
			return abort(401);
		}

	}
	
	public function cancelMembership()
	{
		$data['user'] = Auth::user();
		
		
		if($data['user']->userType == 'vip') {
			
			//Grab the vip...
			$data['vip'] = Vip::where('user_id', $data['user']->id)->firstOrFail();
			
			//Load its fundraiser
			$data['vip']['fundraiser'] = Fundraiser::find($data['vip']->fundraiser_id);
			
			//determine what profile image to use...
			if($data['vip']->profileImage) {
				$data['profileImage'] = asset('/uploads/'.$data['vip']->profileImage);
			}else {
				$data['profileImage'] = asset('/assets/img/default-profile-image.jpg');
			}

			
			//Give the page a meta title
		    $data['title'] = 'Cancel VIP Account | Plenty4/7';
		    
	        return view('vip.cancel', $data);
			
			
		}else {
			return abort(401);
		}
	}
	
	public function confirmCancelMembership()
	{
		$user = Auth::user();
		$user->subscription()->cancel();
		return redirect('/my-account');
	}
	
	public function renewMembership(Request $request)
	{
		$user = Auth::user();
		
		//Create sub
		 $user->subscription('newvip')->create($request->stripeToken, [
		    'email' => $user->email, 'description' => 'P4/7 VIP Renewal'
		 ]);
		 
		 //Send an email to the new vip...
		$data['title'] = 'Thank You for Renewing!';
		$data['mainMsg'] = '<p>Thank you for your Plenty4/7 VIP Membership renewal. You may start using your membership immediately.</p>';
		$data['actionButton'] = false;
		
		Mail::send('email.transactional', $data, function ($message) use ($user) {
			
			//Grab the user object...

		    $message->from('no-reply@plenty47.com', 'Plenty4/7');
			$message->to($user->email);
			$message->subject('P4/7 VIP Renewal Confirmation');
		});
		
		Session::forget('vipSuspended');
		
		return redirect('/my-account');

	}
    
}
