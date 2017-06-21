<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubfederationstatusesTableAndAddStatusesInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubfederation_statuses', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('status_name')->nullable(false);
        });

        Artisan::call('db:seed', array('--class' => 'ClubFederationstatuses'));
        
        Schema::table('federation_accounts', function ($table) {
            $table->integer('status')->nullable(FALSE)->default(1)->after('name');
        });
        
        Schema::table('club_accounts', function ($table) {
            $table->integer('status')->nullable(FALSE)->default(1)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubfederation_statuses');
        Schema::table('federation_accounts', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('club_accounts', function($table) {
            $table->dropColumn('status');
        });
    }
}
