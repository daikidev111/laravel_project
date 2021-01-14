<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\ItemRepository;
final class ItemController extends Controller
{
	private $item;
	const NUMBER_OF_ITEMS = 5;

	public function __construct(ItemRepository $item)
	{
		$this->item = $item;
	}

	public function show($id)
	{
		$item_arr = $this->item->getItem($id);
		return view('admin.item.detail', compact('item_arr'));
	}

	public function index()
	{
		$item_arr = $this->item->paginate(self::NUMBER_OF_ITEMS);
		return view('admin.item.index', compact('item_arr'));
	}

	public function create()
	{
		return view('admin.item.create');
	}

	public function store(StoreRequest $request)
	{
		$this->item->store($request->all());
		return redirect()->route('admin.item.index')->with('success', '新規商品の追加に成功しました');
	}

	public function edit($id)
	{
		$item_arr = $this->item->getItem($id);
		return view('admin.item.edit', compact('item_arr'));
	}

	public function update(UpdateRequest $request, $id)
	{
		$this->item->update($id, $request->all());
		return redirect()->route('admin.item.index')->with('success', '既存商品の編集に成功しました');
	}

	public function destroy($id)
	{
		$this->item->delete($id);
		return redirect()->route('admin.item.index')->with('success', '既存商品の削除に成功しました');
	}
}
