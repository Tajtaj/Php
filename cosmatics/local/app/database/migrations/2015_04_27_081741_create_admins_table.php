<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

    public function up()
    {
        //
        Schema::create('admins', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username', 32);
            $table->string('password', 64);
            $table->string('remember_token', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }


}
