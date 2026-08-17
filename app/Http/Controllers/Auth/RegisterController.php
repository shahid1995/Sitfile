<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use DB;
use Mail;
use App\Http\Requests;

use CRUDBooster;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    protected $redirectTo = "/otpvalidation?id='.base64_encode(Auth::User()->id)";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		//dd($data);
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
			// 'confirm_email' => 'required|same:email',
            //'name' => 'required|string',
            'phoneno' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
            //'username' => 'required|string|min:6|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
		//dd($data);

        /*$token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        echo $max; die;

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
        }*/
        $name= substr($data['name'], 0, 2);
        
        $uniqueId1 = time();
        $uniqueId1 = substr($uniqueId1,6); 

        $uniqueId = $name.''.$uniqueId1;

        //echo $uniqueId; die;

        //dd(str_random(8));

        //dd('jbb');

        $user= User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            //'username' => $data['username'],
            'username' => str_random(8),
            'phoneno' => $data['phoneno'],
            //'whatsappno' => $data['whatsappno'],
            'usertoken' => str_random(40),
            'roll_id' => $data['roll_id'],
            'name' => $data['name'],
            'otp' => $uniqueId1,
        ]);
        
        
         

        # sent user to veryfication mail #
        $postdata = array();

        #set mail content array
        $postdata = array(
          'name'        => $data['username'],
          'link'        => url('/veryfyaccount/'.$user->usertoken),
        );
        
        #set to mail
        $email_id = $data['email'];

        #sent mail to student for new registration by department head.
        //CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'customer_registration']);

        # sent user to veryfication mail #

        

		return $user;
    }
	
	public function register(Request $request)
    {
        // $this->validator($request->all())->validate();
        // event(new Registered($user = $this->create($request->all())));
        // return $this->registered($request, $user)
        //     ?: redirect('/register')->with('success', 'Thank you for registration, check yuor mail account for activation link.');

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            // 'confirm_email' => 'required|same:email',
           // 'name' => 'required|string',
            'phoneno' => 'required|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator)->withInput();
        }
        
        $chars = "0123456789";
        $otp = "";
        for ($i = 0; $i < 6; $i++) {
            $otp .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        
         $postdata = array(
          'name'        => $request->input('first_name').' '.$request->input('last_name'),
          'otp'        => $otp,
        );
        
        #set to mail
       
        
       $userdata = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phoneno' => $request->input('phoneno'),
            //'name' => $request->input('name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'active_status' => 1,
            'roll_id' => '1',
            'otp' => $otp,
        ]);
        
        
        Auth::loginUsingId($userdata->id);


       


         $email_id = $request->input('email');
        //$email_id = 'development.tapasmahato@gmail.com';
        
        

        CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'otp-varification']);
        

        // Mail::send('mail',['name','Ripon Uddin Arman'],function($message){
        //     $message->to('goutam.nayek@webguru-development.com')->subject("Email Testing with Laravel");
        //     $message->from('goutam.nayek@webguru-development.com','Creative Losser Hopeless Genius');
        // });

        //return redirect('/register')->with('success', 'Thank you for registration, check yuor mail account for activation link.');

        //return redirect('/register2?id='.base64_encode($userdata->id));
        return redirect('/otpvalidation?id='.base64_encode($userdata->id));


    }
    
    
    public function otpvalidation(Request $request){
        
       /* $id = base64_decode(Auth::user()->id);
        
        if(empty($id)){
            return redirect('/register');
        }
        $data['user_id'] = $id;
        
        $data['user_details'] = User::where('id',$id)->first();
        */
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


    # transporter registration
    public function transportregister(Request $request)
    {   
        $data = array();
        return view('frontend.transportregister')->with($data);
    }
    # transporter registration

    /**
     * Store a newly created Transporter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTransporter(Request $request)
    {
        //
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            // 'confirm_email' => 'required|same:email',
            'name' => 'required|string',
            'phoneno' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|min:6|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect('transportregister')
                        ->withErrors($validator)
                        ->withInput();
        }

        $transporter = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'username' => $request->input('username'),
            'phoneno' => $request->input('phoneno'),
            'whatsappno' => $request->input('whatsappno'),
            'usertoken' => str_random(40),
            'roll_id' => $request->input('roll_id'),
            'name' => $request->input('name'),
            'company_name' => $request->input('company_name'),
            'address' => $request->input('address'),
            'other_details' => $request->input('other_details'),
            'active_status' => 0,
        ]);


        # sent user to veryfication mail #
        $postdata = array();

        #set mail content array
        $postdata = array(
          'name'        => $transporter->username,
          'link'        => url('/veryfyaccount/'.$transporter->usertoken),
        );
        
        #set to mail
        $email_id = $transporter->email;

        #sent mail to student for new registration by department head.
        CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'transporter_registration']);

        # sent user to veryfication mail #

        return redirect('transportregister')->with('success', 'Thank you for registration, check yuor mail account for activation link.');
    }

    # account veryfy section
    public function accountVeryfy($utoken)
    {   
        #check user
        $checkUser = User::where('usertoken',$utoken)->first();
        #check user

        if($checkUser){
            User::where('usertoken',$utoken)->update(['status' => 1]);
            return redirect()->route('login')->with('success', 'Your account is activate successfully.');
        }else{
            return redirect()->route('login')->with('error', 'Usertoken is invalid. Try again.'); 
        }
        
    }
    # account veryfy section
}
