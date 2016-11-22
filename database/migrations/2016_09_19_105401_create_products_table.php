<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('material_id')->unsigned();
            $table->decimal('cost', 5, 2)->unsigned();
            $table->tinyInteger('vat_rate')->default(5);
            $table->integer('unit_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(0);
            $table->integer('extra')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
