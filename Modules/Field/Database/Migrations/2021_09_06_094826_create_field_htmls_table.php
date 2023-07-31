<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldHtmlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_htmls', function (Blueprint $table) {
            $table->id();
            $table->morphs('fieldable');
            $table->mediumText('body');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('position')->nullable();
            $table->json('styles')->nullable();
            $table->json('attributes')->nullable();
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
        Schema::dropIfExists('field_htmls');
    }
}
