<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Mail;
use View;
use Image;
use File;
use Storage;
use Twilio;
use CRUDBooster;
use App\User;
use App\CmsSetting;
use Validator;
use App\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\StaticPage;
use App\Models\StaticPageDetails;
use App\Models\StaticPageSlider;
use DateTime;
use DateInterval;

use Razorpay\Api\Api;
//use Session;
use Exception;
use PDF;

class HomeController extends Controller{


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

	}
	
	function index(){

		$data = array();
		
          $data['clients_say'] = DB::table('client_says')->where('status',1)->get();

          $data['static_page'] = DB::table('static_page_details')->where('page_id',9)->first();
          $data['satisfaction'] = DB::table('static_page_details')->where('page_id',21)->first();
          $data['package_list'] = DB::table('membership_packages')->where('status',1)->orderBy('id','desc')->get();

          //dd($data['package_list']);
          
          /**/
          
          
          $data['user_id'] = Auth::user()->id;
          
          if(Auth::user()->id){
              
              $id = Auth::user()->id;
              $user_details = User::where('id',$id)->first();
              
              if($user_details->otp_varification == 0){
                  
                 return redirect('/logout')->with('error', 'Enter your OTP !');
                 //return redirect('/home')->with('error', 'Enter your OTP !');
              }
          }
                
		
                
		return View::make('frontend.home')->with($data);
	}

	function home(){
		return $this->index();
	}
	
	
	function date_calculation(Request $request){
	    
	    
	            
	            $total_year1 = $request->total_year;
	            
	            if($total_year1 == 2){
	               
	                $total_year = 730; 
	            }else{
	                 $total_year = 0;
	            }
	            
	            //$total_year = 365*$total_year;
	            
	            $dob = date('d-m-Y',strtotime($request->date1));
	            
	            $today = date('d-m-Y');
	            
	            //$today = date('d-m-Y', strtotime($today . ' +365 day'));
	             $today = date('d-m-Y', strtotime($today . ' +'.$total_year.' day'));
	            //$dob = date('d-m-Y', strtotime($dob . ' +'.$total_year.' day'));
	            
				//$dob = '05-07-2020';
				
				$fdate = $dob;
                $tdate = $today;
                $datetime1 = new DateTime($fdate);
                $datetime2 = new DateTime($tdate);
                $interval = $datetime1->diff($datetime2);
                $total_days = $interval->format('%a');
                //$total_days = $interval->format('%m');
                
                //echo $interval->format('%Y years, %m months, %d days'); die;
				
				//dd($total_days);
			
				
				
				
				

				$dob_a = explode("-", $dob);
				$today_a = explode("-", $today);
				$dob_d = $dob_a[0];$dob_m = $dob_a[1];$dob_y = $dob_a[2];
				$today_d = $today_a[0];$today_m = $today_a[1];$today_y = $today_a[2];
				$years = $today_y - $dob_y;
				$months = $today_m - $dob_m;
				$days=$today_d - $dob_d;
				if ($today_m.$today_d < $dob_m.$dob_d) 
				{
					$years--;
					$months = 12 + $today_m - $dob_m;
					
				}

				if ($today_d < $dob_d) 
				{
					$months--;
				}

				$firstMonths=array(1,3,5,7,8,10,12);
				$secondMonths=array(4,6,9,11);
				$thirdMonths=array(2);

				if($today_m - $dob_m == 1) 
				{
					if(in_array($dob_m, $firstMonths)) 
					{
						array_push($firstMonths, 0);
					}
					elseif(in_array($dob_m, $secondMonths)) 
					{
						array_push($secondMonths, 0);
					}elseif(in_array($dob_m, $thirdMonths)) 
					{
						array_push($thirdMonths, 0);
					}
				}
				
				//dd();
				
				if($total_year1 == 2){
				
				//dd($total_days);
				
				if($total_days < 730){
				    
				       //$total_days = 730 - $total_days;
				    
				     //dd($total_days);
				    
				    
				   echo '<div class="alert alert-warning">Your last QA has already expired. Please click on “Get Quote” to proceed</div><div class="bookbtns"><a href='.url('sign-up').' class="bookbtn">Get Quote</a></div>'; die;
				    
				    
				}else{
				    
				    
				    $totaldays = $total_days - 730;
				    
				   //dd($totaldays);
				   
				   if($totaldays > 730){
				       
				      echo '<div class="alert alert-warning">Your last QA has already expired. Please click on “Get Quote” to proceed</div><div class="bookbtns"><a href='.url('sign-up').' class="bookbtn">Get Quotee</a></div>'; die;
				       
				   }
				    
				    
				      $total_days = 730 - $totaldays;
				    
				    //dd($total_days);
				    
				    
				    $days = $total_days;

                    $start_date = new DateTime();
                    $end_date = (new $start_date)->add(new DateInterval("P{$days}D") );
                    $dd = date_diff($start_date,$end_date);
                   $full_year =  $dd->y." year ".$dd->m." months ".($dd->d -1)." days";
				    
				    //echo '<div class="alert alert-warning">Your last QA will be expired in '.$full_year.' </div><div class="bookbtns"><a href="{{url("/register")}}" class="bookbtn">Remind Me</a></div>'; die;
				    echo '<div class="alert alert-warning">Your last QA will be expired in '.$full_year.' </div> <div class="bookbtns"><a href="{{url("/register")}}" class="bookbtn"><input type="submit" value="Remind Me" class="bookbtn"> </div>'; die;
				}
			}else{
			    
			    	if($total_days > 365){
				    
				      $total_days = 365- $total_days;
				    
				    /*now*/
				   echo '<div class="alert alert-warning">Your last QA has already expired. Please click on “Get Quote” to proceed</div><div class="bookbtns"><a href='.url('sign-up').' class="bookbtn">Get Quote</a></div>'; die;
				    
				    
				}else{
				    
				     $total_days = 365- $total_days;
				    
				    
				    
				    $days = $total_days;

                    $start_date = new DateTime();
                    $end_date = (new $start_date)->add(new DateInterval("P{$days}D") );
                    $dd = date_diff($start_date,$end_date);
                   $full_year =  $dd->y." year ".$dd->m." months ".($dd->d -1)." days";
				    
				    //echo '<div class="alert alert-warning">Your last QA will be expired in '.$full_year.' </div><div class="bookbtns"><a href="{{url("/register")}}" class="bookbtn">Remind Me</a></div>'; die;
				    echo '<div class="alert alert-warning">Your last QA will be expired in '.$full_year.' </div><div class="bookbtns"><input type="submit" value="Remind Me" class="bookbtn"></div>'; die;
				}
			}

				
				
	    
	}
	
	
	
	
	
	

    public function newsletter(Request $request){

        

        $allergydata = array(
                'email' => $request->email,                
                'created_at' => date('Y-m-d'),                
            );
        $insertallergydata = DB::table('newslatter')->insert($allergydata);
        
        
        //$this->sendNewsletterMail($request);
        $site_dtls = DB::table('cms_settings')->where('name', 'site_phone')->first();

        //dd($site_dtls);

        $site_email = $site_dtls->content;
        
         $email_data = array(
            'email_id'          =>  $request->email,
            'site_email'        =>  $site_email,
            
        );
        
        /*Mail::send('emails.mailnews', $email_data,  function ($message) use ($email_data) 
                {
                $message->from($email_data['site_email'], 'Altibbe');
                $message->to($email_data['email_id'] )->subject('Successfully Subscribed');            
        });*/
        
        return back()->with('success', 'Thanks for contacting us!');
    }

    public function postForgot(Request $request)
    {
        $user = CRUDBooster::first('users', ['email' => g('email')]);

        //dd($user);
        
        if($user){

        $site_dtls=CmsSetting::where('name', 'email')->first();
        $site_email = $site_dtls->content;

        $key_user=base64_encode(g('email'));    
        //$key_user=base64_decode($key_user);   

       // dd($key_user);

        $email_verify_link=url('/').'/change-pass/'.$key_user;

        //dd($email_verify_link);
        $user_email = g('email');

        $email_data = array(
            'email_id'          =>  g('email'),
            'site_email'        =>  $site_email,
            'verification_link' =>  $email_verify_link
        );
        
        //dd($email_data);
        
        
            $user->email_verify_link = $email_verify_link;
            $user->first_name = ucfirst($user->first_name);
                CRUDBooster::sendEmail(['to' => $user_email, 'data' => $email_data, 'template' => 'change_password_frontend']);
                CRUDBooster::insertLog(trans("crudbooster.log_forgot", ['email' => g('email')]));

            return redirect()->route('auth.forgot')->with('message', 'We have sent link to your email, check inbox or spambox !');
        
            
        }else{
                $message ='The selected email is invalid.';
                return redirect()->back()->with(['message' => $message, 'message_type' => 'danger']);
        }
    }


    public function change_pass($email){

        //dd($email);
        $data['varify_key']=$email;

        return View::make('changepass')->with($data);

    }


    public function change_forgot_pass(Request $request){
        $user_exist=base64_decode($request->varify_key);
        //dd($user_exist);
         $newp= $request->newp;
         $password = Hash::make($newp);
         $cmsuser=User::where('email', $user_exist)->first();
         $cmsuser->password = $password;
         $cmsuser->save();

         return redirect('login');
    }

    
    public function page($slug=null){

      if ($slug === 'about-us') {
        $page = DB::table('static_page')->where('seo_url',$slug)->first();
        /*$data['page_details'] = DB::table('static_page_details')
                                ->leftJoin('static_page_slider', 'static_page_details.id', '=', 'static_page_slider.page_details_id')
                                ->where('page_id',$page->id)->get();
            // dd($data['page_details']);*/

        $data['page_details'] = StaticPage::where('id', $page->id)->with(['details' => function($q){ $q->with('sliders');  }])->get();

         //dd($data['page_details']);

        return View::make('frontend.about')->with($data);
      }
      else{
        $page = DB::table('static_page')->where('seo_url',$slug)->first();
        $data['page_details'] = DB::table('static_page_details')->where('page_id',$page->id)->first();

        //dd($data['page_details']);
    
        return View::make('frontend.page')->with($data);
      }
    }

    public function serviceprovider(){

      //$data['providers'] = DB::table('users')->where('roll_id',2)->get();
      
      //$data['quality_assurance'] = DB::table('static_page')->where('paid',14)->first();
      $data['quality_assurance'] = DB::table('static_page_details')->where('page_id',33)->first();
      $data['regulatory_compliance'] = DB::table('static_page_details')->where('page_id',29)->first();
      $data['procurement_equipment'] = DB::table('static_page_details')->where('page_id',30)->first();
      //$data['shielding_requirement'] = DB::table('static_page_details')->where('page_id',31)->first();
      $data['shielding_requirement'] = DB::table('shielding_requirement')->get();
      
      
      //dd($data['quality_assurance']);
      
      return View('frontend.service')->with($data);
      
      //return View::make('frontend.user.sproviderlist')->with($data);
    }

    public function contactus()
    {
      return View('frontend.contact_us');
    }

    public function contactusmsg(Request $request)
    {
      $input = Input::all();
      $rules = array(
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:50|email',
            'mobile' => 'required|numeric|min:10',
            'message' => 'required|string|min:6',
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect()->to('contact')->withErrors($validator)->withInput();
        }else{
          $name = $request->input('name');
          $email = $request->input('email');
          $mobile = $request->input('mobile');
          $msg = $request->input('message');

          DB::table('contact_us')->insert([
            'name'=>$name,
            'email'=>$email,
            'mobile'=>$mobile,
            'message'=>$msg
          ]);

          $data = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'msg'=>$msg);
          Mail::send('contact',$data, function($message){
              $message->to('goutam.nayek@webguru-development.com')->subject("Enquiry");
              $message->from('goutam.nayek@webguru-development.com','Enquiry');
          });
          return redirect()->to('contact')->with('success','Message send successfully');
        }
    }

     public function schedulecall(Request $request)
      {
          $date = $request->input('date');
          $time = $request->input('time');
          $mobile = $request->input('mobile');

          $data = array();
          if(!empty($date) && !empty($time) && !empty($mobile))
          {
              DB::table('call_schedule')->insert(
              array(
                  'date'     =>   $date, 
                  'time'   =>   $time,
                  'mobile'   =>   $mobile
              )
          );
              $data['success']="We have received your request. You will received a call in your schedule date & time.";
          }else{
              $data['error'] ="We can not process your request.";
          }

          echo json_encode($data);
      }
      
      
      public function testreminder(Request $request)
      {
          $date = $request->input('date');
          $mobile = $request->input('mobile');
          $email = $request->input('email');
          $response = $request->input('response');

          $data = array();
          if(!empty($date)  && !empty($mobile))
          {
              DB::table('testreminder')->insert(
              array(
                  'date'     =>   $date, 
                  'response'     =>   $response, 
                  'mobile'   =>   $mobile,
                  'email'   =>   $email
              )
          );
              $data['success']="We have received your request. You will received a call in your schedule date.";
          }else{
              $data['error'] ="We can not process your request.";
          }

          echo json_encode($data);
      }

      public function signup_process(Request $request)
      {
        $data['services'] = DB::table('services')->where('status','=','1')->get();
        $data['equipments'] = DB::table('manage_machine_type')->where('status','=','1')->get();
        
        //dd($data['services']);
        
        $data['location'] = '';
        return View::make('frontend.signup')->with($data);
      }

      /*Sign-up page */
      public function getxrymachines(Request $request)
      {
        $service_id = $request->input('service_id');
        // $sql = "SELECT * FROM xray_machines_services_tag as xtag JOIN xray_machines as xm ON xtag.xray_machines_id=xm.id JOIN manage_machine_type as mt ON xm.machine_type=mt.id WHERE xtag.services_id='".$service_id."'";
        $data = DB::table('xray_machines_services_tag as xtag')
                ->select('*','mt.id as equipment_id')
                ->join('xray_machines as xm','xtag.xray_machines_id','=','xm.id')
                ->join('manage_machine_type as mt','xm.machine_type','=','mt.id')
                ->where('xtag.services_id','=',$service_id)
                ->get();
        return response()->json($data);
        
        //
      }

      public function orderprocess(Request $request)
      {
       //dd($request->all());
        if(!empty($request->input('machine_id')))
        {
          $invoice_no = time();
          
          Session::put('invoice_no', $invoice_no);
          
          $invoice_no_session = Session::get('invoice_no');
          
          //dd($invoice_no_session);
          
          
          $price = 0;
          /*for($a=0; $a<count($request->input('price')); $a++)
          {
            $price +=$request->input('price')[$a];
          }*/
          
          
          for($a=0; $a<count($request->input('price')); $a++)
          {
            $price +=$request->input('price')[$a] * $request->input('quantity')[$a];
          }
          
          
          
          $service_order = array(
              'invoice_no'=>$invoice_no,
              'total_amount'=>$price,
              //'user_id'=>$request->input('user_id'),
              'status'=>0,
              'created_at'=>date('Y-m-d h:i:s'),
          );
          
          //dd($service_order);
          
          $order_id = DB::table('service_order')->insertGetId($service_order);
          
          for($i=0; $i<count($request->input('machine_id')); $i++){
            if(!empty($request->input('service_id')[$i])):
              $service_order_equipment = array(
              'order_id'=>$order_id,
              'service_id'=>$request->input('service_id')[$i],
              'machine_id'=>$request->input('machine_id')[$i],
              'equipment_id'=>$request->input('equipment_id')[$i],
              'equipments'=>$request->input('equipment')[$i],
              'quantity'=>$request->input('quantity')[$i],
              'amount'=>$request->input('price')[$i],
              'location'=>$request->input('location'),
              'created_at'=>date('Y-m-d h:i:s'),
            );

            DB::table('service_order_equipment_services')->insert($service_order_equipment);
          endif;
          }
          
          //dd($service_order_equipment);
          
          //return redirect()->to('orderplaced?order_id='.$order_id)->with('success','Service requested successfully');
           return redirect()->to('login');
          
        }
        return redirect()->to('sign-up');
      }
      
      
      
      public function orderprocessuser(Request $request)
      {
       
        if(!empty($request->input('machine_id')))
        {
          $invoice_no = time();
          
          
          
          
          $price = 0;
         /* for($a=0; $a<count($request->input('price')); $a++)
          {
            $price +=$request->input('price')[$a];
          }*/
          
          
          for($a=0; $a<count($request->input('price')); $a++)
          {
            $price +=$request->input('price')[$a] * $request->input('quantity')[$a];
          }
          
          
          $service_order = array(
              'invoice_no'=>$invoice_no,
              'total_amount'=>$price,
              'user_id'=>Auth::user()->id,
              'status'=>0,
              'created_at'=>date('Y-m-d h:i:s'),
          );
          
          //dd($price);
          
          //dd($request->all());
          
          $order_id = DB::table('service_order')->insertGetId($service_order);
          
          for($i=0; $i<count($request->input('machine_id')); $i++){
            if(!empty($request->input('service_id')[$i])):
              $service_order_equipment = array(
              'order_id'=>$order_id,
              'service_id'=>$request->input('service_id')[$i],
              'machine_id'=>$request->input('machine_id')[$i],
              'equipment_id'=>$request->input('equipment_id')[$i],
              'equipments'=>$request->input('equipment')[$i],
              'quantity'=>$request->input('quantity')[$i],
              'amount'=>$request->input('price')[$i],
              'location'=>$request->input('location'),
              'created_at'=>date('Y-m-d h:i:s'),
            );

            DB::table('service_order_equipment_services')->insert($service_order_equipment);
          endif;
          }
          
          //dd($service_order_equipment);
          
          return redirect()->to('orderplaced?order_id='.$order_id)->with('success','Service requested successfully');
          // return redirect()->to('login');
          
        }
        return redirect()->to('active-offer');
      }
      
      
      
      
      
      
      public function placeorder($invoice_no)
      {
          /*if(!empty($invoice_no))
          {
              DB::table('service_order')->where('invoice_no', $invoice_no)->update(['active_offer'=>1]);
              return redirect('user/myorders');
          }
          */
          
          
          $price = DB::table('service_order')->where('invoice_no', $invoice_no)->first();
          
          $total_price = $price->total_amount;
          
          
          $user_id = Auth::user()->id;
          
          //dd($user_id);
          
          $order_id = time();

            $oders_data =array(

                          'user_id' => $user_id, 
                          'order_id' => $order_id, 
                          'order_price' =>$total_price, 
                          'transection_id' =>'',
                          'item_id' =>$invoice_no,
                          'updated_at' => date('Y-m-d'), 
                        );
             DB::table('orders')->insert($oders_data);
             
             
             
             DB::table('service_order')->where('invoice_no', $invoice_no)->update(['service_order'=>$order_id]);
             
             
             $paypal_data =  array(

                'unique_id' =>$order_id,
                'price' =>$total_price, 
        
              );

           $data['payment_details'] = $paypal_data;

        return View::make('paypal')->with($data);
          
          
      }

      public function orderplaced(Request $request)
      {
        
        if(!empty($request->input('inv_order_id')))
        {
            
            $order_id = $request->input('inv_order_id');
            
            $order_details = DB::table('service_order')->where('id',$order_id)->first();
            
            $offer_prices = DB::table('offer_prices')->where('order_id',$order_id)->where('status',1)->first();
            
            $provider_id = $offer_prices->provider_id;
            
            $provider_details = DB::table('users')->where('id',$provider_id)->first();
            
            $user_id = $order_details->user_id;
            $user_details = DB::table('users')->where('id',$user_id)->first();
            
            $services = DB::table('service_order_equipment_services as soe')->select('services.service_name','soe.order_id','soe.service_id','soe.quantity','soe.amount')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_id)->groupBy('soe.service_id')->get();
            
            
            foreach($services as $key=>$service){
                       
                                $service_details = DB::table('service_order_equipment_services')->where('order_id',$service->order_id)->where('service_id',$service->service_id)->first();
            
               $services[$key]->all_equipment .= $service_details->equipments.'';
            }
            
            $email_data = array(
              'order_details'=>$order_details, 
              'user_details'=>$user_details, 
              'services'=>$services,
              'provider_details'=>$provider_details,
              );
              
            //dd($services);
              
            $pdf = PDF::loadView('invoice_mail_pdf', $email_data);
            
           // return View::make('invoice_mail_pdf')->with($email_data);
            
            
            
            return $pdf->download('invoice.pdf');
            
            
            
        }
        
        if(!empty($request->input('order_id')))
        {
          $order_id = $request->input('order_id');
          $data['order_details'] = DB::table('service_order')->where('id',$order_id)->first();
          $data['services'] = DB::table('service_order_equipment_services as soe')->select('services.service_name','soe.order_id','soe.service_id')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_id)->groupBy('soe.service_id')->get();
          
          
          //dd($data['order_details']);
          
          
          return View::make('frontend.invoice1')->with($data);
        }else{
          return redirect()->to('/');
        }
        
      }
      
      
    public function testimonials()
    {
      return View('frontend.testimonials');
    }
    
    public function service()
    {
      return View('frontend.service');
    }
    
    public function guarantee()
    {
      return View('frontend.guarantee');
    }
    
    
   
    
    public function otpvalidation(){
        
        
        
        
        $id = base64_decode(Auth::user()->id);
        
        
        $data['user_id'] = $id;
        
        $data['user_details'] = User::where('id',$id)->first();
        
        //dd($data['user_details']);
        
        return view('auth.otpvalidation')->with($data);
    }
    
    
   public function submit_otp(Request $request){
       
       //dd($request->all());
       
       $user_id = $request->user_id;
       $otp = $request->otp;
       
       
       
       if($otp == ''){
           
           return redirect('/otpvalidation?id='.base64_encode($user_id))->with('error', 'Enter OTP !');
       }
       
       
       $count = User::where('otp',$otp)->where('otp',$otp)->count();
       
       
       
       if($count == 1){
           
           return redirect('/register2?id='.base64_encode($user_id));
           
       }else{
           
           return redirect('/otpvalidation?id='.base64_encode($user_id))->with('error', 'Invalid OTP !');
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

            //return redirect('/success')->with('success', 'Thank you for registration, check yuor mail account for activation link.');
            return redirect('/success')->with('success', 'Thank you for registration');
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
    
    
    public function paymentrazarpay($invoice_id)
    {
        
        
        $price = DB::table('service_order')->where('invoice_no', $invoice_id)->first();
          
          $total_price = $price->total_amount*(18/100);
          $total_price = $total_price + $price->total_amount;
          
          //dd($price);
        
       $order_id = time();

            $oders_data =array(

                          'user_id' => $user_id, 
                          'order_id' => $order_id, 
                          'order_price' =>$total_price, 
                          'transection_id' =>'',
                          'item_id' =>$invoice_id,
                          'updated_at' => date('Y-m-d'), 
                        );
             DB::table('orders')->insert($oders_data);
             
             
             
             //DB::table('service_order')->where('invoice_no', $invoice_no)->update(['service_order'=>$order_id]);
             DB::table('service_order')->where('invoice_no', $invoice_id)->update(['service_order'=>$order_id]);
  
  
        $data['invoice_id'] = $invoice_id;
        $data['invoice_description'] = "Order #{$invoice_id} Invoice";
        $data['return_url'] = route('payment.success1');
        $data['cancel_url'] = route('payment.cancel1');
        $data['total'] = $total_price;
        
  
    return view('razorpayView')->with($data);
    
       
    }
    
    
    public function store(Request $request)
    {
        $input = $request->all();
        
        
        
        
        $id = Auth::user()->id;
        
        $user_details = User::where('id',$id)->first();
        

        
        $postdata = array(
          'name'        => $user_details->first_name.' '.$user_details->last_name,
          
        );
        
        $email_id = $user_details->email;
        //$email_id = 'development.tapasmahato@gmail.com';
        
        CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'payment-success']);
        
        
       
        
        
        
        
        //dd($input);
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
        $invoice_no = $request->invoice_id;
        
        //dd($request->invoice_id);
        
        if($payment->status=='authorized'){
            
            DB::table('user_membership')->where('invoice_no', $invoice_no)->update(['payment_status'=>'Success','token'=>'','payer_id'=>$payment->id,'status'=>1]);
  
  
                $qoutedata1=array(
                     'transection_id'=>$payment->id,                               
                     'status'=>'1',                             
                        
                        );
                    
                       
                        $orderUpdate1 = DB::table('orders')->where('order_id',$invoice_no)->update($qoutedata1);

                        /*DB::table('service_order')->where('service_order', $invoice_no)->update(['active_offer'=>1]);*/
                        
                        DB::table('service_order')->where('invoice_no', $invoice_no)->update(['status'=>1]);
                        
                        return redirect('/user/myorders');
            
        }
        
        
        
         
        
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
    
    public function dopayment(Request $request) {
        //Input items of form
        $input = $request->all();

        // Please check browser console.
        print_r($input);
        exit;
    }
    
    
    public function paymentrenew(Request $request)
    {
        //dd($request->all());
        $booking_id = $request->get('booking_id');
        $order_details = DB::table('user_membership')->join('manage_membership','manage_membership.id','user_membership.membership_id')->where('user_membership.id', $booking_id)->first();
        $data = [];
        $data['items'] = [
            [
                'name' => $order_details->title,
                'price' => $order_details->price,
                'desc'  => $order_details->description,
                'qty' => 1
            ]
        ];
  
        
        //dd();
       
        
        $data['invoice_id'] = $request->get('order_id');
        $data['invoice_description'] = "Order #{$request->get('order_id')} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $order_details->price;
        
  
        return view('razorpayViewrenew')->with($data);
    }
    
    
    public function storerenew(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
        $invoice_no = $request->invoice_id;
        
        //dd($request->invoice_id);
        
        if($payment->status=='authorized'){
            
           $invoice_no = $response['INVNUM'];
        //dd($response);
        
        DB::table('user_membership')->where('invoice_no', $invoice_no)->update(['payment_status'=>'Success','token'=>'','payer_id'=>$payment->id,'status'=>1]);
        
         DB::table('service_order')->where('invoice_no', $invoice_no)->update(['status'=>1]);
  
        return redirect('renew')->with('success','Membership subscribed successfully');
            
        }
        
        
        
         
        
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
    
    public function success_s()
    {
        return view('frontend.thankyou');
    }

    
}
