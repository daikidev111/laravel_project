<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
class ChangePasswordController extends Controller
{
	public function changePassword(ChangePasswordRequest $request)
	{
		$user = Auth::user();
		$current_password = $request->input('current_password');
		$new_password = $request->input('new_password');
		if (Hash::check($current_password, $user->password)) {
			if ($current_password !== $new_password) {
				$user->password = bcrypt($new_password);
				$user->save();
				return redirect()->route('account.detail')->with('message', 'パスワードの変更に成功しました。');
			} else {
				return redirect()->route('account.edit_password')->with('message', 'パスワードの変更ができませんでした。');
			}
		}
		return redirect()->route('account.edit_password')->with('message', '現在のパスワードが一致しませんでした。');
	}
}
