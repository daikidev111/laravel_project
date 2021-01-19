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
			$table->integer('postal_code');
			$table->string('prefecture');
			$table->string('city');
			$table->string('building')->nullable();
			$table->integer('phone');
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
