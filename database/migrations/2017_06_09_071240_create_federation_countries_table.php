<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFederationCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federation_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('federation_id')->unsigned()->nullable(FALSE)->default(0);
            $table->integer('country_id')->unsigned()->nullable(FALSE)->default(0);
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
        Schema::drop('federation_countries');
    }
}
