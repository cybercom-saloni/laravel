<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('addressId');
            $table->unsignedBigInteger('orderId');
            $table->string('address');
            $table->string('area');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('country');
            $table->string('addressType');
            $table->timestamps();
            $table->foreign('addressId')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
