<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
