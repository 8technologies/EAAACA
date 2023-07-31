<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_coordinators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('case_id')->unsigned();
            $table->bigInteger('contact_point_id')->unsigned();
            $table->boolean('is_inactive')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('case_id')->references('id')->on('cases')->onDelete('restrict');
            $table->foreign('contact_point_id')->references('id')->on('contact_points')->onDelete('restrict');
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
        Schema::dropIfExists('case_coordinators');
    }
}
