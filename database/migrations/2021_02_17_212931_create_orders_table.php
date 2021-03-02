<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->string('name', 100);
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('date_delivery')->nullable()->comment('Дата доставки');
            $table->string('time_delivery')->nullable()->comment('Время доставки');
            $table->tinyInteger('pay_type')->comment('Тип оплаты'); // Тип оплаты
            $table->unsignedBigInteger('user_id')->nullable();

            $table->integer('total');
            $table->text('comment')->nullable();
            $table->integer('status')->defalut(0);
            $table->double('delivery_cost')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
