<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('user_lesson', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('lesson_id')->unsigned()->nullable();
			$table->foreign('lesson_id')->references('id')->on('lessons');

			$table->decimal('score', 5, 2);
			$table->boolean('completed');
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
        Schema::dropIfExists('user_lesson');
    }
}
