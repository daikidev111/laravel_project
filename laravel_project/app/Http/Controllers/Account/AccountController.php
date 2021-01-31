<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

final class AccountController extends Controller
{
	public function show()
	{
		return view('account.detail');
	}

	public function editAccount()
	{
		return view('account.edit_account');
	}

	public function editPassword()
	{
		return view('account.edit_password');
	}
}
