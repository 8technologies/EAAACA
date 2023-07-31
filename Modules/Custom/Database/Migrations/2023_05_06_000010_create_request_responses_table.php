<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_responses', function (Blueprint $table) {
            $table->id();
            $table->text('response')->nullable();
            $table->bigInteger('information_request_id')->unsigned();
            $table->dateTime('date_of_response');

            $table->boolean('is_approved')->nullable();
            $table->dateTime('is_approved_on')->nullable();
            $table->bigInteger('is_approved_by_id')->unsigned()->nullable();
            
            $table->boolean('response_accepted')->nullable();
            $table->dateTime('response_accepted_on')->nullable();
            $table->bigInteger('response_accepted_by_id')->unsigned()->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('information_request_id')->references('id')->on('information_requests')->onDelete('restrict');
            $table->foreign('is_approved_by_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('response_accepted_by_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('request_responses');
    }
}
