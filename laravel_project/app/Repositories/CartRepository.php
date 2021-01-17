<?php

namespace App\Repositories;

interface CartRepository
{
	public function getCart($item_id);
	public function subTotal($carts);
	public function getCartForView();
	public function delete($item_id);
	public function add(array $data);
}
