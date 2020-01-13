<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (Schema::hasTable('users')) {
            return;
        }
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('uuid', 36);
			$table->string('email')->unique();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('title', 10)->nullable();
			$table->string('firstname', 30)->nullable();
			$table->string('middlename', 30)->nullable();
			$table->string('lastname', 30)->nullable();
			$table->string('job_title', 30)->nullable();
			$table->dateTime('dob')->nullable();
			$table->string('photo')->nullable();
			$table->softDeletes();
			$table->string('gender', 10)->nullable();
			$table->decimal('hours_per_week', 5)->nullable();
			$table->decimal('holiday_entitlement', 4)->nullable();
			$table->string('name');
			$table->boolean('book_past_holidays')->default(0);
			$table->char('token', 36)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        if (!Schema::hasTable('users')) {
            return;
        }
		Schema::drop('users');
	}

}
