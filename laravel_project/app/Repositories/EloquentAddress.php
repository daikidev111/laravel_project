<?php

namespace App\Repositories;

use App\Address;
use App\Repositories\AddressRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class EloquentAddress implements AddressRepository {
	private $address;

	public function __construct(Address $address) {
		$this->address = $address;
	}

	public function selectAll() {
		$address = $this->address->where('user_id', Auth::id())->get();
		return $address;
	}

	public function getAddress($id) {
		$address = $this->address->findOrFail($id);
		return $address;
	}

	public function store(array $data) {
		return $this->address->create([
			'name' => $data['name'],
			'user_id' => Auth::id(),
			'postal_code' => $data['postal_code'],
			'prefecture' => $data['prefecture'],
			'city' => $data['city'],
			'building' => $data['building'],
			'phone' => $data['phone'],
		]);
	}

	public function update(array $data, $id) {
		$this->address->findOrFail($id)->update($data);
	}

	public function delete($id) {
		$validate = $this->address->findOrFail($id)->delete();
		if (empty($validate)) {
			return false;
		}
		return true;
	}
}
