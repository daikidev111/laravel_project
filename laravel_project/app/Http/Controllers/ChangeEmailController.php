<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangeEmailRequest;
use Illuminate\Support\Facades\Auth;
use App\EmailReset;
use Illuminate\Support\Facades\DB;
use App\Notifications\ResetEmailNotification;
use Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\User;

require 'vendor/autoload.php';
use Carbon\Carbon;


class ChangeEmailController extends Controller
{
	use Notifiable;

	public function sendChangeEmailLink(ChangeEmailRequest $request)
	{
		$user = User::find(Auth::id());

		if (Hash::check($request->input('current_password'), $user->password)) {
				$new_email = $request->input('email');
				$user_name = $request->input('name');
			if ($user->email !== $request->input('email')) {
				$token = hash_hmac(
					'sha256',
					$this->randomKeyGenerator(40),
					config('app.key')
				);

				DB::transaction(function() use ($new_email, $token, $user_name, $user) {
					$param = [];
					$param['new_email'] = $new_email;
					$param['token'] = $token;
					$param['user_id'] = Auth::id();
					$email_reset = EmailReset::create($param);
					if ($user_name !== $user->name) {
						$user->name = $user_name;
						$user->save();
					}

					Notification::route('mail', $new_email)->notify(new ResetEmailNotification($token));
				});
			return redirect()->route('account.edit_account')->with('message', '確認用メールを送信いたしました。');
			} else {
				if ($user->name !== $user_name) {
					$user->name = $user_name;
					$user->save();
					return redirect()->route('account.edit_account')->with('message', '名前の変更を成功しました。');
				}
				return redirect()->route('account.edit_account')->with('message', '変更がありませんでした');
			}
		} else {
			return redirect()->route('account.edit_account')->with('message', '現在のパスワードが異なります');
		}
	}

	public function reset(Request $request, $token) {
		$email_reset = DB::table('email_resets')->where('token', $token)->first();
		if ($email_reset && !$this->tokenExpired($email_reset->created_at)) {
			$user = User::find(Auth::id());
			$user->email = $email_reset->new_email;
			$user->save();

			DB::table('email_resets')->where('token', $token)->delete();

			return redirect()->route('account.detail')->with('message', 'メールアドレスの更新に成功しました。');
		} else {
			if ($email_reset) {
				DB::table('email_resets')->where('token', $token)->delete();
			}
			return redirect()->route('account.detail')->with('message', 'メールアドレスの更新に失敗しました。');
		}
	}

	private function tokenExpired($created_at)
	{
		$expiry_time = 60 * 60;
		return Carbon::parse($created_at)->addSeconds($expiry_time)->isPast();
	}


	private function randomKeyGenerator($length = 64, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
		if ($length < 1) {
			throw new \RangeException("Length must be a positive integer");
		}
		$pieces = [];
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$pieces []= $keyspace[random_int(0, $max)];
		}

		return implode('', $pieces);
	}

}
