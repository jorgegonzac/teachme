<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
			$table->text('description');
			$table->integer('lesson_id')->unsigned()->nullable();
			$table->foreign('lesson_id')->references('id')->on('lessons');
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
        Schema::dropIfExists('tests');
    }
}
