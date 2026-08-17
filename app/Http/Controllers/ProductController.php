<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use View;
use Session;
use Illuminate\Support\Facades\Hash;
use Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

   




    public function submit_customize(Request $request){


        $width = $request->width;
        $height = $request->height;

        $dimensions = DB::table('dimensions')->where('status',1)

       // ->where('width','>=',$width)
        //->where('hight','<=',$height)

        ->whereBetween('width', [$width, $height])
        ->whereBetween('hight', [$width, $height])
        ->orderby('price','DESC')
        ->first();

        $price = $dimensions->price;

        if($request->option){
            $options = DB::table('options')->where('id',$request->option)->first();
             $price += $options->price;
        }

        if($request->decoration){
            $decoration = DB::table('parameters')->where('id',$request->decoration)->first();
             $price += $decoration->price;
        }
        if(Session::get('temp_user_id') && Session::get('user_id')==''){

             $user_id = Session::get('temp_user_id');

        }elseif(Session::get('user_id')){

            $user_id = Session::get('user_id');

        }else{

         $user_id = time();
             Session::put('temp_user_id', $user_id);             
            Session::save();
        }


        $custome_data = array(

                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'location' => $request->location,
                'width' => $request->width,
                'height' => $request->height,                
                'color' => $request->color,                
                'option' => $request->option,
                'decoration' => $request->decoration,
                'price' => $price,
                'temp_price' => $price,
                'created_at' => date('Y-m-d h:s:i'),

             );

     DB::table('customizeproducts')->insert($custome_data);
    
    return redirect('cart');

        //dd($custome_data);
    }

    public function cart(){

        $data= array();

       //session()->forget('user_id');

       // $user_id = Session::get('temp_user_id');

        if(Session::get('temp_user_id') && Session::get('user_id')==''){

             $user_id = Session::get('temp_user_id');

        }elseif(Session::get('user_id')){

            $user_id = Session::get('user_id');

        }

        $data['cartitem'] = DB::table('customizeproducts as cp')->where('user_id',$user_id)
        ->select('cp.*','cp.price as item_price','p.*','cp.id as cart_id')
        ->join('products as p', 'cp.product_id', '=', 'p.id')
        ->where('cp.is_complete','0')
        ->orderby('cp.id')

        ->get();

        //dd($cartitem);

         return View::make('cart')->with($data);
    }

   


     public function paypal_payment_ipn(Request $request){
         
         
        

        /*paypal response*/
        $paypaldata=$request->input();   
        
      
      
      
      
        
        $paypaldata['txn_id'];
        $paypaldata['item_number'];

        $paypaldata['payment_status'];
        
        

                $quote_unique_id = $paypaldata['item_number'];
            
                if($paypaldata['payment_status'] == 'Completed'){
                $qoutedata=array(
                     //'transection_id'=>$paypaldata['txn_id'],                               
                     'is_complete'=>'1',                             
                                                  
                                                
                    );

                    $qoutedata1=array(
                     'transection_id'=>$paypaldata['txn_id'],                               
                     'status'=>'1',                             
                        
                        );
                    
                       
                        $orderUpdate1 = DB::table('orders')->where('order_id',$quote_unique_id)->update($qoutedata1);

                        DB::table('service_order')->where('order_id', $quote_unique_id)->update(['active_offer'=>1]);

                        $order_id= $quote_unique_id;
                        //$this->send_invoice($order_id);
                }else{
                    
                $qoutedata=array(
                     'transection_id'=>$paypaldata['txn_id'],                               
                     'is_complete'=>'2',                             
                                                  
                                                
                    );

                    $qoutedata1=array(
                     'transection_id'=>$paypaldata['txn_id'],                               
                     'status'=>'0',                             
                        
                        );
                    
                       
                        $orderUpdate1 = DB::table('orders')->where('order_id',$quote_unique_id)->update($qoutedata1);
                    
                       
                }
            

                        

    }

    public function payment_success(Request $request){


      $msg = "First line of text\nSecond line of text";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);
        
        // send email
        mail("developertestphp2020@gmail.com","My subject",$msg);
        
        
       
      return View::make('sucess')->with('');
    
    }

  public function payment_failed(Request $request){

    return View::make('frontend.user.paymentfailed')->with('');
  }


public function send_invoice($order_id)
    {
        
        
        
        
        $invoice_details = DB::table('service_order')->where('order_id',$order_id)->first();
        
        
          $order_id = $invoice_details->id;
          
          $user_details = DB::table('users')->where('id',$invoice_details->user_id)->first();
          
          
          $to_email = $user_details->mail;
          $to_email = 'development.tapasmahato@gmail.com';
          
          
            
          $order_details = DB::table('service_order')->where('id',$order_id)->first();
          $services = DB::table('service_order_equipment_services as soe')->select('services.service_name','soe.order_id','soe.service_id')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_id)->groupBy('soe.service_id')->get();
        
        
          
          $email_data = array(
              
              'order_details'=>$order_details, 
              'services'=>$services,
               'email_id'          =>  $to_email,
              'site_email'        =>  'smtp@quality-web-programming.com',
              
              );
       
        
        Mail::send('invoice_mail', $email_data,  function ($message) use ($email_data) 
                {
                $message->from($email_data['site_email'], 'Service Requested');
                $message->to($email_data['email_id'] )->subject('Service Requested');            
            });
          
          
        }
    


  



     public function show_price(Request $request){


      //dd($request->all());


        $width = $request->width;
        $height = $request->height;

        $dimensions = DB::table('dimensions')->where('status',1)

       // ->where('width','>=',$width)
        //->where('hight','<=',$height)

        ->whereBetween('width', [$width, $height])
        ->whereBetween('hight', [$width, $height])
        ->orderby('price','DESC')
        ->first();

        $price = $dimensions->price;

        if($request->option){
            $options = DB::table('options')->where('id',$request->option)->first();
             $price += $options->price;
        }

        if($request->decoration){
            $decoration = DB::table('parameters')->where('id',$request->decoration)->first();
             $price += $decoration->price;
        }

        return $price;

  }


  public function submit_custome_order(Request $request){


    //dd($request->all());

    $order_data = array(

                'name'=>$request->name,
                'email'=>$request->email,
                'phone_no'=>$request->phone,
                'address'=>$request->address,
                'requirement'=>$request->requirments,
                'product_id'=>1,
    );

    DB::table('customorders')->insert($order_data);
return redirect()->back()->with('message', 'Your Order is Successfully Submit');


  }








    public function logout(){

        session()->forget('user_id');
        session()->forget('temp_user_id');

       return redirect('home');
    }




}
