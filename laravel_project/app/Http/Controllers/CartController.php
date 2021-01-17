<?php

namespace App\Http\Controllers;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

final class CartController extends Controller
{
	private $cart;
	const tax = 1.1;

	public function __construct(CartRepository $cart)
	{
		$this->cart = $cart;
	}

	public function index()
	{
		$carts = $this->cart->getCartForView();
		$sub = $this->cart->subTotal($carts);
		$total = $sub * self::tax;
		return view('cart.index', compact('carts', 'sub', 'total'));
	}

	public function delete($item_id)
	{
		dd($this->cart->getCart(intval($item_id)));
		$this->cart->delete($item_id);
		return redirect()->route('cart.index')->with('success', 'カート内の商品の削除に成功しました');
	}

	public function add(Request $request) {
		//TODO: true or false で返す
		$this->cart->add($request->all());
		return redirect()->route('cart.index')->with('success', '商品をカートに追加しました');
	}
}
