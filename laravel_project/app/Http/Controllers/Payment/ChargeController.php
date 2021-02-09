<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Refund;
use App\Repositories\CartRepository;
use App\Repositories\AddressRepository;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\Customer;
use App\Transaction;
use App\PurchaseItem;

class ChargeController extends Controller
{
	private $cart;
	private $address;
	const tax = 1.1; //TODO add it in the const config later

	public function __construct(CartRepository $cart, AddressRepository $address)
	{
		$this->cart = $cart;
		$this->address = $address;
	}

	public function index($id)
	{
		$carts = $this->cart->getCartForView();
		$sub = $this->cart->subTotal($carts);
		$total = $sub * self::tax;
		$address = $this->address->getAddress($id);
		return view('payment.index', compact('address', 'carts', 'sub', 'total'));
	}

	public function charge(Request $request)
	{
		$carts = $this->cart->getCartForView();
		$total = self::tax * $this->cart->subTotal($carts);
		$chargeId = null;
		$idempotency_key = rand();
		$idempotency_key = hash('sha256', $idempotency_key);

		try {
			Stripe::setApiKey(env('STRIPE_SECRET'));

			$customer = Customer::create([
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken
			]);

			$charge = Charge::create([
				'customer' => $customer->id,
				'amount' => $total,
				'currency' => 'jpy', //should it be set in default or be retrieve from the client side??
			], [
				'idempotency_key' => $idempotency_key,
			]);

			/*
			DB::transaction(function() use ($charge, $customer) {
				Transaction::firstOrNew([
					'user_id' => Auth::id(),
					'amount' => $charge->amount,
					'currency' => $charge->currency,
					'status' => $charge->status,
				]);

				Customers::firstOrNew([
					'transaction_id' => $charge->id,
					'name' => $address->name,
					'email' => $request->stripeEmail,
					'postal_id' => $address->postal_id,
					'prefecture' => $address->prefecture,
					'city' => $address->city,
					'building' => $address->building,
					'phone' => $address->phone
				]);

				PurchaseItem::firstOrNew([
					'transaction_id' => $charge->id,
					'user_id' => Auth::id(),
					'quantity' => null,
					'amount' => null,
				]);
		});
			 */

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

			return redirect()->route('item.index')->with('message', '支払いを完了致しました');
		} catch (\Exception $e) {
			if ($chargeId !== null) {
				Refund::create([
					'charge' => $chargeId,
				]);
			}
			return $e->getMessage();
		}
	}
}
