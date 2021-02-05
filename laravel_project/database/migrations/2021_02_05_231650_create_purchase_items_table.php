<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemsTable extends Migration
{
	public function up()
	{
		Schema::create('purchase_items', function (Blueprint $table) {
			$table->increments('id');
			$table->string('transaction_id');
			$table->string('user_id');
			$table->string('item_id');
			$table->integer('quantity');
			$table->integer('amount');
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('purchase_items');
	}
}
