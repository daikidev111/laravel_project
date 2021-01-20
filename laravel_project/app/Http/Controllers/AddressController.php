<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AddressRepository;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;
class AddressController extends Controller
{
	private $address;

	public function __construct(AddressRepository $address) {
		$this->address = $address;
	}

	public function index()
	{
		$address = $this->address->selectAll();
		return view('address.index', compact('address'));
	}

	public function create()
	{
		return view('address.create');
	}

	public function store(AddressRequest $request)
	{
		$this->address->store($request->all());
		return redirect()->route('address.index')->with('message', 'お届け先の追加に成功しました');
	}

	public function edit($id)
	{
		$address = $this->address->getAddress($id);
		if ($address == null || $address->user_id !== Auth::id()) {
			return redirect()->route('address.index')->with('message', '編集画面へのリダイレクトに失敗しました。');
		}
        return view('address.edit', compact('address'));
	}

	public function update(AddressRequest $request, $id)
	{
		$this->address->update($request->all(), $id);
		return redirect()->route('address.index')->with('message', 'お届け先の編集に成功しました');
	}

	public function destroy($id)
	{
		if ($this->address->delete($id)) {
			return redirect()->route('address.index')->with('message', 'お届け先の削除に成功しました');
		}
		return redirect()->route('address.index')->with('message', 'お届け先の削除をする際にエラーが発生しました。もう一度お試しください。');
	}
}
