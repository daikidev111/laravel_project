<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetEmailNotification extends Notification
{
	public $token;
	protected $title = 'メールリセット通知';

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
		return (new MailMessage)->subject($this->title)->view('mail.confirm_mail', [
			'reset_url' => url('email/change', $this->token),
		]);
	}

}
