<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = [
		'user_id',
		'amount',
		'currency',
		'status',
		'updated_at'
	];

	protected $table = 'transactions';
}
