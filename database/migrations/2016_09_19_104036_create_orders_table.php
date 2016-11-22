<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->boolean('vat');
            $table->decimal('total_cost', 10, 2)->unsigned();
            $table->text('note')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('submit')->default(0);
            $table->boolean('deliver')->default(0);
            $table->timestamp('delivery_at');
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
        Schema::drop('orders');
    }
}
