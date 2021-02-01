<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\Address;

final class AccountController extends Controller
{
	const NUMBER_OF_USERS = 5;

	public function index()
	{
		$user_data = new User();
		$users = $user_data->latest()->paginate(self::NUMBER_OF_USERS);
		return view('admin.account.index', compact('users'));
	}

	public function detail($id)
	{
		$user = new User();
		$address = new Address();
		$user_details = $user->where('id', $id)->get();
		$address_details = $address->where('user_id', $id)->get();
		return view('admin.account.detail', compact('user_details', 'address_details'));
	}
}
