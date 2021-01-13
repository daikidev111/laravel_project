<?php

namespace App\Repositories;

interface ItemRepository
{
	public function paginate($num);
	public function selectAll();
	public function getItem($id);
	public function store(array $data);
	public function update($id, array $data);
	public function delete($id);
}
