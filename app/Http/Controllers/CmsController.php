<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Mail;
use View;
use Image;
use File;
use Storage;
use Twilio;
use App\User;
use Validator;
use App\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Routing\ResponseFactory;
//use Srmklive\PayPal\Services\ExpressCheckout;
use Helper;

use CRUDBooster;

class CmsController extends Controller{


	/**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        return view('home');
    }*/

    protected $provider;

	function __construct(){

		//$this->middleware('auth');

		$this->data = $this->init_elements();

		# get session language code and corresponding language id
		if(Session::has('locale')){
			$this->data['session_lang_code'] = Session::get('locale');
		}else{
			$this->data['session_lang_code'] = 'en';
		}
		$language_id = DB::table('language')->where('language_code', '=', $this->data['session_lang_code'])->select('id')->first();
		$this->data['sess_language_id'] = $language_id->id;
		# get session language code and corresponding language id

        #set checkout provider
        //$this->provider = new ExpressCheckout();

	}
	
	/*function index(){
		$data = array();
		$data = $this->data;
		//dd(Helper::demo('ddd'));
		return View::make('cmsdetails')->with($data);
	}

	public function list(){
		return $this->index();
	}*/

	public function cmsdetails($slug){

        $data = array();
        $data = $this->data;

		$data['pages'] = DB::table('static_page as sp')
                        ->leftJoin('static_page_details as spd', 'sp.id', '=', 'spd.page_id')
                        ->where('spd.lang_id', '=', $this->data['sess_language_id'])
                        ->where('sp.seo_url', '=', $slug)
                        ->select('sp.*', 'spd.page_title','spd.page_content')->first();

        #breadcrumbs
        $data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => url('/'),
		);

		$data['breadcrumbs'][] = array(
			'text' => $data['pages']->page_title,
			'href' => url('/pages/'.$data['pages']->seo_url),
            'active' => 'active',
		);

	    //dd($data);
	    return View::make('frontend.cmsdetails')->with($data);
		
	}

    //============for contact us===================
    public function contactUs(Request $request){

        $data = array();
        $data = $this->data;

        #breadcrumbs
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => url('/'),
        );

        $data['breadcrumbs'][] = array(
            'text' => trans('sitelanguage.contact_us'),
            'href' => url('/contact-us/'),
            'active' => 'active',
        );

        if($request->input('name')){

            # sent contact us mail to admin #
            $postdata = array();

            #set mail content array
            $postdata = array(
              'name'        => $request->input('name'),
              'email'       => $request->input('email'),
              'mobile'      => $request->input('mobile'),
              'message'     => $request->input('message'),
            );
            
            #set to admin mail
            $email_id = config('settings.site_email_id');

            #sent mail to student for new registration by department head.
            CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'contact_us']);

            # sent contact us mail to admin #

            return redirect('contact-us')->with('success', 'Thank you for contacting us, we will contact you soon.');
        }

        //dd($data);
        return View::make('frontend.contact_us')->with($data);
        
    }
    //============for contact us===================

}
