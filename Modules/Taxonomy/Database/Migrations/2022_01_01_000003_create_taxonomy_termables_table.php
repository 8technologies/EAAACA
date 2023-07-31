<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyTermablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy_termables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('taxonomy_term_id')->unsigned();
            $table->string('taxonomy_termable_type');
            $table->bigInteger('taxonomy_termable_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index('taxonomy_termable_id');
            $table->foreign('taxonomy_term_id')->references('id')->on('taxonomy_terms')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomy_termables');
    }
}
