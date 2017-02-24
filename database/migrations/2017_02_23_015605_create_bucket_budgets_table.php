<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucketBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucket_budgets', function (Blueprint $table) {
            $table->integer('bucket_id')->unsigned();
            $table->foreign('bucket_id')
                ->references('id')
                ->on('buckets')
                ->onDelete('cascade');

            $table->integer('budget_id')->unsigned();
            $table->foreign('budget_id')
                ->references('id')
                ->on('budgets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bucket_budgets', function(Blueprint $table) {
            $table->dropForeign(['bucket_id']);
            $table->dropForeign(['budget_id']);
        });

        Schema::dropIfExists('bucket_budgets');
    }
}
