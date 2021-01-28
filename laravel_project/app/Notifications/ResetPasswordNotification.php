<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
	public $token;
	protected $title = 'パスワードリセット通知';

	use Queueable;

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function via($notifiable)
	{
		return ['mail'];
	}

	public function toMail($notifiable)
	{
		return (new MailMessage)->subject($this->title)->view('mail.resetpassword', [
			'reset_url' => url('password/reset', $this->token),
		]);
	}

}
