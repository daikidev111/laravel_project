<?php

namespace App\Http\Controllers;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\AddRequest;
final class CartController extends Controller
{
	private $cart;

	public function __construct(CartRepository $cart)
	{
		$this->cart = $cart;
	}

	public function index()
	{
		$carts = $this->cart->getCartForView();
		$sub = $this->cart->subTotal($carts);
		$total = $sub * config('const.Tax');
		return view('cart.index', compact('carts', 'sub', 'total'));
	}

	public function delete($item_id)
	{
		if ($this->cart->delete(intval($item_id))) {
			return redirect()->route('cart.index')->with('message', 'カート内の商品の削除に成功しました');
		}
		return redirect()->route('cart.index')->with('message', 'カート内の商品を削除する際にエラーが起きました。もう一度お試しください');
	}

	public function add(Request $request) {
		if ($this->cart->add($request->all())) {
			return redirect()->route('cart.index')->with('message', '商品をカートに追加しました');
		}
		return redirect()->route('cart.index')->with('message', '商品をカートに追加する際にエラーが起きました。もう一度お試しください');
	}
}
