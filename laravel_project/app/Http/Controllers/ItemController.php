<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ItemRepository;

final class ItemController extends Controller
{
	private $item;

	public function __construct(ItemRepository $item)
	{
		$this->item = $item;
	}

	public function index() {
		$items = $this->item->selectAll();
		return view('item.index', compact('items'));
	}

	public function show($id)
	{
		$item = $this->item->getItem($id);
		return view('item.detail', compact('item'));
	}

}
