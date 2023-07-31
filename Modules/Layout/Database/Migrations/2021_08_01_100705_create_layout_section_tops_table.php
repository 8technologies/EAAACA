<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutSectionTopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_section_tops', function (Blueprint $table) {
            $table->id();
            $table->morphs('fieldable');
            // $table->integer('col_width')->nullable();
            $table->integer('position')->nullable();
            $table->json('styles', 2025)->nullable();
            $table->json('attributes', 2025)->nullable();
            $table->string('css_classes', 2025)->nullable();
            $table->string('css_styles', 2025)->nullable();
            $table->json('settings')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('layout_section_tops');
    }
}
