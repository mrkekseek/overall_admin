<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLengthCountryCodeFederationRepresentatives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('federation_representatives', function(Blueprint $table){
            DB::statement("ALTER TABLE `federation_representatives` MODIFY `country` VARCHAR(255) NOT NULL DEFAULT ''");
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('federation_representatives', function(Blueprint $table){
            DB::statement("ALTER TABLE `federation_representatives` MODIFY `country` CHAR(2) NOT NULL DEFAULT ''");
        });
        
    }
}
