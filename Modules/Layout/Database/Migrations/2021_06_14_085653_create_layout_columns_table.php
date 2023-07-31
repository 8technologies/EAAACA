<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_columns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('layout_row_id')->unsigned();
            $table->string('width')->nullable();
            $table->integer('position')->nullable();
            $table->json('styles')->nullable();
            $table->json('attributes')->nullable();
            $table->string('css_classes', 2025)->nullable();
            $table->string('css_styles', 2025)->nullable();
            $table->json('settings')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('layout_row_id')->references('id')->on('layout_rows')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_columns');
    }
}
