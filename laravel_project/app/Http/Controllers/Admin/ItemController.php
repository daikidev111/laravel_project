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
		$item_arr = $this->item->paginate(config('const.Item')['PAGE']);
		return view('admin.item.index', compact('item_arr'));
	}

	public function create()
	{
		return view('admin.item.create');
	}

	public function store(StoreRequest $request)
	{
		if ($this->item->store($request->all())) {
			return redirect()->route('admin.item.index')->with('message', '新規商品の追加に成功しました');
		} else {
			return redirect()->route('admin.item.index')->with('message', '新規商品の追加に失敗しました');
		}
	}

	public function edit($id)
	{
		$item_arr = $this->item->getItem($id);
		return view('admin.item.edit', compact('item_arr'));
	}

	public function update(UpdateRequest $request, $id)
	{
		if ($this->item->update($id, $request->all())) {
			return redirect()->route('admin.item.index')->with('message', '既存商品の編集に成功しました');
		} else {
			return redirect()->route('admin.item.index')->with('message', '既存商品の編集に失敗しました');
		}
	}
}
