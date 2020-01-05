<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HolidayEntitlementUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'holiday_entitlement')) {
            return;
        }
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('holiday_entitlement')->nullable();
            $table->decimal('hours_per_week', 5, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('users', 'holiday_entitlement')) {
            return;
        }
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('holiday_entitlement');
        });
    }
}
