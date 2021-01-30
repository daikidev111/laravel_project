<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthComposer
{
	public function compose(View $view)
	{
		$view->with('user', Auth::user());
	}
}


