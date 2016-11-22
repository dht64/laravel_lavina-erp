<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('human_id')->unsigned()->index();
            $table->integer('basic_salary')->unsigned()->default(0);
            $table->string('nondeduct_leave')->nullable();
            $table->string('deduct_leave')->nullable();
            $table->integer('change')->default(0);
            $table->date('dates')->default(date("Y-m-01"));
            $table->integer('total')->unsigned()->default(0);
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
        Schema::drop('salaries');
    }
}
