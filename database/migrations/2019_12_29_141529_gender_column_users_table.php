<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GenderColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'gender')) {
            return;
        }
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender', 10)->nullable();
            $table->renameColumn('surname', 'lastname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('users', 'gender')) {
            return;
        }
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
}
