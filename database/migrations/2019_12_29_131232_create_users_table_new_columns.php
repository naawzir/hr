<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTableNewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'title')) {
            return;
        }
        Schema::table('users', function (Blueprint $table) {
            $table->string('title', 10)->nullable();
            $table->string('firstname', 30);
            $table->string('middlename', 30)->nullable();
            $table->string('surname', 30);
            $table->string('job_title', 30)->nullable();
            $table->datetime('dob')->nullable();
            $table->string('hours_per_week', 8)->nullable();
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('users', 'title')) {
            return;
        }
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'firstname',
                'middlename',
                'surname',
                'job_title',
                'dob',
                'hours_per_week',
                'photo'
            ]);
        });
    }
}
