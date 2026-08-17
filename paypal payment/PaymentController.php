<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
Use Redirect;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
	private $_api_context;
    public function __construct()
	{
	    $paypal_conf = \Config::get('paypal');
	    $this->_api_context = new APIContext(new OAuthTokenCredential(
	    	$paypal_conf['client_id'],
	    	$paypal_conf['secret']
	    ));
	    $this->_api_context->setConfig($paypal_conf['settings']);
	}  
	public function payWithpaypal(Request $request)
    {
        $payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item1 = new Item();
		$item1->setName('Ground Coffee 40 oz')
	    ->setCurrency('USD')
	    ->setQuantity(1)
	    ->setPrice($request->get('amount'));/* unit price */

	    $itemList = new ItemList();
		$itemList->setItems(array($item1));

		$amount = new Amount();
		$amount->setCurrency("USD")
		    ->setTotal($request->get('amount'));

		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setItemList($itemList)
		    ->setDescription("Payment description");

		//$baseUrl = getBaseUrl();
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(URL::to('status')) /* specify return url*/
		    ->setCancelUrl(URL::to('status'));

		$payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));

		//$request = clone $payment;
		try {
		    $payment->create($this->_api_context);
		} catch (\Paypal\Exception\PPConectionException $ex) {
			if (\Config::get('app.debug')) {
				\Session::put('error','Connection timeout');
				return Redirect::to('/payment');
			} else {
				\Session::put('error','Some error occoured,Sorry for the inconvinience');
				return Redirect::to('/payment');
			}
		}

		foreach ($payment->getlinks() as $link) {
			if ($link->getRel() == 'approval_url') {
				
				$redirect_url = $link->getHref();
				break;
			}
		}

		/** add payment ID to session **/
		\Session::put('paypal_payment_id', $payment->getId());

		if (isset($redirect_url)) {

			/** redirect to paypal **/
			return Redirect::away($redirect_url);
		}

		\Session::put('error', 'Unknown error occoured');
		return Redirect::to('/payment');
		
    }
    public function getPaymentStatus()
    {
    	$payment_id = \Session::get('paypal_payment_id');

    	\Session::forget('paypal_payment_id');

    	if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
    		\Session::put('error', 'Payment failed');
			return Redirect::to('/payment');
    	}

    	
    	$payment = Payment::get($payment_id, $this->_api_context);
    	$execution = new PaymentExecution();
    	$execution->setPayerId(Input::get('PayerID'));


    	/* execute the payment */
    	$result = $payment->execute($execution, $this->_api_context);
	    if ($result->getState() == 'approved') 
	    {

	    	\Session::put('success', 'Payment successful');
			return Redirect::to('/payment');
	    }

	    \Session::put('error', 'Payment failed');
		return Redirect::to('/payment');

    }
}
