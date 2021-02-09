<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AddressRepository;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;

final class AddressController extends Controller
{
	private $address;

	public function __construct(AddressRepository $address) {
		$this->address = $address;
	}

	public function index()
	{
		return view('address.index');
	}

	public function address_list()
	{
		return view('address.confirm_address');
	}

	public function create()
	{
		return view('address.create');
	}

	public function store(AddressRequest $request)
	{
		if ($this->address->checkDuplicates($request->all()) == false) {
			if ($this->address->store($request->all())) {
				return redirect()->route('address.index')->with('message', 'お届け先の追加に成功しました');
			}
			return redirect()->route('address.index')->with('message', 'お届け先の追加に失敗しました');
		} else {
			return redirect()->route('address.index')->with('message', 'お届け先は既に存在しています。');
		}
	}

	public function edit($id)
	{
		$address = $this->address->getAddress($id);
		if ($address == null) {
			return redirect()->route('address.index')->with('message', '編集画面へのリダイレクトに失敗しました。');
		}
		return view('address.edit', compact('address'));
	}

	public function update(AddressRequest $request, $id)
	{
		if (!$this->address->checkDuplicates($request->all())) {

			if ($this->address->update($request->all(), $id)) {
				return redirect()->route('address.index')->with('message', 'お届け先の編集に成功しました');
			}
			return redirect()->route('address.index')->with('message', 'お届け先の編集に失敗しました');

		} else {
			return redirect()->route('address.index')->with('message', 'お届け先は既に存在しています');
		}
	}

	public function destroy($id)
	{
		if ($this->address->delete($id)) {
			return redirect()->route('address.index')->with('message', 'お届け先の削除に成功しました');
		}
		return redirect()->route('address.index')->with('message', 'お届け先の削除をする際にエラーが発生しました。もう一度お試しください。');
	}
}
