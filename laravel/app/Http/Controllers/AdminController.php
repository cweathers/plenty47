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
use App\User;
use App\Vendor;
use App\Categories;
use App\VendorHour;
use App\VendorDeal;
use App\Fundraiser;
use App\FundraisingCategories;
use App\CardNumber;
use App\SocialSettings;
use App\Vip;
use App\AdvancedPage;
use App\AdvancedContentList;

class AdminController extends Controller
{
	
	public function __construct() {
        $data['socialSettings'] = SocialSettings::all();
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'dash';
			
			//Title the page
			$data['pageTitle'] = 'Plenty4/7 Admin Dashboard';
			
			
			return view('admin/dashboard', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
    }
    
    //Manage Admins
    public function administrators() {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'admins';
			
			//Title the page
			$data['pageTitle'] = 'Manage P4/7 Administrators';
			
			//Grab all the admins
			$data['admins'] = User::where('userType', 'admin')->get();
			
			return view('admin/administrators/index', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
	    
    }
    
    //Add Administrator
    public function addAdmin(Request $request)
    {
	    //Create an admin
	    $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userType' => $request->userType
        ]);
        
        //Should we email the admin their password?
        if($request->sendInfo == 1) {
	        
	        $email = $request->email;
	        
	        //Send an email to the new vendor...
			$data['title'] = 'Your Plenty4/7 Admin Account Info';
			$data['mainMsg'] = '<p>You have been added as an administrator to Plenty4/7. To log in, please click the login button below. Your account information is as follows:</p><p>Email: '.$request->email.'<br />Password: '.$request->password.'</p>';
			$data['actionButton'] = true;
			$data['actionButtonLink'] = url('/admin');
			$data['actionButtonLabel'] = 'Administrator Login';
			
			Mail::send('email.transactional', $data, function ($message) use ($email) {
	
			    $message->from('no-reply@plenty47.com', 'Plenty4/7');
				$message->to($email);
				$message->subject('Your Plenty4/7 Admin Account Info');
			});

        }
        
        //Grab a refreshed version of the table...
        $data['admins'] = User::where('userType', 'admin')->get();
        
        //Refresh the view...
        return view('admin/administrators/partials/adminTable', $data)->render();
        
    }
    
    public function getAdminDetails(Request $request)
    {
	    //Get the admin...
	    $data['admin'] = User::find($request->id);
	    
	    //Grab the form...
	    return view('admin/administrators/partials/editAdminForm', $data);
	    
    }
    
    //Add Administrator
    public function editAdmin(Request $request)
    {
	    //Create an admin
	    $admin = User::find($request->user_id);
	    
	    $admin->email = $request->email;
	    
	    if($request->password) {
	    	$admin->password = bcrypt($request->password);
	    }
	    
	    $admin->save();
	            
        //Should we email the admin their password?
        if($request->sendInfo == 1) {
	        
	        $email = $request->email;
	        
	        //Send an email to the new vendor...
			$data['title'] = 'Your Plenty4/7 Admin Account Updated';
			$data['mainMsg'] = '<p>You P4/7 admin account has been updated. To log in, please click the login button below. Your account information is as follows:</p><p>Email: '.$request->email.'<br />Password: '.$request->password.'</p>';
			$data['actionButton'] = true;
			$data['actionButtonLink'] = url('/admin');
			$data['actionButtonLabel'] = 'Administrator Login';
			
			Mail::send('email.transactional', $data, function ($message) use ($email) {
	
			    $message->from('no-reply@plenty47.com', 'Plenty4/7');
				$message->to($email);
				$message->subject('Your Plenty4/7 Admin Account Updated');
			});

        }
        
        //Grab a refreshed version of the table...
        $data['admins'] = User::where('userType', 'admin')->get();
        
        //Refresh the view...
        return view('admin/administrators/partials/adminTable', $data)->render();
        
    }
    
    //Delete an admin
    public function deleteAdmin(Request $request)
    {
	    //delete the admin
	    User::destroy($request->id);
	    
	    //Grab a refreshed version of the table...
        $data['admins'] = User::where('userType', 'admin')->get();
        
        //Refresh the view...
        return view('admin/administrators/partials/adminTable', $data)->render();
    }
    
    //Manage Vendors
    public function vendors() {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'vendors';
			
			//Title the page
			$data['pageTitle'] = 'Manage P4/7 Vendors';
			
			//Grab all the vendors
			$data['vendors'] = Vendor::orderBy('created_at', 'desc')->get();
			
			return view('admin/vendors/index', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
	    
    }
    
    //Get Vendor details
    public function getVendorDetails(Request $request)
    {
	    //Get the admin...
	    $data['vendor'] = Vendor::find($request->id);
	    $data['vendor']->load('facts');
	    
	    //Get Categories
	    $data['categories'] = Categories::all();
	    
	    //Grab the form...
	    return view('admin/vendors/partials/editVendorForm', $data);
	    
    }
    
    public function newFact(Request $request) {
	    //First create a new user with the userType of "vendor"
	    
	    //Set the user id
	    $id = $request->id;
	    
	    //Grab the vendor info
	    $vendor = Vendor::find($id);

	    VendorFact::create([
		    'vendor_id' => $vendor->id,
            'fact' => $request->fact
        ]);
	    return 'fact created';
    }
    
    public function changeLogo(Request $request) {
	    
	    //Set the user id
	    $user_id = $request->id;
	    
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
    
    public function updateVendor(Request $request) {
    
    	//Set the user id
	    $user_id = $request->user_id;
	    
	    //Grab the vendor info
	    $vendor = Vendor::find($user_id);
	    
	    $vendor->companyName = $request->companyName;
		$vendor->category = $request->category;
		$vendor->phone = $request->phone;
		$vendor->address = $request->address;
		$vendor->address2 = $request->address2;
		$vendor->city = $request->city;
		$vendor->state = $request->state;
		$vendor->zipcode = $request->zipcode;
		$vendor->vimeo_id = $request->vimeo_id;
		
		$vendor->save();

		//Delete all facts for vendor 
	    VendorHour::where('vendor_id', $vendor->id)->delete();
	    
	    //Now add the hours...
		$count = count($request->hours);
		$i = 0;
		if($count > 0) {
			while($i <= $count - 1) {
				//First create a new user with the userType of "vendor"
			    VendorHour::create([
				    'vendor_id' => $vendor->id,
		            'label' => $request->label[$i],
		            'hours' => $request->hours[$i]
		        ]);
		        $i++;
			}
		}
		
	    //Grab all the deal categoies...
	    $data['categories'] = Categories::all();
	    
	    //Grab all the vendors
		$data['vendors'] = Vendor::orderBy('created_at', 'desc')->get();
	    
	    return view('admin/vendors/partials/vendorTable', $data);
	    
	}
	
	//Delete a vendor
    public function deleteVendor(Request $request)
    {
	    //delete the vendor
	    Vendor::destroy($request->id);
	    
	    //Delete all the vendor deals
	    VendorDeal::where('vendor_id', $request->id)->delete();
	    
	    //Grab all the vendors
		$data['vendors'] = Vendor::orderBy('created_at', 'desc')->get();
			
		return view('admin/vendors/partials/vendorTable', $data);
    }
    
    //Set the vendors status
    public function setVendorStatus(Request $request)
    {
	    $vendor = Vendor::find($request->id);
	    $vendor->active = $request->status;
	    $vendor->save();
	    return 'status saved';
    }
    
    //Manage Vendor Deals
    public function deals(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'deals';
			
			//Title the page
			$data['pageTitle'] = 'Manage P4/7 Deals';
			
			//Grab all the vendor deals
			if(isset($_GET['vendor_id'])) {
				$data['deals'] = VendorDeal::where('vendor_id', $_GET['vendor_id'])->orderBy('created_at', 'desc')->get();
				$data['deals']->load('vendor');
			}else {
				$data['deals'] = VendorDeal::orderBy('created_at', 'desc')->get();
				$data['deals']->load('vendor');
			}
			
			return view('admin/deals/index', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
	    
    }
    
    public function getDealDetails(Request $request)
    {
	    //Get the admin...
	    $data['deal'] = VendorDeal::find($request->id);
	    $data['deal']->load('vendor');
	    
	    //Grab the form...
	    return view('admin/deals/partials/editDealForm', $data);
	    
    }
    
    public function saveDealChanges(Request $request)
    {
    
	    
	    //Grab the vendor info
	    $vendor = Vendor::find($request->vendor_id);
	    
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
	    $vendorDeal->featuredDeal = $request->featuredDeal;
	    $vendorDeal->featuredExpiration = date('Y-m-d H:i:s', strtotime($request->featuredExpiration));
	    
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
		
		Session::flash('success', 'The Deal has been saved. If you would like to view only that vendors deals, <a href="/admin/deals?vendor_id='.$request->vendor_id.'" class="alert-link">click here to filter the list below.</a>');
		
		return redirect('/admin/deals');
		
	}
	
	//Delete a deal
    public function deleteDeal(Request $request)
    {
	    //delete the vendor
	    VendorDeal::destroy($request->id);
	    
	    //Grab all the vendor deals
		$data['deals'] = VendorDeal::orderBy('created_at', 'desc')->get();
		$data['deals']->load('vendor');
			
		return view('admin/deals/partials/dealsTable', $data);
    }
	
	//Manage Fundraising Groups
    public function fundraisers(Request $request) {
	    
	    //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'fundraisers';
			
			//Title the page
			$data['pageTitle'] = 'Manage P4/7 Fundraising Groups';
			
			//Grab all the vendor deals
			$data['fundraisers'] = Fundraiser::orderBy('created_at', 'desc')->get();
			
			return view('admin/fundraisers/index', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
	    
    }
    
    //Grab the fundraiser details
    public function getFundraiserDetails(Request $request)
    {
	    //Get the fundraiser...
	    $data['fundraiser'] = Fundraiser::find($request->id);
	    
	    //Get all the fundraising categories
	    $data['categories'] = FundraisingCategories::all();
	    
	    //Grab the form...
	    return view('admin/fundraisers/partials/editFundraiserForm', $data);
	    
    }
    
    public function fundraiserChangeLogo(Request $request) {
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::find($request->id);
	    
	    $fundraiser->logo = $request->logo;
	    $fundraiser->save();

	    
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
    
    public function fundraiserStatus($id, $status)
    {
	    $fundraiser = Fundraiser::find($id);
	    if($status == 1) {
		    $statCode = 'active';
		    $active = 1;
	    }else {
		    $statCode = 'inactive';
		    $active = 0;
	    }
	    
	    
	    $fundraiser->active = $active;
	    
	    $fundraiser->save();
	    
	    Session::flash('success', 'You have successfully changed the status of the fundraising group, "'.$fundraiser->groupName.'" to: '.$statCode);
	    return redirect('/admin/fundraisers');
    }
    
    public function changeProfileImage(Request $request) {
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::find($request->id);
	    
	    $fundraiser->profileImage = $request->profileImage;
	    $fundraiser->save();

	    
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
    
    public function saveFundraiserChanges(Request $request) {
	    
	    //Grab the fundraiser info
	    $fundraiser = Fundraiser::find($request->id);
	    
	    $fundraiser->groupName = $request->groupName;
		$fundraiser->category = $request->category;
		$fundraiser->phone = $request->phone;
		$fundraiser->address = $request->address;
		$fundraiser->address2 = $request->address2;
		$fundraiser->city = $request->city;
		$fundraiser->state = $request->state;
		$fundraiser->zipcode = $request->zipcode;
		
		$fundraiser->save();
		
		Session::flash('success', 'The Fundraiser has been updated.');
				
	    return redirect('admin/fundraisers');
	    
    }
    
    //Delete a fundraiser
    public function deleteFundraiser(Request $request)
    {
	    //delete the vendor
	    Fundraiser::destroy($request->id);
	    
	    //Grab all the vendor fundraisers
	    $data['fundraisers'] = Fundraiser::orderBy('created_at', 'desc')->get();
			
		return view('admin/fundraisers/partials/fundraisersTable', $data);
    }
    
    //Card Administration
    public function cards()
    {
        //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'cards';
			
			//Title the page
			$data['pageTitle'] = 'Plenty4/7 Card Number Administration';
			
			//Grab all the cards...
			$data['cards'] = CardNumber::all();
			
			$data['cards']->load('fundraiser');
			
			
			return view('admin/cards/index', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
    }
    
    public function createCards()
    {
        //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'cards';
			
			//Title the page
			$data['pageTitle'] = 'Create A Batch of Cards';
			
			
			return view('admin/cards/create', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
    }
    
    public function saveCards(Request $request)
    {
        //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Create cards...
		  	if($request->fundraiser_id) {
		  		$fundraiser_id = $request->fundraiser_id; 
		  	}else {
			  	$fundraiser_id = NULL;
		  	}
		  	
		  	$qty = $request->qty;
		  	
		  	$data['cards'] = $this->createCardFunc($qty, $fundraiser_id);
		  	
		  	//save these cards to the session...
		  	
		  	$filename = 'card_numbers_'.uniqid().'.csv';
		  	$filepath = public_path().'/exports/'.$filename;
		  	
		  	$out = fopen($filepath, 'w');
			
			foreach ($data['cards'] as $card) {
				
				if(isset($card->fundraiser->groupName)) {
					$fundraiser = $card->fundraiser->groupName;
				}else {
					$fundraiser = '';
				}
				
				$array = array(
					'number' => $card->number,
					'fundraiser' => $fundraiser
				);
				
			    fputcsv($out, $array, chr(9));
			}
			
			fclose($out);
			
			//save the filename to the session
			Session::put('latestDownload', $filename);
		  	
		  	//Set the currentPage
			$data['currentPage'] = 'cards';
			
			//Title the page
			$data['pageTitle'] = 'Plenty4/7 Card Number Administration';
		  	
		  	return view('admin/cards/createSuccess', $data);
		  	
		  	
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
    }
    
    function createCardFunc($qty, $fundraiser_id)
    {
	    
	    $cardArray = array();
		$i = 1;
		while($i <= $qty) {
			
			$one = mt_rand(1000, 9999);
			$two = mt_rand(1000, 9999);
			$three = mt_rand(1000, 9999);
			$four = mt_rand(1000, 9999);
			
			$num = $one.'-'.$two.'-'.$three.'-'.$four;
			
			//Check if this is used already...
			$used = CardNumber::where('number', $num)->get();
			
			if(count($used) == 0) {
			
				//Create a card
				$card = CardNumber::create([
		            'number' => $num,
		            'fundraiser_id' => $fundraiser_id
		        ]);
		        
		        $card->load('fundraiser');
				
				array_push($cardArray, $card);
				
				$i++;
			}
		}
		
		return $cardArray;
		
    }
    
    public function searchFundraisers(Request $request)
    {
	    $term = $_GET['term'];
	    
	    $results = Fundraiser::where('groupName', 'LIKE', '%'.$term.'%')->get()->toArray();
	    
	    $array = array();
	    
	    foreach($results as $r) {
		    $temp = array(
			    'label' => $r['groupName'],
			    'id' => $r['id']
		    );
		    array_push($array, $temp);
	    }
	    
	    return json_encode($array);
	    
    }
    
    public function downloadAllCards(Request $request)
    {
	    
	    $cards = CardNumber::all();
	    
    	$filename = 'card_numbers_'.uniqid().'.csv';
	  	
	  	header( 'Content-Type: text/csv' );
        header( 'Content-Disposition: attachment;filename='.$filename);
        $out = fopen('php://output', 'w');
		
		foreach ($cards as $card) {
			
			if($card->fundraiser->groupName) {
				$fundraiser = $card->fundraiser->groupName;
			}else {
				$fundraiser = '';
			}
			
			$array = array(
				'number' => $card->number,
				'fundraiser' => $fundraiser
			);
			
		    fputcsv($out, $array, chr(9));
		}
		
		fclose($out);
    }
    
    public function deleteCard($id)
    {
	    //delete the admin
	    CardNumber::destroy($id);
	    
	    Session::flash('success', 'The card has been successfully deleted.');
	    
	    return redirect('/admin/cards');
    }
    
    /**
     * VIP Management
     */
    public function vips()
    {
        //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		    
		    //Grab all the vips
		    $data['vips'] = Vip::all();
		    $data['vips']->load('user', 'fundraiser', 'salesperson');
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'dash';
			
			//Title the page
			$data['pageTitle'] = 'Plenty4/7 VIP Administration';
			
			
			return view('admin.vips.index', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
    }
    
    //Delete an admin
    public function deleteVip(Request $request)
    {
	    
	    //Grab the vip...
	    $vip = Vip::find($request->id);
	    
	    //Delete the user...
	    User::where('id', $vip->user_id)->delete();
	    
	    //delete the admin
	    Vip::destroy($request->id);
	    
	    //Grab a refreshed version of the table...
	    $data['vips'] = Vip::all();
	    $data['vips']->load('user', 'fundraiser', 'salesperson');			
		
		return view('admin.vips.partials.vipTable', $data);

    }
    
    public function getVipDetails(Request $request)
    {
	    //Get the admin...
	    $data['vip'] = Vip::find($request->id);
	    $data['vip']->load('user', 'fundraiser', 'salesperson');
	    
	    //Grab the form...
	    return view('admin/vips/partials/editVipForm', $data);
	    
    }


}
