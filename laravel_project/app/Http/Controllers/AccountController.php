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

	public function show() {
		$account_detail = $this->account->getAccount();
		return view('account.detail', compact('account_detail'));
	}

}
