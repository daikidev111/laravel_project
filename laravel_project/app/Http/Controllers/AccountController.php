<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Auth;

final class AccountController extends Controller
{
	private $account;

	public function __construct(AccountRepository $account)
	{
		$this->account = $account;
	}

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
