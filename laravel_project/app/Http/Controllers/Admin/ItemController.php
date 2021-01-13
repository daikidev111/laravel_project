<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$item_arr = $this->item->getItem($id);
		return view('admin.item.detail', compact('item_arr'));
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{
		$item_arr = $this->item->paginate(self::NUMBER_OF_ITEMS);

		return view('admin.item.index', compact('item_arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		$this->item->store($request->all());

		return redirect()->route('admin.item.index')->with('success', '新規商品の追加に成功しました');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$item_arr = $this->item->getItem($id);
		return view('admin.item.edit', compact('item_arr'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
	{
		$this->item->update($id, $request->all());
		return redirect()->route('admin.item.index')->with('success', '既存商品の編集に成功しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
	{

        return redirect()->route('admin.item.index')->with('success', '既存商品の削除に成功しました');
    }
}
