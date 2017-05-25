<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFederationAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federation_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable(FALSE)->default('');
            $table->integer('owner_id')->unsigned()->nullable(FALSE)->default(0);
            $table->string('activities')->nullable(FALSE)->default('');
            $table->integer('address_id')->unsigned()->nullable(FALSE)->default(0);
            $table->char('country', 2)->nullable(FALSE)->default('');
            $table->integer('subdomain_specific_id')->unsigned()->nullable(FALSE)->default(0);
            $table->timestamps();
            $table->unique('id', 'id_UNIQUE');
            $table->unique('name', 'name_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('federation_accounts');
    }
}
