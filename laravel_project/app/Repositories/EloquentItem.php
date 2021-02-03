<?php

namespace App\Repositories;

use App\Item;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class EloquentItem implements ItemRepository
{
	private $item;
	private $dir = '/home/www/kubo421/laravel_project/laravel_project/storage/app/public/image';

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
		if (empty($data['image'])) {
			$image = null;
		} else {
			$image = $this->uploadImage($data['image']);
		}
		return $this->item->create([
			'name' => $data['name'],
			'description' => $data['description'],
			'price' => $data['price'],
			'stock' => $data['stock'],
			'updated_at' => null,
			'image' => $image,
		]);
	}

	public function update($id, array $data)
	{
		return $this->item->findOrFail($id)->update($data);
	}

	public function uploadImage($image_data)
	{
		$image = time() . "." . $image_data->getClientOriginalExtension();
		$image_data->move('/home/www/kubo421/laravel_project/laravel_project/storage/app/public/image', $image);
		return $image;
	}


}
