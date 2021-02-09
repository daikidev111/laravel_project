<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Address;

class AddressComposer
{
	public function compose(View $view)
	{
		$address = new Address();
		$address = $address->where('user_id', Auth::id())->get();
		$view->with('address', $address);
	}
}
