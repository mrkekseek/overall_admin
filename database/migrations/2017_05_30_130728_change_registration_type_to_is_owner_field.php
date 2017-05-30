<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRegistrationTypeToIsOwnerField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('federation_representatives', function (Blueprint $table) {
            $table->dropColumn('registration_type');
            $table->enum('is_owner', ['0', '1'])->after('federation_id')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('federation_representatives', function (Blueprint $table) {
            $table->dropColumn('is_owner');
            $table->enum('registration_type', ['0', '1'])->after('federation_id')->default('0');
        });
    }
}
