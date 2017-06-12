<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatabasePasswordToSubdomainSpecifics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subdomain_specifics', function($table) {
            $table->string('database_password', 255)->after('database_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subdomain_specifics', function($table) {
            $table->dropColumn('database_password');
        });
    }
}
