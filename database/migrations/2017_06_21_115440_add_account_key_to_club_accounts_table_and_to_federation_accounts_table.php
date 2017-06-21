<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountKeyToClubAccountsTableAndToFederationAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('club_accounts', function($table) {
            $table->char('account_key', 29)->after('registration_type');
            $table->unique('account_key', 'account_key_UNIQUE');
        });

        Schema::table('federation_accounts', function($table) {
            $table->char('account_key', 29)->after('subdomain_specific_id');
            $table->unique('account_key', 'account_key_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('club_accounts', function($table) {
            $table->dropColumn('account_key');
        });

        Schema::table('federation_accounts', function($table) {
            $table->dropColumn('account_key');
        });
    }
}
