<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use Helper;
use App\User;
use CRUDBooster;
 
class ServiceRegistrationController extends Controller
{
    public function create()
    {
        $data['packages'] = DB::table('membership_packages')->where('status',1)->get();
        return view('registration.create')->with($data);
    }
    /**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $rules = array(
            'name' => 'required|string|max:150',
            'mobileno' => 'required|min:10|numeric|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
            'company_name' => 'required',
            'gstin' => 'required|min:12|numeric',
            'pincode' => 'required|numeric',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'number_of_serv_eng' => 'required',
            'name_of_serv_eng' => 'required',
            'remarks' => 'required',
            'city' => 'required',
            'auth_upload' => 'required|max:10000|mimes:jpeg,jpg,png',
            'certificate_upload' => 'required|max:10000|mimes:jpg,jpeg,png',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->to('sregister')->withErrors($validator)->withInput();;
        } else {

            $uploadFile['auth_letter'] = $request->file('auth_upload');
            $uploadFile['rso_certificate'] = $request->file('certificate_upload');

            $destinationPath = 'public/images/upload/service';
            $uploadFile['auth_letter']->move($destinationPath,$uploadFile['auth_letter']->getClientOriginalName());
            $uploadFile['rso_certificate']->move($destinationPath,$uploadFile['rso_certificate']->getClientOriginalName());

            $chars = "0123456789";
            $otp = "";
            for ($i = 0; $i < 6; $i++) {
                $otp .= $chars[mt_rand(0, strlen($chars)-1)];
            }
        
             $postdata = array(
              'name'        => $request->input('first_name').' '.$request->input('last_name'),
              'otp'        => $otp,
            );
    

            DB::table('users')->insert(
            [
             'name' => $input['name'],
             'phoneno' => $input['mobileno'],
             'email' => $input['email'],
             'password' => bcrypt($input['password']),
             'company_name' => $input['company_name'],
             'gst' => $input['gstin'],
             'pin_code' => $input['pincode'],
             'address' => $input['address'],
             'country' => $input['country'],
             'state' => $input['state'],
             'city' => $input['city'],
             'number_of_service' => $input['number_of_serv_eng'],
             'name_of_serv_eng' => $input['name_of_serv_eng'],
             'remarks' => $input['remarks'],
             'auth_letter' => $destinationPath.'/'.$uploadFile['auth_letter']->getClientOriginalName(),
             'rso_certificate' => $destinationPath.'/'.$uploadFile['rso_certificate']->getClientOriginalName(),
             'roll_id' => 2,
             'active_status' => '0',
             'otp' => $otp,
            ]
            );
            
            $last_id =  DB::getPdo()->lastInsertId();
            
            Auth::loginUsingId($last_id);
            
            //dd($last_id);
            
            $email_id = $input['email'];
            //$email_id = 'development.tapasmahato@gmail.com';
            CRUDBooster::sendEmail(['to' => $email_id, 'data' => $postdata, 'template' => 'otp-varification']);
            
           
            
          return redirect('/otpvalidation?id='.base64_encode($last_id));
            
            return redirect('/success')->with('success', 'Thank you for registration, check yuor mail account for activation link.');
        }
    }
    
    public function dashboard()
    {
        $user_id = Auth::user()->id;
	    $data['equipments'] = DB::table('user_equipment_details')->select('user_equipment_details.*','branch.pincode','branch.city','users.name','manage_machine_type.machine_type')->join('manage_machine_type','manage_machine_type.id','=','user_equipment_details.equipment_type')->join('branch','branch.branch_id','=','user_equipment_details.branch')->join('users','users.id','=','user_equipment_details.user_id')->where('user_equipment_details.user_id', $user_id)->get();
	    $expiry_date = DB::table('user_equipment_details')->select('user_equipment_details.last_qa_test','branch.nabh_nabl_accredited')->leftjoin('branch', 'user_equipment_details.branch', '=', 'branch.branch_id')->where('user_equipment_details.user_id',$user_id)->orderBy('user_equipment_details.last_qa_test','ASC')->first();
	    
	    //dd($expiry_date);
	    
	    
	    $data['expiry'] = Helper::getExpireyByDate($expiry_date->last_qa_test, $expiry_date->nabh_nabl_accredited);
	    
	    //dd($data['expiry']);
	    
	    
	    $data['users'] = DB::table('users')->where('users.id',$user_id)->first();
	    $profile = DB::table('branch')->join('user_equipment_details','user_equipment_details.user_id','=','branch.user_id')->join('account_info','account_info.user_id','=','branch.user_id')->where('branch.user_id', $user_id)->first();
	    $data['profile_percentage'] = Helper::getProfilePercentage($profile);
	    
	    $data['order_status'] = DB::table('service_order')->where('user_id', $user_id)->orderby('id','DESC')->first();
	    
        return view('frontend.user.dashboard', $data);
    }

    public function changepass()
    {
        return view('frontend.user.changepassword');
    }

    public function changepassupdate(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }


    public function renewpackage()
    {
        $user = Auth::user();
        $data['membership'] = DB::table('manage_membership')->where('status',1)->get();
        $data['subscribed_membership'] = DB::table('user_membership')->join('manage_membership','manage_membership.id','=','user_membership.membership_id')->where('user_membership.user_id', $user->id)->get();
        $data['current_plan'] = DB::table('user_membership')->join('manage_membership','manage_membership.id','=','user_membership.membership_id')->where('user_membership.user_id', $user->id)->where('user_membership.status', 1)->first();
        return view('frontend.user.renew')->with($data);
    }

    public function renewpackageview()
    {
        $package['info'] = DB::table('membership_packages')->get();

        return view('frontend.user.package')->with($package);
    }
    
    public function subscribe_membership1($id)
    {
        $details = DB::table('manage_membership')->where('id',$id)->first();
        $invoice = time();
        DB::table('user_membership')->insert([
            'user_id' => Auth::user()->id,
            'membership_id' => $details->id,
            'invoice_no' => $invoice,
            'amount' => $details->price,
            'start_date' => date('Y-m-d H:i:s'),
            'end_date' => date('Y-m-d H:i:s', strtotime('+'.$details->duration.' month')),
            'token' => '',
            'payment_status' => 'Pending',
            'status' => 0
            ]);
        
        $booking_id = DB::getPDO()->lastInsertId();
        return redirect('payWithpaypal?order_id='.$invoice.'&booking_id='.$booking_id);
    }
    
    public function subscribe_membership($id)
    {
        $details = DB::table('manage_membership')->where('id',$id)->first();
        $invoice = time();
        DB::table('user_membership')->insert([
            'user_id' => Auth::user()->id,
            'membership_id' => $details->id,
            'invoice_no' => $invoice,
            'amount' => $details->price,
            'start_date' => date('Y-m-d H:i:s'),
            'end_date' => date('Y-m-d H:i:s', strtotime('+'.$details->duration.' month')),
            'token' => '',
            'payment_status' => 'Pending',
            'status' => 0
            ]);
        
        $booking_id = DB::getPDO()->lastInsertId();
        return redirect('payWithpaypal?order_id='.$invoice.'&booking_id='.$booking_id);
    }

    public function addservicetypes(Request $request)
    {
        $machine_type = $request->input('machine_type');
        $service_type = $request->input('service');
        $user_id = Auth::user()->id;

        if(!empty($machine_type) && !empty($service_type)){
            for($i=0; $i<count($machine_type); $i++)
            {
                DB::table('sp_machine_service_type')->insert([
                    'user_id' => $user_id,
                    'service_type' => $machine_type[$i]
                ]);
            }

            for($j=0; $j<count($service_type); $j++)
            {
                DB::table('sp_service_type')->insert([
                    'user_id' => $user_id,
                    'service' => $service_type[$j]
                ]);
            }

            $user = Auth::user();
            $user->is_service_selected = '1';
            $user->save();

            return redirect('/user/profile')->with('success','Service list saved successfully');
        }else{
            return redirect('/user/profile')->with('error','You have not selected any machine & service list');
        }

        // DB::table('service_list')->insert([
        //     'machine_service_type' => json_encode($machine_type),
        //     'service_type' => json_encode($service_type),
        //     'user_id' => $user_id
        // ]);

    }

    public function updateservicetypes(Request $request)
    {
        $machine_type = $request->input('machine_type');
        $service_type = $request->input('service');
        $machine_type_id = $request->input('machine_type_id');
        $service_type_id = $request->input('service_type_id');
        $user_id = Auth::user()->id;

        if(!empty($machine_type) && !empty($service_type)){
            DB::table('sp_machine_service_type')->where('user_id','=',$user_id)->delete();
            DB::table('sp_service_type')->where('user_id','=',$user_id)->delete();
            for($i=0; $i<count($machine_type); $i++)
            {
                DB::table('sp_machine_service_type')->insert([
                    'user_id' => $user_id,
                    'service_type' => $machine_type[$i]
                ]);
            }

            for($j=0; $j<count($service_type); $j++)
            {
                DB::table('sp_service_type')->insert([
                    'user_id' => $user_id,
                    'service' => $service_type[$j]
                ]);
            }

            return redirect('/user/manageservices')->with('success','Service list updated successfully');
        }else{
            return redirect('/user/manageservices')->with('error','You have not selected any machine & service list');
        }
    }

    public function servicerequest()
    {
        return view('frontend.user.servicerequest');
    }

//service request view start

  public function servicerequest_new(Request $request)
    {
        $user_id = Auth::user()->id;
        
        
        //$request->get('declined');
        
        if($request->get('declined')){
           
           $order_id = $request->get('declined');
           
           $service_order_details =DB::table('service_order')->where('id',$order_id)->first();
           
           $userid = $service_order_details->user_id;
           
           $user_data = array(
               
               'order_id'=>$order_id,
               'user_id'=>$userid,
               'provider_id'=>$user_id,
               'created_at'=>date('Y-m-d h:s:i'),
               
               
               );
           
           DB::table('decline_jobs')->where('id',$order_id)->insert($user_data);
           //dd($user_data);
           
           return redirect('/user/servicerequest_new')->with('success','Job Declined successfully');
           
           
        }
        
        
        $data['order_details'] = DB::table('service_order')->where('status','=','1')->where('is_bid_accepted','=','0')->where('accept_job',0)->where('open_service',1)->orderBy('id', 'DESC')->get();
        $service_type = DB::table('sp_service_type')->where('user_id', $user_id)->get();
        $services = array();
        $bid = array();
        if(!empty($service_type)){
            foreach($service_type as $service)
            {
                $services[] = $service->service;
            }
        }
        
        
        //dd($data['order_details']);
        
        
        foreach($data['order_details'] as $key=>$order_details_data){
            
             $offer_count = DB::table('offer_prices')->where('order_id',$order_details_data->id)->orderby('provider_price','ASC')->get(); 
             $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_details_data->id)->groupBy('soe.service_id')->get();
            
           $quantity = 0;
           foreach($services as $service){
               
                        $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get();
                
                
            foreach($service_details as $service_dt){
                
                $quantity += $service_dt->quantity;
            }
           }
            
            $data['order_details'][$key]->offer_count = count($offer_count);
            $data['order_details'][$key]->machine_quantity = $quantity;
            
            
            
            
            
            
            
            
            
            
            
           
           $decline_jobs = DB::table('decline_jobs')->where('order_id',$order_details_data->id)->count();
           
          //dd($user_id);
          
          $values = explode(";",$order_details_data->assign_provider);
          
          //$values = $user_id;
          
          
          if(in_array($user_id, $values)){
        	        
        	       $data['order_details'][$key]->assign = 1; 
        	        
        	    }else{
        	        
        	         $data['order_details'][$key]->assign = 0; 
        	    }
          
          
           
           
           if($decline_jobs > 0){
           
            $data['order_details'][$key]->decline_jobs = 1;
            
           }else{
               
               $data['order_details'][$key]->decline_jobs = 0;
           }
            
        }
        
        //dd($data['order_details']);
        
       
        
        $data['service_type'] = $services;
        
        //dd($data['service_type']);
         
        return view('frontend.user.servicerequest_new', $data);
    }
  public function servicerequest_completed()
    {
        
       
        $user_id = Auth::user()->id;
       //$data['order_details'] = DB::table('service_order')->select('service_order.*')->join('bid_report','bid_report.order_id','=','service_order.id')->where('bid_report.status','=','1')->where('service_order.accept_job','=','1')->where('bid_report.user_id','=',$user_id)->where('service_order.is_completed','=','1')->orderby('id','DESC')->get();
        $data['order_details'] = DB::table('service_order')->select('service_order.*')->join('offer_prices','offer_prices.order_id','=','service_order.id')->where('offer_prices.status','=','1')->where('service_order.accept_job','=','1')->where('offer_prices.provider_id','=',$user_id)->where('service_order.is_completed','=','1')->orderby('id','DESC')->get();
        $service_type = DB::table('sp_service_type')->where('user_id', $user_id)->get();
        $bid_report = DB::table('bid_report')->where('user_id', $user_id)->get();
        $services = array();
        $bid = array();
        if(!empty($service_type)){
            foreach($service_type as $service)
            {
                $services[] = $service->service;
            }
        }
        if(!empty($bid_report))
        {
            foreach($bid_report as $bidreport)
            {
                $bid[] = $bidreport->service_id;
            }
        }
        $data['service_type'] = $services;
        $data['bids'] = $bid;
        
        
       
        
        //dd($data['order_details']);
        
        
        return view('frontend.user.servicerequest_completed')->with($data);
    }
  public function servicerequest_expired()
    {
        
        $user_id = Auth::user()->id;
        
        $data['order_details'] = DB::table('service_order')->select('service_order.*','decline_jobs.provider_id')
        
        ->leftjoin('decline_jobs','decline_jobs.order_id','=','service_order.id')
        
        //->where('service_order.status','=','0')->where('service_order.is_bid_accepted','=','0')
        //->where('service_order.accept_job',0)
        ->where('decline_jobs.provider_id',$user_id)
        
        ->orderBy('service_order.id', 'DESC')->get();
        
        $service_type = DB::table('sp_service_type')->where('user_id', $user_id)->get();
        $services = array();
        $bid = array();
        if(!empty($service_type)){
            foreach($service_type as $service)
            {
                $services[] = $service->service;
            }
        }
        
        
        
          //dd($data['order_details']);
        
        return view('frontend.user.servicerequest_expired')->with($data);
    }
  public function servicerequest_active()
    {
        $user_id = Auth::user()->id;
        $data['order_details'] = DB::table('service_order')->where('status','=','1')->where('is_bid_accepted','=','0')->where('accept_job',1)->get();
        
        
        foreach($data['order_details'] as $key=> $order_details_data){
            
            
           $service_order = DB::table('offer_prices')->where('order_id',$order_details_data->id)->orderby('provider_price','ASC')->first();  
           $offer_count = DB::table('offer_prices')->where('order_id',$order_details_data->id)->orderby('provider_price','ASC')->get(); 
           
           $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_details_data->id)->groupBy('soe.service_id')->get();
           
           $quantity = 0;
           foreach($services as $service){
               
                        $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get();
                
                
            foreach($service_details as $service_dt){
                
                $quantity += $service_dt->quantity;
            }
            
            
           }
           
           
           //dd($quantity);
           
           
            
            $data['order_details'][$key]->low_price = $service_order->provider_price;
            $data['order_details'][$key]->offer_count = count($offer_count);
            $data['order_details'][$key]->machine_quantity = $quantity;
        }
        
        
        //dd($data['order_details']);
        
        $service_type = DB::table('sp_service_type')->where('user_id', $user_id)->get();
        $bid_report = DB::table('bid_report')->where('user_id', $user_id)->get();
        $services = array();
        $bid = array();
        if(!empty($service_type)){
            foreach($service_type as $service)
            {
                $services[] = $service->service;
            }
        }
        if(!empty($bid_report))
        {
            foreach($bid_report as $bidreport)
            {
                $bid[] = $bidreport->service_id;
            }
        }
        $data['service_type'] = $services;
        $data['bids'] = $bid;
        return view('frontend.user.servicerequest_active', $data);
    }
    
    public function manageproject()
    {
        $user_id = Auth::user()->id;
        //$data['order_details'] = DB::table('service_order')->where('status','=','1')->where('is_bid_accepted','=','1')->where('accept_job',1)->where('is_completed',0)->get();
        
        $data['order_details'] = DB::table('service_order')->select('service_order.*')->join('offer_prices','offer_prices.order_id','=','service_order.id')->where('offer_prices.status','=','1')->where('service_order.accept_job','=','1')->where('offer_prices.provider_id','=',$user_id)->where('service_order.is_completed','=','0')->orderby('id','DESC')->get();
        foreach($data['order_details'] as $key=> $order_details_data){
            
            
          /* $service_order = DB::table('offer_prices')->where('order_id',$order_details_data->id)->orderby('provider_price','ASC')->first();  
            
            $data['order_details'][$key]->low_price = $service_order->provider_price;*/
            
            $user_details = DB::table('users')->where('id',$order_details_data->user_id)->first();
            
            
            
            
             $service_order = DB::table('offer_prices')->where('order_id',$order_details_data->id)->orderby('provider_price','ASC')->first();  
           $offer_count = DB::table('offer_prices')->where('order_id',$order_details_data->id)->orderby('provider_price','ASC')->get(); 
           
           $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_details_data->id)->groupBy('soe.service_id')->get();
           
           $quantity = 0;
           foreach($services as $service){
               
                        $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get();
                
                
            foreach($service_details as $service_dt){
                
                $quantity += $service_dt->quantity;
            }
            
            
           }
           
           
           //dd($quantity);
           
           
            
            $data['order_details'][$key]->low_price = $service_order->provider_price;
            $data['order_details'][$key]->offer_count = count($offer_count);
            $data['order_details'][$key]->machine_quantity = $quantity;
            $data['order_details'][$key]->location = $user_details->city.'-'.$user_details->state;
        }
        
        
        //dd($data['order_details']);
        
        $service_type = DB::table('sp_service_type')->where('user_id', $user_id)->get();
        $bid_report = DB::table('bid_report')->where('user_id', $user_id)->get();
        $services = array();
        $bid = array();
        if(!empty($service_type)){
            foreach($service_type as $service)
            {
                $services[] = $service->service;
            }
        }
        if(!empty($bid_report))
        {
            foreach($bid_report as $bidreport)
            {
                $bid[] = $bidreport->service_id;
            }
        }
        $data['service_type'] = $services;
        $data['bids'] = $bid;
        return view('frontend.user.manageproject', $data);
    }
    
    
  public function servicerequest_won(Request $request)
    {
        if(!empty($request->get('accept')))
        {
            DB::table('service_order')->where('id', $request->get('accept'))->update(['status'=>1]);
        }
        if(!empty($request->get('declined')))
        {
            DB::table('service_order')->where('id', $request->get('declined'))->update(['status'=>2]);
        }
       
        $user_id = Auth::user()->id;
        $data['order_details'] = DB::table('service_order')->select('service_order.*')->join('bid_report','bid_report.order_id','=','service_order.id')->where('bid_report.status','=','1')->where('service_order.accept_job','=','1')->where('bid_report.user_id','=',$user_id)->get();
        $service_type = DB::table('sp_service_type')->where('user_id', $user_id)->get();
        $bid_report = DB::table('bid_report')->where('user_id', $user_id)->get();
        $services = array();
        $bid = array();
        if(!empty($service_type)){
            foreach($service_type as $service)
            {
                $services[] = $service->service;
            }
        }
        if(!empty($bid_report))
        {
            foreach($bid_report as $bidreport)
            {
                $bid[] = $bidreport->service_id;
            }
        }
        $data['service_type'] = $services;
        $data['bids'] = $bid;
        
        //dd($data['order_details']);
        
        return view('frontend.user.servicerequest_won', $data);
    }
  public function servicerequest_lost()
    {
        
        $user_id = Auth::user()->id;
        /*$data['order_details'] = DB::table('service_order')->select('service_order.*')->join('bid_report','bid_report.order_id','=','service_order.id')->where('bid_report.status','!=','1')->where('bid_report.user_id','=',$user_id)->where('service_order.is_bid_accepted','=',0)->get();
        $service_type = DB::table('sp_service_type')->where('user_id', $user_id)->get();
        $bid_report = DB::table('bid_report')->where('user_id', $user_id)->get();
        $services = array();
        $bid = array();
        if(!empty($service_type)){
            foreach($service_type as $service)
            {
                $services[] = $service->service;
            }
        }
        if(!empty($bid_report))
        {
            foreach($bid_report as $bidreport)
            {
                $bid[] = $bidreport->service_id;
            }
        }
        $data['service_type'] = $services;
        $data['bids'] = $bid;
        return view('frontend.user.servicerequest_lost');*/
        
        
        $user_id = Auth::user()->id;
	    $order_details = DB::table('service_order')->join('offer_prices','offer_prices.order_id','=','service_order.id')
	    
	    ->where('service_order.status',1)
	    ->where('offer_prices.status',0)
	    
	    ->get();
	    
	    //dd($order_details);
        
        
        
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


//service request view end
    public function manageservices()
    {
        $data = array();
        $data['machine_types'] = DB::table('manage_machine_type')->where('status','=','1')->get();
        $data['services'] = DB::table('services')->where('status','=','1')->get();
        $data['machine_service_type'] = DB::table('sp_machine_service_type as mst')
                                        ->select('mst.id','mst.service_type','mmt.id as mt_id')
                                        ->join('manage_machine_type as mmt','mmt.id','=','mst.service_type')
                                        ->where('mst.user_id','=',Auth::user()->id)->get();
        $data['service_type'] = DB::table('sp_service_type as st')
                                        ->select('st.id','st.service')
                                        ->join('services as s','s.id','=','st.service')
                                        ->where('st.user_id','=',Auth::user()->id)->get();
        return view('frontend.user.servicelists')->with($data);
    }
    
    public function myoders(){
        
        $data = array();
        return view('frontend.user.myorders')->with($data);
    }
    
    public function deshboard(){
        
        $data = array();
        return view('frontend.user.deshboard')->with($data);
    }

    public function bid_service(Request $request)
    {
        $user_id = Auth::user()->id;
        
        //dd($request->all());
        DB::table('bid_report')->insert(
            [
                'user_id' => $user_id,
                'order_id' => $request->get('service_order_id'),
                'service_id' => $request->get('service_id'),
                'bid_amount' => $request->get('min_bid_amt'),
                'status' => 0
            ]
        );
        
        
        $service_data = array(
            
            'accept_job'=>1
            
            );
        
        DB::table('service_order')->where('id',$request->service_order_id)->update($service_data);

        //DB::table('service_order')->where('id','=',$request->get('service_order_id'))->update(['status'=>1]);
        return redirect('/user/servicerequest_active')->with('success','Bidding successfully');
    }
    
    
    public function offer_bid(Request $request){
        
        
        
        $orderid = $request->orderid;
        $provider_price = $request->provider_price;
        
        $service_order = DB::table('service_order')->where('id',$orderid)->first();
        
        $total_amount = $service_order->total_amount;
        $user_id = $service_order->user_id;
        $provider_id = Auth::user()->id;
        
        $offer_status_count = DB::table('offer_prices')->where('order_id',$orderid)->where('status',1)->count();
        
        if($offer_status_count > 0){
            
            echo 0; die;
        }
        
        
         $offer_prices_count = DB::table('offer_prices')->where('order_id',$orderid)->where('provider_id',$provider_id)->count();
         $offer_prices_id = DB::table('offer_prices')->where('order_id',$orderid)->where('provider_id',$provider_id)->first();
         
         if($offer_prices_count > 0){
             
             
             $data_offer= array(
                    
                    'order_id'=>$orderid,
                    'user_id'=>$user_id,
                    'user_price'=>$total_amount,
                    'provider_id'=>$provider_id,
                    'provider_price'=>$provider_price,
                    'created_at'=>date('Y-m-d h:s:i'),
                    
                );
                
            $offer_prices = DB::table('offer_prices')->where('id',$offer_prices_id->id)->update($data_offer);
             
             echo 1; die;
         }else{
        
                $data_offer= array(
                    
                    'order_id'=>$orderid,
                    'user_id'=>$user_id,
                    'user_price'=>$total_amount,
                    'provider_id'=>$provider_id,
                    'provider_price'=>$provider_price,
                    'created_at'=>date('Y-m-d h:s:i'),
                    
                );
                
            $offer_prices = DB::table('offer_prices')->insert($data_offer);
         }
        
        //dd($data_offer);
        
        
        
        echo 1; die;
    }
    
    
    function change_status(Request $request){
        
        
        if($request->status=='Project Completed'){
            
            $is_completed = 1;
        }else{
            
            $is_completed = 0;
        }
        
        
         $data_offer= array(
            
            'order_status'=>$request->status,
            'is_completed'=>$is_completed,
           
            );
        
        DB::table('service_order')->where('id',$request->orderid)->update($data_offer);
        
        echo 1; die;
        
    }
    
    
    function user_accept_bid($id=null){
        
        
        $offer_prices = DB::table('offer_prices')->where('order_id',$id)->first();
        
        //dd($offer_prices);
        
        $data_offer= array(
            
            'is_bid_accepted'=>1,
            'offer_price'=>$offer_prices->provider_price,
            'accept_job'=>0,
            
            );
        
        DB::table('service_order')->where('id',$id)->update($data_offer);
        
        return redirect('user/myorders')->with('success','Bidding Accepted Please Confirm Order');
    }
    
    public function profile_setting()
    {
        $data = array();
        $user_id = Auth::user()->id;
        $data['userdata'] = User::find($user_id);
        $data['head_info'] = DB::table('account_info')->where('user_id', $user_id)->where('type', '1')->first();
        $data['contact_info'] = DB::table('account_info')->where('user_id', $user_id)->where('type', '2')->first();
        $data['user_info'] = DB::table('users')->where('id', $user_id)->first();
        return view('frontend.user.profile_setting')->with($data);
    }
        
    public function profile_setting_update(Request $request)
    {
        $input = Input::all();
        $user_id = Auth::user()->id;
        $rules = array(
            'company_name' => 'required',
            'business_type' => 'required',
            'gstin' => 'required|min:12|numeric',
            'pincode' => 'required|numeric',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'number_of_service' => 'required',
            'name_of_service_eng' => 'required',
            'city' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->to('user/profile_setting')->withErrors($validator)->withInput();;
        } else {

            $uploadFile['auth_letter'] = $request->file('aerb_auth_letter');
            $uploadFile['rso_certificate'] = $request->file('service_engineer_certificate');

            $destinationPath = 'public/images/upload/service';
            if($uploadFile['auth_letter'])
            {
                $uploadFile['auth_letter']->move($destinationPath,$uploadFile['auth_letter']->getClientOriginalName());
            }
            if($uploadFile['rso_certificate']){
                $uploadFile['rso_certificate']->move($destinationPath,$uploadFile['rso_certificate']->getClientOriginalName());
            }
            
            $post_data['company_name'] = $input['company_name'];
            $post_data['business_type'] = $input['business_type'];
            $post_data['gst'] = $input['gstin'];
            $post_data['pin_code'] = $input['pincode'];
            $post_data['address'] = $input['address'];
            $post_data['country'] = $input['country'];
            $post_data['state'] = $input['state'];
            $post_data['city'] = $input['city'];
            $post_data['number_of_service'] = $input['number_of_service'];
            $post_data['name_of_serv_eng'] = $input['name_of_service_eng'];
            if(!empty($uploadFile['auth_letter'])){
                $post_data['auth_letter'] = $destinationPath.'/'.$uploadFile['auth_letter']->getClientOriginalName();
            }
            if(!empty($uploadFile['rso_certificate'])){
                $post_data['rso_certificate'] = $destinationPath.'/'.$uploadFile['rso_certificate']->getClientOriginalName();
            }
            

            DB::table('users')->where('id', $user_id)->update($post_data);
            
            return redirect('/user/profile_setting')->with('success', 'Profile updated successfully');
        }
    }
    
    public function bank_account_details()
    {
        $data = array();
        $user_id = Auth::user()->id;
        $data['userdata'] = User::find($user_id);
        $data['acc_details'] = DB::table('bank_account_details')->where('user_id', $user_id)->first();
        return view('frontend.user.bank_acc_details')->with($data);
    }
    
    public function save_bank_details(Request $request)
    {
        $validatedData = $request->validate([
            'branch_ifsc' => 'required',
            'acc_number' => 'required',
            'conf_acc_number' => 'required|string|min:6|same:acc_number',
            'beneficary_name' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $post_data = array(
                'user_id' => $user_id,
                'branch_ifsc' => $request->input('branch_ifsc'),
                'acc_number' => $request->input('acc_number'),
                'name' => $request->input('beneficary_name')
            );
        
        if(DB::table('bank_account_details')->where('user_id', $user_id)->exists())
        {
            DB::table('bank_account_details')->where('user_id', $user_id)->update($post_data);
        }else{
            DB::table('bank_account_details')->insert($post_data);
        }
        
        return back()->with('success', 'Profile updated successfully');
    }
    
    public function equipment_list()
	{
	    $user_id = Auth::user()->id;
	    $p_equipments = DB::table('provider_equipments')->where('user_id', $user_id)->get();
	    
	    foreach($p_equipments as $key=>$equipments){
	        
	        $equipment1 = DB::table('manage_machine_type')->where('id',$equipments->equipment_id)->where('status','=','1')->first();
	        $services = DB::table('services')->where('id',$equipments->service_id)->where('status','1')->first();
	        
	        
	        
	        $p_equipments[$key]->machine_type = $equipment1->machine_type;
	        $p_equipments[$key]->service_name = $services->service_name;
	    }
	    
	    $data['p_equipments'] = $p_equipments;
	    
	   // dd($data['p_equipments']);
	    
	    return view('frontend.user.p_equipment_list')->with($data);
	}
	
	/*public function equipment_price_create(){
	    
	    
	}*/
	
	public function equipment_price_create(Request $request)
	{
	    $user_id = Auth::user()->id;
	    $data['equipment'] = DB::table('manage_machine_type')->where('status','=','1')->get();
	    $data['services'] = DB::table('services')->where('status','1')->get();
		if(!empty($request->all())){
			
           // dd($request->all());
            
	        DB::table('provider_equipments')->insert([
	        	'user_id' => $user_id,
	        	'service_id' => $request->service,
	        	'equipment_id' => $request->equipment_type,
	        	'price' => $request->price,
	        	
	        ]);

	        return redirect('user/equipment-list/')->with('success', "Equipment added successfully.");
		}else{
			return view('frontend.user.equipment_price_create')->with($data);
		}
	}
	
	public function equipment_details_delete($id=null)
	{
	    if(!empty($id))
		{
			DB::table('provider_equipments')->where('id', $id)->delete();
			return redirect('/user/equipment-list')->with('success', "Equipment deleted successfully.");
		}
	}

}