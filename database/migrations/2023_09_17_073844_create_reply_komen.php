<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyKomen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_komen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('komen_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->text('message');
            $table->timestamps();
            $table->foreign('komen_id')->references('id')->on('komen_artikel');
            $table->foreign('users_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reply_komen');
    }
}
