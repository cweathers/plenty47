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
use App\SimplePage;
use App\AdvancedPage;
use App\AdvancedContentList;
use App\HomePageContent;

class ContentController extends Controller
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
	    
	    $data['socialSettings'] = SocialSettings::all();
	    
        //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'content';
			
			//Title the page
			$data['pageTitle'] = 'Plenty4/7 Content Management';
			
			
			return view('admin/content/index', $data);
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
    }
    
    public function deleteSetting(Request $request)
    {
	    SocialSettings::destroy($request->id);
	    return 'done!';
    }
    
    public function saveSetting(Request $request)
    {
	    
	    if($request->type == 'new') {
		    SocialSettings::create([
	            'icon' => $request->icon,
	            'link' => $request->link
	        ]);
	    }else {
		    $setting = SocialSettings::find($request->id);
		    $setting->icon = $request->icon;
		    $setting->link = $request->link;
		    $setting->save();
	    }
	    
	    return 'done!';
    }
    
    public function managePage($slug)
    {
	    
        //Set the user id
	    $user_id = Auth::id();
	    
	    //Get the user object...
	    $user = User::find($user_id);
	    
	    if($user->userType === 'admin') {
		  	
		  	//Set the user object
			$data['user'] = $user;
			
			//Set the currentPage
			$data['currentPage'] = 'content';
			
			//Title the page
			$data['pageTitle'] = 'Plenty4/7 Content Management';
			
			//What kind of page is it?
			if($slug == 'about-us' || $slug == 'terms' || $slug == 'legal') {
				
				//Grab the page data
				$data['content'] = SimplePage::where('slug', $slug)->first();
				
				//Title the page
				$data['pageTitle'] = 'Plenty4/7 Content Management';
			
			
				return view('admin/content/simplePage', $data);
				
			}elseif($slug == 'vendors' || $slug == 'fundraisers' || $slug == 'trade-show-organizations') {
				
				//Grab the page data
				$data['content'] = AdvancedPage::where('slug', $slug)->first();
				
				$data['lists'] = AdvancedContentList::where('advanced_page_id', $data['content']->id)->get();
				
				//Title the page
				$data['pageTitle'] = 'Plenty4/7 Content Management';
			
				return view('admin/content/advancedPage', $data);
				
			}elseif($slug == 'home') {
				
				//Grab the page data
				$data['content'] = HomePageContent::find(1);
				
				//Title the page
				$data['pageTitle'] = 'Plenty4/7 Content Management';
			
				return view('admin/content/homePage', $data);
				
			}
		  
	    }else {
		    abort(403, 'You do not have access to this.');
	    }
    }
    
    public function saveSimplePage(Request $request, $slug)
    {
	    //Grab the page data
		$content = SimplePage::where('slug', $slug)->first();
		$content->heading = $request->heading;
		$content->subheading = $request->subheading;
		$content->content = $request->content;
		$content->save();
		
		Session::flash('success', 'You have successfully saved the page changes!');
		
		return redirect('/manage-page/'.$slug);
    }
    
    public function deleteListItem(Request $request)
    {
	    AdvancedContentList::destroy($request->id);
	    return 'done!';
    }
    
    public function saveListItem(Request $request)
    {
	    
	    
	    if($request->type == 'new') {
		    AdvancedContentList::create([
	            'advanced_page_id' => $request->advanced_page_id,
	            'show_number' => $request->show_number,
	            'content' => $request->content
	        ]);
	    }else {
		    $listItem = AdvancedContentList::find($request->id);
		    $listItem->show_number = $request->show_number;
		    $listItem->content = $request->content;
		    $listItem->save();
	    }
	    
	    return 'done!';
    }
    
    public function saveAdvancedPage(Request $request, $slug)
    {
	    
	    $advancedPage =  AdvancedPage::where('slug', $slug)->first();
	    
	    
	    $temp = array(
	    	'top_section_image',
	    	'qs_left_icon',
	    	'qs_left_image',
	    	'qs_leftMiddle_icon',
	    	'qs_leftMiddle_image',
	    	'qs_rightMiddle_icon',
	    	'qs_rightMiddle_image',
	    	'qs_right_icon',
	    	'qs_right_image',
	    	'bottom_section_left_image',
	    	'bottom_bg_section_image'
	    );
	    
	    foreach($temp as $key => $value) {
	    
		    //Top Section image...
		    $image = '';
		    $contentBlock = $value;
		    
		    //Does the request even have a file for this?
		    if($request->hasFile($contentBlock)) {
			    
			    //Create a unique image name
			    $imageName = uniqid().'-'.uniqid().'.'.$request->file($contentBlock)->getClientOriginalExtension();
				
				//Move the file to the appropriate place
			    $request->file($contentBlock)->move(public_path().'/contentUploads/', $imageName);
			    
			    $advancedPage->{$contentBlock} = $imageName;
			    $advancedPage->save();
			    
		    }
		
		}
		
		//Add the rest of the fields...
        $advancedPage->top_section_heading = $request->top_section_heading;
        $advancedPage->top_section_subheading = $request->top_section_subheading;
        $advancedPage->top_section_text = $request->top_section_text;
        $advancedPage->top_section_button_text = $request->top_section_button_text;
        $advancedPage->top_section_button_link = $request->top_section_button_link;
        $advancedPage->top_section_button_text_2 = $request->top_section_button_text_2;
        $advancedPage->top_section_button_link_2 = $request->top_section_button_link_2;
        $advancedPage->blue_section_heading = $request->blue_section_heading;
        $advancedPage->qs_left_heading = $request->qs_left_heading;
        $advancedPage->qs_left_subheading = $request->qs_left_subheading;
        $advancedPage->qs_leftMiddle_heading = $request->qs_leftMiddle_heading;
        $advancedPage->qs_leftMiddle_subheading = $request->qs_leftMiddle_subheading;
        $advancedPage->qs_rightMiddle_heading = $request->qs_rightMiddle_heading;
        $advancedPage->qs_rightMiddle_subheading = $request->qs_rightMiddle_subheading;
        $advancedPage->qs_right_heading = $request->qs_right_heading;
        $advancedPage->qs_right_subheading = $request->qs_right_subheading;
        $advancedPage->extra_section_active = $request->extra_section_active;
        $advancedPage->extra_section_left = $request->extra_section_left;
        $advancedPage->extra_section_right = $request->extra_section_right;
        $advancedPage->extra_section_bg_color = $request->extra_section_bg_color;
        $advancedPage->bottom_section_active = $request->bottom_section_active;
        $advancedPage->bottom_section_left = $request->bottom_section_left;
        $advancedPage->bottom_section_bg_color = $request->bottom_section_bg_color;
        $advancedPage->bottom_bg_section_active = $request->bottom_bg_section_active;
        $advancedPage->bottom_bg_section_left = $request->bottom_bg_section_left;
        $advancedPage->bottom_bg_section_right = $request->bottom_bg_section_right;
        $advancedPage->last_section_active = $request->last_section_active;
        $advancedPage->last_section_left = $request->last_section_left;
        $advancedPage->last_section_right = $request->last_section_right;
        $advancedPage->save();
		
		Session::flash('success', 'You have successfully saved the page changes.');
		
		return redirect('/manage-page/'.$slug);
    }
    
    public function saveHomePage(Request $request, $slug)
    {
	    
	    $homePage =  HomePageContent::find(1);
	    
	    
	    $temp = array(
	    	'slide_1_bg_image',
	    	'slide_2_bg_image',
	    	'slide_3_bg_image',
	    	'merchant_icon',
	    	'fundraiser_icon',
	    	'tradeshow_icon'
	    );
	    
	    foreach($temp as $key => $value) {
	    
		    //Top Section image...
		    $image = '';
		    $contentBlock = $value;
		    
		    //Does the request even have a file for this?
		    if($request->hasFile($contentBlock)) {
			    
			    //Create a unique image name
			    $imageName = uniqid().'-'.uniqid().'.'.$request->file($contentBlock)->getClientOriginalExtension();
				
				//Move the file to the appropriate place
			    $request->file($contentBlock)->move(public_path().'/contentUploads/', $imageName);
			    
			    $homePage->{$contentBlock} = $imageName;
			    $homePage->save();
			    
		    }
		
		}
		
		//Add the rest of the fields...
		$homePage->vimeo_id = $request->vimeo_id;
        $homePage->slide_1_heading = $request->slide_1_heading;
        $homePage->slide_1_subheading = $request->slide_1_subheading;
        $homePage->slide_1_text = $request->slide_1_text;
        $homePage->slide_1_btns = $request->slide_1_btns;
        $homePage->slide_2_heading = $request->slide_2_heading;
        $homePage->slide_2_subheading = $request->slide_2_subheading;
        $homePage->slide_2_text = $request->slide_2_text;
        $homePage->slide_2_btns = $request->slide_2_btns;
        $homePage->slide_3_heading = $request->slide_3_heading;
        $homePage->slide_3_subheading = $request->slide_3_subheading;
        $homePage->slide_3_text = $request->slide_3_text;
        $homePage->slide_3_btns = $request->slide_3_btns;
        $homePage->merchant_heading = $request->merchant_heading;
        $homePage->merchant_subheading = $request->merchant_subheading;
        $homePage->merchant_text = $request->merchant_text;
        $homePage->merchant_button_text = $request->merchant_button_text;
        $homePage->fundraiser_heading = $request->fundraiser_heading;
        $homePage->fundraiser_subheading = $request->fundraiser_subheading;
        $homePage->fundraiser_text = $request->fundraiser_text;
        $homePage->fundraiser_button_text = $request->fundraiser_button_text;
        $homePage->tradeshow_heading = $request->tradeshow_heading;
        $homePage->tradeshow_subheading = $request->tradeshow_subheading;
        $homePage->tradeshow_text = $request->tradeshow_text;
        $homePage->tradeshow_button_text = $request->tradeshow_button_text;
        $homePage->save();
		
		Session::flash('success', 'You have successfully saved the page changes.');
		
		return redirect('/manage-page/'.$slug);
    }
    
}
