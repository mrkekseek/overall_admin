<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubdomainSpecificsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdomain_specifics', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('is_assigned', ['0', '1'])->nullable(FALSE)->default('0');
            $table->integer('assigned_by')->unsigned()->nullable(FALSE)->default(0);
            $table->string('subdomain_link', 150)->nullable(FALSE)->default('');
            $table->integer('web_server_id')->unsigned()->nullable(FALSE)->default(0);
            $table->integer('database_server_id')->unsigned()->nullable(FALSE)->default(0);
            $table->string('database_name', 45)->nullable(FALSE)->default('');
            $table->string('database_user', 45)->nullable(FALSE)->default('');
            $table->timestamps();
            $table->unique('id', 'id_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subdomain_specifics');
    }
}
