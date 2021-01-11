<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ItemRepository;

class ItemController extends Controller
{
	private $item;

	public function __construct(ItemRepository $item)
	{
		$this->item = $item;
	}

	public function index() {
		$item_arr = $this->item->selectAll();
		return view('admin.item.index', compact('item_arr'));
	}

	public function show($id)
	{
		$item_arr = $this->item->getItem($id);
		return view('admin.item.detail', compact('item_arr'));
	}

	public function store(Request $request)
	{
		$this->item->store($request->all());
	}

}
