<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->string('status');

            $table->float('amount');

            $table->integer('currency_id')->unsigned();
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('cascade');

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
        Schema::table('budgets', function(Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['currency_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('budgets');
    }
}
