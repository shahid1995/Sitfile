<?php

namespace App\Http\Controllers;

use App\UserQuote;
use App\VendarSetPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CRUDBooster;
use DB;
use Illuminate\Support\Facades\Session;

class UserQuoteController extends Controller
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
        $uniqueId = time();
        $uniqueId = substr($uniqueId, -7); 
        $uniqueId = 'FAB'.$uniqueId;
        // $uniqueId = substr($uniqueId, 0, 10);        
        $uniqueId = $uniqueId;

        //dd($uniqueId);

        $id=Auth::user()->id;
        $userquote = new UserQuote;
        
        $userquote->quote_id = $uniqueId; 

        $userquote->delevery_type_id = $request->delevery_type_id;               
        $userquote->truck_type_id = $request->truck_type_id;
        $userquote->country_id = $request->country_id;
        $userquote->state_id = $request->state_id;
        $userquote->city_id = $request->city_id;
        $userquote->zip_code = $request->zip_code;
        $userquote->date = date('Y-m-d',strtotime($request->date));
        $userquote->country_id_to = $request->country_id_to;
        $userquote->state_id_to = $request->state_id_to;
        $userquote->city_id_to = $request->city_id_to;
        $userquote->zip_code_to = $request->zip_code_to;
        $userquote->weight = $request->weight;
        $userquote->hight = $request->hight;
        $userquote->width = $request->width;
        $userquote->length = $request->length;
        $userquote->customer_id = $id;

        //dd($userquote);

        $userquote->save();

        $msg='Your Quote Successfully Sent !';
        Session::flash('success', $msg);
       // return redirect('/user/profile')->with('success', "Your Quote Successfully Send !");
        CRUDBooster::redirect('/user/quotelist'," Your Quote Successfully Sent !","success");
    }

    public function send_price(Request $request){

        $id=Auth::user()->id;

        if($request->price_id){


            $postdata=array(
                             'vendar_price'=>$request->vendar_price,                              
                            );
            $userUpdate = DB::table('vendar_set_prices')->where('id', '=', $request->price_id)->update($postdata);

            return back()->withSuccess('Your price successfully send to customer.');

        }else{


            $sendprice = new VendarSetPrice;
            
            $sendprice->vendar_price = $request->vendar_price;               
            $sendprice->customer_request_id = $request->customer_request_id;
            $sendprice->customer_id = $request->customer_id; 
            $sendprice->vender_id = $id; 

            $sendprice->save();

            return back()->withSuccess('Your price successfully send to customer.');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function show(UserQuote $userQuote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function edit(UserQuote $userQuote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserQuote $userQuote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserQuote  $userQuote
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserQuote $userQuote)
    {
        //
    }
}
