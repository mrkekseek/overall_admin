<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address1', 45)->nullable(FALSE)->default('');
            $table->string('address2', 45)->nullable(FALSE)->default('');
            $table->string('city', 45)->nullable(FALSE)->default('');
            $table->string('region', 45)->nullable(FALSE)->default('');
            $table->string('zipcode', 45)->nullable(FALSE)->default('');
            $table->string('country', 45)->nullable(FALSE)->default('');
            $table->string('details', 45)->nullable(FALSE)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
