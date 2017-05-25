<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFederationRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federation_representatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 150)->nullable(FALSE)->default('');
            $table->string('last_name', 150)->nullable(FALSE)->default('');
            $table->string('middle_name', 45)->nullable(FALSE)->default('');
            $table->string('email_address', 150)->nullable(FALSE)->default('');
            $table->string('phone_number', 45)->nullable(FALSE)->default('');
            $table->char('country', 2)->nullable(FALSE)->default('');
            $table->integer('federation_id')->unsigned()->nullable(FALSE)->default(0);
            $table->enum('registration_type', ['0', '1'])->nullable(FALSE)->default('0');
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
        Schema::drop('federation_representatives');
    }
}
