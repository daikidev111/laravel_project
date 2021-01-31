<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailReset extends Model
{
	protected $table = 'email_resets';
	public $timestamps = false;

	protected $fillable = [
		'user_id',
		'token',
		'new_email',
	];
}
