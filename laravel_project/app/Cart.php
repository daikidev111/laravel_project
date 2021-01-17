<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
	use SoftDeletes;
	protected $fillable = [
		'user_id',
		'item_id',
		'quantity',
		'updated_at'
	];

	protected $table = 'carts';

	public function item() {
		return $this->belongsTo('App\Item', 'item_id');
	}

}
