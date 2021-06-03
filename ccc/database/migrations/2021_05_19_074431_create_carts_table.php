<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->decimal('total',10,2)->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->unsignedBigInteger('paymentId');
            $table->unsignedBigInteger('shippingId');
            $table->decimal('shippingAmount',10,2)->default(0);
            $table->timestamps();
            $table->foreign('shippingId')->references('id')->on('shippings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customerId')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('paymentId')->references('id')->on('payments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
