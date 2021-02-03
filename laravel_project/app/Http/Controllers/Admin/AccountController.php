<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\Address;

final class AccountController extends Controller
{
	public function index()
	{
		$user_data = new User();
		$users = $user_data->latest()->paginate(config('const.Account')['PAGE']);
		return view('admin.account.index', compact('users'));
	}

	public function detail($id)
	{
		$user = new User();
		$user->findOrFail($id);
		$user_details = $user->where('id', $id)->get();
		$address = new Address();
		$address_details = $address->where('user_id', $id)->get();
		return view('admin.account.detail', compact('user_details', 'address_details'));
	}
}
