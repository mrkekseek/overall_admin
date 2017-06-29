<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateOfBirthToFederationRepresentativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('federation_representatives', function ($table) {
            $table->date('date_of_birth')->after('middle_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('federation_representatives', function($table) {
            $table->dropColumn('date_of_birth');
        });
    }
}
