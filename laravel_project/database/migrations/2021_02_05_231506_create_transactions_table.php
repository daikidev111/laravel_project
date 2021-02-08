<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
	public function up()
	{
		Schema::create('transactions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('amount');
			$table->string('currency');
			$table->string('status');
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('transactions');
	}
}
