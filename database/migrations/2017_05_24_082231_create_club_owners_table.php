<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 150)->nullable(FALSE)->default('');
            $table->string('last_name', 150)->nullable(FALSE)->default('');
            $table->string('middle_name', 45)->nullable(FALSE)->default('');
            $table->string('email_address', 150)->nullable(FALSE)->default('');
            $table->string('phone_number', 45)->nullable(FALSE)->default('');
            $table->char('country', 2)->nullable(FALSE)->default('');
            $table->timestamps();
            $table->unique('id', 'id_UNIQUE');
            $table->unique('email_address', 'email_address_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('club_owners');
    }
}
