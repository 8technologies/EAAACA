<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseFindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_findings', function (Blueprint $table) {
            $table->id();
            $table->text('findings')->nullable();
            $table->bigInteger('case_investigation_id')->unsigned();
            $table->dateTime('date_of_submission');
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('case_investigation_id')->references('id')->on('case_investigations')->onDelete('restrict');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
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
        Schema::dropIfExists('case_findings');
    }
}
