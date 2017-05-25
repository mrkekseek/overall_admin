<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable(FALSE)->default('');
            $table->integer('owner_id')->unsigned()->nullable(FALSE)->default(0);
            $table->char('country', 2)->nullable(FALSE)->default('');
            $table->integer('address_id')->unsigned()->nullable(FALSE)->default(0);
            $table->integer('subdomain_specific_id')->unsigned()->nullable(FALSE)->default(0);
            $table->text('details');
            $table->enum('registration_type', ['online', 'rankedin', 'admin'])->nullable(FALSE)->default('admin');
            $table->timestamps();
            $table->unique('id', 'id_UNIQUE');
            $table->unique('subdomain_specific_id', 'subdomain_specific_id_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('club_accounts');
    }
}
