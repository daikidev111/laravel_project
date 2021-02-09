<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
	protected $fillable = [
		'transaction_id',
		'name',
		'email',
		'postal_code',
		'prefecture',
		'city',
		'building',
		'phone',
		'updated_at',
	];

	protected $table = 'customers';

}
