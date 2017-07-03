<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableForSubdomainSpecificIdInClubAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('club_accounts', function(Blueprint $table)
        {
            $table->dropColumn('subdomain_specific_id');
        });

        Schema::table('club_accounts', function(Blueprint $table)
        {
            $table->integer('subdomain_specific_id')->unsigned()->nullable()->after('address_id');
            $table->unique('subdomain_specific_id', 'subdomain_specific_id_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()    {
        Schema::table('club_accounts', function(Blueprint $table)
        {
            $table->integer('subdomain_specific_id')->unsigned()->nullable(FALSE)->default(0)->after('address_id');
            $table->unique('subdomain_specific_id', 'subdomain_specific_id_UNIQUE');
        });
    }
}
