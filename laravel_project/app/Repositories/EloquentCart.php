<?php

namespace App\Repositories;

use App\Cart;
use App\Item;
use App\Repositories\CartRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class EloquentCart implements CartRepository
{
	private $cart;

	public function __construct(Cart $cart) {
		$this->cart = $cart;
	}

	public function getCart($item_id) {
		$cart = $this->cart->where('item_id', $item_id)->first();
		return $cart;
	}

	public function getCartForView() {
		$carts = $this->cart->select('item_id', DB::raw('SUM(quantity) AS quantity'))->where('user_id', Auth::id())->groupBy('item_id')->get();
		return $carts;
	}

	public function subTotal($carts) {
		$sub = 0;
		foreach ($carts as $cart) {
			$sub += $cart->item->price * $cart->quantity;
		}
		return $sub;
	}

	public function delete($item_id) {
		DB::transaction(function() use ($item_id) {
			$this->cart->where('item_id', $item_id)->delete();
			DB::table('items')->where('id', $item_id)->update([
				'stock' => 1 //$this->getCart($item_id)->quantity + $this->getCart($item_id)->item->stock
			]);
		});
	}

	public function add(array $data) {
		DB::transaction(function() use ($data) {
			$this->cart->create([
				'user_id' => Auth::id(),
				'item_id' => $data['item_id'],
				'quantity' => $data['quantity'],
				'updated_at' => null
			]);
			DB::table('items')->where('id', $data['item_id'])->update([
				'stock' => $this->getCart($data['item_id'])->item->stock - $data['quantity']
			]);
		});
	}

}
