<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHolidaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (Schema::hasTable('holidays')) {
            return;
        }
		Schema::create('holidays', function(Blueprint $table)
		{
			$table->increments('holiday_id');
			$table->integer('id');
			$table->integer('user_id');
			$table->string('request_date', 20);
			$table->string('request_time', 20);
			$table->string('requested_date', 20);
			$table->string('booked', 30);
			$table->string('stage', 20)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        if (!Schema::hasTable('holidays')) {
            return;
        }
		Schema::drop('holidays');
	}

}
