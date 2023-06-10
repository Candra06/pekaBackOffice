<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnsweredDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answered_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answered_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->string('answer');
            $table->timestamps();
            $table->foreign('answered_id')->references('id')->on('answered_questions');
            $table->foreign('question_id')->references('id')->on('question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answered_detail');
    }
}
