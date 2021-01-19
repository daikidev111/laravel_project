<?php

namespace App\Repositories;

interface AddressRepository
{
	public function selectAll();
	public function getAddress($id);
	public function store(array $data);
	public function update(array $data, $id);
	public function delete($id);
}
