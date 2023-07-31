<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_links', function (Blueprint $table) {
            $table->id();
            $table->morphs('fieldable');
            $table->string('link');
            $table->text('link_text')->nullable();
            // $table->set('apply_link_to', array('wrap', 'title', 'image', 'text', 'link_text'));
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
        Schema::dropIfExists('field_links');
    }
}
