<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalCommunicationablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_communicationables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('internal_communication_id')->unsigned();
            $table->string('internal_communicationable_type');
            $table->bigInteger('internal_communicationable_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index('internal_communicationable_id');
            $table->foreign('internal_communication_id')->references('id')->on('internal_communications')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_communicationables');
    }
}
