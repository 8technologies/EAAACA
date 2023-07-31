<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaVideoablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_videoables', function (Blueprint $table) {
            $table->bigInteger('media_video_id')->unsigned();
            $table->bigInteger('media_videoable_id');
            $table->string('media_videoable_type');

            $table->foreign('media_video_id')->references('id')->on('media_videos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_videoables');
    }
}
