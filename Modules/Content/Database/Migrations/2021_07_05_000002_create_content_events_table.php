<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('starting_date')->nullable();
            $table->dateTime('ending_date')->nullable();
            $table->text('location');
            $table->text('body')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->json('metatags')->nullable();
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
        Schema::dropIfExists('content_events');
    }
}
