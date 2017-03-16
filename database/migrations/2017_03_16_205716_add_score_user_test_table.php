<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoreUserTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_test', function (Blueprint $table) {
			$table->decimal('score', 5, 2);
			$table->boolean('completed')->default(false);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('user_test', function (Blueprint $table) {
			$table->dropColumn('score');
			$table->dropColumn('completed');
		});
    }
}
