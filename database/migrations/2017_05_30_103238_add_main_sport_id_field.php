<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMainSportIdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('club_accounts', function (Blueprint $table) {
            $table->integer('main_sport_id')->after('owner_id')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('club_accounts', function (Blueprint $table) {
            $table->dropColumn('main_sport_id');
        });
    }
}
