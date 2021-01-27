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
		$address = $this->address->whereRaw('id = ? AND user_id = ?', [$id, Auth::id()])->first();
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

	public function checkDuplicates(array $data) {
		$address = $this->address->whereRaw('postal_code = ? AND prefecture = ? AND city = ? AND building = ? AND phone = ? AND user_id = ?', [
			$data['postal_code'],
			$data['prefecture'],
			$data['city'],
			$data['building'],
			$data['phone'],
			Auth::id(),
		])->first();

		// if the address is empty then it means there is no duplicates, hence it should return false
		if (empty($address)) {
			return false;
		} else {
			return true;
		}
	}

	public function update(array $data, $id) {
		$address = $this->getAddress($id);
		if (empty($address)) {
			return false;
		}
		$address->update($data);
		return true;
	}

	public function delete($id) {
		$address = $this->getAddress($id);
		if (empty($address)) {
			return false;
		} else {
			$address->delete();
			return true;
		}
	}
}
