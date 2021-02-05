<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
	public function up()
	{
		Schema::create('customers', function (Blueprint $table) {
			$table->increments('id');
			$table->string('transaction_id');
			$table->string('name');
			$table->string('email');
			$table->string('postal_id');
			$table->string('prefecture');
			$table->string('city');
			$table->string('building');
			$table->string('phone');
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('customers');
	}
}
