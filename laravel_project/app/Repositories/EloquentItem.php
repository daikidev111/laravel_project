<?php

namespace App\Repositories;

use App\Item;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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
		$image_validate = false;
		if (empty($data['image'])) {
			$image = null;
			$image_validate = true;
		} else {
			$image_data = $data['image'];
			$extension = $image_data->getMimeType();
			if (in_array($extension, array('image/gif', 'image/png', 'image/jpg', 'image/jpeg'))) {
				$extension = explode("/", $extension, PATHINFO_EXTENSION);
				$image = time() . "." . array_pop($extension);
				$image_data->move('/home/www/kubo421/laravel_project/laravel_project/storage/app/public/image/', $image);
				$image_validate = true;
			}
		}

		if ($image_validate) {
			$this->item->create([
				'name' => $data['name'],
				'description' => $data['description'],
				'price' => $data['price'],
				'stock' => $data['stock'],
				'updated_at' => null,
				'image' => $image,
			]);
			return true;
		} else {
			return false;
		}
	}

	public function update($id, array $data)
	{
		$item = $this->getItem($id);
		$image_validate = false;
		$path = '/home/www/kubo421/laravel_project/laravel_project/storage/app/public/image/';

		if (!empty($data['image'])) {
			$image_data = $data['image'];
			$extension = $image_data->getMimeType();
			if (in_array($extension, array('image/gif', 'image/png', 'image/jpg', 'image/jpeg'))) {
				$extension = explode("/", $extension, PATHINFO_EXTENSION);
				$image = time() . "." . array_pop($extension);
				$image_validate = true;
				if ($item->image == null) {
					$image_data->move($path, $image);
				} else {
					unlink($path . $item->image);
					$image_data->move($path, $image);
				}
			}
		} else {
			$image = $item->image;
			$image_validate = true;
		}
		if ($image_validate) {
			$this->item->findOrFail($id)->update([
				'name' => $data['name'],
				'description' => $data['description'],
				'stock' => $data['stock'],
				'updated_at' => null,
				'image' => $image,
			]);
			return true;
		} else {
			return false;
		}
	}
}
