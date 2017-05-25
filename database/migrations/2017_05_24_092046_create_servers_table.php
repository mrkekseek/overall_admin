<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address', 45)->nullable(FALSE)->default('');
            $table->enum('server_type', ['web', 'database', 'fileserver', 'backup'])->nullable(FALSE)->default('web');
            $table->tinyInteger('is_filled')->unsigned()->nullable(FALSE)->default(0);
            $table->enum('perfomance_level', ['1', '2', '3', '4', '5'])->nullable(FALSE)->default('1');
            $table->text('description');
            $table->timestamps();
            $table->unique('id', 'id_UNIQUE');
            $table->unique('ip_address', 'ip_address_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');
    }
}
