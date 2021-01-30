<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetEmailNotification;
use Illuminate\Notifications\Notification;
class EmailReset extends Model
{
	use Notifiable;

	protected $fillable = [
		'user_id',
		'token',
		'new_email',
	];

	protected $table = 'email_resets';
	public $timestamps = false;

	/*
	public function sendEmailResetNotification($token)
	{
		$this->notify(new ResetEmailNotification($token));
	}
	 */

/*
	public function routeNotificationForMail()
	{
		return $this->new_mail;
	}
*/
}
