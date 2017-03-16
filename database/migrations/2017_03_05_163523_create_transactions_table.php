<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->string('type'); // cash, check, credit. debit, etc
            $table->string('location'); // location it was tendered
            $table->date('date');

            $table->integer('budget_items_id')->unsigned();
            $table->foreign('budget_items_id')
                ->references('id')
                ->on('budget_items')
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
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign(['budget_items_id']);
        });

        Schema::dropIfExists('transactions');
    }
}
