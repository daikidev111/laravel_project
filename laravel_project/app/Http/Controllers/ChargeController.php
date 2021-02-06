<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
class ChargeController extends Controller
{
	public function index()
	{
		return view('payment.index');
	}

	public function charge(Request $request)
	{
		try {
			Stripe::setApiKey(env('STRIPE_SECRET'));
			$customer = Customer::create(array(
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken
			));

			$charge = Charge::create(array(
				'customer' => $customer->id,
				'amount' => 1000,
				'currency' => 'jpy'
			));
			/*
			$charge->id;
			$charge->currency;
			$charge->status;
			$charge->customer(same as the customer id??)
			$charge->refunded(<=bool);
			$charge->refunds

			dd($charge);
			/*
			dd($customer);
			$customer->email
			$customer->name
			$customer->id
			 */


			//https://stripe.com/docs/api/charges/list?lang=php

			//$charge->capture for refunding?

			return back();
		} catch (\Exception $ex) {
			return $ex->getMessage();
		}
	}
}
