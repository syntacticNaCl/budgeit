<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_transactions', function(Blueprint $table) {
            $table->integer('budget_id')->unsigned();
            $table->foreign('budget_id')
                ->references('id')
                ->on('budgets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('transaction_id')->unsigned();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
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
        Schema::table('budget_transactions', function(Blueprint $table) {
            $table->dropForeign(['budget_id']);
            $table->dropForeign(['transaction_id']);
        });

        Schema::dropIfExists('budget_transactions');
    }
}
