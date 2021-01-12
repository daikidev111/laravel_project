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

	public function selectAll() {
		return $this->item->all();
	}

	public function getItem($id)
	{
		return $this->item->find($id);
	}

	public function store(array $data)
	{
		return $this->item->create($data);
	}

	public function update($id, array $data)
	{
		return "a";
	}

	public function delete($id)
	{
		return "a";
	}
}
