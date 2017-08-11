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
        DB::statement("ALTER TABLE `federation_representatives` MODIFY `country` VARCHAR(255) NOT NULL DEFAULT ''");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `federation_representatives` MODIFY `country` CHAR(2) NOT NULL DEFAULT ''");
    }
}
