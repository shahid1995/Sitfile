<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* FRONTEND ROUTES */
# Home
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'UserController@otpvalidation');
Route::get('/resendotp', 'UserController@resendotp');


Route::get('/service-page', 'HomeController@service')->name('service-page');
Route::get('/guarantee', 'HomeController@guarantee')->name('guarantee');



Route::get('logout', 'Auth\LoginController@logout');
Route::get('/','HomeController@home');
Route::post('changelanguage','AjaxController@sessionlanguage'); 
//Aniruddha --------------------------------------------------
Route::get('/sregister', 'ServiceRegistrationController@create')->name('serviceregisterer');
Route::post('sregister', 'ServiceRegistrationController@store');
// Route::get('changepass', 'ServiceRegistrationController@changepass')->middleware('auth');
Route::post('updatenewpass', 'ServiceRegistrationController@changepassupdate')->name('changePassword')->middleware('auth');
Route::get('/service', 'HomeController@serviceprovider');
//Route::any('/sign-up', 'HomeController@signup_process')->middleware('auth');
Route::any('/sign-up', 'HomeController@signup_process');
Route::get('/contact', 'HomeController@contactus');
Route::post('/date-calculation', 'HomeController@date_calculation');
Route::post('/contact', 'HomeController@contactusmsg');
Route::get('renew', 'ServiceRegistrationController@renewpackage')->middleware('auth');
Route::get('renewpack', 'ServiceRegistrationController@renewpackageview')->middleware('auth');
Route::get('myoders', 'ServiceRegistrationController@myoders')->middleware('auth');
Route::get('deshboard', 'ServiceRegistrationController@deshboard')->middleware('auth');
Route::get('/subscribe-membership/{id}', 'ServiceRegistrationController@subscribe_membership');

//Payment process
//Route::get('payWithpaypal', 'PaymentController@payment')->name('payment');
Route::get('payWithpaypal', 'HomeController@paymentrenew')->name('paymentrenew');
Route::any('razorpay-payment-renew', 'HomeController@storerenew');
Route::get('cancel', 'PaymentController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PaymentController@success')->name('payment.success');

/***/

//Route::any('/user/placeorder/{id}', 'PaymentController@payment1');
Route::any('user/placeorder/{id}', 'HomeController@paymentrazarpay');
Route::any('razorpay-payment', 'HomeController@store');

//Route::any('razorpay-payment', [HomeController::class, 'store'])->name('razorpay-payment');
//Route::any('/razorpay-payment', [App\Http\Controllers\HomeController::class, 'store'])->name('razorpay-payment');


//Route::get('pay', 'RazorpayController@paymentrazarpay')->name('pay');

// route for make payment request using post method
Route::post('dopayment', 'HomeController@dopayment')->name('dopayment');




Route::get('cancel1', 'PaymentController@cancel1')->name('payment.cancel1');
Route::get('payment/success1', 'PaymentController@success1')->name('payment.success1');


Route::get('user/dashboard', 'ServiceRegistrationController@dashboard')->name('dashboard')->middleware('auth');
Route::get('/user/servicerequest', 'ServiceRegistrationController@servicerequest')->name('servicerequest')->middleware('auth');
Route::any('/user/servicerequest_new', 'ServiceRegistrationController@servicerequest_new')->name('servicerequest_new')->middleware('auth');
Route::get('/user/servicerequest_completed', 'ServiceRegistrationController@servicerequest_completed')->middleware('auth');
Route::get('/user/servicerequest_expired', 'ServiceRegistrationController@servicerequest_expired')->middleware('auth');
Route::get('/user/servicerequest_active', 'ServiceRegistrationController@servicerequest_active')->middleware('auth');
Route::get('/user/manageproject', 'ServiceRegistrationController@manageproject')->middleware('auth');
Route::get('/user/servicerequest_won', 'ServiceRegistrationController@servicerequest_won')->middleware('auth');
Route::get('/user/servicerequest_lost', 'ServiceRegistrationController@servicerequest_lost')->middleware('auth');
Route::get('/user/manageservices', 'ServiceRegistrationController@manageservices')->name('manageservices')->middleware('auth');
Route::post('addservices', 'ServiceRegistrationController@addservicetypes')->middleware('auth');
Route::post('updateservices', 'ServiceRegistrationController@updateservicetypes')->middleware('auth');
Route::get('user/profile_setting', 'ServiceRegistrationController@profile_setting')->middleware('auth');
Route::post('user/profile_setting_update', 'ServiceRegistrationController@profile_setting_update')->middleware('auth');
Route::get('user/bank_account_details', 'ServiceRegistrationController@bank_account_details')->middleware('auth');
Route::post('user/save-bank-details', 'ServiceRegistrationController@save_bank_details')->middleware('auth');

Route::post('user/offer-bid', 'ServiceRegistrationController@offer_bid')->middleware('auth');
Route::post('user/change_status', 'ServiceRegistrationController@change_status')->middleware('auth');

Route::get('user/user-accept-bid/{id}', 'ServiceRegistrationController@user_accept_bid')->middleware('auth');


Route::get('user/equipment-list/', 'ServiceRegistrationController@equipment_list')->middleware('auth');
Route::any('user/equipment-price-create/', 'ServiceRegistrationController@equipment_price_create')->middleware('auth');

Route::any('user/p-delete-equipment/{id}', 'ServiceRegistrationController@equipment_details_delete')->name('settings')->middleware('auth');



//Route::any('/user/placeorder/{id}', 'HomeController@placeorder');
Route::any('/user/myorders', 'UserController@myorders')->middleware('auth');
Route::any('/user/qa-expiration', 'UserController@qa_expiration');
Route::any('/user/active-offer', 'UserController@active_offer');
Route::any('/active-offer', 'UserController@active_offer');
Route::any('/user/new-order', 'UserController@new_order');
Route::any('/user/expired-offer', 'UserController@expired_offer');
Route::any('/orderprocess', 'HomeController@orderprocess');
Route::any('/orderprocessuser', 'HomeController@orderprocessuser');
Route::any('/orderplaced', 'HomeController@orderplaced');
Route::post('user/sendinvoicemail', 'UserController@sendEmailInvoice');

//Aniruddha --------------------------------------------------

Route::get('/forgetpass', function () {
    return view('forgotpass');
})->name('auth.forgot');

Route::post('/forgetpass', 'HomeController@postForgot')->name('auth.forgot.reset');

Route::get('/change-pass/{key?}', 'HomeController@change_pass');
Route::post('/change-forgot-pass', 'HomeController@change_forgot_pass');

Route::get('/transportregister', 'Auth\RegisterController@transportregister')->name('transportregister');
Route::post('/addtransporter', 'Auth\RegisterController@addTransporter')->name('addtransporter');

Route::any('/veryfyaccount/{token}', 'Auth\RegisterController@accountVeryfy');
#User
Route::post('user/verify-account', 'UserController@verifyaccount');
//Route::get('/user/profile', 'UserController@profile')->name('profile')->middleware('auth');
Route::get('/user/profile', 'UserController@profile');
Route::any('/user/updateprofile', 'UserController@updateprofile')->name('update_profile')->middleware('auth');
Route::any('/user/update-profile-image', 'UserController@updateprofileimage')->name('update_profile')->middleware('auth');
Route::any('/user/serviceorder', 'UserController@serviceorder')->name('serviceorder')->middleware('auth');
Route::post('/user/serviceorderstore', 'UserController@serviceorderstore')->name('serviceorder')->middleware('auth');
Route::get('/user/requestajob', 'UserController@requestajob')->name('job_request')->middleware('auth');
Route::post('/user/requestajob', 'UserController@requestajobstore')->name('job_request')->middleware('auth');
Route::get('/user/requestajob/{id}', 'UserController@requestajob')->name('job_request')->middleware('auth');
Route::get('/user/managejob', 'UserController@managejob')->name('managejob')->middleware('auth');
Route::any('/delete_image', 'UserController@delete_image')->name('delete_image')->middleware('auth');
Route::any('/user/allergy-list', 'UserController@allergylist')->name('allergy_list')->middleware('auth');
Route::any('/user/saveallergyfood', 'UserController@saveallergyfood')->name('allergy_food_save')->middleware('auth');
Route::any('/user/deleteallergy/{id}', 'UserController@allergydelete')->name('delete_allergy')->middleware('auth');
Route::get('/user/institute-details', 'UserController@institute_details')->name('settings')->middleware('auth');

Route::any('/user/institute-details-create', 'UserController@institute_details_create')->name('settings')->middleware('auth');

Route::any('/user/edit-institute/{id}', 'UserController@edit_institute')->name('settings')->middleware('auth');
Route::any('/user/institute_update/{id}', 'UserController@institute_update')->name('settings')->middleware('auth');

Route::any('user/delete-institute/{id}', 'UserController@deleteInstitute')->name('settings')->middleware('auth');


Route::get('/user/equipment-details', 'UserController@equipment_details')->name('settings')->middleware('auth');

Route::get('/user/edit-equipment/{id}', 'UserController@edit_equipment')->name('settings')->middleware('auth');
Route::any('/user/equipment_update/{id}', 'UserController@equipment_update')->name('settings')->middleware('auth');



Route::any('/user/equipment-details-create', 'UserController@equipment_details_create')->name('settings')->middleware('auth');
Route::any('user/delete-equipment/{id}', 'UserController@equipment_details_delete')->name('settings')->middleware('auth');
Route::get('/user/account-info', 'UserController@account_info')->name('settings')->middleware('auth');
Route::post('user/headof-institute', 'UserController@save_headof_institute')->name('settings')->middleware('auth');
Route::post('user/contact-info', 'UserController@save_contact_info')->name('settings')->middleware('auth');
Route::post('user/update-info', 'UserController@update_info')->name('settings')->middleware('auth');
Route::get('/user/blog', 'UserController@blog_list')->name('blog')->middleware('auth');
Route::post('/user/blog/add', 'UserController@add_blog')->name('blog')->middleware('auth');
//Aniruddha------------------------------------------------------------------------
Route::any('/user/xray','UserController@xray')->middleware('auth');
Route::any('/user/xraydetails/{id}','UserController@xraydetails')->middleware('auth');
//Aniruddha------------------------------------------------------------------------

Route::post('/newsletter', 'HomeController@newsletter')->name('newsletter');
Route::get('/page/{slug}', 'HomeController@page')->name('page');


Route::get('/testimonials', 'HomeController@testimonials')->name('testimonials');

Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart-view', 'CartController@cart_view')->name('cart-view');

Route::any('/sendotp','Auth\RegisterController@sendotp');
Route::any('/getmenufacturer','UserController@getmenufacturer');
Route::any('user/getequipment','UserController@getequipment');
Route::any('user/getequipmentdtls','UserController@getequipmentdtls');
Route::any('/getxrymachines','HomeController@getxrymachines');
Route::get('/register2','UserController@reg_step2');
Route::post('/register2','UserController@reg_step2_create');
Route::get('/success','UserController@success');
Route::get('/success_s','HomeController@success_s');
Route::any('/schedulecall','HomeController@schedulecall');
Route::any('/testreminder','HomeController@testreminder');


Route::get('otpvalidation','UserController@otpvalidation');
Route::post('submit-otp','UserController@submit_otp');

Route::post('equipment','UserController@equipment');




Route::get('/testmail','UserController@testmail');
Route::post('user/bid_services', 'ServiceRegistrationController@bid_service');

/* Order status */



/*Route::any('payment-success', 'ProductController@payment_success')->name('payment-success');
Route::any('payment-failed', 'ProductController@payment_failed')->name('payment-failed');
Route::any('paypal-payment-ipn', 'ProductController@paypal_payment_ipn')->name('paypal-payment-ipn');*/


					/* ADMIN ROUTES */
#User

Route::get('assign-provider/{id}','AdminServiceOrderController@list');
Route::any('admin/assign/edit-save/{id}','AdminServiceOrderController@storeditassign');

#Admin Static page
Route::get('admin/staticpage/list','AdminStaticPageController@list');
Route::get('admin/staticpage/add','AdminStaticPageController@create');
Route::post('admin/staticpage/save','AdminStaticPageController@save');
Route::get('admin/staticpage/edit/{id}','AdminStaticPageController@edit');
Route::post('admin/staticpage/update/{id}','AdminStaticPageController@update');
Route::get('admin/staticpage/delete/{id}','AdminStaticPageController@delete');







