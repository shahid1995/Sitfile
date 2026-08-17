<?php
  
namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;

  
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use DB;
use View;
   
class PaymentController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
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
  
  
       
        
        $data['invoice_id'] = $request->get('order_id');
        $data['invoice_description'] = "Order #{$request->get('order_id')} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $order_details->price;
        
  
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);
  
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        $invoice_no = $response['INVNUM'];
        //dd($response);
        
        DB::table('user_membership')->where('invoice_no', $invoice_no)->update(['payment_status'=>'Success','token'=>$request->token,'payer_id'=>$request->PayerID,'status'=>1]);
        
         DB::table('service_order')->where('invoice_no', $invoice_no)->update(['status'=>1]);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect('renew')->with('success','Membership subscribed successfully');
        }
  
        dd('Something is wrong.');
    }
    
    
    
    
    public function payment12($invoice_id)
    {
        
        
        $price = DB::table('service_order')->where('invoice_no', $invoice_id)->first();
          
          $total_price = $price->total_amount;
        
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
        
  
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);
  
        return redirect($response['paypal_link']);
    }
    
    
    
    
    public function success1(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        $invoice_no = $response['INVNUM'];
        //dd($response);
        
        DB::table('user_membership')->where('invoice_no', $invoice_no)->update(['payment_status'=>'Success','token'=>$request->token,'payer_id'=>$request->PayerID,'status'=>1]);
  
  
                $qoutedata1=array(
                     'transection_id'=>$request->token,                               
                     'status'=>'1',                             
                        
                        );
                    
                       
                        $orderUpdate1 = DB::table('orders')->where('order_id',$invoice_no)->update($qoutedata1);

                        /*DB::table('service_order')->where('service_order', $invoice_no)->update(['active_offer'=>1]);*/
                        
                        DB::table('service_order')->where('invoice_no', $invoice_no)->update(['status'=>1]);
  
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            //return View::make('sucess')->with('');
            
           
            
            return redirect('/user/myorders');
        }
  
        dd('Something is wrong.');
    }
    
    
    public function payment1($invoice_id)
    {
        
        
        $price = DB::table('service_order')->where('invoice_no', $invoice_id)->first();
          
          $total_price = $price->total_amount;
        
       $order_id = time();

            /*$oders_data =array(

                          'user_id' => $user_id, 
                          'order_id' => $order_id, 
                          'order_price' =>$total_price, 
                          'transection_id' =>'',
                          'item_id' =>$invoice_id,
                          'updated_at' => date('Y-m-d'), 
                        );
             DB::table('orders')->insert($oders_data);
             
             
             
             //DB::table('service_order')->where('invoice_no', $invoice_no)->update(['service_order'=>$order_id]);
             DB::table('service_order')->where('invoice_no', $invoice_id)->update(['service_order'=>$order_id]);*/
  
  
    return view('razorpayView');
    
       
    }
    
    
    
    
}