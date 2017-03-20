<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateBudgetGroupBudgetItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_group_budget_item', function(Blueprint $table) {
            $table->integer('budget_item_id')->unsigned();
            $table->foreign('budget_item_id')
                ->references('id')
                ->on('budget_items')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('budget_group_id')->unsigned();
            $table->foreign('budget_group_id')
                ->references('id')
                ->on('budget_groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_group_budget_item', function(Blueprint $table) {
            $table->dropForeign(['budget_item_id']);
            $table->dropForeign(['budget_group_id']);
        });

        Schema::dropIfExists('budget_group_budget_item');
    }
}
