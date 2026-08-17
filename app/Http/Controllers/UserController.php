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
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Hash;
use Helper;
use App\Trucktype;
use App\Deliverytype;
use App\Country;
use App\FState;
use App\FCitie;
use App\UserQuote;
use App\VendarSetPrice;
use App\QuotePayment;
use App\FTruckDriver;
use App\AssignTruckDriver;
use PDF;
use Swift_Attachment;
use CRUDBooster;

class UserController extends Controller{


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


	function __construct(){

		$this->middleware('auth');

		$this->data = $this->init_elements();
		# logged in user data
		$this->data['userdetails'] = DB::table('users')
                          ->where('id',Auth::user()->id)
                          ->select('*')
                          ->first();
		# logged in user data

        # get session language code and corresponding language id
        if(Session::has('locale')){
            $this->data['session_lang_code'] = Session::get('locale');
        }else{
            $this->data['session_lang_code'] = 'en';
        }
        $language_id = DB::table('language')->where('language_code', '=', $this->data['session_lang_code'])->select('id')->first();
        $this->data['sess_language_id'] = $language_id->id;
        # get session language code and corresponding language id

	}
	

	function index(){
		$data = array();
		$data = $this->data;
		$data['userdata']=$this->data['userdetails'];
		$data['packageinfo'] = DB::table('membership_packages')
		->select('membership_packages.package_name')
		->join('users','users.membership_package','=','membership_packages.id')
		->first();
		$data['machine_types'] = DB::table('manage_machine_type')->where('status','=','1')->get();
		$data['services'] = DB::table('services')->where('status','=','1')->get();
		$data['is_service_selected'] = Auth::user()->is_service_selected;
		
		
		return View::make('frontend.user.profile')->with($data);
	}

	function profile(){
	    
	    
	    
	    
	    if(Session::get('invoice_no')){
	        
	       $invoice_no = Session::get('invoice_no'); 
	        
	        $order_id = DB::table('service_order')->where('invoice_no',$invoice_no)->first();
	        
	        $order_id = $order_id->id;
	        
	        //dd($order_id);
	        
	        $service_order = array(
              'user_id'=> Auth::user()->id,
             );
             
	       DB::table('service_order')->where('id',$order_id)->update($service_order);
	       
	       
	       session()->forget('invoice_no');
	       
	       return redirect()->to('orderplaced?order_id='.$order_id)->with('success','Service requested successfully');
	        
	    }else{
	        
	        return $this->index();
	    }
	    
		

	}

	function verifyaccount(Request $request)
	{
		$user_id = $request->input('user_id');
		if(!empty($user_id))
		{
			$input = Input::all();
        	$rules = array(
        		'document' => 'required|image|max:10000|mimes:jpg,jpeg,png',
        	);

        	$validator = Validator::make($input, $rules);

        	if ($validator->fails()) {
            	return redirect()->to('user/profile')->withErrors($validator)->withInput();;
        	} else {
        		/*$uploadFile['documents'] = $request->file('document');
        		$destinationPath = 'public/images/upload/certificate';
        		$uploadFile['documents']->move($destinationPath,$uploadFile['documents']->getClientOriginalName());*/
        		
        		  $file = $request->file('document');
                  $filename = time().$file->getClientOriginalName();
                  $location = storage_path('app/uploads/1/'.date('Y').'-'.date('m').'/'. $filename);
                  Image::make($file)->save($location);
                  $document = 'uploads/1/'.date('Y').'-'.date('m').'/'.$filename;
                  File::makeDirectory($document, 0777, true, true);
            		
        		
        		DB::table('users')->where('id','=',$user_id)->update([
        			//'documents'=>$uploadFile['documents']->getClientOriginalName(),
        			'documents'=>$document,
        			'status'=>1
        		]);
        		return redirect('user/profile')->with('success','Account verified successfully');
        	}
		}
	}

	function allergylist(){
		$data = array();
		$data = $this->data;
		$data['allergy_list']=DB::table('sa_food_allergies')
                            ->select('*')
                            ->where('user_id', '=', Auth::user()->id)
                            ->get();;
		return View::make('frontend.user.allergylist')->with($data);
	}

	function allergydelete($id = null)
	{
		DB::table('sa_food_allergies')->where('id', '=', $id)->delete();
		Session::flash('success_message', 'Deleted Successfully.');
        return redirect('user/allergy-list');
	}

	function saveallergyfood(Request $request)
	{
		$food_name = $request->input('food_name');
		$allergydata = array(
				'user_id' => Auth::user()->id,
				'name' => $food_name,
				'created_at' => date('Y-m-d H:i:s')
			);
			$insertallergydata = DB::table('sa_food_allergies')->insert($allergydata);

			if($insertallergydata)
			{
				 Session::flash('success', 'Allergy food added successfully!');
        		return redirect('user/allergy-list');
			}
			else
			{
				 Session::flash('error', 'Some error occured!');
        		return redirect('user/allergy-list');
			}
	}

	#update profile image
	function updateprofileimage(Request $request)
	{
		$profile_img = $request->file('profile_image');
		$id = $id=Auth::user()->id;
		if($profile_img!=NULL)
		{
			$filename = time().$profile_img->getClientOriginalName();
			$extension = $profile_img->getClientOriginalExtension();
			$upload = $profile_img->move(public_path('images/upload/profile'), $filename);
			$path = "images/upload/profile/".$filename;
			$update_data = array('profile_picture'=>$path);
			$userUpdate = DB::table('users')->where('id', '=', $id)->update($update_data);
			if($userUpdate){
				return redirect('/user/profile')->with('success', "Profile picture updated successfully.");
			}else{
				return redirect('/user/profile')->with('error', "Profile picture type should be jpg,jpeg,png");
			}
		}else{
			return redirect('/user/profile')->with('error', "Please select a image.");
		}
	}

	#update profile
	function updateprofile(Request $request){
		//echo "<pre>";print_r($request->input('company_logo'));die();
		$data=array();
		$data['userdata']=$this->data['userdetails'];
		if($request->input('submit')){
			$id=Auth::user()->id;
			
			
			$role = $request->input('role');
			if($role == '1'):
				$file = $request->file('user_image');
				if($file!=NULL){
					$filename = time().$file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$upload = $file->move(public_path('images/upload/profile'), $filename);
					$path="images/upload/profile/".$filename;
					$postdata=array(
								'profile_picture'=>$path,
								
								'first_name'=>$request->input('first_name'),
								'last_name'=>$request->input('last_name'),
								'phoneno'=>$request->input('phoneno'),
								'customer_type'=>$request->input('customer_type'),
								'med_estab_name'=>$request->input('med_estab_name'),
								'gst'=>$request->input('gstin'),
								'pin_code'=>$request->input('pincode'),
								'address'=>$request->input('address'),
								'country'=>$request->input('country'),
								'state'=>$request->input('state'),
								'city'=>$request->input('city'),
								'created_at'=> date('Y-m-d H:i:s'),
								'institute_name'=>$request->input('institute_name'),
								'contact_person_name'=>$request->input('contact_person_name'),
							);

						$userUpdate = DB::table('users')->where('id', '=', $id)->update($postdata); 
						
						if($userUpdate){
					            return redirect('/user/profile')->with('success', "Your account details updated successfully.");
				            }

				}else{
					$postdata=array(
								'first_name'=>$request->input('first_name'),
								'last_name'=>$request->input('last_name'),
								'phoneno'=>$request->input('phoneno'),
								'customer_type'=>$request->input('customer_type'),
								'med_estab_name'=>$request->input('med_estab_name'),
								'gst'=>$request->input('gstin'),
								'pin_code'=>$request->input('pincode'),
								'address'=>$request->input('address'),
								'country'=>$request->input('country'),
								'state'=>$request->input('state'),
								'city'=>$request->input('city'),
								'created_at'=> date('Y-m-d H:i:s'),
								'institute_name'=>$request->input('institute_name'),
								'contact_person_name'=>$request->input('contact_person_name'),
							);

					$userUpdate = DB::table('users')->where('id', '=', $id)->update($postdata); 
						
						if($userUpdate){
					            return redirect('/user/profile')->with('success', "Your account details updated successfully.");
				            }

				}

			elseif($role == '2'):
				$logo = $request->file('company_logo');
				if($logo!=NULL){
					$filename = $logo->getClientOriginalName();
					$extension = $logo->getClientOriginalExtension();
					$upload = $logo->move(public_path('images/upload/service'), $filename);
					$path=$filename;
					$postdata=array(
								'company_logo'=>$path,
								'first_name'=>$request->input('first_name'),
								'last_name'=>$request->input('last_name'),
								'phoneno'=>$request->input('phoneno'),
								'email'=>$request->input('email'),
								'company_name'=>$request->input('business'),
								'gst'=>$request->input('gstin'),
								'website_url'=>$request->input('pincode'),
								'address'=>$request->input('address'),
								'country'=>$request->input('country'),
								'state'=>$request->input('state'),
								'city'=>$request->input('city'),
								'number_of_service'=>$request->input('number_of_service'),
								'name_of_serv_eng'=>$request->input('name_of_serv_eng'),
								'remarks'=>$request->input('remarks'),
								'created_at'=> date('Y-m-d H:i:s')
							);

							$userUpdate = DB::table('users')->where('id', '=', $id)->update($postdata); 
						
						if($userUpdate){
					            return redirect('/user/profile')->with('success', "Your account details updated successfully.");
				            }


				}else{
					$postdata=array(
								'first_name'=>$request->input('first_name'),
								'last_name'=>$request->input('last_name'),
								'phoneno'=>$request->input('phoneno'),
								'email'=>$request->input('email'),
								'company_name'=>$request->input('business'),
								'gst'=>$request->input('gstin'),
								'website_url'=>$request->input('pincode'),
								'address'=>$request->input('address'),
								'country'=>$request->input('country'),
								'state'=>$request->input('state'),
								'city'=>$request->input('city'),
								'number_of_service'=>$request->input('number_of_service'),
								'name_of_serv_eng'=>$request->input('name_of_serv_eng'),
								'remarks'=>$request->input('remarks'),
								'created_at'=> date('Y-m-d H:i:s')
							);

						$userUpdate = DB::table('users')->where('id', '=', $id)->update($postdata); 
						
						if($userUpdate){
					            return redirect('/user/profile')->with('success', "Your account details updated successfully.");
				            }

				}

			endif;

				if(!empty($request->input('password')))
				{
					$postdata=array('password'=>bcrypt($request->input('password')));
				}
			 #update data
				$userUpdate = DB::table('users')->where('id', '=', $id)->update($postdata);
				if($userUpdate){
					return redirect('/user/profile')->with('success', "Your account details updated successfully.");
				}
		}
		return View::make('frontend.user.profile')->with($data);
	}

	public function requestajob($id='')
	{
		$data = array();
		$data['xray_list'] = DB::table("modals")
               				->where("status","=","1")
                			->get();
        $data['allcountry'] = Country::get();
        if(!empty($id))
        {
        	$data['joblist'] = DB::table("user_post_job")->where("id","=",$id)->first();
        }
		return View::make('frontend.user.requestajob')->with($data);
	}

	public function requestajobstore(Request $request)
	{
		$user_id=Auth::user()->id;
		$validator = Validator::make($request->all(), [
            'job_title' => 'required',
            // 'confirm_email' => 'required|same:email',
            'xray_mechine' => 'required',
            'dscription' => 'required',
            'country_id' => 'required',
            'state_city' => 'required',
            'last_date' => 'required',
            'key_skill' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('user/requestajob')->withErrors($validator)->withInput();
        }

        DB::table('user_post_job')->insert([
        	'job_title' => $request->job_title,
        	'product_id' => implode(',',$request->xray_mechine),
        	'job_description' => $request->dscription,
        	'country_id' => $request->country_id,
        	'last_date' => date('Y-m-d', $request->last_date),
        	'key_skill' => $request->key_skill,
        	'user_id' => $user_id
        ]);

        return redirect('/user/requestajob')->with('success', "Job posted successfully.");
	}

	public function managejob()
	{
		$data = array();
		$user_id=Auth::user()->id;
		$data["posted_job_list"] = DB::table('user_post_job as u')
									->select('u.*','c.name as country_name')
									->leftJoin('countries as c','c.id','=','u.country_id')
									->where("user_id","=",$user_id)
									->get();
		return View::make('frontend.user.managejoblist')->with($data);
	}


	/*
	* customer quote list
	*
	*/
	public function quotelist(){
		//dd($data);
		$data = array();

		$data['userdata']=$this->data['userdetails'];
	
		if($data['userdata']->roll_id ==2)
		{
			 return redirect('user/profile');
		}

		$language_code = $this->data['session_lang_code'];
		$data = array();

		$uid = Auth::user()->id;

		//dd($uid);
		 
		$data['request_list'] = UserQuote::select('user_quotes.*','f_countries.country_name_'.$language_code.' as country_name','f_states.state_name_'.$language_code.' as state_name','f_cities.city_name_'.$language_code.' as city_name','city.city_name_'.$language_code.' as city_to_name','country.country_name_'.$language_code.' as country_to_name','state.state_name_'.$language_code.' as state_to_name','f_delevery_type.type_name_'.$language_code.' as delevery_type','f_truck_type.truck_type_name_'.$language_code.' as truck_type')

			->leftJoin('f_countries', 'f_countries.id', '=', 'user_quotes.country_id')
			->leftJoin('f_states', 'f_states.id', '=', 'user_quotes.state_id')
			->leftJoin('f_cities', 'f_cities.id', '=', 'user_quotes.city_id')
			->leftJoin('f_countries as country', 'country.id', '=', 'user_quotes.country_id_to')
			->leftJoin('f_states as state', 'state.id', '=', 'user_quotes.state_id_to')
			->leftJoin('f_cities as city', 'city.id', '=', 'user_quotes.city_id_to')

			->leftJoin('f_delevery_type', 'f_delevery_type.id', '=', 'user_quotes.delevery_type_id')

			->leftJoin('f_truck_type', 'f_truck_type.id', '=', 'user_quotes.truck_type_id')

			->where('user_quotes.customer_id',$uid)
			/*->leftJoin('vendar_set_prices', 'vendar_set_prices.customer_id', '=', 'user_quotes.customer_id')*/
			->paginate(10);

			foreach($data['request_list'] as $key=> $request_list){

				$vendar_price = VendarSetPrice::where('customer_request_id',$request_list->id)->count();
				if($vendar_price){
					$data['request_list'][$key]['customer_request'] = $vendar_price;
					
				}
			}

		   //dd($data['request_list']);

		return View::make('frontend.user.customerquotelist')->with($data);
	}



	/*
	* customer request a quote
	*
	*/
	public function requestQuote(Request $request){
		$language_code = $this->data['session_lang_code'];

		$data['lc'] = $language_code;

		$data['trucktype'] = Trucktype::where('status', '=', 1)->select('id','truck_type_name_'.$language_code)->get();
		$data['deliverytype'] = Deliverytype::where('status', '=', 1)->select('id','type_name_'.$language_code)->get();
		$data['allcountry'] = Country::where('status', '=', 1)->get();
		
		//dd($data['trucktype']);

		return View::make('frontend.user.requestquote')->with($data);
	}


	#delete image
	function delete_image(Request $request){
		$role = $request->input('role_id');
		if($role == '1'):	
			$path=$request->input('image_path');
			$filename=explode("/",$path);

			$image_path = public_path('images/upload/profile').'/'.$filename[2];  // Value is not URL but directory file path
			    if(File::exists($image_path)) {
			        File::delete($image_path);
			    }
				$uid = Auth::user()->id;

			$update=DB::table('users')
			    ->where('id', $uid)
				->where('status', 1)
			    ->update([	'profile_picture' =>"",
							'updated_at' => date('Y-m-d H:i:s')
							]
						);
        elseif($role == '2'):
        	$filename=$request->input('image_path');

			$image_path = public_path('images/upload/service').'/'.$filename;  // Value is not URL but directory file path
			    if(File::exists($image_path)) {
			        File::delete($image_path);
			    }
				$uid = Auth::user()->id;

        	$update=DB::table('users')
            ->where('id', $uid)
			->where('status', 1)
            ->update([	'company_logo' =>NULL,
						'updated_at' => date('Y-m-d H:i:s')
						]
					);
    	endif;

		if($update){
			$msg=true;
		}else{
			$msg=false;
		}
		return response()->json(array('msg'=> $msg), 200);
	}

	function select_state($id){

		 $language_code = $this->data['session_lang_code'];
		 $state_list=FState::where('country_id', $id)->get();

       // dd($state_list);
        ?>

        <option value="">Select State</option>
        <?php  
        foreach($state_list as $st)
        {
            ?>

            <option value="<?php echo $st->id; ?>"><?php echo $st->{'state_name_'.$language_code} ?></option>

            <?php 
        }

	}

	function select_city($id){

	$language_code = $this->data['session_lang_code'];	
	
	$city_list=FCitie::where('state_id', $id)->get();

    ?>
    <option value="">Select City</option>
    <?php
    
    foreach($city_list as $st)
    {
        ?>

        <option value="<?php echo $st->id; ?>"> <?php echo $st->{'city_name_'.$language_code} ?></option>

        <?php 
    }

	}

	public function quoterequetlist(){

       $data['userdata']=$this->data['userdetails'];
	
		if($data['userdata']->roll_id ==1)
		{
			 return redirect('user/profile');
		}

		$language_code = $this->data['session_lang_code'];
		$data = array();
		 
		$data['request_list'] = UserQuote::select('user_quotes.*','f_countries.country_name_'.$language_code.' as country_name','f_states.state_name_'.$language_code.' as state_name','f_cities.city_name_'.$language_code.' as city_name','city.city_name_'.$language_code.' as city_to_name','country.country_name_'.$language_code.' as country_to_name','state.state_name_'.$language_code.' as state_to_name','f_delevery_type.type_name_'.$language_code.' as delevery_type','f_truck_type.truck_type_name_'.$language_code.' as truck_type')

			->leftJoin('f_countries', 'f_countries.id', '=', 'user_quotes.country_id')
			->leftJoin('f_states', 'f_states.id', '=', 'user_quotes.state_id')
			->leftJoin('f_cities', 'f_cities.id', '=', 'user_quotes.city_id')
			->leftJoin('f_countries as country', 'country.id', '=', 'user_quotes.country_id_to')
			->leftJoin('f_states as state', 'state.id', '=', 'user_quotes.state_id_to')
			->leftJoin('f_cities as city', 'city.id', '=', 'user_quotes.city_id_to')

			->leftJoin('f_delevery_type', 'f_delevery_type.id', '=', 'user_quotes.delevery_type_id')

			->leftJoin('f_truck_type', 'f_truck_type.id', '=', 'user_quotes.truck_type_id')

			/*->leftJoin('vendar_set_prices', 'vendar_set_prices.customer_id', '=', 'user_quotes.customer_id')*/
			->get();

			foreach($data['request_list'] as $key=> $request_list){
				$uid = Auth::user()->id;
				$vendar_price = VendarSetPrice::where('customer_request_id',$request_list->id)->where('vender_id',$uid)->first();
				if($vendar_price){
					$data['request_list'][$key]['vendarprice'] = $vendar_price->vendar_price;
					$data['request_list'][$key]['price_id'] = $vendar_price->id;
					$data['request_list'][$key]['online_payment'] = $vendar_price->online_payment;
					$data['request_list'][$key]['ofline_payment'] = $vendar_price->ofline_payment;
				}

				if($request_list->payment_status == 1){

					$quote_exits = VendarSetPrice::where('customer_request_id',$request_list->id)->where('vender_id',$uid)->where('online_payment',1)->first();

					if($quote_exits==null){

						$data['request_list'] = array();
					}
				}
			}



			//dd($data['request_list']);

		return View::make('frontend.user.requestquotelist')->with($data);
	}

	public function receivequotelist($id=null){

		$data['receive_qoute'] = VendarSetPrice::select('vendar_set_prices.*','vendar.name as vendar_name')->where('customer_request_id',$id)
		
			->leftJoin('users as vendar', 'vendar.id', '=', 'vendar_set_prices.vender_id')
		    ->paginate(10);
		$data['customer_request_id'] = $id;

		return View::make('frontend.user.receivequotelist')->with($data);
	}

	public function vendar_details($id){

			$vendar_details = DB::table('users')->where('id',$id)->first();

			//dd($vendar_details);
		?>

		<div class="modal-content">
    	<div class="modal-body">
    		<button type="button" class="close" data-dismiss="modal">×</button>
    		<div class="sellermodalinner">
          <div class="selleruserbox">
            <div class="sellerimag">
            <?php if($vendar_details->profile_picture){ ?>
              <img src="<?php echo asset($vendar_details->profile_picture)?>" />

              <?php }else { ?>              
              <img src="<?php echo asset('images/no-image.png')?>" alt="User Image" />
              <?php } ?>
            </div>
            <div class="sellerusercontent">
              <h4><?php echo $vendar_details->name; ?></h4>
              <p> <?php echo $vendar_details->address; ?>  </p>
            </div>
          </div>
          <dl class="dl-horizontal">
            <dt>Email</dt>
            <dd><?php echo $vendar_details->email; ?></dd>
            <hr>
            <dt>Phone Number</dt>
            <dd> <?php echo $vendar_details->phoneno; ?> </dd>
            <hr>
            
            <dt>Company Name</dt>
            <dd> <?php if($vendar_details->company_name) { echo $vendar_details->company_name; }else{ echo 'N/A';} ?> </dd>
            <hr>
            <dt>Rating</dt>
            <dd><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa  farating fa-star-o"></i></dd>
            <hr>
          </dl>
        </div>
    	</div>
    </div>
    <?php
	}

	public function booking_vendor($id,$rid=null){

		$data['userdata'] = $this->data['userdetails'];
		if($data['userdata']->roll_id ==2)
		{
			 return redirect('user/profile');
		}

		

		$data['vendar_details'] = DB::table('vendar_set_prices')->where('id',$id)->first();
		$data['payment_percentage'] = DB::table('f_payment_percentage')->first();
		$data['currencies'] = DB::table('currencies')->where('status','1')->get();
		$data['user_quote_details'] = UserQuote::where('id',$rid)->first();

		//dd($data['vendar_details']);
				

		return View::make('frontend.user.booking-details')->with($data);


	}

	public function rate_exchange($pid,$sid){

		$exchange_url = 'https://openexchangerates.org/api/latest.json';
		$params = array(
		    'app_id' => '0b326077347b43e1a1ca71696a562ce4'
		);

		/*login through -test.developers2017@gmail.com*/

		// make cURL request // parse JSON
		$curl = curl_init();
		curl_setopt_array($curl, array(
		    CURLOPT_URL => $exchange_url . '?' . http_build_query($params),
		    CURLOPT_RETURNTRANSFER => true
		));
		$response = json_decode(curl_exec($curl));
		curl_close($curl);

		if (!empty($response->rates)) {
		    // convert 150 USD to JPY ( Japanese Yen )
		    $number = $response->rates->$pid * $sid; 
		    echo round($number, 2); die;
		}
	}

	public function booking(Request $request){		

		
		$uniqueId = 'ODR'.time();
        //$uniqueId = substr($uniqueId, 0, 10);        
        $uniqueId = $uniqueId;

		$quotepayment = new QuotePayment;
		$quotepayment->transection_id = '';
        $quotepayment->quote_unique_id = $request->quote_unique_id;
        $quotepayment->quote_id = $request->quote_id;
        $quotepayment->vendor_details_id = $request->vendor_id;
        $quotepayment->customer_id = Auth::user()->id;       
        $quotepayment->total_amount = $request->total_price;
        $quotepayment->remain_amount = $request->total_price - $request->payment_percentage;
        $quotepayment->paid_amount = $request->payment_percentage;

        if($request->currencies){
        	$quotepayment->currencies = $request->currencies;
        }else{

        	$quotepayment->currencies = 'USD';
        }        

        $quotepayment->currency_amount = $request->shipping_price;

        $quotepayment->order_id = $uniqueId;               
        
        $request->merge([
            'quote_unique_id' => $uniqueId,
        ]);

        $quotepayment->save();

        $data['payment_details'] = $request->except('_token');
	    //dd($data['payment_details']);
		

		return View::make('frontend.user.packagepayment')->with($data);
		

	}

	public function payment_success(Request $request){

		

		/*$paypaldata=$request->input();   
        $paypaldata['txn_id'];
        $paypaldata['item_number'];

        $paypaldata['payment_status']; 


        $quote_unique_id = 'FAB1564484';

        $orderdata=array(
						 'transection_id'=>'123456',								
						 'payment_status'=>'1',								
						);
				

			 #update data
				$orderUpdate = DB::table('quote_payments')->where('quote_unique_id', '=', $quote_unique_id)->update($orderdata);


		$set_price_data = DB::table('quote_payments')->where('quote_unique_id',$quote_unique_id)->where('status','Completed')->first();

		$pricedata=array(
						 'online_payment'=>'1',								
						 							
						);				

			 #update data
				$orderUpdate = DB::table('vendar_set_prices')->where('id', '=', $set_price_data->vendor_details_id)->update($pricedata);

			$qoutedata=array(
					 'payment_status'=>'1',								
					 							
					);
			

		 #update data
			$priceUpdate = DB::table('user_quotes')->where('id', '=', $quote_unique_id)->update($qoutedata);*/

        return View::make('frontend.user.paymentsuccess')->with('');
	}

	public function payment_failed(Request $request){

		return View::make('frontend.user.paymentfailed')->with('');
	}

	public function create_truck_driver(){

		//dd('jbb');

		return View::make('frontend.user.create_driver')->with('');
	}

	public function list_truck_driver(){

		$user_id = Auth::user()->id;
		$data['driver_list'] = FTruckDriver::where('user_id',$user_id)->orderby('id','desc')->paginate(10);		
		return View::make('frontend.user.driver_list')->with($data);

	}

	public function add_driver(Request $request){
		
		$truckdriver = new FTruckDriver;		        
        $truckdriver->user_id = Auth::user()->id;      
		$truckdriver->name = $request->driver_name;
		$truckdriver->mobile_number = $request->mobile_number;
		$truckdriver->truck_no = $request->truck_number;
		$truckdriver->truck_details = $request->truck_details;

		$truckdriver->save();

		return redirect('user/truck-driver')->with('success', "Truck driver add successfully.");

		//dd($truckdriver);


	}

	public function driver_edit($id){

		$data['driver_details'] = FTruckDriver::where('id',$id)->first();
		return View::make('frontend.user.edit_driver')->with($data);	
	}

	public function update_driver(Request $request){

		$driver_id = $request->input('driver_id');
		$postdata=array(
						'name'=>$request->input('driver_name'),
						'mobile_number'=>$request->input('mobile_number'),
						'truck_no'=>$request->input('truck_number'),
						'truck_details'=>$request->input('truck_details'),
						
						);

		$userUpdate = FTruckDriver::where('id',$driver_id)->update($postdata);
				if($userUpdate){
					return redirect('user/truck-driver')->with('success', "Truck driver update successfully");
				}
	}

	public function driver_delete($id){

		FTruckDriver::where('id',$id)->delete();
		return redirect('user/truck-driver')->with('success', "Truck driver delete successfully");
	}

	public function assign_driver($id){

		$user_id = Auth::user()->id;
		$data['quote_id'] = $id;
		$data['truck_driver'] = FTruckDriver::where('user_id',$user_id)->get();
		$data['quote_details'] = UserQuote::where('id',$id)->first();
		$driver_assign_exit = AssignTruckDriver::where('quote_id',$id)->count();

		if($driver_assign_exit > 0){

			$data['driver_assign_exit'] = AssignTruckDriver::where('quote_id',$id)->first();

			//dd($data['driver_assign_exit']);
		}

		return View::make('frontend.user.assign_driver')->with($data);
	}

	public function submit_assign_driver(Request $request){

		$user_id = Auth::user()->id;

		$assigntruckdriver = new AssignTruckDriver;		        
        $assigntruckdriver->quote_id = $request->quote_id;     		
		$assigntruckdriver->driver_id = $request->truck_driver;
		$assigntruckdriver->vender_id = $user_id;

		//dd($assigntruckdriver);
		$assigntruckdriver->save();

		return redirect('user/quoterequetlist')->with('success', "Truck driver assign successfully.");

	}

	public function order_status($id){

		$data['order_status'] = AssignTruckDriver::select('assign_truck_drivers.*','f_truck_drivers.name as driver_name','user_quotes.quote_id as order_id','users.name as vender_name','f_truck_drivers.truck_no as truck_no','f_truck_drivers.truck_details as truck_details')

			->leftJoin('f_truck_drivers', 'f_truck_drivers.id', '=', 'assign_truck_drivers.driver_id')
			->leftJoin('user_quotes', 'user_quotes.id', '=', 'assign_truck_drivers.quote_id')
			->leftJoin('users', 'users.id', '=', 'assign_truck_drivers.vender_id')
			->where('assign_truck_drivers.quote_id',$id)-> first();

			foreach($data['order_status'] as $key=> $val){

				$price = QuotePayment::where('quote_id',$id)->where('payment_status','1')->first();

				
				
				
				$data['order_status']['total_amount']= $price['total_amount'];
				$data['order_status']['paid_amount']= $price['paid_amount'];
				$data['order_status']['remain_amount']= $price['remain_amount'];

				
			}

			//dd($data['order_status']);

			return View::make('frontend.user.order_status')->with($data);
			//dd($data['order_status']);

	}

	public function xray(){

		$user = Auth::user();

		$data['xray'] = DB::table('xray_machines as xr')
						->select('xr.*','b.brand_title','b.description as brand_description','m.model_title','m.description as model_description')
						->join('brands as b','b.id','=','xr.brand')
						->join('modals as m','m.id','=','xr.model')
						->where(['xr.status' => '1'])
						->get();


		return view('frontend.user.xray')->with($data);
	}

	public function xraydetails($id = null){

		$data['xdet'] = DB::table('xray_machines as xr')
						->select('xr.*','b.brand_title','b.description as brand_description','m.model_title','m.description as model_description')
						->join('brands as b','b.id','=','xr.brand')
						->join('modals as m','m.id','=','xr.model')
						->where(['xr.status' => '1','xr.id' => $id])
						->get();

		return view('frontend.user.xraydetails')->with($data);

	}

	public function serviceorder()
	{
		$data['equipment_dtls'] = DB::table('xray_machines as xr')
								  ->select('b.brand_title','xr.id as xray_id','mmt.machine_type')
								  ->join('brands as b','b.id','=','xr.brand')
								  ->join('manage_machine_type as mmt','mmt.id','=','xr.machine_type')
								  ->where('xr.status','=','1')
								  ->get();
		$data['brand_dtls'] = DB::table('brands as b')
							  ->select('b.brand_title','b.id as brand_id')
							  ->leftJoin('xray_machines as xr','b.id','=','xr.brand')
							  ->where('xr.status','=','1')
							  ->get();
		$data['modal_dtls'] = DB::table('modals as m')
							  ->select('m.model_title','m.id as model_id')
							  ->leftJoin('xray_machines as xr','m.id','=','xr.model')
							  ->where('xr.status','=','1')
							  ->get();
		$data['branch_dtls'] = DB::table('branch as br')
							  ->select('br.branch_name','br.id as branch_id')
							  ->leftJoin('xray_machines as xr','br.id','=','xr.branch_id')
							  ->where('xr.status','=','1')
							  ->get();
		return view('frontend.user.serviceorder')->with($data);
	}

	public function getequipment(Request $request)
    {
     	
    	$data = DB::table("modals as md")
    			->select("md.model_title","mmt.machine_type")
    			->join("xray_machines as xr", "md.id", "=", "xr.model")
    			->join("manage_machine_type as mmt","mmt.id","=","xr.machine_type")
                ->where("model_title","LIKE","%{$request->get('term')}%")
                ->get();
   
        return response()->json($data);
    }

    public function getequipmentdtls(Request $request)
    {
    	$term = $request->get('term');
    	$equip_id = DB::table('manage_machine_type')->select('id')->where('machine_type','=', $term)->first();
    	$data = DB::table("xray_machines as xr")
    			->select('xr.id as xray_id','xr.*','b.brand_title','b.description as brand_description','m.model_title','m.description as model_description','br.branch_name','mmt.machine_type as equipment')
    			->join("brands as b", "xr.brand","=","b.id")
    			->join("modals as m", "xr.model","=","m.id")
    			->join("branch as br", "xr.branch_id", "=", "br.id")
    			->join("manage_machine_type as mmt","xr.machine_type","=","mmt.id")
                ->where("xr.machine_type","=",$equip_id->id)
                ->get();

        return response()->json($data);
    }

	public function getmenufacturer(Request $request)
	{
		$xray_id = $request->input('xray_id');
		 $dataa = DB::table('xray_machines as xr')
								  ->select('xr.brand')
								  ->where('xr.id','=', $xray_id)
								  ->first();
		$data['menufacturer'] = DB::table('brands b')
								->select('*')
								->where('id','=', $dataa->brand)
								->first();
		// $data['model'] = DB::table('modals')
		// 						->select('*')
		// 						->where('id','=', $brand_id->brand)
		// 						->first();
		return json_encode($data);
	}

	public function serviceorderstore(Request $request)
	{

	}

	public function myorders(Request $request)
	{
	    if(!empty($request->get('reschedule_bid')))
	    {
	        DB::table('bid_report')->where('order_id', $request->get('reschedule_bid'))->update(['status'=>0]);
	        return redirect('user/myorders')->with('success', "Reschedule successfully.");;
	    }
	    if(!empty($request->get('confirm_bid')))
	    {
	        DB::table('service_order')->where('id', $request->get('confirm_bid'))->update(['is_bid_accepted'=>1, 'accept_job'=>1,'is_negotiation'=>1]);
	        
	        DB::table('bid_report')->where('order_id', $request->get('confirm_bid'))->update(['status'=>1]);
	        
	        return redirect('user/myorders')->with('success', "Confirmed successfully.");;
	    }
		$user_id = Auth::user()->id;
		$year = $request->get('year');
		if(!empty($year)){
		    $data['order_details'] = DB::table('service_order')->where('user_id', $user_id)->where('status', 1)->whereYear('created_at', '=', $year)->get();
		}else{
		    $order_details = DB::table('service_order')->where('user_id', $user_id)->where('status', 1)->orderby('id','DESC')->get();  
		    
		    if($order_details > 0){
		       
		       foreach($order_details as $key=>$val){
		           
		           $user_details = DB::table('users')->where('id', $val->user_id)->first();
		           
		           $order_details[$key]->city = $user_details->city.','.$user_details->pin_code;
		           
		           $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$val->id)->groupBy('soe.service_id')->get();
		           
		           $quantity = 0; 
                   foreach($services as $service){
                       
                                $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get();
                        
                       
                    foreach($service_details as $service_dt){
                        
                        $quantity += $service_dt->quantity;
                    }
                }
                
                
		        $order_details[$key]->machine_quantity = $quantity;
		           
		       } 
		        
		    }
		    
		// $order_details[$key]->machine_quantity = $quantity;   
		    
		 $data['order_details'] = $order_details;
		 
		 //$data['order_details'][$key]->machine_quantity = $quantity;
		 
		 
		// dd($data['order_details']);
		 
		 
		}
		$data['year'] = $year;
		return view('frontend.user.myorders')->with($data);
	}

	public function testmail()
	{
      $data = array('name'=>"Goutam");
      Mail::send('mail',['name','Ripon Uddin Arman'],function($message){
		    $message->to('goutam.n99@gmail.com')->subject("Email Testing with Laravel");
		    $message->from('goutam.n99@gmail.com','Creative Losser Hopeless Genius');
		});
      echo "HTML Email Sent. Check your inbox.";
	}
	
	public function institute_details()
	{
		$user_id = Auth::user()->id;
		$data['institute_details'] = DB::table('branch')->where('user_id', $user_id)->get();
		
		//dd($data['institute_details']);
		
	    return view('frontend.user.institute_details')->with($data);
	}

	public function institute_details_create(Request $request)
	{
		$user_id = Auth::user()->id;
		if(!empty($request->all())){
			$validator = Validator::make($request->all(), [
	            'client_type' => 'required',
	            // 'confirm_email' => 'required|same:email',
	            //'hospital_name' => 'required',
	            //'diagnostic_centre' => 'required',
	            //'dental_care' => 'required',
	            'medical_establishment' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return redirect('user/institute-details-create')->withErrors($validator)->withInput();
	        }

	        DB::table('branch')->insert([
	        	'client_type' => $request->client_type,
	        	'hospital' => $request->hospital_name,
	        	'diagnostic_centre' => $request->diagnostic_centre,
	        	'dental_centre' => $request->dental_care,
	        	'medical_establishment' => $request->medical_establishment,
	        	'nabh_nabl_accredited' => $request->nabl_accredited,
	        	'gstin' => $request->gstin,
	        	'pincode' => $request->pincode,
	        	'country' => $request->country,
	        	'country' => $request->country,
	        	'city' => $request->city,
	        	'state' => $request->state,
	        	'state' => $request->state,
	        	'address' => $request->address,
	        	'status' => '1',
	        	'user_id' => $user_id
	        ]);

	        return redirect('/user/institute-details')->with('success', "Branch added successfully.");
		}else{
			return view('frontend.user.institute_details_create')->with($data);
		}
		
	}
	
	
	public function edit_institute($id=null){
	   
	   $data['institute_details'] = DB::table('branch')->where('branch_id',$id)->first();
	   
	   return view('frontend.user.institute_edit')->with($data);
	    
	}
	
	public function institute_update(Request $request,$id=null){
	    
	    $post_data= array(
	            'client_type' => $request->client_type,
	        	'medical_establishment' => $request->medical_establishment,
	        	'nabh_nabl_accredited' => $request->nabl_accredited,
	        	'gstin' => $request->gstin,
	        	'pincode' => $request->pincode,
	        	'country' => $request->country,
	        	'city' => $request->city,
	        	'state' => $request->state,
	        	'address' => $request->address,
	        );
	        
	        
	  // dd($post_data);
    
        DB::table('branch')->where('branch_id',$id)->update($post_data);
        
        return redirect('/user/institute-details')->with('success', "Branch Update successfully.");
	    
	}

	public function deleteInstitute($id=null)
	{
		if(!empty($id))
		{
			DB::table('branch')->where('branch_id', $id)->delete();
			return redirect('/user/institute-details')->with('success', "Branch deleted successfully.");
		}
	}
	
    public function equipment_details()
	{
	    $user_id = Auth::user()->id;
	    $data['equipments'] = DB::table('user_equipment_details')->select('user_equipment_details.*','branch.pincode','branch.city','users.name','manage_machine_type.machine_type')->leftjoin('manage_machine_type','manage_machine_type.id','=','user_equipment_details.equipment_type')->leftjoin('branch','branch.branch_id','=','user_equipment_details.branch')->leftjoin('users','users.id','=','user_equipment_details.user_id')->where('user_equipment_details.user_id', $user_id)->get();
	    return view('frontend.user.equipment_details')->with($data);
	}
	
	
	public function edit_equipment(){
	   
	    $user_id = Auth::user()->id;
	    
	    $data['equipment'] = DB::table('manage_machine_type')->where('status','=','1')->get();
	    $data['branch'] = DB::table('branch')->where('status','1')->where('user_id',$user_id)->get();
	    
	    $data['equipments'] = DB::table('user_equipment_details')->select('user_equipment_details.*','branch.pincode','branch.city','users.name','manage_machine_type.machine_type')->leftjoin('manage_machine_type','manage_machine_type.id','=','user_equipment_details.equipment_type')->leftjoin('branch','branch.branch_id','=','user_equipment_details.branch')->leftjoin('users','users.id','=','user_equipment_details.user_id')->where('user_equipment_details.user_id', $user_id)->first();
	    return view('frontend.user.equipment_edit')->with($data);
	    
	}
	
	public function equipment_update(Request $request, $id){
	    
	    $data = array(
	        	'last_qa_test' => $request->last_qa_test,
	        	'equipment_type' => $request->equipment_type,
	        	'manufacturer' => $request->manufacturer,
	        	'model' => $request->model,
	        	'serial_no' => $request->serial_no,
	        	'branch' => $request->branch,
	        
	            );
	            
	   DB::table('user_equipment_details')->where('id',$id)->update($data);
	   
	   return redirect('/user/equipment-details')->with('success', "Equipment Update successfully.");
	    
	}
	
	public function equipment_details_create(Request $request)
	{
	    $user_id = Auth::user()->id;
	    $data['equipment'] = DB::table('manage_machine_type')->where('status','=','1')->get();
	    $data['branch'] = DB::table('branch')->where('status','1')->get();
		if(!empty($request->all())){
			$validator = Validator::make($request->all(), [
	            'last_qa_test' => 'required',
	            'equipment_type' => 'required',
	            'manufacturer' => 'required',
	            'model' => 'required',
	            //'serial_no' => 'required',
	            'branch' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return redirect('user/equipment-details-create')->withErrors($validator)->withInput();
	        }

	        DB::table('user_equipment_details')->insert([
	        	'user_id' => $user_id,
	        	'last_qa_test' => $request->last_qa_test,
	        	'equipment_type' => $request->equipment_type,
	        	'manufacturer' => $request->manufacturer,
	        	'model' => $request->model,
	        	'serial_no' => $request->serial_no,
	        	'branch' => $request->branch,
	        ]);

	        return redirect('/user/equipment-details')->with('success', "Equipment added successfully.");
		}else{
			return view('frontend.user.equipment_details_create')->with($data);
		}
	}
	
	public function equipment_details_delete($id=null)
	{
	    if(!empty($id))
		{
			DB::table('user_equipment_details')->where('id', $id)->delete();
			return redirect('/user/equipment-details')->with('success', "Equipment deleted successfully.");
		}
	}
    
    public function blog_list()
    {
        $user_id = Auth::user()->id;
        $data['blog_list']=DB::table('user_blog')->where('user_id', $user_id)->get();
        return view('frontend.user.blog')->with($data);
    }
    
    public function add_blog(Request $request)
    {
        $user_id = Auth::user()->id;
        if(!empty($request->all())){
			$validator = Validator::make($request->all(), [
	            'title' => 'required',
	            'content' => 'required',
	        ]);
	        
	        if ($validator->fails()) {
                return redirect('user/blog')->withErrors($validator)->withInput()->with('error', "Please fill the required field");;
            }
            
            $id = DB::table('user_blog')->insert([
    	        	'user_id' => $user_id,
    	        	'blog_title' => $request->title,
    	        	'content' => $request->content
    	        ]);
    	        
    	   $image = $request->file('image');
    		if($image!=NULL)
    		{
    			$filename = time().$image->getClientOriginalName();
    			$extension = $image->getClientOriginalExtension();
    			$upload = $image->move(public_path('images/upload/blog'), $filename);
    			$path = "images/upload/blog/".$filename;
    			$update_data = array('image'=>$path);
    			$userUpdate = DB::table('user_blog')->where('id', '=', $id)->update($update_data);
    		}
    	   return redirect('/user/blog')->with('success', "Blog created successfully.");
        }
        
    }
    
    public function account_info()
    {
        $user_id = Auth::user()->id;
        $data['head_info'] = DB::table('account_info')->where('user_id', $user_id)->where('type', '1')->first();
        $data['contact_info'] = DB::table('account_info')->where('user_id', $user_id)->where('type', '2')->first();
        $data['user_info'] = DB::table('users')->where('id', $user_id)->first();
        return view('frontend.user.account_info')->with($data);
    }
    
    public function save_headof_institute(Request $request)
    {
        $user_id = Auth::user()->id;
		if(!empty($request->all())){
			$validator = Validator::make($request->all(), [
	            'name' => 'required',
	            'email' => 'required|email',
	            'mobile_no' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return redirect('/user/account-info')->withErrors($validator)->withInput();
	        }
            $chk = DB::table('account_info')->where('user_id', $user_id)->where('type', '1')->get();
            if(count($chk)>0)
            {
                DB::table('account_info')->where('user_id', $user_id)->update([
	        	'name' => $request->name,
	        	'email' => $request->email,
	        	'mobile' => $request->mobile_no,
	        	'type' => '1',
	        ]);

            }else{
                DB::table('account_info')->insert([
	        	'name' => $request->name,
	        	'email' => $request->email,
	        	'mobile' => $request->mobile_no,
	        	'type' => '1',
	        	'user_id' => $user_id
	        ]);

            }
	        
	        //return redirect('/user/account-info')->with('success', "Data updated successfully.");
	        return back()->with('success', "Data updated successfully.");
		}
    }
    
    public function save_contact_info(Request $request)
    {
        $user_id = Auth::user()->id;
		if(!empty($request->all())){
			$validator = Validator::make($request->all(), [
	            'name' => 'required',
	            'email' => 'required|email',
	            'mobile_no' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return redirect('/user/account-info')->withErrors($validator)->withInput();
	        }
            $chk = DB::table('account_info')->where('user_id', $user_id)->where('type', '2')->get();
            if(count($chk)>0)
            {
                DB::table('account_info')->where('user_id', $user_id)->update([
	        	'name' => $request->name,
	        	'email' => $request->email,
	        	'mobile' => $request->mobile_no,
	        	'type' => '1',
	        ]);

            }else{
                DB::table('account_info')->insert([
	        	'name' => $request->name,
	        	'email' => $request->email,
	        	'mobile' => $request->mobile_no,
	        	'type' => '2',
	        	'user_id' => $user_id
	        ]);

            }
	        
	        //return redirect('/user/account-info')->with('success', "Data updated successfully.");
	        return back()->with('success', "Data updated successfully.");
		}
    }
    
    public function update_info(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_password = Auth::user()->password;
		if(!empty($request->all())){
			$validator = Validator::make($request->all(), [
	            'email' => 'required|email',
	            'mobile_no' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return redirect('/user/account-info')->withErrors($validator)->withInput();
	        }
	        $old_pass = $request->old_password;
	        $post_arr = array();
	        if(!empty($old_pass))
	        {
	            if(Hash::check($request->old_password, $user_password)) 
	            {
	                $new_pass = $request->new_password;
	                if(!empty($new_pass)){
	                    $post_arr['password'] = bcrypt($new_pass);
	                }else{
	                    return redirect('/user/account-info')->with('error', "New password required.");
	                    exit();
	                }
	                
	            }else{
	                return redirect('/user/account-info')->with('error', "Old password not matched.");
	                exit();
	            }
	        }
            $post_arr['email'] = $request->email;
            $post_arr['phoneno'] = $request->mobile_no;
           DB::table('users')->where('id', $user_id)->update($post_arr);
	        
	        return back()->with('success', "Data updated successfully.");
		}
    }
    
    public function qa_expiration(Request $request)
    {
        if(!empty($request->all())){
            $validator = Validator::make($request->all(), [
	            'service' => 'required',
	            'expiry_time' => 'required',
	        ]);
        if ($validator->fails()) {
            return redirect('user/qa-expiration')->withErrors($validator)->withInput();
        }
        if(!empty($request->edit_id)){
            DB::table('qa_expiration')->where('id', $request->edit_id)->update([
        	'service_id' => $request->service,
        	'time' => $request->expiry_time
        ]);
        return redirect('user/qa-expiration')->with('success', "Data updated successfully.");
        }else{
            DB::table('qa_expiration')->insert([
        	'service_id' => $request->service,
        	'time' => $request->expiry_time
        ]);
        return redirect('user/qa-expiration')->with('success', "Data added successfully.");
        }
        
        }
        $data['services'] = DB::table('services')->where('status','1')->get();
        $data['qa_expiration_list'] = DB::table('qa_expiration')->select('qa_expiration.*','services.service_name')->join('services',"services.id","=","qa_expiration.service_id")->get();
        return view('frontend.user.qa_expiration')->with($data);
    }
    
    // public function active_offer()
    // {
    //     $user_id = Auth::user()->id;
	   // //$data['order_details'] = DB::table('service_order')->where('user_id', $user_id)->where('active_offer',0)->whereDate('created_at','>=', date('Y-m-d', strtotime('-1 day')))->get();
	   // $order_details = DB::table('service_order')->select('service_order.*','offer_prices.provider_price','offer_prices.provider_id')
	        
	   //     //->leftjoin('service_order as sd',"sd.id","=","offer_prices.order_id")
	        
	   //     ->Join('offer_prices', 'offer_prices.order_id', '=', 'service_order.id')
	   //     ->where('service_order.user_id', $user_id)
	   //     ->where('service_order.is_bid_accepted', 0)->get();
	        
	   //     foreach($order_details as $key=>$order_details_data){
	            
	   //         $users_details = DB::table('users')->where('id',$order_details_data->provider_id)->first();
	            
	   //         //dd($users_details->name);
	            
	   //         $order_details[$key]->provider_name = $users_details->name;
	   //     }
	        
	        
	   //    $data['order_details'] =  $order_details;
	       
	       
	       
	   //    $data['services'] = DB::table('services')->where('status','=','1')->get();
    //       $data['equipments'] = DB::table('manage_machine_type')->where('status','=','1')->get();
        
    //     //dd($data['services']);
        
        
    //     $data['location'] = '';
	        
        
    //     //dd($data['order_details']);
        
    //     return view('frontend.user.active_offer')->with($data);
    // }
    
    
    public function active_offer(Request $request)
	{
	    if(!empty($request->get('reschedule_bid')))
	    {
	        DB::table('bid_report')->where('order_id', $request->get('reschedule_bid'))->update(['status'=>0]);
	        return redirect('user/myorders')->with('success', "Reschedule successfully.");;
	    }
	    if(!empty($request->get('confirm_bid')))
	    {
	        DB::table('service_order')->where('id', $request->get('confirm_bid'))->update(['is_bid_accepted'=>1, 'accept_job'=>1,'is_negotiation'=>1]);
	        
	        DB::table('bid_report')->where('order_id', $request->get('confirm_bid'))->update(['status'=>1]);
	        
	        return redirect('user/myorders')->with('success', "Confirmed successfully.");
	    }
	    
	    if(!empty($request->get('cancel_order'))){ 
	        
	        DB::table('service_order')->where('id', $request->get('cancel_order'))->delete();
	        
	         return redirect('user/active-offer')->with('success', "Order Delete successfully.");
	    }
	    
		$user_id = Auth::user()->id;
		$year = $request->get('year');
		if(!empty($year)){
		    $data['order_details'] = DB::table('service_order')->where('user_id', $user_id)->where('status', 1)->whereYear('created_at', '=', $year)->get();
		}else{
		    $data['order_details'] = DB::table('service_order')->where('user_id', $user_id)->where('status', 0)->orderby('id','DESC')->get();  
		    
		    //dd($data['order_details']);
		}
		$data['year'] = $year;
		//return view('frontend.user.myorders')->with($data);
		return view('frontend.user.incompleteorders')->with($data);
	}
    
    
     public function new_order()
    {
        $user_id = Auth::user()->id;
	    //$data['order_details'] = DB::table('service_order')->where('user_id', $user_id)->where('active_offer',0)->whereDate('created_at','>=', date('Y-m-d', strtotime('-1 day')))->get();
	    $order_details = DB::table('service_order')->select('service_order.*','offer_prices.provider_price','offer_prices.provider_id')
	        
	        //->leftjoin('service_order as sd',"sd.id","=","offer_prices.order_id")
	        
	        ->Join('offer_prices', 'offer_prices.order_id', '=', 'service_order.id')
	        ->where('service_order.user_id', $user_id)
	        ->where('service_order.is_bid_accepted', 0)->get();
	        
	        foreach($order_details as $key=>$order_details_data){
	            
	            $users_details = DB::table('users')->where('id',$order_details_data->provider_id)->first();
	            
	            //dd($users_details->name);
	            
	            $order_details[$key]->provider_name = $users_details->name;
	        }
	        
	        
	       $data['order_details'] =  $order_details;
	       
	       
	       $order_pendding = DB::table('service_order')->where('user_id', $user_id)->where('status',0)->count();
	       
	       
	       
	       if($order_pendding == 0){
	           
	           $data['order_pendding'] = 0;
	           
	          
	           
	       }else{
	           
	           //dd('jbb');
	           
	            $data['order_pendding'] = 1;
	           
	           return redirect('user/active-offer')->with('error', "Please first Complete/Cancel, pending orders");
	       }
	       
	       //dd($data['order_pendding']);
	       
	       
	       
	       $data['services'] = DB::table('services')->where('status','=','1')->get();
          $data['equipments'] = DB::table('manage_machine_type')->where('status','=','1')->get();
        
        
        
        
        $data['location'] = '';
	        
        
        //dd($data['order_details']);
        
        return view('frontend.user.active_offer')->with($data);
    }
    
    
    
    public function expired_offer()
    {
        $user_id = Auth::user()->id;
	    $order_details = DB::table('service_order')->where('user_id', $user_id)->where('active_offer',0)->whereDate('created_at','<', date('Y-m-d', strtotime('-1 day')))->get();
        
        
        
        if(count($order_details) > 0){
		       
		       foreach($order_details as $key=>$val){
		           
		           $user_details = DB::table('users')->where('id', $val->user_id)->first();
		           
		           $order_details[$key]->city = $user_details->city.','.$user_details->pin_code;
		           
		           $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$val->id)->groupBy('soe.service_id')->get();
		           
		           $quantity = 0; 
                   foreach($services as $service){
                       
                                $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get();
                        
                       
                    foreach($service_details as $service_dt){
                        
                        $quantity += $service_dt->quantity;
                    }
                }
                
                
		        $order_details[$key]->machine_quantity = $quantity;
		           
		       } 
		        
		    }
		    
		   // dd($order_details);
		    
		    
		     $data['order_details'] = $order_details;
		     
	
        
        return view('frontend.user.expired_offer')->with($data);
    }
    
    public function sendEmailInvoice(Request $request)
    {
        if(!empty($request->order_id))
        {
          $order_id = $request->order_id;
          $to_email = $request->input('email');
          
          
            
          $order_details = DB::table('service_order')->where('id',$order_id)->first();
          $services = DB::table('service_order_equipment_services as soe')->select('services.service_name','soe.order_id','soe.service_id')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_id)->groupBy('soe.service_id')->get();
        
          $user_id = $order_details->user_id;
          $user_details = DB::table('users')->where('id',$user_id)->first();
          
           $offer_prices = DB::table('offer_prices')->where('order_id',$order_id)->where('status',1)->first();
            
            $provider_id = $offer_prices->provider_id;
            
            $provider_details = DB::table('users')->where('id',$provider_id)->first();
          
          // dd($order_details);
        
         
          
          $email_data = array(
              
              'order_details'=>$order_details, 
              'user_details'=>$user_details, 
              'services'=>$services,
              'invoice'=>1,
               'provider_details'=>$provider_details,
               'email_id'          =>  $to_email,
              'site_email'        =>  'smtp@quality-web-programming.com',
              
              );
       
      //return view('invoice_mail')->with($email_data);
       
        
        $fileName = $order_id.'.pdf';
       
        $storagepath = public_path() .'/'. $fileName;
        
      
        
        $path = url('/').'/storage/app/public/pdf/'.$fileName;
        
       
       
        
        
        
        
            
        $pdf = PDF::loadView('invoice_mail_pdf', $email_data);
  
        Mail::send('invoice_mail', $email_data, function($message)use($email_data, $pdf) {
            $message->from($email_data['site_email'])
                    ->to($email_data["email_id"])
                    ->subject('Invoice');
                    //->attachData($pdf->output(), 'invoice.pdf');
        });
  
            
            
        //dd('jbb');   
            
            
          
          return redirect()->back()->withSuccess('Invoice send successfully');
        }
    }
    
    
    public function otpvalidation(){
        
        
        
            
            $id = Auth::user()->id;
       
        
        
        
        
        $data['user_id'] = $id;
        
        $data['user_details'] = User::where('id',$id)->first();
        
        //dd($data['user_details']);
        
        //return redirect('logout');
        
        return view('auth.otpvalidation')->with($data);
    }
    
    
    public function resendotp(){
        
        
        $id = Auth::user()->id;
        
        
        $data['user_id'] = $id;
        
        $user_details = User::where('id',$id)->first();
        
         $chars = "0123456789";
         $otp = "";
         for ($i = 0; $i < 6; $i++) {
            $otp .= $chars[mt_rand(0, strlen($chars)-1)];
         }
         
         $otpdata = array(
          'otp'        => $otp,
         );
         
         DB::table('users')->where('id',$id)->update($otpdata);
        
        $postdata = array(
          'name'        => $user_details->first_name.' '.$user_details->last_name,
          'otp'        => $otp,
        );
        
        $email_id = $user_details->email;
        //$email_id = 'development.tapasmahato@gmail.com';
        
        CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'otp-varification']);
        
        return redirect('/home')->with('success', 'OTP Resend successfully');
    }
    
    
   public function submit_otp(Request $request){
       
       //dd($request->all());
       
       $user_id = $request->user_id;
       
       $user_details = User::where('id',$user_id)->first();
       
      // dd($user_details);
       
       $otp = $request->otp;
       
       if($otp == ''){
           
           return redirect('/otpvalidation?id='.base64_encode($user_id))->with('error', 'Enter OTP !');
       }
       
       
       $count = User::where('otp',$otp)->where('otp',$otp)->count();
       
       if($count == 1){
           
           
            $postdata = array(
                'name'        => $user_details['first_name'],
            );
        
        #set to mail
        $email_id = $user_details['email'];
        //$email_id = 'development.tapasmahato@gmail.com';

        #sent mail to student for new registration by department head.
        CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'new_registration']);
        
        
        
        //dd('jbb');
           
           if($user_details->roll_id==2){
              
             return redirect('/success_s')->with('success', 'Thank you for registration.');
              
              
           }
           
           
           return redirect('/register2?id='.base64_encode($user_id));
           
       }else{
           
          // return redirect('/otpvalidation?id='.base64_encode($user_id))->with('error', 'Invalid OTP !');
           return redirect('home')->with('error', 'Invalid OTP !');
   }
  }
    
    
    

    public function reg_step2(Request $request)
    {
        $id = base64_decode($request->get('id'));
        if(empty($id)){
            return redirect('/register');
        }
        $data['user_id'] = $id;
        return view('auth.register2')->with($data);
    }

    public function reg_step2_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_type' => 'required',
            // 'confirm_email' => 'required|same:email',
            'med_estb_name' => 'required|string',
            'pincode' => 'required|numeric',
            'address' => 'required|string',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);
        
        

        if ($validator->fails()) {
            return redirect('register2?id='.base64_encode($request->input('user_id')))
                        ->withErrors($validator)
                        ->withInput();
        }else{
            User::where('id',$request->input('user_id'))->update([
                'customer_type' => $request->input('customer_type'),
                'med_estab_name' => $request->input('med_estb_name'),
                'pin_code' => $request->input('pincode'),
                'address' => $request->input('address'),
                'country' => $request->input('country'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'about' => $request->input('about'),
                'reminder' => $request->input('reminder'),
                'support' => $request->input('support'),
                'status' => 1,
                'otp_varification' => 1,
            ]);
            
            
            
            if(Session::get('invoice_no')){
	        
	       $invoice_no = Session::get('invoice_no'); 
	        
	        $order_id = DB::table('service_order')->where('invoice_no',$invoice_no)->first();
	        
	        $order_id = $order_id->id;
	        
	        //dd($order_id);
	        
	        $service_order = array(
              'user_id'=> Auth::user()->id,
             );
             
	       DB::table('service_order')->where('id',$order_id)->update($service_order);
	       
	       
	       session()->forget('invoice_no');
	       
	       return redirect()->to('orderplaced?order_id='.$order_id)->with('success','Service requested successfully');
	        
	    }else{
	        
	        return $this->index();
	    }
            
            
            
            

            //return redirect('/success')->with('success', 'Thank you for registration, check yuor mail account for activation link.');
            //return redirect('/success')->with('success', 'Thank you for registration');
        }
    }

    public function sendotp(Request $request)
    {
        $phoneno = $request->input('phoneno');
        $otp = rand();
        if($phoneno!='')
        {
            DB::table('otp_validation')->insert(
            array(
                'mobile_no'     =>   $phoneno, 
                'otp'   =>   $otp
            )
        );
            return $otp;
        }
    }

    public function success()
    {
        return view('frontend.thankyou');
    }
    
    public function equipment(Request $request)
    {
        
        if($request->equipment =='yes'){
            return redirect('sign-up');
        }else{
            return redirect('user/dashboard');
        }
        
    }
    

	
}
