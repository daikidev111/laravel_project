<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('user_id')->unsigned();
			$table->integer('postal_code');
			$table->string('prefecture');
			$table->string('city');
			$table->string('building');
			$table->integer('phone')->unsigned();
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
