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
            $table->integer('customer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('vat');
            $table->decimal('total_cost', 10, 2)->unsigned()->default(0);
            $table->text('note')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('submit')->default(0);
            $table->boolean('deliver')->default(0);
            $table->date('delivery_at');
            $table->timestamps();
            $table->softDeletes();
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
