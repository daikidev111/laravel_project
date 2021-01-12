<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
/**
 * Final Controller class extended from Controller
 * エンキャプスレーションによる抽象化、また継承連鎖の阻止
 *
 * @return void
 */
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
