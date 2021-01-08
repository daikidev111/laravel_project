<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
	public function index() {
		$items = Item::all()->toArray();
		return view('item.index', compact('items'));
	}
}
