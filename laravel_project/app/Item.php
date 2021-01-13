<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
		'name',
		'description',
		'stock',
		'price',
		//'created_at',
		//'updated_at'
    ];
}
