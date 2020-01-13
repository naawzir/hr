<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalendarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (Schema::hasTable('calendar')) {
            return;
        }
		Schema::create('calendar', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('date')->nullable();
			$table->string('day', 3)->nullable();
			$table->string('month', 3)->nullable();
			$table->string('bank_holiday', 12)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        if (!Schema::hasTable('calendar')) {
            return;
        }
		Schema::drop('calendar');
	}

}
