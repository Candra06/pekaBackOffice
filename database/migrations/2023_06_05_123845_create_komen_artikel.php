<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomenArtikel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komen_artikel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artikel_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->text('komentar');
            $table->timestamps();
            $table->foreign('artikel_id')->references('id')->on('artikel');
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
        Schema::dropIfExists('komen_artikel');
    }
}
