<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
	protected $fillable = [
		'transaction_id',
		'user_id',
		'item_id',
		'quantity',
		'amount',
		'updated_at',
	];

	protected $table = 'purchase_items';
}
