<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
	use SoftDeletes;
	protected $fillable = [
		'name',
		'user_id',
		'postal_code',
		'prefecture',
		'city',
		'building',
		'phone',
		'updated_at'
	];

	protected $table = 'address';
}
