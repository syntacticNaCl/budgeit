<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_tags', function (Blueprint $table) {
            $table->integer('budget_id')->unsigned();
            $table->foreign('budget_id')
                ->references('id')
                ->on('budgets')
                ->ondelete('cascade');

            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_tags', function (Blueprint $table) {
            $table->dropForeign('budget_id');
            $table->dropForeign('tag_id');
        });

        Schema::dropIfExists('budget_tags');
    }
}
