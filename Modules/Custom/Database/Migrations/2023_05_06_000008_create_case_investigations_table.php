<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseInvestigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_investigations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('case_id')->unsigned();
            $table->bigInteger('assigned_contributor_id')->unsigned();
            $table->dateTime('assigned_on');
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('case_id')->references('id')->on('cases')->onDelete('restrict');
            $table->foreign('assigned_contributor_id')->references('id')->on('case_contributors')->onDelete('restrict');
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
        Schema::dropIfExists('case_investigations');
    }
}
