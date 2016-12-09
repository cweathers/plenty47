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

class MaintenanceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cleanDeals()
    {
        $deals = VendorDeal::all();
        $vendor_ids = array();
        foreach($deals as $deal) {
	        array_push($vendor_ids, $deal->vendor_id);
        }
        
        $delete_deals = array();
        foreach($vendor_ids as $id) {
	        $vendor = Vendor::find($id);
	        if(empty($vendor)) {
		        array_push($delete_deals, $id);
	        }
        }
        
        foreach($delete_deals as $key => $value) {
	        VendorDeal::where('vendor_id', $value)->delete();
        }
        
        return 'maintenance task executed successfully on : '.date('F j, Y').' @ '.date('H:i:s');
   
    }

   
}
