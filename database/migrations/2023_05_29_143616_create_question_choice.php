<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionChoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_choice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->integer('question_id')->unsigned();
            $table->integer('score');
            $table->timestamps();
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
        Schema::dropIfExists('question_choice');
    }
}
