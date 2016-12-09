<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Maintenance Routes
Route::get('/maintenance/cleanDeals', 'MaintenanceController@cleanDeals');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Set up static pages for now, replace with CMS later
Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index');
Route::get('/vendors', 'PagesController@vendors');
Route::get('/fundraisers', 'PagesController@fundraisers');
Route::get('/trade-show-organizations', 'PagesController@tradeShows');
Route::get('/search-deals', 'PagesController@searchDeals');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@submitContact');
Route::get('/about-us', 'PagesController@aboutUs');
Route::get('/terms', 'PagesController@terms');
Route::get('/legal', 'PagesController@legal');

//Vendor Pages...
Route::get('/merchant-signup', 'MerchantController@signup');
Route::post('/merchant-signup', 'MerchantController@newMerchant');
Route::put('/merchant-signup/{user_id}/{vendor_id}', 'MerchantController@updateMerchantSignup');
Route::post('/merchant/check-email', 'MerchantController@checkEmail');
Route::get('/merchant-signup/enhance-profile', 'MerchantController@signupStepTwo');
Route::post('/merchant/check-slug', 'MerchantController@checkSlug');
Route::post('/merchant-finalize', 'MerchantController@merchantFinalize');
Route::get('/merchant-dashboard', ['middleware' => 'auth', 'uses' => 'MerchantController@index']);
Route::get('/merchant/{slug}', 'MerchantController@viewMerchant');

//Merchant Administration
Route::post('/merchant/saveFact', 'MerchantController@saveFact');
Route::post('/merchant/deleteFact', 'MerchantController@deleteFact');
Route::post('/merchant/newFact', 'MerchantController@newFact');
Route::post('/merchant/newPhoto', 'MerchantController@newPhoto');
Route::post('/merchant/deletePhoto', 'MerchantController@deletePhoto');
Route::post('/merchant/changeLogo', 'MerchantController@changeLogo');
Route::post('/merchant/updateProfile', 'MerchantController@updateProfile');
Route::post('/merchant/changeProfileImage', 'MerchantController@changeProfileImage');
Route::post('/merchant/addNewDeal', 'MerchantController@addNewDeal');
Route::post('/merchant/deleteDeal', 'MerchantController@deleteDeal');
Route::post('/merchant/editDeal', 'MerchantController@editDeal');
Route::post('/merchant/saveDealChanges', 'MerchantController@saveDealChanges');

//Fundraiser Pages...
Route::get('/fundraiser-signup', 'FundraiserController@signup');
Route::post('/fundraiser-signup', 'FundraiserController@newFundraiser');
Route::put('/fundraiser-signup/{user_id}/{fundraiser_id}', 'FundraiserController@updateFundraiserSignup');
Route::get('/fundraiser-signup/enhance-profile', 'FundraiserController@signupStepTwo');
Route::post('/fundraiser/check-slug', 'FundraiserController@checkSlug');
Route::post('/fundraiser-finalize', 'FundraiserController@fundraiserFinalize');
Route::post('/fundraiser/newPhoto', 'FundraiserController@newPhoto');
Route::get('/fundraiser-dashboard', ['middleware' => 'auth', 'uses' => 'FundraiserController@index']);
Route::get('/fundraiser/{slug}', 'FundraiserController@viewFundraiser');
Route::post('/fundraiser/add-salesperson', 'FundraiserController@addSalesPerson');
Route::get('/fundraiser/delete-salesperson/{id}', 'FundraiserController@deleteSalesPerson');

//Fundraiser Administration...
Route::post('/fundraiser/saveFact', 'FundraiserController@saveFact');
Route::post('/fundraiser/deleteFact', 'FundraiserController@deleteFact');
Route::post('/fundraiser/newFact', 'FundraiserController@newFact');
Route::post('/fundraiser/newPhoto', 'FundraiserController@newPhoto');
Route::post('/fundraiser/deletePhoto', 'FundraiserController@deletePhoto');
Route::post('/fundraiser/changeLogo', 'FundraiserController@changeLogo');
Route::post('/fundraiser/changeProfileImage', 'FundraiserController@changeProfileImage');
Route::post('/fundraiser/updateProfile', 'FundraiserController@updateProfile');
Route::post('/fundraiser/updateAboutUs', 'FundraiserController@updateAboutUs');
Route::post('/fundraiser/updateOurCause', 'FundraiserController@updateOurCause');
Route::post('/fundraiser/updateVideoLink', 'FundraiserController@updateVideoLink');

//Administration 
Route::get('/admin', ['middleware' => 'auth', 'uses' => 'AdminController@vips']);

//Administration...
Route::get('/admin/administrators', ['middleware' => 'auth', 'uses' => 'AdminController@administrators']);
Route::post('/admin/addAdmin', 'AdminController@addAdmin');
Route::post('/admin/getAdminDetails', 'AdminController@getAdminDetails');
Route::post('/admin/editAdmin', 'AdminController@editAdmin');
Route::post('/admin/deleteAdmin', 'AdminController@deleteAdmin');

//Vendors
Route::get('/admin/vendors', 'AdminController@vendors');
Route::post('/admin/getVendorDetails', 'AdminController@getVendorDetails');
Route::post('/admin/changeLogo', 'AdminController@changeLogo');
Route::post('/admin/updateVendor', 'AdminController@updateVendor');
Route::post('/admin/deleteVendor', 'AdminController@deleteVendor');
Route::post('/admin/setVendorStatus', 'AdminController@setVendorStatus');
Route::post('/admin/newFact', 'AdminController@newFact');

//Deals
Route::get('/admin/deals', 'AdminController@deals');
Route::post('/admin/getDealDetails', 'AdminController@getDealDetails');
Route::post('/admin/saveDealChanges', 'AdminController@saveDealChanges');
Route::post('/admin/deleteDeal', 'AdminController@deleteDeal');

//Fundraisers
Route::get('/admin/fundraisers', 'AdminController@fundraisers');
Route::post('/admin/getFundraiserDetails', 'AdminController@getFundraiserDetails');
Route::post('/admin/fundraiser/changeLogo', 'AdminController@fundraiserChangeLogo');
Route::post('/admin/fundraiser/changeProfileImage', 'AdminController@fundraiserChangeProfileImage');
Route::post('/admin/saveFundraiserChanges', 'AdminController@saveFundraiserChanges');
Route::get('/admin/fundraiserStatus/{id}/{active}', 'AdminController@fundraiserStatus');
Route::post('/admin/deleteFundraiser', 'AdminController@deleteFundraiser');

//Card Number Administration
Route::get('/admin/cards', 'AdminController@cards');
Route::get('/admin/createCards', 'AdminController@createCards');
Route::post('/admin/createCards', 'AdminController@saveCards');
Route::get('/admin/searchFundraisers', 'AdminController@searchFundraisers');
Route::get('/admin/downloadAllCards', 'AdminController@downloadAllCards');
Route::get('/admin/deleteCard/{id}', 'AdminController@deleteCard');

//Vip Administration
Route::get('/admin/vips', 'AdminController@vips');
Route::post('/admin/deleteVip', 'AdminController@deleteVip');
Route::post('/admin/getVipDetails', 'AdminController@getVipDetails');

//Admin Content Management
Route::get('/admin/content-management', ['middleware' => 'auth', 'uses' => 'ContentController@index']);
Route::post('/content/delete-setting', 'ContentController@deleteSetting');
Route::post('/content/save-setting', 'ContentController@saveSetting');
Route::get('/manage-page/{slug}', ['middleware' => 'auth', 'uses' => 'ContentController@managePage']);
Route::post('/manage-page/{slug}', ['middleware' => 'auth', 'uses' => 'ContentController@saveSimplePage']);
Route::post('/content/delete-list-item', 'ContentController@deleteListItem');
Route::post('/content/save-list-item', 'ContentController@saveListItem');
Route::post('/content/save-advanced-page/{slug}', 'ContentController@saveAdvancedPage');
Route::post('/content/save-home-page/{slug}', 'ContentController@saveHomePage');

//VIP Signup
Route::get('/vip-signup', 'VipController@signup');
Route::post('/vip-signup/validate-card', 'VipController@validateCard');
Route::post('/vip-signup/process-card', 'VipController@processCard');
Route::get('/vip-signup/process-card', 'VipController@processCard');
Route::get('/vip-signup/account-info', 'VipController@accountInfo');
Route::post('/vip-signup/check-email', 'VipController@checkEmail');
Route::post('/vip-signup/check-email-update', 'VipController@checkEmailUpdate');
Route::post('/vip-signup/account-info', 'VipController@saveVip');
Route::put('/vip-signup/account-info/{user_id}/{vip_id}/{address_id}', 'VipController@updateVip');
Route::get('/vip-signup/payment-info', ['middleware' => 'auth', 'uses' => 'VipController@paymentInfo']);
Route::post('/vip-signup/process-payment-info', ['middleware' => 'auth', 'uses' => 'VipController@processPaymentInfo']);
Route::get('/vip-signup/choose-fundraiser', ['middleware' => 'auth', 'uses' => 'VipController@chooseFundraiser']);
Route::post('/vip-signup/choose-fundraiser', ['middleware' => 'auth', 'uses' => 'VipController@saveChosenFundraiser']);
Route::get('/vip-signup/review', ['middleware' => 'auth', 'uses' => 'VipController@signupReview']);
Route::get('/vip-signup/finalize', ['middleware' => 'auth', 'uses' => 'VipController@signupFinalize']);
Route::get('/vip-signup/success', ['middleware' => 'auth', 'uses' => 'VipController@signupSuccess']);
Route::post('/vip/saveRecommendation', 'VipController@saveRecommendation');
Route::post('/vip/saveBookmark', 'VipController@saveBookmark');

//VIP Account Management
Route::get('/my-account', ['middleware' => 'auth', 'uses' => 'VipController@myAccount']);
Route::get('/my-account/settings', ['middleware' => 'auth', 'uses' => 'VipController@myAccountSettings']);
Route::post('/my-account/settings', ['middleware' => 'auth', 'uses' => 'VipController@saveMyAccountSettings']);
Route::post('/my-account/changeAvatar', 'VipController@changeAvatar');
Route::post('/my-account/changeProfileImage', 'VipController@changeProfileImage');
Route::get('/my-account/recommendations', ['middleware' => 'auth', 'uses' => 'VipController@myAccountRecommendations']);
Route::get('/my-account/suspended', ['middleware' => 'auth', 'uses' => 'VipController@myAccountSuspended']);
Route::get('/cancel-vip-membership', ['middleware' => 'auth', 'uses' => 'VipController@cancelMembership']);
Route::get('/my-account/confirm-cancel', ['middleware' => 'auth', 'uses' => 'VipController@confirmCancelMembership']);
Route::post('/my-account/renew-membership', ['middleware' => 'auth', 'uses' => 'VipController@renewMembership']);

//Utilities
Route::post('/upload-photo', 'UtilityController@uploadPhoto');
Route::get('/crop-photo', 'UtilityController@cropPhoto');
Route::post('/listings/filter', 'ListingsController@filter');
Route::post('/listings/search', 'ListingsController@search');
Route::get('/search-fundraisers', 'FundraiserController@search');
