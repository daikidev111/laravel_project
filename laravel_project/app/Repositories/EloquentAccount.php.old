<?php

namespace App\Repositories;

use App\Account;
use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Auth;
class EloquentAccount implements AccountRepository
{
	private $account;

	public function __construct(Account $account) {
		$this->account = $account;
	}

	public function getAccount() {
		return $this->account->where('id', Auth::id())->first();
	}
}
