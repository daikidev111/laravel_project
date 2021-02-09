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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Item;
use App\PurchaseItem;
use App\CustomerModel;
use App\Transaction;

//https://stripe.com/docs/api/charges/list?lang=php

class ChargeController extends Controller
{
	private $cart;
	private $address;

	public function __construct(CartRepository $cart, AddressRepository $address)
	{
		$this->cart = $cart;
		$this->address = $address;
	}

	public function index($id)
	{
		$carts = $this->cart->getCartForView();
		$sub = $this->cart->subTotal($carts);
		$total = $sub * config('const.Tax');
		$address = $this->address->getAddress($id);
		if ($address == null) {
			return redirect()->route('address.confirm_address')->with('message', '正しい住所が見つかりませんでした。');
		}
		return view('payment.index', compact('address', 'carts', 'sub', 'total'));
	}

	public function charge(Request $request)
	{
		$carts = $this->cart->getCartForView();
		$total = config('const.Tax') * $this->cart->subTotal($carts);
		$charge_id = null;
		$idempotency_key = rand();
		$idempotency_key = hash('sha256', $idempotency_key);

		$address = $this->address->getAddress($request->address_id);
		if ($address == null) {
			return redirect()->back()->with('message', '不正な住所です。もう一度お試しください。');
		}

		try {
			Stripe::setApiKey(env('STRIPE_SECRET'));

			$customer = Customer::create([
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken,
			]);

			$charge = Charge::create([
				'customer' => $customer->id,
				'amount' => $total,
				'currency' => 'jpy',
				], [
				'idempotency_key' => $idempotency_key,
			]);

			$charge_id = $charge->id;

			DB::transaction(function() use ($charge, $customer, $address, $request, $carts) {
				Transaction::create([
					'user_id' => Auth::id(),
					'amount' => $charge->amount,
					'currency' => $charge->currency,
					'status' => $charge->status,
				]);

				CustomerModel::create([
					'transaction_id' => $charge->id,
					'name' => $address->name,
					'email' => $request->stripeEmail,
					'postal_id' => $address->postal_code,
					'prefecture' => $address->prefecture,
					'city' => $address->city,
					'building' => $address->building,
					'phone' => $address->phone,
				]);

				foreach ($carts as $cart) {
					PurchaseItem::create([
						'transaction_id' => $charge->id,
						'user_id' => Auth::id(),
						'item_id' => $cart->item_id,
						'quantity' => $cart->quantity,
						'amount' => $cart->item->price * $cart->quantity,
					]);
				}

				Cart::where('user_id', Auth::id())->delete();
			});

			return redirect()->route('item.index')->with('message', '支払いを完了致しました');

		} catch (\Exception $e) {
			if ($charge_id !== null) {
				Refund::create([
					'charge' => $charge_id,
				]);
			}
			return redirect()->back()->with('message', '決済の支払いが失敗しました。もう一度お試しください');
		}
	}
}
