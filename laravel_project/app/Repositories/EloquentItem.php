<?php

namespace App\Repositories;

use App\Item;
use App\Repositories\ItemRepository;

class EloquentItem implements ItemRepository
{
	private $item;

	public function __construct(Item $item)
	{
		$this->item = $item;
	}

	public function paginate($num) {
		return $this->item->latest()->paginate($num);
	}

	public function selectAll() {
		return $this->item->all();
	}

	public function getItem($id)
	{
		return $this->item->findOrFail($id);
	}

	public function store(array $data)
	{
		return $this->item->create([
			'name' => $data['name'],
			'description' => $data['description'],
			'price' => $data['price'],
			'stock' => $data['stock'],
			'updated_at' => null
		]);
	}

	public function update($id, array $data)
	{
		return $this->item->findOrFail($id)->update($data);
	}
}
