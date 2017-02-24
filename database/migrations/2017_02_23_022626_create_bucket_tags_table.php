<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucketTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucket_tags', function (Blueprint $table) {
            $table->integer('bucket_id')->unsigned();
            $table->foreign('bucket_id')
                ->references('id')
                ->on('buckets')
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
        Schema::table('bucket_tags', function (Blueprint $table) {
            $table->dropForeign('bucket_id');
            $table->dropForeign('tag_id');
        });

        Schema::dropIfExists('bucket_tags');
    }
}
