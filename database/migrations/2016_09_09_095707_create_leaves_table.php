<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('leaves', function(Blueprint $table){
            $table->increments('id');
            $table->integer('human_id')->unsigned()->index();
            $table->tinyInteger('annual_leave')->unsigned()->default(10);
            $table->tinyInteger('avai_annual_leave')->unsigned()->default(10);
            $table->smallInteger('unpaid_leave')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('human_id')->references('id')->on('humans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('leaves');
    }
}
