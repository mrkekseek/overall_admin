<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeActivitiesToSportIdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('federation_accounts', function (Blueprint $table) {
            $table->dropColumn('activities');
            $table->integer('sport_id')->after('owner_id')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('federation_accounts', function (Blueprint $table) {
            $table->dropColumn('sport_id');
            $table->string('activities', 255)->after('owner_id')->nullable(FALSE)->default('');
        });
    }
}
