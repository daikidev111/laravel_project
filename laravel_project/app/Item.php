<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes;
	protected $fillable = [
		'name',
		'description',
		'stock',
		'price',
		'updated_at',
	];
	protected $table = 'items';

	public function carts() {
		return $this->hasMany('App\Cart');
	}
}
